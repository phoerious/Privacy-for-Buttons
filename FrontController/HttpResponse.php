<?php
/**
 * Handler for HTTP response output. Use this for sending output via HTTP to
 * the client user agent.
 *
 * @author Janek Bevendorff
 * @package Pfb::FrontController
 * @since 0.1
 */
class Pfb_FrontController_HttpResponse implements Pfb_Interfaces_Response
{
    /**
     * @since 0.1
     * @var int
     */
    private $status = '200 OK';
    
    /**
     * @since 0.1
     * @var array
     */
    private $responseHeaders = array();
    
    /**
     * @since 0.1
     * @var string
     */
    private $body = '';
    
    /**
     * @since 0.1
     * @var FrontController_Request
     */
    private $requestObject = null;
    
    /**
     * @since 0.1
     * @var bool
     */
    private $isUnflushed;
    
    /**
     * Constructor. Pass the request object to this method.
     * 
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param FrontController_Request $request
     */
    public function __construct(Pfb_Interfaces_Request $request) {
        $this->requestObject = $request;
        
        // set default headers
        $headers = Pfb_Config::getConfig('defaultResponseHeaders');
        foreach ($headers as $key => $value) {
            $this->addHeader($key, $value);
        }
    }
    
    /**
     * Set HTTP Status. Pass a status string such as '200 OK' or '404 Not found'.
     * 
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param string $status
     * @return void
     */
    public function setStatus($status) {
        $this->status = $status;
        $this->isUnflushed = true;
    }
    
    /**
     * Add a response header. If the third parameter is set to false, existing
     * headers with the same name will be preserved.
     * 
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param string $name
     * @param string $value
     * @param bool $replace
     * @return void
     */
    public function addHeader($name, $value, $replace = true) {
        // if $replace is set to false, don't overwrite existing headers
        if (false == $replace && array_key_exists($name, $this->responseHeaders)) {
            if (is_array($this->responseHeaders[$name])) {
                $this->responseHeaders[$name][] = $value;
            } else {
                $this->responseHeaders[$name] = array($this->responseHeaders[$name], $value);
            }
            $this->isUnflushed = true;
            return;
        }
        
        $this->responseHeaders[$name] = $value;
        $this->isUnflushed = true;
    }
    
    /**
     * Redirect client to specified location. This is an extra method not defined
     * in the Response interface.
     * If $permanent is set to true, a 301 status code will be sent instead of 302.
     * You still need to call flush() for the redirect to take effect.
     * 
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param string $location
     * @param bool $permanent
     * @return void
     */
    public function redirect($location, $permanent = false) {
        if (false == $permanent) {
            $this->setStatus('302 Found');
        } else {
            $this->setStatus('301 Moved Permanently');
        }
        $this->addHeader('Location', $location, true);
        
        $this->isUnflushed = true;
    }
    
    /**
     * Write to body buffer. Contents will not be sent directly. To send the buffer
     * to the client user agent use flush().
     * 
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param string $output
     * @return void;
     */
    public function write($output) {
        $this->body .= $output;
        $this->isUnflushed = true;
    }
    
    /**
     * Check if object contains unflushed contents.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return bool
     */
    public function hasUnflushedContents() {
        return $this->isUnflushed;
    }
    
    /**
     * Flush body buffer. This sends all content written to the buffer and sets
     * defined HTTP status and headers.
     * 
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @return void
     */
    public function flush() {
        header($this->requestObject->getProtocol() . ' ' . $this->status);
        
        foreach ($this->responseHeaders as $key => $value) {
            // if more headers of the same name exists, keep them all
            if (is_array($value)) {
                foreach ($value as $v) {
                    header($key . ': ' . $v, false);
                }
            } else {
                header($key . ': ' .$value);
            }
        }
        
        // apply compression
        if (Pfb_Config::getConfig('enableGzipEncoding') && in_array('zlib', get_loaded_extensions())) {
            ini_set('zlib.output_compression', true);
        }
        
        print $this->body;
        
        // reset headers and body
        $this->responseHeaders = array();
        $this->body = null;
        
        $this->isUnflushed = false;
    }
}