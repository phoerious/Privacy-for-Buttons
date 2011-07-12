<?php
/**
 * Exception thrown if a class could not be found.
 *
 * @author Janek Bevendorff
 * @package Pfb::Exceptions
 * @version 2011-07-10
 * @since 0.1
 */
class Pfb_Exceptions_ClassNotFound extends Exception
{
    /**
     * @since 0.1
     * @var int
     */
    const ERROR_CODE = 200;
    
    /**
     * Constructor. Pass error message to this method.
     *
     * @author Janek Bevendorff
     * @version 2011-07-10
     * @since 0.1
     *
     * @param string $message
     * @return void
     */
    public function __construct($message = null) {
        parent::__construct($message, self::ERROR_CODE);
    }
}