{extends file="main.tpl"}

{block name=footer}Domyślna treść stopki w szablonieu głównym.{/block}

{block name=content}
<form action="{$config->action_root}calcCompute" method="post" class="pure-form pure-form-stacked">
	<legend>Kalkulator</legend>
	<fieldset>
		<label >Koszt całkowity:
			<input type="text" name="cost" value="{$form->cost}" /><br />
		</label>
		<label>Na ile lat:
			<input type="text" name="year" value="{$form->year}" /><br />
		</label>
		<label>Oprocentowanie:
			<input type="text" name="percent" value="{$form->percent}" /><br />
		</label>
	</fieldset>
	<input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
</form>	

</div>

<div class="messages">
	{if $messages->isError()}
		<h3>Wynikowe błędy: </h3>
		<ol class="error">
			{foreach $messages->getErrors() as $errors}
			{strip}
				<li>{$errors}</li>
			{/strip}
			{/foreach}
		</ol>
	{/if}

	{if $messages->isInfo()}
		<h3>Etap: </h3>
		<ol class="info">
			{foreach $messages->getInfos() as $info}
			{strip}
				<li>{$info}</li>
			{/strip}
			{/foreach}
		</ol>
	{/if}

	{if isset($result->result)}
		<h3>Wynik:</h3>
		<p class="result">{$result->result}</p>
	{/if}
</div>

{/block}