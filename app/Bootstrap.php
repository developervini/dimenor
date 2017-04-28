<?php

use \Slim\Slim as Slim;
use \Slim\Views\Twig as Twig;
use \Slim\Views\TwigExtension as TwigExtension;
use \Slim\Log as Log;
use Illuminate\Database\Capsule\Manager as Capsule;

date_default_timezone_set('America/Sao_Paulo');

$app = new Slim(array(
		"view" => new Twig()
));

session_start();

// Make a new connection
if (file_exists(ROOT . 'config' . DS . 'database.config.php')) {
    $capsule = new Capsule;
    $capsule->addConnection(include ROOT . "config" . DS . 'database.config.php');
    $capsule->bootEloquent();
    $capsule->setAsGlobal();

    $app->db = $capsule;
} else {
    die("<pre>Rename 'config/database.config.php.install' to 'config/database.config.php' and configure your connection</pre>");
}

$app->config(array(
    "templates.path" => TEMPLATEDIR,
));

/**
 * Twig extensions and Smarty Functions (baseUrl)
 */
$app->view->parserExtensions = array(
    new TwigExtension(),
    new Twig_Extension_StringLoader()
);

/**
 * Load all libs
 */
foreach (glob(ROOT . 'app' . DS . 'view' . DS . '*.php') as $filename) {
    require_once $filename;
}