<?php
require_once dirname(__FILE__).'/../config.php';

$cost = $_REQUEST ['cost'];
$year = $_REQUEST ['year'];
$percent = $_REQUEST ['percent'];

if ( ! (isset($cost) && isset($year) && isset($percent))) {
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

if ( $cost == "") {
	$messages [] = 'Nie podano kosztu';
}
if ( $year == "") {
	$messages [] = 'Nie podano lat';
}
if ( $percent == "") {
	$messages [] = 'Nie podano oprocentowania';
}

if (empty( $messages )) {
	
	if (! is_numeric( $cost )) { $messages [] = 'Koszt nie jest liczbą całkowitą'; }
	if (! is_numeric( $year )) { $messages [] = 'Lata nie są liczbą całkowitą';	}	
	if (! is_numeric( $percent )) { $messages [] = 'Oprocentowanie nie jest liczbą całkowitą'; }	

}

if (empty ( $messages )) {
	
	$cost = intval($cost);
	$year = intval($year);
	$percent = intval($percent);
	
	$result = ($cost+($cost*$percent/100))/($year*12);
}

include 'calc_view.php';