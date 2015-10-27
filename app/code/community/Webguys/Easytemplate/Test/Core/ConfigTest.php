<?php

class Webguys_Easytemplate_Test_Core_ConfigTest extends EcomDev_PHPUnit_Test_Case_Config
{

    /**
     * @dataProvider Webguys_Easytemplate_Test_Provider_Datatypes::get
     */
    public function testBackendType($type)
    {
        $l_type = strtolower($type);
        $u_type = ucfirst($l_type);

        $this->assertModelAlias(
            'easytemplate/template_data_' . $l_type,
            'Webguys_Easytemplate_Model_Template_Data_' . $u_type
        );
        $this->assertResourceModelAlias(
            'easytemplate/template_data_' . $l_type,
            'Webguys_Easytemplate_Model_Resource_Template_Data_' . $u_type
        );

        /** @var $model Webguys_Easytemplate_Model_Backend_Varchar */
        $model = Mage::getModel('easytemplate/template_data_' . $l_type);
        $this->assertInstanceOf('Webguys_Easytemplate_Model_Template_Data_' . $u_type, $model);

        $resource = $model->getResource();
        $this->assertInstanceOf('Webguys_Easytemplate_Model_Resource_Template_Data_' . $u_type, $resource);

        $resourceCollection = $model->getResourceCollection();
        $this->assertInstanceOf(
            'Webguys_Easytemplate_Model_Resource_Template_Data_' . $u_type . '_Collection',
            $resourceCollection
        );

    }

    public function testBlockAlias()
    {
        $this->assertBlockAlias('easytemplate/block', 'Webguys_Easytemplate_Block_Block');
    }

}