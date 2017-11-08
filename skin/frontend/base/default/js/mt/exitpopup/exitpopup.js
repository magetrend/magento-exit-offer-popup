var exitPopup = (function($) {

    var isOpenFlag = false;

    var processingFlag = false;

    var lastTopPositionFlag = 0;

    var config ={
        subscriptionProcessUrl: '',
        popupSelector: '#mteo_popup_bg_layer',
        popupContentSelector: '#mteo_popup_content',
        popupCloseSelector: '.mteo-close',
        layerClose: false,
        cookieLifeTime: 3,
        showInLast: true,
        autoPosition: true,
        emailFieldSelector: '#mteo_email',
        submitButtonSelector: '#mteo_submit',
        errorMsgSelector: '#mteo_msg_error',
        successMsgSelector: '#mteo_subscription_success',
        successMsgWithCouponSelector: '#mteo_subscription_success_with_coupon',
        subscriptionFormSelector: '#mteo_subcription_form',
        couponSelector: '#mteo_coupon',
        couponCodeSelector: '#mteo_coupon span',
        translate: {}
    };

    var init = function(options) {
        $.extend(config, options );

        initEvents();
        countTab(1);
    };

    var initEvents = function() {

        $(document).on('mouseleave', function (e){
            if( e.clientY < 0 )  {
                initPopup();
            }
        });

        if (config.layerClose) {
            $(config.popupSelector).click(function(e) {
                if ('#'+e.target.id == config.popupSelector) {
                    popupClose();
                }
            });
        }

        $(config.popupCloseSelector).click(function() {
            popupClose();
        });

        $(window).unload(function(){
            countTab(-1);
        });
    };

    var initPopup = function () {
        if (config.showInLast == true && getTabCounter() > 1) {
            return false;
        }

        if (!getCookie(config.cookieName)) {
            popupOpen();
            setCookie(config.cookieName, true);
        }

        $(config.emailFieldSelector).keypress(function (e) {
            if (e.which == 13) {
                $(config.submitButtonSelector).trigger('click');
                return false;
            }
        });

        $(config.submitButtonSelector).click(function () {
            if (!validateSubscriptionForm()) {
                return false;
            }
            hideErrorMsg();
            processSubscription();
        });

        $(config.popupCloseSelector).click(function(e){
            e.preventDefault();
            popupClose();
        });

        if (config.autoPosition) {
            $(document).scroll(function() {
                eventScrollPopup();
            });

            $(window).resize(function() {
                eventResizePopup();
            });
        }


    };

    var processSubscription = function() {
        if (!startProcess()) {
            return;
        }
        showLoading();
        var data = getSubscriptionFormData();

        $.ajax({
            url: config.subscriptionProcessUrl,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(responseData) {
                if (responseData.errorMsg) {
                    showErrorMsg(responseData.errorMsg);
                } else {
                    hideSubscriptionForm();
                    if (responseData.couponCode && $(config.couponSelector).length > 0) {
                        showSuccessMsg(responseData.successMsg, responseData.couponCode);
                    } else {
                        showSuccessMsg(responseData.successMsg);
                        setTimeout(function() {
                            popupClose();
                        }, 6000);
                    }
                }
                hideLoading();
                endProcess();
            }
        });
    };

    var getSubscriptionFormData = function() {
        var data = {
            'email':  $(config.emailFieldSelector).val()
        };

        $('.mteo-additional-field').each(function() {
            var name = $(this).attr('name');
            if ($(this).attr('type') == 'checkbox' && !$(this).is(':checked')) {
                data[name] = 0;
            } else {
                data[name] = $(this).val();
            }
        });

        return data;
    };

    var validateSubscriptionForm = function() {
        var error = 0;

        var fieldList = $('.mt-validator-required');

        for (var i = fieldList.length - 1; i >= 0; i--) {
            var field = $(fieldList[i]);
            if (field.val().length == 0 || field.data('field-name') == field.val()) {
                showErrorMsg(translate('Field')+ ' "'+field.data('field-name')+'" '+translate('is_required'));
                error = 1;
            } else if (field.is(':checkbox') && field.is(':checked') == false) {
                showErrorMsg(translate('Field')+ ' "'+field.data('field-name')+'" '+translate('must_be_checked'));
                error = 1;
            }
        }

        if (error == 0) {
            $('.mt-validator-email').each(function() {
                var field = $(this);
                var tmp = field.val().split('@');
                if (tmp.length < 2 || tmp[1].split('.').length < 2) {
                    showErrorMsg(translate('error_email_not_valid'));
                    error = 1;
                }
            });
        }

        return error == 0;
    };

    var translate = function($key) {
        if (config.translate[$key]) {
            return config.translate[$key];
        }
        return $key;
    };

    var showSuccessMsg = function(msg, couponCode) {
        hideErrorMsg();
        if (couponCode) {
            $(config.successMsgWithCouponSelector+' #mteo_msg_success').html(msg);
            $(config.successMsgWithCouponSelector+' #mteo_coupon_code span').html(couponCode);
            $(config.successMsgWithCouponSelector).show();
        } else {
            $(config.successMsgSelector+' .mteo-success-msg').html(msg);
            $(config.successMsgSelector).show();
        }
    };

    var hideSuccessMsg = function() {
        $(config.successMsgSelector).hide();
        $(config.successMsgWithCouponSelector).hide();
    };

    var showErrorMsg = function(msg) {
        hideSuccessMsg();
        $(config.errorMsgSelector).html(msg).css('display', 'inline-block');
    };

    var hideErrorMsg = function() {
        $(config.errorMsgSelector).hide();
    };


    var startProcess = function() {
        if (processingFlag == true)
            return false;
        processingFlag = true;
        return true;
    };

    var endProcess = function() {
        processingFlag = false;
    };

    var showLoading = function() {
        $(config.submitButtonSelector).text(translate('wait'));
    };

    var hideLoading = function() {
        $(config.submitButtonSelector).text(translate('subscribe'));
    };

    var hideSubscriptionForm = function() {
        $(config.subscriptionFormSelector).hide();
    };

    var getTabCounter = function() {
        var openedTab = getCookie('tabCounter');
        if (!openedTab) {
            return 0;
        }
        return parseInt(openedTab);
    };

    var countTab = function(val) {
        if (config.showInLast) {
            var openedTab = getCookie('tabCounter');
            if (!openedTab || openedTab < 0) {
                openedTab = 0;
            } else {
                openedTab = parseInt(openedTab);
            }
            setCookie('tabCounter', (openedTab+val), true);
        }
    };

    var popupOpen = function () {
        if (!isOpenFlag) {
            $(config.popupSelector).css('height', $(document).height()+'px').show();
            $(config.popupContentSelector).css('margin-top', getTopPositionPopup()+'px');
            isOpenFlag = true;
        }
    };

    var popupClose = function () {
        if (isOpenFlag) {
            $(config.popupSelector).fadeOut();
            isOpenFlag = false;
        }
    };

    var getTopPositionPopup = function() {
        var popupBox = $(config.popupContentSelector);
        var scrollTop = jQuery(document).scrollTop();
        var windowH = jQuery(window).height();
        var boxH = popupBox.height();
        var boxTop = 0;
        if (windowH <= boxH) {
            boxTop = scrollTop;
        } else {
            boxTop = scrollTop + ((windowH - boxH ) /2);
        }
        return boxTop;
    };

    var eventScrollPopup = function()
    {
        var popupBox = $(config.popupContentSelector);
        var windowH = $(window).height();
        var boxH = popupBox.height();
        var scrollTop = $(document).scrollTop();
        var diff = Math.abs(lastTopPositionFlag - scrollTop);
        if (windowH <= boxH) {
            return;
        }

        if (diff > 20
            || scrollTop == 0
            || scrollTop + $(window).height() == $(document).height()
        ) {
            lastTopPositionFlag = scrollTop;
            popupBox.css('margin-top', getTopPositionPopup()+'px');
        }
    };

    var eventResizePopup = function() {
        var popupBox = $(config.popupContentSelector);
        var windowH = $(window).height();
        var boxH = popupBox.height();
        if (windowH <= boxH) {
            return;
        }
        popupBox.css('margin-top', getTopPositionPopup()+'px');
    };

    var setCookie = function(key, value, session) {

        var now = new Date();
        var time = now.getTime();
        time += 3600 * 1000 *24 * config.cookieLifeTime;
        now.setTime(time);
        if (session && session == true) {
            var expires = "; expires="+0;
        } else {
            var expires = "; expires="+now.toUTCString();
        }
        document.cookie = escape(key)+"="+escape(value)+expires+"; path=/";
    };

    var getCookie = function(key) {
        var nameEQ = escape(key) + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return unescape(c.substring(nameEQ.length,c.length));
        }
        return null;
    };

    return {
        init: init
    }
})(jQuery);
jQuery.noConflict();