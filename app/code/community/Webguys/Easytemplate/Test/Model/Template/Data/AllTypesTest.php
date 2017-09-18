<?php

class Webguys_Easytemplate_Test_Model_Template_Data_AllTypesTest extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @dataProvider Webguys_Easytemplate_Test_Provider_Datatypes::get
     */

    /*
    TODO
    public function testLoadAndSave( $type )
    {
        $l_type = strtolower($type);

        $model = Mage::getModel('easytemplate/template_data_'.$l_type );

        $model->setField('Test');
        $model->save();

        $id = $model->getId();
        $model = Mage::getModel('easytemplate/template_data_'.$l_type );
        $model->load( $id );
        $this->assertEquals('Test', $model->getField() );

        $model->delete();
        $model = Mage::getModel('easytemplate/template_data_'.$l_type );
        $model->load( $id );
        $this->assertNotEquals( $id, $model->getId() );

    }
    */

    public function testDummy()
    {
        $this->assertTrue(true);
    }
}
