<?php
/**
 * API for generating social media buttons on server-side.
 * When you use the API, this is the only file you need to include.
 * 
 * NOTE: When using the API 'PFB_CONFIG_APP_PATH' still points to the
 * application root, not the API directory
 */

// do includes
require_once 'ApiIncludes.php';

/**
 * Concrete factory for social media buttons such as Twitter's Tweet button.
 * Use this to get your button objects.
 *
 * @package Pfb::API
 * @author Janek Bevendorff
 * @since 0.1
 */
class Pfb_API_SocialMediaButtons extends Pfb_API_ButtonFactory
{
    /**
     * Intantiate buttons and include needed files.
     * Returns null if button could not be intantiated.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $name
     * @return Pfv_Interfaces_Button | null
     */
    protected function instantiateButton($name) {
        if (!preg_match('#^[a-z][\w]*$#i', $name) ||
            !file_exists(PFB_CONFIG_APP_PATH . '/Buttons/' . $name . '.php') ||
            !file_exists(PFB_CONFIG_APP_PATH . '/Models/' . $name . 'Model.php')) {
            return null;
        }
        
        require_once PFB_CONFIG_APP_PATH . '/Buttons/' . $name . '.php';
        require_once PFB_CONFIG_APP_PATH . '/Models/' . $name . 'Model.php';
        
        $className = 'Pfb_Buttons_' . $name;
        return new $className();
    }
}