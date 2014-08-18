<?php
/**
 * Index
 *
 * The Front Controller for handling every request
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.webroot
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Use the DS to separate the directories in other defines
 */
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

/**
 * These defines should only be edited if you have cake installed in
 * a directory layout other than the way it is distributed.
 * When using custom settings be sure to use the DS and do not add a trailing DS.
 */

/**
 * The full path to the directory which holds "app", WITHOUT a trailing DS.
 *
 */
if (!defined('ROOT')) {
	define('ROOT', dirname(dirname(dirname(__FILE__))));
}

/**
 * The actual directory name for the "app".
 *
 */
if (!defined('APP_DIR')) {
	define('APP_DIR', basename(dirname(dirname(__FILE__))));
}

/**
 * The absolute path to the "cake" directory, WITHOUT a trailing DS.
 *
 * Un-comment this line to specify a fixed path to CakePHP.
 * This should point at the directory containing `Cake`.
 *
 * For ease of development CakePHP uses PHP's include_path. If you
 * cannot modify your include_path set this value.
 *
 * Leaving this constant undefined will result in it being defined in Cake/bootstrap.php
 *
 * The following line differs from its sibl1203ing
 * /lib/Cake/Console/Templates/skel/webroot/index.php
 */
//define('CAKE_CORE_INCLUDE_PATH', ROOT . DS . 'lib');

/**
 * Editing below this line should NOT be necessary.
 * Change at your own risk.
 *
 */

if (!defined('WEBROOT_DIR')) {
	define('WEBROOT_DIR', basename(dirname(__FILE__)));
}
if (!defined('WWW_ROOT')) {
	define('WWW_ROOT', dirname(__FILE__) . DS);
}

// for built-in server
if (php_sapi_name() === 'cli-server') {
	if ($_SERVER['REQUEST_URI'] !== '/' && file_exists(WWW_ROOT . $_SERVER['PHP_SELF'])) {
		return false;
	}
	$_SERVER['PHP_SELF'] = '/' . basename(__FILE__);
}

if (!defined('CAKE_CORE_INCLUDE_PATH')) {
	if (function_exists('ini_set')) {
		ini_set('include_path', ROOT . DS . 'lib' . PATH_SEPARATOR . ini_get('include_path'));
	}
	if (!include 'Cake' . DS . 'bootstrap.php') {
		$failed = true;
	}
} else {
	if (!include CAKE_CORE_INCLUDE_PATH . DS . 'Cake' . DS . 'bootstrap.php') {
		$failed = true;
	}
}
if (!empty($failed)) {
	trigger_error("CakePHP core could not be found. Check the value of CAKE_CORE_INCLUDE_PATH in APP/webroot/index.php. It should point to the directory containing your " . DS . "cake core directory and your " . DS . "vendors root directory.", E_USER_ERROR);
}


//todo: store these in a json file,"defs", and then create these from it so the same can be done for JS
// OLT LOCATIONS
if (!defined('APP_LIB') ) {
	define('APP_LIB', ROOT.DS.APP_DIR.DS."lib".DS);
}

	if (!defined('LAB_ROOT') ) {
		define('LAB_ROOT', APP_LIB."Labs".DS);
	}

	if (!defined('SVG_ROOT') ) {
		define('SVG_ROOT', APP_LIB."templates".DS."svg".DS);
	}

if (!defined('OLT_DEFINITIONS') ) {
	define('OLT_DEFINITIONS',ROOT.DS.APP_DIR.DS."lib".DS."defs.json");
}

if ( !defined( "HTML5V_CTRL_ID_SHIM" ) ) {
	define( "HTML5V_CTRL_ID_SHIM", "_html5v_control" );
}
if ( !defined( "OLT_HTML5V_CLASS" ) ) {
	define( "OLT_HTML5V", "html5v" );
}
if ( !defined( "OLT_HTML5V_CLASS" ) ) {
	define( "OLT_HTML5V_PLAYER", "html5v-player" );
}
if ( !defined( "OLT_HTML5V_CTRL_CLASS" ) ) {
	define( "OLT_HTML5V_CTRL_CLASS", "html5v-control" );
}
if ( !defined( "OLT_UI_HTML5V" ) ) {
	define( "OLT_UI_HTML5V", "html5v-ui-bar" );
}
if ( !defined( "MSECS" ) ) {
	define( "MSECS", "milliseconds" );
}
if ( !defined( "SECS" ) ) {
	define( "SECS", "seconds" );
}
if ( !defined( "MINS" ) ) {
	define( "MINS", "minutes" );
}
if ( !defined( "HRS" ) ) {
	define( "HRS", "hours" );
}

// saves writing the if clause 90 times...
$definitions = array( "PHP" => ".php","SVG" => ".svg",
                      "MP4"  => ".mp4",
                      "AVI"  => ".avi",
                      "MPEG" => ".mpeg",
                      "SGL_Q" => "'",
                      "DBL_Q" => "\"" );

foreach ( $definitions as $def => $ref ) {
	if ( !defined( $def ) ) {
		define( $def, $ref );
	}
}

App::uses('Dispatcher', 'Routing');

$Dispatcher = new Dispatcher();
$Dispatcher->dispatch(
	new CakeRequest(),
	new CakeResponse()
);

