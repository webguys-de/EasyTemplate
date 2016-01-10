<?php

namespace Webguys\Easytemplate\Model;

class Config
{
    const VIEW_MODE_DEFAULT = 'default';
    const VIEW_MODE_EASYTEMPLATE = 'easytemplate';

    protected $reader;

    function __construct(
        \Webguys\Easytemplate\Model\Config\Reader $reader
    )
    {
        $this->reader = $reader;
    }

    public function getViewModes() {
        return array(
            self::VIEW_MODE_DEFAULT => 'Default',
            self::VIEW_MODE_EASYTEMPLATE => 'EasyTemplate'
        );
    }

    /**
     * @return Config\Reader\Data\Group[];
     */
    public function getTemplateGroups()
    {
        return $this->reader->read();
    }

    /**
     * @param $id
     * @return Config\Reader\Data\Template|null
     */
    public function findTemplate( $id )
    {
        foreach( $this->getTemplateGroups() AS $group )
        {
            foreach( $group->getTemplates() AS $template )
            {
                if( $template->getId() == $id )
                {
                    return $template;
                }
            }
        }
        return null;
    }

}

