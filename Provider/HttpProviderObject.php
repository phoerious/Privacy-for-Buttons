<?php
/**
 * ProviderObject for HTTP requests containing the HTTP response.
 * This require PEAR::HTTP_Request2.
 *
 * @author Janek Bevendorff
 * @package Pfb::Provider
 * @since 0.1
 */
class Pfb_Provider_HttpProviderObject implements Pfb_Interfaces_ProviderObject
{
    /**
     * @since 0.1
     * @var HTTP_Request2_Response
     */
    private $httpResponseObject;
    
    /**
     * Constructor. Initialize with HTTP response object.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param HTTP_Request2_Response $httpResponse
     * @return void
     */
    public function __construct(HTTP_Request2_Response $httpResponse) {
        $this->httpResponseObject = $httpResponse;
    }
    
    /**
     * Get response body.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return string
     */
    public function getBody() {
        return $this->httpResponseObject->getBody();
    }
    
    /**
     * Get response status code.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return int
     */
    public function getStatus() {
        return $this->httpResponseObject->getStatus();
    }
    
    /**
     * Get response status message.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return int
     */
    public function getStatusMessage() {
        return $this->httpResponseObject->getReasonPhrase();
    }
    
    /**
     * Get HTTP response header.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $name
     */
    public function getHeader($name) {
        return $this->httpResponseObject->getHeader($name);
    }
    
    /**
     * Get cookies set by the remote server.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return array
     */
    public function getCookies() {
        return $this->httpResponseObject->getCookies();
    }
}