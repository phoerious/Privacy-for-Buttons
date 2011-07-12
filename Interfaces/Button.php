<?php
/**
 * Interface for buttons as returned by the button factory of
 * the server-side PHP API.
 *
 * @package Pfb::Interfaces
 * @author Janek Bevendorff
 * @since 0.1
 */
interface Pfb_Interfaces_Button
{
    /**
     * @since 0.1
     * @param string | array $nameOrDataArray
     * @param string $value
     */
    public function setParam($nameOrDAtaArray, $value);
    
    /**
     * @since 0.1
     * @param string $referenceUrl
     */
    public function init($referenceUrl);
    
    /**
     * @since 0.1
     */
    public function getButtonCode();
    
    /**
     * @since 0.1
     */
    public function getButtonCSS();
    
    /**
     * @since 0.1
     */
    public function getCounter();
    
    /**
     * @since 0.1
     */
    public function getModel();
}