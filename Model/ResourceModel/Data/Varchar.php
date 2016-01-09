<?php

namespace Webguys\Easytemplate\Model\ResourceModel\Data;

class Varchar extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('easytemplate_data_varchar', 'id');
    }

}
