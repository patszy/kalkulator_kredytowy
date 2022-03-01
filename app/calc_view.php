<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator Kredytu</title>
</head>
<body>

<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
	<label for="id_cost">Koszt całkowity: </label>
	<input id="id_cost" type="text" name="cost" value="<?php print($cost); ?>" /><br />
	<label for="id_year">Na ile lat: </label>
	<input id="id_year" type="text" name="year" value="<?php print($year); ?>" /><br />
	<label for="id_percent">Oprocentowanie: </label>
	<input id="id_percent" type="text" name="percent" value="<?php print($percent); ?>" /><br />
	<input type="submit" value="Oblicz" />
</form>	

<?php

if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Miesięczna rata: '.$result; ?>
</div>
<?php } ?>

</body>
</html>