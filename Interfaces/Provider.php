<?php
/**
 * Generic interface for content providers.
 *
 * @author Janek Bevendorff
 * @package Pfb::Interfaces
 * @since 0.1
 */
interface Pfb_Interfaces_Provider
{
    /**
     * @since 0.1
     * @param string $source
     */
    public function setObjectSource($source);
    
    /**
     * @since 0.1
     * @param string $requestMethod
     */
    public function requestObject($requestMethod);
    
    /**
     * @since 0.1
     * @param int $time
     */
    public function setCacheTime($time);
    
    /**
     * @since 0.1
     */
    public function getCacheTime();
}