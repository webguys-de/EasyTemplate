<?php

class Webguys_Easytemplate_Test_Model_GroupTest
    extends EcomDev_PHPUnit_Test_Case
{

    public function testLoadAndSave()
    {
        $model = Mage::getModel('easytemplate/group');

        $model->setEntityType('Test');
        $model->save();

        $id = $model->getId();
        $model = Mage::getModel('easytemplate/group');
        $model->load( $id );
        $this->assertEquals('Test', $model->getEntityType() );

        $model->delete();
        $model = Mage::getModel('easytemplate/group');
        $model->load( $id );
        $this->assertNotEquals( $id, $model->getId() );

    }

}