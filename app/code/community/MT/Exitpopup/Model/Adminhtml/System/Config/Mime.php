<?php

class MT_Exitpopup_Model_Adminhtml_System_Config_Mime
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'application/pdf', 'label'=> '.pdf'),
            array('value' => 'application/zip', 'label'=> '.zip'),
            array('value' => 'image/jpeg', 'label'=> '.jpg'),
            array('value' => 'image/png', 'label'=> '.png'),
            array('value' => 'image/gif', 'label'=> '.gif'),
        );
    }
}