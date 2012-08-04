<?
	/**
	 * Expects $entity to be an instance of Entity
	 */
?>
<div class="well entity">
	<div class='data'>
		<strong><?=$entity->name?></strong>

		<div class='labels'>
		<? if($entity->dead()) { ?>
			<span class='label label-warning'>Död</span>
		<? } ?>

		<?  if($entity->type == 'friendly') { ?>
			<span class='label label-success'>Vänlig</span>
		<? } else if($entity->type == 'neutral') { ?>
			<span class='label'>Neutral</span>
		<? } else if($entity->type == 'hostile') { ?>
			<span class='label label-important'>Fientlig</span>
		<? } ?>

		<? if($entity->visible) { ?>
			<span class='label label-info'>Synlig</span>
		<? } else { ?>
			<span class='label label-inverse'>Dold</span>
		<? } ?>


		</div>
		<div class='progress progress-<?=hp_class_select($entity->life_percent())?>'>
		<div class='bar' style='width: <?=$entity->life_percent()?>%'></div>
		</div>
	</div>

	<div class='attributes'>
		<strong>Liv: </strong> <span class='muted'><?=$entity->life_remaining?> / <?=$entity->life?></span><br/>
		<strong>Rustning <?=($entity->armor_type == 'natural') ? " (naturlig)":""?>: </strong> <span class='muted'><?=$entity->armor_str()?></span><br/>
		<form class='form-inline data-form'>
			<label for='visible_<?=$entity->id?>'><strong>Synlig: </strong></label>
			<input type='checkbox' class='entity-visible' name = 'visible' <?=($entity->visible ? "checked='checked'" : "" ) ?> id='visible_<?=$entity->id?>'/>
			<br/>
			<textarea name='info' class='entity-info' id='info_<?=$entity->id?>'><?=$entity->info?></textarea>
		</form>
	</div>

	<div class='bottom'>
		<? if(!$entity->dead()) { ?>
			<form class='form-inline hit-form'>
				<input type='hidden' name='action' value='hit_entity'/>
				<input type='hidden' name='entity_id' value='<?=$entity->id?>'/>
				<input type='number' class='input-mini' name='hit'/>
				<input type='submit' value='Gör skada' class='btn btn-danger'/>
			</form>
		<? } ?>
	</div>

	<p class='clear'/>
</div>
