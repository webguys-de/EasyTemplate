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
        '/config/group' => 'code',
        '/config/group/templates/template' => 'code',
        '/config/group/templates/template/fields' => 'code',
    ];
}
