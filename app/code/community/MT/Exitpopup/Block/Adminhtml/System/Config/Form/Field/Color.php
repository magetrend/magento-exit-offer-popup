<?php
class MT_Exitpopup_Block_Adminhtml_System_Config_Form_Field_Color extends Mage_Adminhtml_Block_System_Config_Form_Field {

    protected function _getElementHtml( Varien_Data_Form_Element_Abstract $element ) {
        $color = new Varien_Data_Form_Element_Text();
        $data = array(
            'name'      => $element->getName(),
            'html_id'   => $element->getId(),
        );
        $color->setData($data);
        $color->setValue($element->getValue());
        $color->setForm( $element->getForm() );
        $color->addClass($element->getClass() . ' color {required:false, adjust:false, hash:true}' );
        return $color->getElementHtml();
    }

}
