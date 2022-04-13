<?php
require_once 'core/Config.class.php';
$config = new core\Config();
include 'config.php';

function &getConf(){ global $config; return $config; }

require_once 'core/Messages.class.php';
$messages = new core\Messages();

function &getMessages(){ global $messages; return $messages; }

$smarty = null;	
function &getSmarty(){
	global $smarty;
	if (!isset($smarty)){
		include_once 'lib/smarty/Smarty.class.php';
		$smarty = new Smarty();	
		$smarty->assign('config',getConf());
		$smarty->assign('messages',getMessages());
		$smarty->setTemplateDir(array(
			'one' => getConf()->root_path.'/app/views',
			'two' => getConf()->root_path.'/app/views/templates'
		));
	}
	return $smarty;
}

require_once 'core/ClassLoader.class.php';
$cloader = new core\ClassLoader();
function &getLoader() {
    global $cloader;
    return $cloader;
}

require_once 'core/Router.class.php';
$router = new core\Router();
function &getRouter(): core\Router {
    global $router; return $router;
}

$db = null;
function &getDB() {
    global $config, $db;
    if (!isset($db)) {
        require_once 'lib/medoo/Medoo.php';
        $db = new \Medoo\Medoo([
            'database_type' => &$config->db_type,
            'server' => &$config->db_server,
            'database_name' => &$config->db_name,
            'username' => &$config->db_user,
            'password' => &$config->db_pass,
            'charset' => &$config->db_charset,
            'port' => &$config->db_port,
            'prefix' => &$config->db_prefix,
            'option' => &$config->db_option
        ]);
    }
    return $db;
}

require_once 'core/functions.php';

session_start();
$config->roles = isset($_SESSION['_roles']) ? unserialize($_SESSION['_roles']) : array();

$router->setAction( getFromRequest('action') );
