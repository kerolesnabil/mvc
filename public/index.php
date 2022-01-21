<?php

namespace PHPMVC;

use PHPMVC\LIB\Authentication;
use PHPMVC\LIB\Messenger;
use PHPMVC\Lib\Registry;
use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\Language;
use PHPMVC\LIB\SessionManager;
use PHPMVC\LIB\Template\Template;

if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}
require_once '..' . DS . 'app' . DS.'config'.DS .'config.php';

require_once APP_PATH.DS.'lib'.DS.'autoload.php';

$session = new SessionManager();
$session->start();


if(!isset($_SESSION['lang'])){
    $_SESSION['lang']=APP_DEFAULT_LANGUAGE;
}

$template_parts  = require_once '..' . DS . 'app' . DS.'config'.DS .'templateconfig.php';

$messenger = Messenger::getInstance($session);

$authentication = Authentication::getInstance($session);

$template=new Template($template_parts);
$language= new Language();
$registry = Registry::getInstance($session);

$registry->session = $session;
$registry->language =$language;
$registry->messenger = $messenger;


$frontController = new FrontController($template,$registry,$authentication);
$frontController->dispatch();

