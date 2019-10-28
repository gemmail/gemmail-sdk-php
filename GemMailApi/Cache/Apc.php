<?php
/**
 * This file contains the APC cache class used in the GemMailApi PHP-SDK.
 * 
 * @author Rapt Internet <rapt@rapt.com.br>
 * @link https://rapt.com.br/
 * @copyright 2017-2019 https://rapt.com.br/
 */
 
 
/**
 * GemMailApi_Cache_Apc makes use of the APC extension in order to cache data in memory.
 * 
 * As all the data will stay in memory, it is recommeded that will be used only if 
 * the system has enough memory, or for development/small servers.
 * 
 * @author Adnan Neser Junior <neser@rapt.com.br>
 * @package GemMailApi
 * @subpackage Cache
 * @since 1.0
 */
class GemMailApi_Cache_Apc extends GemMailApi_Cache_Abstract
{
    /**
     * Cache data by given key.
     * 
     * For consistency, the key will go through sha1() before it is saved.
     * 
     * This method implements {@link GemMailApi_Cache_Abstract::set()}.
     * 
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function set($key, $value)
    {
        return apc_store(sha1($key), $value, 0);
    }
    
    /**
     * Get cached data by given key.
     * 
     * For consistency, the key will go through sha1() 
     * before it will be used to retrieve the cached data.
     * 
     * This method implements {@link GemMailApi_Cache_Abstract::get()}.
     * 
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return apc_fetch(sha1($key));    
    }
    
    /**
     * Delete cached data by given key.
     * 
     * For consistency, the key will go through sha1() 
     * before it will be used to delete the cached data.
     * 
     * This method implements {@link GemMailApi_Cache_Abstract::delete()}.
     * 
     * @param string $key
     * @return bool
     */
    public function delete($key)
    {
        return apc_delete(sha1($key));
    }
    
    /**
     * Delete all cached data.
     * 
     * This method implements {@link GemMailApi_Cache_Abstract::flush()}.
     * 
     * @return bool
     */
    public function flush()
    {
        return apc_clear_cache('user');
    }
}