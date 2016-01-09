<?php

namespace Webguys\Easytemplate\Model\Config;

class Reader extends \Magento\Framework\Config\Reader\Filesystem
{
    /**
     * List of identifier attributes for merging
     *
     * @var array
     */
    protected $_idAttributes = [
        '/config/group' => 'id',
        '/config/group/templates/template' => 'id',
        '/config/group/templates/template/fields' => 'id',
    ];
}
