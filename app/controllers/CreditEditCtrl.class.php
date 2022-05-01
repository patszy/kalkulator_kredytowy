<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\Validator;
use app\forms\CreditEditForm;

class CreditEditCtrl {

    private $form; //dane formularza

    public function __construct() {
        //stworzenie potrzebnych obiektów
        $this->form = new CreditEditForm();
    }

    // Walidacja danych przed zapisem (nowe dane lub edycja).
    public function validateSave() {
        //0. Pobranie parametrów z walidacją
        $this->form->id = ParamUtils::getFromRequest('id',true,'Błędne wywołanie aplikacji');
		$this->form->value = ParamUtils::getFromRequest('value',true,'Błędne wywołanie aplikacji');
		$this->form->year = ParamUtils::getFromRequest('year',true,'Błędne wywołanie aplikacji');
		$this->form->percent = ParamUtils::getFromRequest('percent',true,'Błędne wywołanie aplikacji');

        if (App::getMessages()->isError()) return false;

        // 1. sprawdzenie czy wartości wymagane nie są puste
        if (empty(trim($this->form->value))) {
            Utils::addErrorMessage('Wprowadź koszt');
        }
        if (empty(trim($this->form->year))) {
            Utils::addErrorMessage('Wprowadź lata');
        }
        if (empty(trim($this->form->percent))) {
            Utils::addErrorMessage('Wprowadź oprocentowanie');
        }

        if (App::getMessages()->isError())
            return false;

        // 2. sprawdzenie poprawności przekazanych parametrów

        return !App::getMessages()->isError();
    }

    //validacja danych przed wyswietleniem do edycji
    public function validateEdit() {
        //pobierz parametry na potrzeby wyswietlenia danych do edycji
        //z widoku listy osób (parametr jest wymagany)
        $this->form->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        return !App::getMessages()->isError();
    }

    public function action_creditNew() {
        $this->generateView();
    }

    //wysiweltenie rekordu do edycji wskazanego parametrem 'id'
    public function action_creditEdit() {
        // 1. walidacja id osoby do edycji
        if ($this->validateEdit()) {
            try {
                // 2. odczyt z bazy danych osoby o podanym ID (tylko jednego rekordu)
                $record = App::getDB()->get("credit", "*", [
                    "idcredit" => $this->form->id
                ]);
                // 2.1 jeśli osoba istnieje to wpisz dane do obiektu formularza
                $this->form->id = $record['idcredit'];
				$this->form->value = $record['value'];
				$this->form->year = $record['year'];
				$this->form->percent = $record['percent'];
				$this->form->cost = $record['cost'];
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }

        // 3. Wygenerowanie widoku
        $this->generateView();
    }

    public function action_creditDelete() {
        // 1. walidacja id osoby do usuniecia
        if ($this->validateEdit()) {

            try {
                // 2. usunięcie rekordu
                App::getDB()->delete("credit", [
                    "idcredit" => $this->form->id
                ]);
                Utils::addInfoMessage('Pomyślnie usunięto rekord');
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas usuwania rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }

        // 3. Przekierowanie na stronę listy osób
        App::getRouter()->forwardTo('creditList');
    }

    public function action_creditSave() {

        // 1. Walidacja danych formularza (z pobraniem)
        if ($this->validateSave()) {
            // 2. Zapis danych w bazie
            try {

                //2.1 Nowy rekord
                if ($this->form->id == '') {
                    //sprawdź liczebność rekordów - nie pozwalaj przekroczyć 20
                    $count = App::getDB()->count("credit");
                    if ($count <= 20) {
                        App::getDB()->insert("credit", [
                            "value" => $this->form->value,
							"year" => $this->form->year,
							"percent" => $this->form->percent,
							"cost" => ($this->form->value+($this->form->value*($this->form->percent/100)*$this->form->year))/($this->form->year*12)
                        ]);
                    } else { //za dużo rekordów
                        // Gdy za dużo rekordów to pozostań na stronie
                        Utils::addInfoMessage('Ograniczenie: Zbyt dużo rekordów. Aby dodać nowy usuń wybrany wpis.');
                        $this->generateView(); //pozostań na stronie edycji
                        exit(); //zakończ przetwarzanie, aby nie dodać wiadomości o pomyślnym zapisie danych
                    }
                } else {
                    //2.2 Edycja rekordu o danym ID
                    App::getDB()->update("credit", [
						"value" => $this->form->value,
						"year" => $this->form->year,
						"percent" => $this->form->percent,
						"cost" => ($this->form->value+($this->form->value*($this->form->percent/100)*$this->form->year))/($this->form->year*12)
					], [ 
						"idcredit" => $this->form->id
					]);
                }
                Utils::addInfoMessage('Pomyślnie zapisano rekord');
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }

            // 3b. Po zapisie przejdź na stronę listy osób (w ramach tego samego żądania http)
            App::getRouter()->forwardTo('creditList');
        } else {
            // 3c. Gdy błąd walidacji to pozostań na stronie
            $this->generateView();
        }
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form); // dane formularza dla widoku
        App::getSmarty()->display('CreditEdit.tpl');
    }

}
