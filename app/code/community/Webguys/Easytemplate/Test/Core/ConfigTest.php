<?php

class Webguys_Easytemplate_Test_Core_ConfigTest extends EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * @dataProvider Webguys_Easytemplate_Test_Provider_Datatypes::get
     */
    public function testBackendType($type)
    {
        $lType = strtolower($type);
        $uType = ucfirst($lType);

        $this->assertModelAlias('easytemplate/template_data_' . $lType, 'Webguys_Easytemplate_Model_Template_Data_' . $uType);
        $this->assertResourceModelAlias('easytemplate/template_data_' . $lType, 'Webguys_Easytemplate_Model_Resource_Template_Data_' . $uType);

        /** @var $model Webguys_Easytemplate_Model_Backend_Varchar */
        $model = Mage::getModel('easytemplate/template_data_' . $lType);
        $this->assertInstanceOf('Webguys_Easytemplate_Model_Template_Data_' . $uType, $model);

        $resource = $model->getResource();
        $this->assertInstanceOf('Webguys_Easytemplate_Model_Resource_Template_Data_' . $uType, $resource);

        $resourceCollection = $model->getResourceCollection();
        $this->assertInstanceOf('Webguys_Easytemplate_Model_Resource_Template_Data_' . $uType . '_Collection', $resourceCollection);
    }

    public function testBlockAlias()
    {
        $this->assertBlockAlias('easytemplate/block', 'Webguys_Easytemplate_Block_Block');
    }
}
