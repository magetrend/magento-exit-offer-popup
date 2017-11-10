<?php

class MT_Exitpopup_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getExtensionVersion()
    {
        return (string) Mage::getConfig()->getNode()->modules->MT_Exitpopup->version;
    }

    public function isMobile()
    {
        $isMobile = '0';
        $request = Mage::app()->getRequest();
        $userAgent = $request->getServer('HTTP_USER_AGENT', false);
        $httpAccept = $request->getServer('HTTP_ACCEPT', false);
        $httpXWapProfile = $request->getServer('HTTP_X_WAP_PROFILE', false);
        $httpProfile = $request->getServer('HTTP_PROFILE', false);
        $allHttp = $request->getServer('ALL_HTTP', false);

        if ($userAgent
            && preg_match(
                '/(android|up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i',
                strtolower($userAgent)
            )
        ) {
            $isMobile = 1;
        }

        if ($httpAccept) {
            if ((strpos(strtolower($httpAccept), 'application/vnd.wap.xhtml+xml') !== false)
                || (($httpXWapProfile || $httpProfile))
            ) {
                $isMobile = 1;
            }
        }

        if ($userAgent) {
            $mobileUa = strtolower(substr($userAgent, 0, 4));
            $mobileAgents = array(
                'w3c ','acs-','alav','alca','amoi','andr','audi','avan','benq','bird','blac','blaz','brew',
                'cell','cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java','jigs','kddi','keji',
                'leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto',
                'mwbp','nec-','newt','noki','oper','palm','pana','pant','phil','play','port','prox','qwap',
                'sage','sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal','smar',
                'sony','sph-','symb','t-mo','teli','tim-','tosh','tsm-','upg1','upsi','vk-v','voda','wap-',
                'wapa','wapi','wapp','wapr','webc','winw','winw','xda','xda-'
            );

            if (in_array($mobileUa, $mobileAgents)) {
                $isMobile = 1;
            }
        }

        if ($allHttp) {
            if (strpos(strtolower($allHttp), 'OperaMini') !== false) {
                $isMobile = 1;
            }
        }

        if ($userAgent) {
            if (strpos(strtolower($userAgent), 'windows') !== false) {
                $isMobile = 0;
            }
        }

        return $isMobile;
    }

    public function translate($key)
    {
        return Mage::getStoreConfig('exitpopup/translate/'.$key);
    }
}