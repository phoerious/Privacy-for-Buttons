<?php
/**
 * FrontController for HTTP requests. Since most buttons etc. are included via
 * HTTP this should be the most important request method.
 * The HTTP request handler is called automatically by the Front Controller.
 *
 * @author Janek Bevendorff
 * @package Pfb::FrontController
 * @since 0.1
 */
class Pfb_FrontController_HttpRequest implements Pfb_Interfaces_Request
{
    /**
     * Contains an array of all parameters passed to this request.
     *
     * @since 0.1
     * @var array
     */
    private $params;
    
    /**
     * Constructor. Catch all parameters and unescape them if needed.
     *
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @return void
     */
    public function __construct() {
        if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
            foreach ($_REQUEST as $key => $value) {
                $this->params[$key] = stripslashes($value);
            }
        } else {
            $this->params = $_REQUEST;
        }
    }
    
    /**
     * Check if parameter exists.
     *
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param string $name
     * @return bool
     */
    public function hasParam($name) {
        return isset($this->params[$name]);
    }
    
    /**
     * Get specified parameter.
     *
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param string $name
     * @return string | null if not exists
     */
    public function getParam($name) {
        if (isset($this->params[$name])) {
            return $this->params[$name];
        }
        return null;
    }
    
    /**
     * Get a header as passed to this request.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $name
     * @return string | null if not exists
     */
    public function getHeader($name) {
        $name = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        if (isset($_SERVER[$name])) {
            return $_SERVER['name'];
        }
        return null;
    }
    
    /**
     * Return protocol name and version used to request the page.
     * 
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @return string
     */
    public function getProtocol() {
        return $_SERVER['SERVER_PROTOCOL'];
    }
    
    /**
     * Get hostname.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return string
     */
    public function getHost() {
        return $_SERVER['HTTP_HOST'];
    }
    
    /**
     * Get path relative to document root.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return string
     */
    public function getPath() {
        return $_SERVER['SCRIPT_NAME'];
    }
    
    /**
     * Return whether site has been called via an SSL encrypted connection.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return bool
     */
    public function isHttps() {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off');
    }
    
    /**
     * Get complete request URI.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param bool $omitProtocol
     * @param bool $omitFileName
     * @return string
     */
    public function getUri($omitProtocol = false, $omitFileName = false) {
        $uri = '';
        if (!$omitProtocol) {
            $uri .= $this->isHttps() ? 'https://' : 'http://';
        }
        $uri .= empty($_SERVER['HTTP_HOST']) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
        $uri .= $omitFileName ? dirname($_SERVER['SCRIPT_NAME']) . '/' : $_SERVER['SCRIPT_NAME'];
        
        return $uri;
    }
}