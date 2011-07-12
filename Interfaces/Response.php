<?php
/**
 * Generic interface for response methods. Use this for implementing new response methods.
 *
 * @author Janek Bevendorff
 * @package Pfb::Interfaces
 * @since 0.1
 */
interface Pfb_Interfaces_Response
{
    /**
     * @since 0.1
     * @param string $status
     */
    public function setStatus($status);
    
    /**
     * @since 0.1
     * @param string $name
     * @param string $value
     * @param bool $replace
     */
    public function addHeader($name, $value, $replace = false);
    
    /**
     * @since 0.1
     * @param string $output
     */
    public function write($output);
    
    /**
     * @since 0.1
     */
    public function hasUnflushedContents();
    
    /**
     * @since 0.1
     */
    public function flush();
}