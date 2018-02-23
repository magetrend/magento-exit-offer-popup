<?php

class MT_Exitpopup_Block_Adminhtml_System_Config_Info
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $config = $this->getConfig();
        $version = Mage::helper('exitpopup')->getExtensionVersion();
        $html = '<h4>'.$config['name'].'. Version: <span style="color: #eb5e00">'.$version.'</span></h4>';
        $html .= '<div style="height: 40px"><a target="_blank"  style="margin-right: 10px; color: #494848; padding: 5px 10px; border: 1px solid #494848; text-decoration: none" href="'.$config['home'].'"/><b>Extension Page</b></a>'
            .'<a target="_blank" style="color: #494848; padding: 5px 10px; border: 1px solid #494848; text-decoration: none" href="'.$config['manual'].'"/><b>User Guide</b></a> </div>';

        $html .= '<p>You are using <span style="color: #eb5e00"><b>FREE</b></span> extension version.'
            .' Check it out, how many great features have <a  target="_blank" href="'.$config['paid_link'].'"/><span style="color: #eb5e00"><b>PRO</b></span></a> version!'
            .' <a style="margin: 0 0 0 10px; padding: 5px 10px; border: 1px solid #eb5e00; text-decoration: none" target="_blank" href="'.$config['compare'].'"><b>Compare</b></a></p>';
        $html .='<table border="0" style="padding-top: 5px"><tr>';
        $html .='<td><img src="'.$config['paid_img'].'" /></td>';
        $html .='<td style="padding: 0 0 0 20px"><div style="font-size: 16px; padding: 0 0 10px;"><b>'.$config['paid_name'].'</b></div>';
        $html .='<div style="height: 40px;"><a style="padding: 5px 10px; border: 1px solid #eb5e00; text-decoration: none" target="_blank" href="'.$config['paid_link'].'"><b>View Details</b></a>'
            .'<a style="margin: 0 0 0 10px; padding: 5px 10px; border: 1px solid #eb5e00; text-decoration: none" target="_blank" href="'.$config['paid_link'].'"><b>Get it Now</b></a></div>';
        $html .='<div><b>PRO version features</b></div>';
        $html .='<ul style="list-style: circle; padding-left: 16px;">';

        foreach ($config['features'] as $feature) {
            $html .='<li>'.$feature.'</li>';
        }


        $html .='</ul>';
        $html .='</td></tr></table>';
        return $this->_decorateRowHtml($element, $html);
    }


    public function getConfig()
    {
        return array(
            'name' => 'Exit Intent Popup (FREE)',
            'manual' => 'http://www.magetrend.com/exit-intent-popup-free/user-guide/?utm_source=m1epf',
            'home' => 'http://www.magetrend.com/exit-intent-popup-free/?utm_source=m1epf',
            'compare' => 'http://www.magetrend.com/exit-intent-popup-free/?utm_source=m1epf#compare',
            'paid_name' => 'Exit Intent Popup PRO',
            'paid_link' => 'http://www.magetrend.com/exit-intent-popup/?utm_source=m1epf',
            'paid_img' => 'http://magetrend.com/media/images/info/magento-exit-intent-popup.png',
            'features' => array(
                'Mobile Triggers',
                'Responsive',
                'Popup with Yes/No Buttons',
                'Popup with Contact Request Form',
                'Multi-Popups',
                'Different Popups On Different Pages',
                'Additional Fields',
                'Show Coupon Code Instantly',
                'Show on Page Load (Delay Time)',
                'FREE Support & Money Back Guarantee',
            )
        );
    }


}