<?php
/**
 * Provider for HTTP content. This class requires PEAR::HTTP_Request2
 *
 * @author Janek Bevendorff
 * @package Pfb::Provider
 * @since 0.1
 */
class Pfb_Provider_HttpProvider implements Pfb_Interfaces_Provider
{
    /**
     * @since 0.1
     * @var string
     */
    private $sourceUrl;
    
    /**
     * @since 0.1
     * @var HTTP_Request2
     **/
    private $requestObject = null;
    
    /**
     * @since 0.1
     * @var int
     */
    private $cacheTime;
    
    /**
     * Constructor.
     * If $cacheTime is null, the global default setting will be used.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param int $cacheTime
     * @return void
     */
    public function __construct($cacheTime = null) {
        $this->requestObject = new HTTP_Request2();
        if (in_array('curl', get_loaded_extensions())) {
            $this->requestObject->setAdapter('curl');
        }
        
        $this->requestObject->setConfig(array(
            'follow_redirects' => true,
            'max_redirects' => 20
        ));
        
        if (null !== $cacheTime) {
            $this->cacheTime = $cacheTime;
        } else {
            $this->cacheTime = Pfb_Config::getConfig('defaultCacheTime');
        }
        
        // change user agent
        $this->addHeader('User-Agent', Pfb_Config::getConfig('defaultRequestUserAgent'));
    }
    
    /**
     * Set URL source.
     *
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param string $source
     */
    public function setObjectSource($source) {
        $this->sourceUrl = $source;
    }
    
    /**
     * Set HTTP header. If third parameter is set to false existing headers with
     * the same name will be preserved.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $name
     * @param string $value
     * @param bool $replace
     */
    public function addHeader($name, $value, $replace = true) {
        $this->requestObject->setHeader($name, $value, $replace);
    }
    
    /**
     * Set request body.
     *
     * @author Janek Bevendorff
     * @since 0.2
     * 
     * @param string $body
     * @return void
     */
    public function setBody($body) {
        $this->requestObject->setBody($body);
    }
    
    /**
     * Send request and return response object.
     *
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param string $requestMethod
     * @return Pfb_Interfaces_ProviderObject
     */
    public function requestObject($requestMethod) {
        $hashContent = $this->sourceUrl;
        if ($this->requestObject->getBody()) {
            $hashContent .= $this->requestObject->getBody();
        }
        $idHash = sha1($hashContent);
        
        $cacheFilename = PFB_CONFIG_APP_PATH . '/Cache/' . $idHash;
        
        if (file_exists($cacheFilename) && (time() - filemtime($cacheFilename)) <= $this->cacheTime) {
            return unserialize(file_get_contents($cacheFilename));
        }
        
        $this->requestObject->setUrl($this->sourceUrl);
        $this->requestObject->setMethod($requestMethod);
        $this->requestObject->setConfig('protocol_version', Pfb_Config::getConfig('requestProtocolVersion'));
        
        $response = $this->requestObject->send();
        
        $responseObj = new Pfb_Provider_HttpProviderObject($response);
        
        // cache contents
        if ($this->cacheTime > 0) {
            $cacheObj = serialize($responseObj);
            file_put_contents($cacheFilename, $cacheObj, LOCK_EX);
        }
        
        return $responseObj;
    }
    
    /**
     * Set cache time in seconds. Set to zero to disable caching.
     * This overrides the global default setting.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param int $time
     */
    public function setCacheTime($time) {
        $this->cacheTime = ($time >= 0 ? $time : 0);
    }
    
    /**
     * Get cache time in seconds. Zero means no caching.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return int
     */
    public function getCacheTime() {
        return $this->cacheTime;
    }
    
    /**
     * Set HTTP Protocol version (either 1.0 or 1.1). Specify without leading 'HTTP/'.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $version
     */
    public function setProtocolVersion($version) {
        $this->httpProtocolVersion = $version;
    }
}