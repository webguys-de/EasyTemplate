<?php

namespace Webguys\Easytemplate\Model\Data;

class Varchar extends DataAbstract
{

    protected function _construct()
    {
        $this->_init('Webguys\Easytemplate\Model\ResourceModel\Data\Varchar');
    }

    protected function getInitEventPrefix()
    {
        return 'easytemplate_data_varchar';
    }

    public function isValid()
    {
        return (strlen($this->getValue()) <= 255);
    }

}