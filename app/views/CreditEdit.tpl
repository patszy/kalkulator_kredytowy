{extends file="main.tpl"}

{block name=top}

<div class="bottom-margin">
<form action="{$conf->action_root}creditSave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Dane kredytu</legend>
		<div class="pure-control-group">
            <label for="value">Wartość</label>
            <input id="value" type="text" placeholder="Wartość" name="value" value="{$form->value}">
        </div>
		<div class="pure-control-group">
            <label for="year">Lata</label>
            <input id="year" type="text" placeholder="Lata" name="year" value="{$form->year}">
        </div>
		<div class="pure-control-group">
            <label for="percent">Procenty</label>
            <input id="percent" type="text" placeholder="Procenty" name="percent" value="{$form->percent}">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
			<a class="pure-button button-secondary" href="{$conf->action_root}creditList">Powrót</a>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="{$form->id}">
</form>	
</div>
{include file='messages.tpl'}

{/block}
