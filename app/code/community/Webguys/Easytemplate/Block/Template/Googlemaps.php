<?php

/**
 * Class Webguys_Easytemplate_Block_Template_Googlemaps
 *
 *
 */
class Webguys_Easytemplate_Block_Template_Googlemaps extends Webguys_Easytemplate_Block_Template
{
    public function getIFrameSrc()
    {
        preg_match('/< *iframe[^>]*src *= *["\']?([^"\']*)/i', $this->getMapUrl(), $iframe_matches);
        return $iframe_matches[1];
    }

    public function getIFrameLink()
    {
        preg_match('/<small>(.*)<\/small>/isU', $this->getMapUrl(), $iframe_link);
        return $iframe_link[1];
    }
}
