<?php
// static main configuration
define('PFB_CONFIG_APP_VERSION', '0.1');
define('PFB_CONFIG_APP_PATH', __DIR__);

// Dynamic runtime configuration. Don't change values here, use config.local.php instead.
Pfb_Config::setConfig(array(
    // Enable direct access to buttons via HTTP
    // (if set to false only PHP API use will be permitted).
    'enableWebInterface' => true,
    
    // User-agent string that is used for requesting HTTP APIs
    'defaultRequestUserAgent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:2.0.1) Gecko/20100101 Firefox/4.0.1',
    
    // How long (in seconds) HTTP Requests will be cached
    // Zero disables caching (not recommended, only use for testing!).
    'defaultCacheTime' => 900,
    
    // HTTP response headers set by default (note: several application components might override these)
    'defaultResponseHeaders' => array(
        // Set correct MIME type and encoding
        'Content-Type' => 'text/html; charset=utf-8',
        // Let the browser cache expire after half an hour
        'Expires' => gmdate('D, d M Y H:i:s', time() + 1800) . ' GMT',
        // Consider contents fresh for at most 3 hours
        'Cache-Control' => 'max-age=10800, public'
    ),
    
    // Public path/URL to this application. Needed for server-side API use.
    // You MUST set this value if you use the API and want to use the default CSS!
    'publicApplicationPath' => null,
    
    // Use gzip compression for web interface (strictly recommended). This requires
    // 'zlib' extension to be installed (if it's not available, this option will have no effect).
    'enableGzipEncoding' => true
));

/**
 * Static registry class for saving runtime configuration.
 *
 * @author Janek Bevendorff
 * @package Pfb
 * @since 0.1
 */
class Pfb_Config
{
    /**
     * @since 0.1
     * @var array
     */
    private static $config = array();
    
    
    /**
     * Get configuration option by name. You can also pass an array of names.
     * You will then get an array back. Options that do not exist return null.
     * 
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string | array $name
     * @return string | array | null if not set
     */
    public static function getConfig($name) {
        if (is_array($name)) {
            $returnArr = array();
            foreach ($name as $value) {
                $returnArr[$name] = (isset(self::$config[$name]) ? self::$config[$name] : null);
            }
            return $returnArr;
        }
        return (isset(self::$config[$name]) ? self::$config[$name] : null);
    }
    
    /**
     * Set configuration option. For setting a single config option pass name and
     * value. For more than one option pass an array of key => value pairs to the first
     * parameter and omit the second one.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string | array $nameOrConfigArray
     * @param mixed $value
     * @return void
     */
    public static function setConfig($nameOrConfigArray, $value = null) {
        if (is_array($nameOrConfigArray)) {
            foreach ($nameOrConfigArray as $key => $value) {
                self::$config[$key] = $value;
            }
            return;
        } else if (null !== $value) {
            !array_key_exists($nameOrConfigArray, self::$config) or self::$config[$nameOrConfigArray] = $value;
        }
    }
}