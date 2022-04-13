<?php

namespace app\controllers;

use app\transfer\User;
use app\forms\LoginForm;

class LoginCtrl{
	private $form;
	
	public function __construct(){
		$this->form = new LoginForm();
	}
	
	public function getParams(){
		$this->form->login = getFromRequest('login');
		$this->form->password = getFromRequest('password');
	}
	
	public function validate() {
		if (! (isset ( $this->form->login ) && isset ( $this->form->password ))) {
			return false;
		}
			
		if (! getMessages()->isError ()) {
			if ($this->form->login == "") {
				getMessages()->addError ( 'Ale... że jak się nazywasz?' );
                getMessages()->addError ( 'No bo raczej nie tak jak wpisałeś.' );
			}
			if ($this->form->password == "") {
				getMessages()->addError ( 'Złe hasło.' );
                getMessages()->addError ( 'Podaj co najmniej jedną literę.' );
                getMessages()->addError ( 'Dorzuć złę ostatniej Dziewicy.' );
                getMessages()->addError ( 'Zamieszaj z piórem Archanioła.' );
                getMessages()->addError ( 'Posyp sproszkowanym pazurem Draculi.' );
            }
		}

		if ( !getMessages()->isError() ) {
			if ($this->form->login == "admin" && $this->form->password == "admin") {
				$user = new User($this->form->login, 'admin');

				$_SESSION['user'] = serialize($user);				

				addRole($user->role);
			} else if ($this->form->login == "user" && $this->form->password == "user") {
				$user = new User($this->form->login, 'user');

				$_SESSION['user'] = serialize($user);				
				
				addRole($user->role);
			} else {
				getMessages()->addError('Niepoprawne dane.');
                getMessages()->addError('Weź nie kłam, dobra?');
			}
		}
		
		return ! getMessages()->isError();
	}
	
	public function action_loginShow(){
		$this->generateView(); 
	}

	public function action_login(){
		$this->getParams();
		
		if ($this->validate()){
			header("Location: ".getConf()->app_url."/");
		} else {
			$this->generateView(); 
		}
	}
	
	public function action_logout(){
		session_destroy();
		
		getMessages()->addInfo('Ej, no weź się nie obrażaj.');
        getMessages()->addInfo('Wróć do nas.');

		$this->generateView();		 
	}
	
	public function generateView(){
		getSmarty()->assign('page_title', 'Logowanko');
		getSmarty()->assign('form', $this->form);
		getSmarty()->display('LoginView.tpl');		
	}
}