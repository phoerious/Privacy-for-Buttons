<?php
/**
 * Abstract button factory for use in the server-side PHP API.
 * Relys on Pfb_Interfaces_Button.
 *
 * @package Pfb::API
 * @author Janek Bevendorff
 * @since 0.1
 * @abstract
 */
abstract class Pfb_API_ButtonFactory
{
    /**
     * Get new button by name. The second required parameter sets the reference
     * URL for which you want to create the button. The third parameter is optional.
     * Use it to pass additional parameters at creation time.
     * Throws an exception if button could not be intantiated.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $name
     * @param string $referenceUrl
     * @param array $params
     * @return Pfb_Interfaces_Button
     * @throws Pfb_Exceptions_ButtonNotFound
     */
    public function getButton($name, $referenceUrl, $params = array()) {
        $button = $this->instantiateButton($name);
        if (null === $button) {
            throw new Pfb_Exceptions_ButtonNotFound('Button \'' . $name . '\' could not be intantiated.');
        }
        $button->init($referenceUrl);
        
        foreach ($params as $key => $value) {
            $button->setParam($key, $value);
        }
        
        return $button;
    }
    
    /**
     * Intantiate new button. The button name is NOT the fully-qualified class name.
     * Returns null if button could not be intantiated.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $name
     * @return Pfb_Interface_Button | null
     * @abstract
     */
    abstract protected function instantiateButton($name);
}