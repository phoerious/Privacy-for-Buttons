<?php
/**
 * Generic interface for CommandResolvers. CommandResolvers analyze the request
 * and invoke the proper Commands.
 *
 * @author Janek Bevendorff
 * @package Pfb::Interfaces
 * @since 0.1
 */
interface Pfb_Interfaces_CommandResolver
{
    /**
     * @since 0.1
     * @param Interfaces_Request
     */
    public function getCommand(Pfb_Interfaces_Request $request);
}