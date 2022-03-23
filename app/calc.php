<?php
require_once dirname(__FILE__).'/../config.php';
require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';

include _ROOT_PATH.'/app/security/check.php';


function getParams(&$form){
	$form['cost'] = isset($_REQUEST['cost']) ? $_REQUEST['cost'] : null;
	$form['year'] = isset($_REQUEST['year']) ? $_REQUEST['year'] : null;
	$form['percent'] = isset($_REQUEST['percent']) ? $_REQUEST['percent'] : null;
}

function validate(&$form, &$infos, &$messages){
	if( ! (isset($form['cost']) && isset($form['year']) && isset($form['percent']))) return false;

	$infos [] = 'Podano dane.';

	if($form['cost'] == "") $messages[] = 'Nie podano kosztu.';
	if($form['year'] == "") $messages[] = 'Nie podano lat.';
	if($form['percent'] == "") $messages[] = 'Nie podano oprocentowania.';

	if(count($messages) == 0) {
		if(! is_numeric($form['cost'])) $messages [] = 'Koszt nie jest liczbą całkowitą.';
		if(! is_numeric($form['year'])) $messages [] = 'Lata nie są liczbą całkowitą.';
		if(! is_numeric($form['percent'])) $messages [] = 'Oprocentowanie nie jest liczbą całkowitą.';
	}
	if(count ($messages) > 0) return false;
	else return true;
}

function process(&$form, &$infos, &$messages, &$result){
	global $role;

	$infos [] = 'Jest legitnie, zaczynam liczyć.';
	$form['cost'] = intval($form['cost']);
	$form['year'] = intval($form['year']);
	$form['percent'] = intval($form['percent']);

	if ($role == 'admin') $result = ($form['cost']+($form['cost']*$form['percent']/100))/($form['year']*12);
	else {
		$messages [] = 'Tylko administrator umie liczyć!';
		$messages [] = 'Idź poskarż się Mamie!';
	}
}

$form = null;
$result = null;
$infos = array();
$messages = array();

getParams($form);
if( validate($form, $infos, $messages)) process($form, $infos, $messages, $result);

$smarty = new Smarty();

$smarty->assign('app_url', _APP_URL);
$smarty->assign('root_path', _ROOT_PATH);
$smarty->assign('page_title', 'Przykład 04');
$smarty->assign('page_description', 'Profesjonalne szablonowanie oparte na bibliotece Smarty');
$smarty->assign('page_header', 'Szablony Smarty');

$smarty->assign('form', $form);
$smarty->assign('result', $result);
$smarty->assign('messages', $messages);
$smarty->assign('infos', $infos);

$smarty->display(_ROOT_PATH.'/app/calc.html');