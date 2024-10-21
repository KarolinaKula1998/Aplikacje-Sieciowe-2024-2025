<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';
// Kontroler podzielono na część definicji etapów (funkcje)
// oraz część wykonawczą, która te funkcje odpowiednio wywołuje.
// Na koniec wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy  przez zmienne.

//pobranie parametrów
function getParams(&$form){
	$form['k'] = isset($_REQUEST['k']) ? $_REQUEST['k'] : null;
	$form['b'] = isset($_REQUEST['b']) ? $_REQUEST['b'] : null;
	$form['n'] = isset($_REQUEST['n']) ? $_REQUEST['n'] : null;
	$form['m'] = 12;
}

function validate(&$form,&$infos,&$msgs,&$hide_intro){

	//sprawdzenie, czy parametry zostały przekazane - jeśli nie to zakończ walidację
	if ( ! (isset($form['k']) && isset($form['b']) && isset($form['n']) ))	return false;	
	
	//parametry przekazane zatem
	//nie pokazuj wstępu strony gdy tryb obliczeń (aby nie trzeba było przesuwać)
	// - ta zmienna zostanie użyta w widoku aby nie wyświetlać całego bloku itro z tłem 
	$hide_intro = true;

	$infos [] = 'Przekazano parametry.';

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $form['k'] == "") $msgs [] = 'Nie podano pierwszej wartości';
	if ( $form['b'] == "") $msgs [] = 'Nie podano drugiej wartości';
	if ( $form['n'] == "") $msgs [] = 'Nie podano trzeciej wartości';
	
	//nie ma sensu walidować dalej gdy brak parametrów
	if ( count($msgs)==0 ) {
		// sprawdzenie, czy $k, $b i $n są liczbami całkowitymi
		if (! is_numeric( $form['k'] )) $msgs [] = 'Pierwsza wartość nie jest liczbą calkowitą';
		if (! is_numeric( $form['b'] )) $msgs [] = 'Druga wartość nie jest liczbą całkowitą';
		if (! is_numeric( $form['n'] )) $msgs [] = 'Trzecia wartość nie jest liczbą całkowitą';
	}
	
	if (count($msgs)>0) return false;
	else return true;
}
// 3. wykonaj zadanie jeśli wszystko w porządku
function process(&$form,&$infos,&$msgs,&$r){
	$infos [] = 'Parametry poprawne. Wykonuję obliczenia.';
	
	//konwersja parametrów na int
	$form['k'] = floatval($form['k']);
	$form['b'] = floatval($form['b']);
	$form['n'] = floatval($form['n']);

	$r = ($form['k']*(1+($form['b']/$form['m'])^$form['n'])*(1+($form['b']/$form['m'])-1)/((1+($form['b']/$form['m'])^$form['n'])-1))/10;
	}

//definicja zmiennych kontrolera
//inicjacja zmiennych
$form = null;
$infos = array();
$messages = array();
$r = null;
//domyślnie pokazuj wstęp strony (tytuł i tło)
$hide_intro = false;
	
getParams($form);
if ( validate($form,$infos,$messages,$hide_intro) ){
	process($form,$infos,$messages,$r);
}
//Wywołanie widoku, wcześniej ustalenie zawartości zmiennych elementów szablonu
$page_title = 'Kalkulator kredytowy';
$page_description = 'Zachęcam do skorzystania z mojego kalkulatora w celu obliczenia przewidywanej raty kredytu.';
$page_header = 'Symulacja kredytowa';
$page_footer = 'Kalkulator stworzony przez Karolinę Kula';

include 'calc_view.php';