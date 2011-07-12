<?php
/**
 * FrontController for handling requests and invoking ProxyCommandResolvers.
 *
 * @author Janek Bevendorff
 * @package Pfb::FrontController
 * @since 0.1
 */
class Pfb_FrontController_FrontController
{
    /**
     * @since 0.1
     * @var Interfaces_ProxyCommandResolver
     */
    private $commandResolver = null;
    
    /**
     * Constructor. Pass a CommandResolver to this method.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param Interfaces_CommandResolver $commandResolver
     * @return void
     */
    public function __construct(Pfb_Interfaces_CommandResolver $commandResolver) {
        $this->commandResolver = $commandResolver;
    }
    
    /**
     * Handle the request. Pass request and response object to this method.
     * The rest is more or less magic.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param Interfaces_Request $request
     * @param Interfaces_Response $response
     * @return void
     */
    public function handleRequest(Pfb_Interfaces_Request $request, Pfb_Interfaces_Response $response) {
        $command = $this->commandResolver->getCommand($request);
        $command->execute($request, $response);
        
        if ($response->hasUnflushedContents()) {
            $response->flush();
        }
    }
}