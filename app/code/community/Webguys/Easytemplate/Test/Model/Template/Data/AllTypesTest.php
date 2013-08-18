<?php

class Webguys_Easytemplate_Test_Model_Template_Data_AllTypesTest
    extends EcomDev_PHPUnit_Test_Case
{

    /**
     * @dataProvider Webguys_Easytemplate_Test_Provider_Datatypes::get
     */
    public function testLoadAndSave( $type )
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