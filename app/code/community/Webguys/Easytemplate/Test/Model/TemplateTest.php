<?php

class Webguys_Easytemplate_Test_Model_TemplateTest extends EcomDev_PHPUnit_Test_Case
{
    public function testLoadAndSave()
    {
        $model = Mage::getModel('easytemplate/template');

        $model->setCode('Test');
        $model->save();

        $id = $model->getId();
        $model = Mage::getModel('easytemplate/template');
        $model->load($id);
        $this->assertEquals('Test', $model->getCode());

        $model->delete();
        $model = Mage::getModel('easytemplate/template');
        $model->load($id);
        $this->assertNotEquals($id, $model->getId());
    }
}
