<?php

#doc
#    classname:    Memcache
#    scope:        PUBLIC
#
#/doc

class MemcachedWrapper
{
    #    internal variables

    #    Constructor


    var $iTtl = MEMCACHE_TTL; // Time To Live
    var $bEnabled = false; // Memcache enabled or installed on server?
    var $oCache = null;

    function __construct ()
    {
        # code...
         if (class_exists('Memcache')) {
            $this->oCache = new Memcache();
            $this->bEnabled = true;
            if (! $this->oCache->connect(MEMCACHE_HOST, 11211))  { // Instead 'localhost' here can be IP
                $this->oCache = null;
                $this->bEnabled = true;
            }
        }
    }
    ###


     // get data from cache server
    public function getData($sKey) {
        $vData = $this->oCache->get($sKey);
        return false === $vData ? null : $vData;
    }

    // save data to cache server
    function setData($sKey, $vData) {
        //Use MEMCACHE_COMPRESSED to store the item compressed (uses zlib).
        return $this->oCache->set($sKey, $vData, 0, $this->iTtl);
    }

    // delete data from cache server
    function delData($sKey) {
        return $this->oCache->delete($sKey);
    }

}
###

?>

