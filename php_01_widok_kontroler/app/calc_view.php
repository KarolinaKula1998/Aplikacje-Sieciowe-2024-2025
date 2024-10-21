<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>

<h3>Prosty kalkulator</h2>

<form class="pure-form pure-form-stacked" action="<?php print(_APP_ROOT);?>/app/calc.php" method="post">
	<legend>Kalkulator kredytowy</legend>
	<fieldset>
	<label for="id_k">Kwota kredytu o którą się ubiegasz </label>
	<input id="id_k" type="text" name="k" value="<?php out($k) ?>" />
	<label for="id_b">Oprocentowanie kredytu w % </label>
	<input id="id_b" type="text" name="b" value="<?php out($b) ?>"  />
	<label for="id_n">Czas kredytowania w miesiącach </label>
	<input id="id_n" type="text" name="n" value="<?php out($n) ?>"  />
	</fieldset>	
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>	

<div class="messages">

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
	echo '<h4>Wystąpiły błędy: </h4>';
	echo '<ol class="err">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php
//wyświeltenie listy informacji, jeśli istnieją
if (isset($infos)) {
	if (count ( $infos ) > 0) {
	echo '<h4>Informacje: </h4>';
	echo '<ol class="inf">';
		foreach ( $infos as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($r)){ ?>
<h4>Wynik</h4>
	<p class="res">
<?php print($r); ?>
	</p>
<?php } ?>

</div>

<?php //dół strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>