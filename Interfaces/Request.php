<?php

/**
 * Generic interface for request methods. use this for implementing new request methods.
 *
 * @author Janek Bevendorff
 * @package Pfb::Interfaces
 * @since 0.1
 */
interface Pfb_Interfaces_Request
{
    /**
     * @since 0.1
     * @param string $name
     */
    public function hasParam($name);
    
    /**
     * @since 0.1
     * @param string $name
     */
    public function getParam($name);
    
    /**
     * @since 0.1
     * @param string $name
     */
    public function getHeader($name);
    
    /**
     * @since 0.1
     */
    public function getProtocol();
    
    /**
     * @since 0.1
     **/
    public function getHost();
    
    /**
     * @since 0.1
     */
    public function getPath();
    
    /**
     * @since 0.1
     * @param bool $omitProtocol
     * @param bool $omitFileName
     */
    public function getUri($omitProtocol = false, $omitFileName = false);
}