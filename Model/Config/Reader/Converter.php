<?php

namespace Webguys\Easytemplate\Model\Config\Reader;

use \Webguys\Easytemplate\Model\Config\Reader\Data\Template AS DataTemplate;
use \Webguys\Easytemplate\Model\Config\Reader\Data\Field AS DataField;
use \Webguys\Easytemplate\Model\Config\Reader\Data\Group AS DataGroup;
use \Webguys\Easytemplate\Model\Config\Reader\Data\Backend AS DataFrontend;
use \Webguys\Easytemplate\Model\Config\Reader\Data\Frontend AS DataBackend;

class Converter implements \Magento\Framework\Config\ConverterInterface
{
    /**
     * Convert dom node tree to array
     *
     * @param \DOMDocument $source
     * @return array
     */
    public function convert($source)
    {
        $result = array();

        $groups = $source->getElementsByTagName('group');
        foreach ($groups as $group) {
            /** @var \DOMNode $group */

            if ($group->hasChildNodes()) {
                $result[] = DataGroup::xmlFactory($group);
            }
        }

        return $result;
    }

}
