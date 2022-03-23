<?php
require_once dirname(__FILE__).'/../../config.php';

function getParamsLogin(&$form){
    $form['login'] = isset($_REQUEST['login']) ? $_REQUEST['login'] : null;
    $form['password'] = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
}

function validateLogin(&$form, &$messages){
    if (! (isset($form['login']) && isset($form['password']))) { return false; }

    if($form['login'] == "") $messages [] = 'Nie podano loginu.';
    if($form['password'] == "") {
        $messages [] = 'Złe hasło.';
        $messages [] = 'Podaj co najmniej jedną literę.';
        $messages [] = 'Dorzuć złę ostatniej Dziewicy.';
		$messages [] = 'Zamieszaj z piórem Archanioła.';
		$messages [] = 'Posyp sproszkowanym pazurem Draculi.';
    }

    if(count($messages) > 0) return false;

    if ($form['login'] == "admin" && $form['password'] == "admin") {
		session_start();
		$_SESSION['role'] = 'admin';
		return true;
	}
	if ($form['login'] == "user" && $form['password'] == "user") {
		session_start();
		$_SESSION['role'] = 'user';
		return true;
	}

    $messages [] = 'Niepoprawne dane.';
    return false;
}

$form = array();
$messages = array();

getParamsLogin($form);
exit();
if (!validateLogin($form,$messages)) include _ROOT_PATH.'/app/security/login_view.php';
else header("Location: "._APP_URL);