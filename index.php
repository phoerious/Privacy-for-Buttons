<?php
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

// load configuration
include_once __DIR__ . '/config.php';
!file_exists(PFB_CONFIG_APP_PATH . '/config.local.php') or include_once PFB_CONFIG_APP_PATH . '/config.local.php';

// include third party PEAR libs
require_once 'HTTP/Request2.php';

// autoload missing classes
function __autoload($className) {
    $path = str_replace('_', '/', substr($className, 4));
    $path = PFB_CONFIG_APP_PATH . '/' . $path . '.php';
    
    // don't handle PEAR classes
    if (preg_match('#^PEAR#U', $className)) {
        return;
    }
    
    if (!file_exists($path)) {
        throw new Pfb_Exceptions_ClassNotFound('Class \'' . $className . '\' could not be loaded. File \'' . $path . '\' not found.');
    }
    
    require_once $path;
}

// initialize system
$request  = new Pfb_FrontController_HttpRequest();
$response = new Pfb_FrontController_HttpResponse($request);

// check if web interface is enabled
if (!Pfb_Config::getConfig('enableWebInterface')) {
    $view = new Pfb_FrontController_TemplateView('Forbidden');
    $response->setStatus('403 Forbidden');
    $view->display($request, $response);
    exit();
}

$proxyCommandResolver = new Pfb_FrontController_HttpCommandResolver('Index', 'NotFound');
$frontController      = new Pfb_FrontController_FrontController($proxyCommandResolver);

$frontController->handleRequest($request, $response);