<?php
// Include all files needed for the API to work properly.
// Note: no autoloading is done to prevent conflicts with your PHP application

// include configuration
include_once dirname(__DIR__) . '/config.php';
!file_exists(PFB_CONFIG_APP_PATH . '/config.local.php') or include_once PFB_CONFIG_APP_PATH . '/config.local.php';

// include needed classes
require_once PFB_CONFIG_APP_PATH . '/API/ButtonFactory.php';
require_once PFB_CONFIG_APP_PATH . '/FrontController/TemplateView.php';
require_once PFB_CONFIG_APP_PATH . '/Exceptions/ClassNotFound.php';
require_once PFB_CONFIG_APP_PATH . '/Exceptions/ButtonNotFound.php';
require_once PFB_CONFIG_APP_PATH . '/Interfaces/Button.php';
require_once PFB_CONFIG_APP_PATH . '/Interfaces/Model.php';
require_once PFB_CONFIG_APP_PATH . '/Interfaces/Provider.php';
require_once PFB_CONFIG_APP_PATH . '/Interfaces/ProviderObject.php';
require_once PFB_CONFIG_APP_PATH . '/Provider/HttpProvider.php';
require_once PFB_CONFIG_APP_PATH . '/Provider/HttpProviderObject.php';

// include third party PEAR libs
require_once 'HTTP/Request2.php';