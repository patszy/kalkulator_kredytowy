<?php
require_once $config->root_path.'/lib/smarty/Smarty.class.php';
require_once $config->root_path.'/lib/Messages.class.php';
require_once $config->root_path.'/app/calc/CalcForm.class.php';
require_once $config->root_path.'/app/calc/CalcResult.class.php';

class CalcCtrl {

	private $messages;
	private $form;
	private $result;

	public function __construct(){
		$this->messages = new Messages();
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}

	public function getParams(){
		$this->form->cost = isset($_REQUEST ['cost']) ? $_REQUEST ['cost'] : null;
		$this->form->year = isset($_REQUEST ['year']) ? $_REQUEST ['year'] : null;
		$this->form->percent = isset($_REQUEST ['percent']) ? $_REQUEST ['percent'] : null;
	}
	
	public function validate() {
		if (! (isset ( $this->form->cost ) && isset ( $this->form->year ) && isset ( $this->form->percent ))) {
			return false;
		}
		
		if ($this->form->cost == "") {
			$this->messages->addError('Nie podano kosztu.');
		}
		if ($this->form->year == "") {
			$this->messages->addError('Nie podano lat.');
		}
        if ($this->form->percent == "") {
			$this->messages->addError('Nie podano oprocentowania.');
		}
		
		if (! $this->messages->isError()) {
			if (! is_numeric ( $this->form->cost )) $this->messages->addError('Koszt nie jest liczbą całkowitą.');
			if (! is_numeric ( $this->form->year )) $this->messages->addError('Lata nie są liczbą całkowitą.');
            if (! is_numeric ( $this->form->percent )) $this->messages->addError('Oprocentowanie nie jest liczbą całkowitą.');
		}
		
		return ! $this->messages->isError();
	}
	
	public function process(){

		$this->getparams();
		
		if ($this->validate()) {
				
			$this->form->cost = intval($this->form->cost);
			$this->form->year = intval($this->form->year);
            $this->form->percent = intval($this->form->percent);
			$this->messages->addInfo('Jest legitnie, zaczynam liczyć.');
				
			// $this->result->result = ($this->form->cost+$this->form->cost*($this->form->percent/100))/$this->form->year*12;
			$this->result->result = ($this->form->cost+$this->form->cost*($this->form->percent*$this->form->year/100))/($this->form->year*12);
			$this->messages->addInfo('Się jusz zliczyło.');
		}
		
		$this->generateView();
	}
	
	public function generateView(){
		global $config;
		
		$smarty = new Smarty();
		$smarty->assign('config',$config);
		
		$smarty->assign('page_title','Przykład 05');
		$smarty->assign('page_description','Obiektowość. Funkcjonalność aplikacji zamknięta w metodach różnych obiektów. Pełen model MVC.');
		$smarty->assign('page_header','Obiekty w PHP');
				
		$smarty->assign('messages',$this->messages);
		$smarty->assign('form',$this->form);
		$smarty->assign('result',$this->result);
		
		$smarty->display($config->root_path.'/app/calc/CalcView.html');
	}
}

?>
