<?php
/* Smarty version 4.1.0, created on 2022-03-22 10:00:59
  from '/Applications/XAMPP/xamppfiles/htdocs/kalkulator_kredytowy/app/calc.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_6239904bb1f3a7_93528896',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '619c05ef3cb23a649f7a8ad9f2a450b3630fe235' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/kalkulator_kredytowy/app/calc.html',
      1 => 1647365645,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6239904bb1f3a7_93528896 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_169848296239904bae3b44_08323851', 'footer');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8604754576239904bae5ea5_02279973', 'content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "../templates/main.html");
}
/* {block 'footer'} */
class Block_169848296239904bae3b44_08323851 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_169848296239904bae3b44_08323851',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Domyślna treść stopki w szablonieu głównym.<?php
}
}
/* {/block 'footer'} */
/* {block 'content'} */
class Block_8604754576239904bae5ea5_02279973 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_8604754576239904bae5ea5_02279973',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<form action="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/app/calc.php" method="post" class="pure-form pure-form-stacked">
	<legend>Kalkulator</legend>
	<fieldset>
		<label >Koszt całkowity:
			<input type="text" name="cost" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['cost'];?>
" /><br />
		</label>
		<label>Na ile lat:
			<input type="text" name="year" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['year'];?>
" /><br />
		</label>
		<label>Oprocentowanie:
			<input type="text" name="percent" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['percent'];?>
" /><br />
		</label>
	</fieldset>
	<input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
</form>	

</div>

<div class="messages">
	<?php if ((isset($_smarty_tpl->tpl_vars['messages']->value))) {?>
		<?php if (count($_smarty_tpl->tpl_vars['messages']->value) > 0) {?>
			<h3>Wynikowe błędy: </h3>
			<ol class="error">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
				<li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ol>
		<?php }?>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['infos']->value))) {?>
		<?php if (count($_smarty_tpl->tpl_vars['infos']->value)) {?>
			<h3>Etap: </h3>
			<ol class="error">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['infos']->value, 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
				<li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ol>
		<?php }?>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['result']->value))) {?>
		<h3>Wynik:</h3>
		<p class="result"><?php echo $_smarty_tpl->tpl_vars['result']->value;?>
</p>
	<?php }?>
</div>

<?php
}
}
/* {/block 'content'} */
}
