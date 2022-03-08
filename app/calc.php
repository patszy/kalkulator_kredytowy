<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH.'/app/security/check.php';

function getParams(&$cost, &$year, &$percent){
	$cost = isset($_REQUEST['cost']) ? $_REQUEST['cost'] : null;
	$year = isset($_REQUEST['year']) ? $_REQUEST['year'] : null;
	$percent = isset($_REQUEST['percent']) ? $_REQUEST['percent'] : null;
}

function validate(&$cost, &$year, &$percent, &$messages){
	if( ! (isset($cost) && isset($year) && isset($percent) && isset($messages))) {
		return false;
	}

	if($cost == "") $messages[] = 'Nie podano kosztu.';
	if($year == "") $messages[] = 'Nie podano lat.';
	if($percent == "") $messages[] = 'Nie podano oprocentowania.';

	if(count ($messages) != 0) return false;

	if(! is_numeric($cost)) $messages [] = 'Koszt nie jest liczbą całkowitą.';
	if(! is_numeric($year)) $messages [] = 'Lata nie są liczbą całkowitą.';
	if(! is_numeric($percent)) $messages [] = 'Oprocentowanie nie jest liczbą całkowitą.';

	if(count ($messages) != 0) return false;
	else return true;
}

function process(&$cost, &$year, &$percent, &$messages, &$result){
	global $role;

	$cost = intval($cost);
	$year = intval($year);
	$percent = intval($percent);

	if ($role == 'admin') $result = ($cost+($cost*$percent/100))/($year*12);
	else {
		$messages [] = 'Tylko administrator umie liczyć!';
		$messages [] = 'Idź poskarż się Mamie!';
	}
}

$cost = null;
$year = null;
$percent = null;
$result = null;
$messages = array();

getParams($cost, $year, $percent);
if( validate($cost, $year, $percent, $messages)) process($cost, $year, $percent, $messages, $result);

include 'calc_view.php';