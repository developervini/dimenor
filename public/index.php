<?php
/**
 * Define some constants
 */

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", realpath(dirname(__DIR__)) . DS);
define("VENDORDIR", ROOT . "vendor" . DS);
define("CONFIG", ROOT . "config" . DS);
define("CONFIG_DB", CONFIG . "database.config.php");
define("CONFIG_ROUTES", CONFIG . "routes.config.php");
define("BOOTSTRAP", ROOT . "app" . DS . "Bootstrap.php");
define("TEMPLATEDIR", ROOT . "public" . DS . "templates");

/**
 * Include autoload file
 */
if (file_exists(VENDORDIR . "autoload.php")) {
	require_once VENDORDIR . "autoload.php";
} else {
	die("<pre>Execute 'php composer.phar install' na raiz do projeto</pre>");
}

 /**
  * Include config database file
  */
 if (file_exists(CONFIG_DB)) {
 	require_once CONFIG_DB;
 } else {
 	die("<pre>Verify config database file</pre>");
 }

/**
* Include Bootstrap file
*/
if (file_exists(BOOTSTRAP)) {
	require_once BOOTSTRAP;
} else {
	die("<pre>Verify Bootstrap file</pre>");
}

 /**
  * Config routes file
  */
 if (file_exists(CONFIG_ROUTES)) {
 	require_once CONFIG_ROUTES;
 } else {
 	die("<pre>Verify routes config file</pre>");
 }

 $app->run();