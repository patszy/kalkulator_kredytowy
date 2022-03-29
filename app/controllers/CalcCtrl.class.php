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
	
	public function process(){

		$this->getparams();
		
		if ($this->validate()) {
				
			$this->form->cost = intval($this->form->cost);
			$this->form->year = intval($this->form->year);
            $this->form->percent = intval($this->form->percent);
			getMessages()->addInfo('Jest legitnie, zaczynam liczyć.');
				
			$this->result->result = ($this->form->cost+$this->form->cost*($this->form->percent*$this->form->year/100))/($this->form->year*12);
			getMessages()->addInfo('Się jusz zliczyło.');
		}
		
		$this->generateView();
	}
	
	public function generateView(){
		getSmarty()->assign('page_title','Kalkulator Kredytowy');
		getSmarty()->assign('page_description','Aplikacja z jednym "punktem wejścia". Zmiana w postaci nowej struktury foderów, skryptu inicjalizacji oraz pomocniczych funkcji.');
		getSmarty()->assign('page_header','Kontroler główny');
					
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);
		
		getSmarty()->display('CalcView.tpl'); // już nie podajemy pełnej ścieżki - foldery widoków są zdefiniowane przy ładowaniu Smarty
	}
}

?>
