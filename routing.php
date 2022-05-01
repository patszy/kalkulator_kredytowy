<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('creditList'); // akcja/ścieżka domyślna
App::getRouter()->setLoginRoute('login'); // akcja/ścieżka na potrzeby logowania (przekierowanie, gdy nie ma dostępu)

Utils::addRoute('creditList',    'CreditListCtrl');
Utils::addRoute('loginShow',     'LoginCtrl');
Utils::addRoute('login',         'LoginCtrl');
Utils::addRoute('logout',        'LoginCtrl');
Utils::addRoute('creditNew',     'CreditEditCtrl',	['user','admin']);
Utils::addRoute('creditEdit',    'CreditEditCtrl',	['user','admin']);
Utils::addRoute('creditSave',    'CreditEditCtrl',	['user','admin']);
Utils::addRoute('creditDelete',  'CreditEditCtrl',	['admin']);