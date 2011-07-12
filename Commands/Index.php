<?php
/**
 * Default Command. Called if no Command is specified.
 *
 * @author Janek Bevendorff
 * @package Pfb::ProxyCommands
 * @since 0.1
 */
class Pfb_Commands_Index implements Pfb_Interfaces_Command
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
        $view = new Pfb_FrontController_TemplateView('Index');
        $view->display($request, $response);
    }
}