{extends file="main.tpl"}

{block name=top}

<div class="bottom-margin">
<form class="pure-form pure-form-stacked" action="{$conf->action_url}creditList">
	<legend>Opcje wyszukiwania</legend>
	<fieldset>
		<input type="text" placeholder="Wartość" name="sf_value" value="{$searchForm->value}" /><br />
		<button type="submit" class="pure-button pure-button-primary">Filtruj</button>
	</fieldset>
</form>
</div>	

{/block}

{block name=bottom}

<div class="bottom-margin">
<a class="pure-button button-success" href="{$conf->action_root}creditNew">+ Nowa osoba</a>
</div>	

<table id="tab_people" class="pure-table pure-table-bordered">
<thead>
	<tr>
		<th>Wartość</th>
		<th>Lata</th>
		<th>Procent</th>
		<th>Koszt</th>
		<th>Edycja</th>
	</tr>
</thead>
<tbody>
{foreach $credits as $c}
{strip}
	<tr>
		<td>{$c["value"]}</td>
		<td>{$c["year"]}</td>
		<td>{$c["percent"]}</td>
		<td>{$c["cost"]}</td>
		<td>
			<a class="button-small pure-button button-secondary" href="{$conf->action_url}creditEdit/{$c['idcredit']}">Edytuj</a>
			&nbsp;
			<a class="button-small pure-button button-warning" href="{$conf->action_url}creditDelete/{$c['idcredit']}">Usuń</a>
		</td>
	</tr>
{/strip}
{/foreach}
</tbody>
</table>
{include file='messages.tpl'}

{/block}
