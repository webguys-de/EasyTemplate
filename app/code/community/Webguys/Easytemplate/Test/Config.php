<?php

class Webguys_Easytemplate_Test_Config extends EcomDev_PHPUnit_Test_Case_Config
{

    public function testModelAlias()
    {
        $this->assertModelAlias('easytemplate/block', 'Webguys_Easytemplate_Block_Block' );
    }

}