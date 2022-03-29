<?php
require_once dirname(__FILE__).'/core/Config.class.php';
$config = new Config();
include dirname(__FILE__).'/config.php';

function &getConf(){ global $config; return $config; }

require_once getConf()->root_path.'/core/Messages.class.php';
$messages = new Messages();

function &getMessages(){ global $messages; return $messages; }

$smarty = null;	
function &getSmarty(){
	global $smarty;
	if (!isset($smarty)){
		include_once getConf()->root_path.'/lib/smarty/Smarty.class.php';
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

require_once getConf()->root_path.'/core/functions.php';

$action = getFromRequest('action');
