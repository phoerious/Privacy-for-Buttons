<?php
/**
 * Exception thrown if Button could not be found.
 *
 * @author Janek Bevendorff
 * @package Pfb::Exceptions
 * @since 0.1
 */
class Pfb_Exceptions_ButtonNotFound extends Exception
{
    /**
     * @since 0.1
     * @var int
     */
    const ERROR_CODE = 202;
    
    /**
     * Constructor. Pass error message to this method.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $message
     * @return void
     */
    public function __construct($message = null) {
        parent::__construct($message, self::ERROR_CODE);
    }
}