<?php
/**
 * Generic interface for Commands.
 *
 * @author Janek Bevendorff
 * @package Pfb::Interfaces
 * @since 0.1
 */
interface Pfb_Interfaces_Command
{
    /**
     * @since 0.1
     * @param FrontController_Request $request
     * @param FrontController_Response $response
     */
    public function execute(Pfb_Interfaces_Request $request, Pfb_Interfaces_Response $response);
}