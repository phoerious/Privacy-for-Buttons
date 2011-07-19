<?php
/**
 * Model for +1 button.
 *
 * @package Pfb::Models
 * @author Janek Bevendorff
 * @since 0.2
 */
class Pfb_Models_PlusOneButtonModel implements Pfb_Interfaces_Model
{
    /**
     * @since 0.2
     * @var string
     */
    private $referenceUrl;
    
    /**
     * Currently not implemented
     * 
     * @since 0.2
     * @var array
     * @ignore
     */
    private $locales = array();
    
    /**
     * Constructor. Pass the reference URL for which you want the button
     * data for to this method.
     *
     * @author Janek Bevendorff
     * @since 0.2
     *
     * @param string $referenceUrl
     * @return void
     */
    public function __construct($referenceUrl) {
        $this->referenceUrl = $referenceUrl;
    }
    
    /**
     * Get counter for reference URL.
     *
     * @author Janek Bevendorff
     * @since 0.2
     * 
     * @return int
     */
    public function getCounter() {
        $provider = new Pfb_Provider_HttpProvider();
        
        $postData[] = array(
            'apiVersion' => 'v1',
            'id'         => 'p',
            'jsonrpc'    => '2.0',
            'key'        => 'p',
            'method'     => 'pos.plusones.get',
            'params'     => array(
                'nolog'     => 'true',
                'id'        => $this->referenceUrl,
                'source'    => 'widget',
                'container' => $this->referenceUrl,
                'userId'    => '@viewer',
                'groupId'   => '@self'
            ),
        );
        
        $jsonData = json_encode($postData);
        $provider->addHeader('Content-Type', 'application/json');
        $provider->setBody($jsonData);
        $provider->setObjectSource('https://clients6.google.com/rpc?key=AIzaSyCKSbrvQasunBoV16zDH9R33D88CeLr9gQ');
        $json = json_decode($provider->requestObject('POST')->getBody());
        
        return (int)$json[0]->{'result'}->{'metadata'}->{'globalCounts'}->{'count'};
    }
    
    /**
     * Currently not implemented.
     * 
     * Get array of localized strings for specified language.
     * Returns null if locale does not exist.
     *
     * @author Janek Bevendorff
     * @since 0.2
     * @ignore
     *
     * @param string $lang
     * @return array | null
     */
    public function getLocales($lang) {
        return null;
    }
    
    /**
     * Return +1 button background sprite image (raw data, not URL).
     * Returns false on failure.
     * 
     * @author Janek Bevendorff
     * @since 0.2
     * 
     * @return string | bool
     */
    public function getBackgroundImage() {
        $provider = new Pfb_Provider_HttpProvider();
        $provider->setObjectSource('https://ssl.gstatic.com/s2/oz/images/stars/po/Publisher/sprite.png');
        $provObj = $provider->requestObject('GET');
        
        if (200 == $provObj->getStatus() || 304 == $provObj->getStatus()) {
            return $provObj->getBody();
        }
        return false;
    }
}