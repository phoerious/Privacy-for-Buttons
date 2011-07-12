<?php
/**
 * Error Command. Called if the given Command could not be found or is invalid.
 *
 * @author Janek Bevendorff
 * @package Pfb::ProxyCommands
 * @since 0.1
 */
class Pfb_Commands_NotFound implements Pfb_Interfaces_Command
{
    /**
     * Execute command.
     *
     * @author Janek Bevendorff
     * @since 01.
     *
     * @param Interfaces_Request $request
     * @param Interfaces_Response $response
     * @return void
     */
    public function execute(Pfb_Interfaces_Request $request, Pfb_Interfaces_Response $response) {
        $response->setStatus('404 Not Found');
        $view = new Pfb_FrontController_TemplateView('NotFound');
        $view->display($request, $response);
    }
}