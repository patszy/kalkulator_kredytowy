{extends file="main.tpl"}

{block name=content}

<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$config->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: {$user->login}, rola: {$user->role}</span>
</div>

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

{include file='messages.tpl'}

{if isset($result->result)}
<div class="messages info">
	Wynik: {$result->result}
</div>
{/if}

{/block}