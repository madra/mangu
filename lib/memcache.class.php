<?php

#doc
#    classname:    Memcache
#    scope:        PUBLIC
#
#/doc

class memcache
{
    #    internal variables

    #    Constructor


    var $iTtl = MEMCACHE_TTL; // Time To Live
    var $bEnabled = false; // Memcache enabled or installed on server?
    var $oCache = null;

    function __construct ()
    {
        # code...
         if (class_exists('Memcached')) {
            $this->oCache = new Memcached();
            $this->bEnabled = true;
            if (! $this->oCache->addServer(MEMCACHE_HOST, 11211))  { // Instead 'localhost' here can be IP
                $this->oCache = null;
                $this->bEnabled = true;
            }
        }

    }
    ###


     // get data from cache server
    public function getData($sKey) {
         $sKey = $this->format_key($sKey);
        $vData = $this->oCache->get($sKey);
        return false === $vData ? null : $vData;
    }

    // save data to cache server
    function setData($sKey, $vData) {
         $sKey = $this->format_key($sKey);
        //Use MEMCACHE_COMPRESSED to store the item compressed (uses zlib).
        return $this->oCache->set($sKey, $vData,$this->iTtl);
    }

    // delete data from cache server
    function delData($sKey) {
        $sKey = $this->format_key($sKey);
        return $this->oCache->delete($sKey);
    }

    function format_key($key)
    {
    $key = md5($key);    
   // util::pre($key);    
    return $key;    
    }

}
###

?>

