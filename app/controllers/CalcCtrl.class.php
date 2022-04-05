<?php
namespace app\controllers;

use app\forms\CalcForm;
use app\transfer\CalcResult;

class CalcCtrl {

	private $form;
	private $result;

	public function __construct(){
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}

	public function getParams(){
		$this->form->cost = getFromRequest('cost');
		$this->form->year = getFromRequest('year');
		$this->form->percent = getFromRequest('percent');
	}
	
	public function validate() {
		if (! (isset ( $this->form->cost ) && isset ( $this->form->year ) && isset ( $this->form->percent ))) {
			return false;
		}
		
		if ($this->form->cost == "") {
			getMessages()->addError('Nie podano kosztu.');
		}
		if ($this->form->year == "") {
			getMessages()->addError('Nie podano lat.');
		}
        if ($this->form->percent == "") {
			getMessages()->addError('Nie podano oprocentowania.');
		}
		
		if (! getMessages()->isError()) {
			if (! is_numeric ( $this->form->cost )) getMessages()->addError('Koszt nie jest liczbą całkowitą.');
			if (! is_numeric ( $this->form->year )) getMessages()->addError('Lata nie są liczbą całkowitą.');
            if (! is_numeric ( $this->form->percent )) getMessages()->addError('Oprocentowanie nie jest liczbą całkowitą.');
		}
		
		return ! getMessages()->isError();
	}
	
	public function action_calcCompute(){

		$this->getparams();
		
		if ($this->validate()) {
				
			$this->form->cost = intval($this->form->cost);
			$this->form->year = intval($this->form->year);
            $this->form->percent = intval($this->form->percent);
			getMessages()->addInfo('Jest legitnie, zaczynam liczyć.');
			
			if (inRole('admin')) {
				$this->result->result=($this->form->cost+($this->form->cost*($this->form->percent/100)*$this->form->year))/($this->form->year*12);
			} else {
				getMessages()->addError('Tylko admin umie liczyć.');
				getMessages()->addError('Idź poskarż się mamie.');
			}
			
			getMessages()->addInfo('Się jusz zliczyło.');
		}
		
		$this->generateView();
	}

	public function action_calcShow() {
		getMessages()->addInfo('Witaj w kalkulatorze.');
		$this->generateView();
	}

	public function generateView(){
		getSmarty()->assign('user',unserialize($_SESSION['user']));
				
		getSmarty()->assign('page_title','Super kalkulator - role');

		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('result',$this->result);
		
		getSmarty()->display('CalcView.tpl');
	}
}

?>
