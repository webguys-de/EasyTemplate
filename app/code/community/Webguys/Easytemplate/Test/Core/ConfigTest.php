<?php

class Webguys_Easytemplate_Test_Core_ConfigTest extends EcomDev_PHPUnit_Test_Case_Config
{

    public function testModelAlias()
    {
        $this->assertModelAlias('easytemplate/backend_varchar', 'Webguys_Easytemplate_Model_Backend_Varchar' );
    }

    public function testResourceAlias()
    {
        $this->assertResourceModelAlias('easytemplate/backend_varchar', 'Webguys_Easytemplate_Model_Resource_Backend_Varchar' );
    }

    public function testBlockAlias()
    {
        $this->assertBlockAlias('easytemplate/block', 'Webguys_Easytemplate_Block_Block' );
    }

}