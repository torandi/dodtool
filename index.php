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
		
		<link type="text/plain" rel="author" href="humans.txt" />
	</head>
	<body>
	<div id="battle_select" class="well">
		<h4>Ändra/skapa strid</h2>
		<form method="get" class="form-horizontal">
			<label for="battle_id">Befintlig strid:</label>
			<select id="battle_id" name="id">
<? foreach(Battle::selection() as $battle) { ?>
				<option value="<?=$battle->id?>"><?=$battle?></option>
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
	<div id="content">
	<?  if($battle) { ?>
		<div class="page-header">
			<h1>
				DoD Strid: <?=$battle->name?>
				<small><?=$battle->strdate()?></small>
			</h1>
		</div>
		<h2>Spelledarpersoner</h2>
		<div class="well" id="add_entity">
			<h4>Skapa nya</h4>
			<p>
				Värden med range slumpas inom den.
			</p>
			<hr/>
			<form id="add_entity_form" class="form-horizontal">
				<input type='hidden' name='action' value='add_entity'/>
				<input type='hidden' name='battle_id' value='<?=$battle->id?>'/>
				<?=range_field("add_entity", "count", "Antal: ")?>
				<?=field("add_entity", "name", "Namn", "text")?>
				<?=range_field("add_entity", "life", "Liv: ")?>
				<?=range_field("add_entity", "armor", "Rustning (BV): ")?>
				<?=radio_select("add_entity", "armor_type", "Rustningstyp: ", array('normal'=>"Normal", 'natural'=>"Naturlig"))?>
				<?=radio_select("add_entity", "type", "Typ: ", array('hostile'=>"Fientlig", 'neutral'=>"Neutral", 'friendly' => "Vänlig"))?>
				<?=field("add_entity", "visible", "Visa för spelare", "checkbox")?>
				<?=textarea("add_entity", "info", "Info")?>
				<input type="submit" class="btn btn-primary" value="Skapa"/>
			</form>
		</div>
		<div id="entities">
<?
		foreach($battle->Entity() as $entity) {
			include "partials/entity.php";
		}
?>
		</div>
	<? } ?>
	</div>
	</body>
</html>
