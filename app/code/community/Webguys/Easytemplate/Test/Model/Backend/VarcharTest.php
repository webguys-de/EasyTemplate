<?php

class Webguys_Easytemplate_Test_Model_Backend_VarcharTest
    extends EcomDev_PHPUnit_Test_Case
{

    public function testLoadAndSave()
    {
        $model = Mage::getModel('easytemplate/template_data_varchar' );

        $model->setField('Test');
        $model->save();

        $id = $model->getId();
        $model = Mage::getModel('easytemplate/template_data_varchar' );
        $model->load( $id );
        $this->assertEquals('Test', $model->getField() );

        $model->delete();
        $model = Mage::getModel('easytemplate/template_data_varchar' );
        $model->load( $id );
        $this->assertNotEquals( $id, $model->getId() );

    }

}