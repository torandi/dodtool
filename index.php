<?

include "includes.php";
include "index_actions.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>DoD Spelledarverktyg</title>
		<script src="jquery.js" type="text/javascript"></script>
		<script src="dod.js" type="text/javascript"></script>
		<link type="text/css" rel="stylesheet" href="bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="dod.css" />
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/toggle_display.js"></script>
		<script type="text/javascript" src="js/forum.js"></script>
		<script type="text/javascript" src="js/wz_jsgraphics.js"></script>
		<script type="text/javascript" src="js/override_chrome_stupidity.js"></script>
		
		<link type="text/plain" rel="author" href="/humans.txt" />
	</head>
	<body>
	<div id="battle_select" class="well">
		<h4>Ändra/skapa strid</h2>
		<form method="get" class="form-horizontal">
			<label for="battle_id">Befintlig strid:</label>
			<select id="battle_id" name="id">
<? foreach(Battle::selection() as $battle) { ?>
				<option value="<?=$battle->id?>"><?=$battle->name?></option>
<? } ?>
			</select>
			<input type="submit" value="Välj" class="btn btn-primary"/>
		</form>
		<hr/>
		<form method="post" class="form-horizontal">
			<label for="battle_new">Ny strid: </label>
			<input type="text" name="new_battle"/>
			<input type="submit" value = "Skapa" class="btn btn-success"/>
		</form>
	</div>
	<div id="entities">
		
	</div>

	</body>
</html>
