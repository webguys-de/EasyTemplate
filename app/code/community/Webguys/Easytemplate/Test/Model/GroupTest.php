<?php

class Webguys_Easytemplate_Test_Model_GroupTest extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @return Webguys_Easytemplate_Model_Group
     */
    protected function getModel()
    {
        return Mage::getModel('easytemplate/group');
    }

    public function testLoadAndSave()
    {
        $model = $this->getModel();

        $model->setEntityType('Test');
        $model->save();
        $id = $model->getId();

        $model = $this->getModel();
        $model->load($id);
        $this->assertEquals('Test', $model->getEntityType());
        $model->delete();

        $model = $this->getModel();
        $model->load($id);
        $this->assertNotEquals($id, $model->getId());
    }

    public function testRoundtrip()
    {
    }

    public function testGetTemplateCollection()
    {
        $model = $this->getModel();
        $collection = $model->getTemplateCollection();
        $this->assertInstanceOf('Webguys_Easytemplate_Model_Resource_Template_Collection', $collection);
    }
}
