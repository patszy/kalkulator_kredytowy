<?php
require_once 'init.php';

// getRouter()->setDefaultRoute('calcShow');
// getRouter()->setLoginRoute('login');

// getRouter()->addRoute('calcShow',    'CalcCtrl',  ['user','admin']);
// getRouter()->addRoute('calcCompute', 'CalcCtrl',  ['user','admin']);
// getRouter()->addRoute('login',       'LoginCtrl');
// getRouter()->addRoute('logout',      'LoginCtrl', ['user','admin']);

getRouter()->setDefaultRoute('creditList');
getRouter()->setLoginRoute('login');

getRouter()->addRoute('creditList',		'CreditListCtrl');
getRouter()->addRoute('loginShow',		'LoginCtrl');
getRouter()->addRoute('login',			'LoginCtrl');
getRouter()->addRoute('logout',			'LoginCtrl');
getRouter()->addRoute('creditNew',		'CreditEditCtrl',	['user','admin']);
getRouter()->addRoute('creditEdit',		'CreditEditCtrl',	['user','admin']);
getRouter()->addRoute('creditSave',		'CreditEditCtrl',	['user','admin']);
getRouter()->addRoute('creditDelete',	'CreditEditCtrl',	['admin']);

getRouter()->go();
?>