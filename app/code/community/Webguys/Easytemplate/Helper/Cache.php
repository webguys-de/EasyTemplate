<?php

/**
 * Class Webguys_Easytemplate_Helper_Cache
 *
 */
class Webguys_Easytemplate_Helper_Cache extends Mage_Core_Helper_Abstract
{
    const CACHE_TYPE = 'easytemplate';
    const CACHE_TAG = 'EASYTEMPLATE';

    public function cachingEnabled()
    {
        return Mage::app()->useCache(self::CACHE_TYPE);
    }

    /**
     * @return int|null|string
     */
    public function getCacheLifeTime()
    {
        if ($this->cachingEnabled()) {
            $cacheLifetime = Mage::getStoreConfig('easytemplate/configuration/cache_lifetime');
            if (!is_numeric($cacheLifetime)) {
                return null;
            }

            return $cacheLifetime * 60;
        }

        return null;
    }

    /**
     * Removes all cache information with easytemplate tags
     */
    public function flushCache()
    {
        if ($this->cachingEnabled()) {
            $cache = Mage::app()->getCache();
            $cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array(self::CACHE_TAG));
        }
    }
}
