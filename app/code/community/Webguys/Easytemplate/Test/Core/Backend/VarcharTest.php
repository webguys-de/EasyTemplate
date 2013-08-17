<?php

class Webguys_Easytemplate_Test_Core_Backend_VarcharTest
    extends EcomDev_PHPUnit_Test_Case
{

    public function testLoadAndSave()
    {
        $model = Mage::getModel('easytemplate/backend_varchar' );

        $model->setName('Test');
        $model->save();

        $id = $model->getId();
        $model = Mage::getModel('easytemplate/backend_varchar' );
        $model->load( $id );
        $this->assertEquals('Test', $model->getName() );

        $model->delete();
        $model = Mage::getModel('easytemplate/backend_varchar' );
        $model->load( $id );
        $this->assertNotEquals( $id, $model->getId() );

    }

}