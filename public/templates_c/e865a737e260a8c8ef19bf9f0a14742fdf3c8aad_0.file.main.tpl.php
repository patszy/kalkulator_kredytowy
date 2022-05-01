<?php
/* Smarty version 4.1.0, created on 2022-05-01 14:32:31
  from '/Applications/XAMPP/xamppfiles/htdocs/kalkulator_kredytowy/app/views/templates/main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_626e7ddf1858a9_23353877',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e865a737e260a8c8ef19bf9f0a14742fdf3c8aad' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/kalkulator_kredytowy/app/views/templates/main.tpl',
      1 => 1651407727,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_626e7ddf1858a9_23353877 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
	<meta charset="utf-8"/>
	<title>Aplikacja bazodanowa</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css"
		integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_url;?>
/css/style.css">
</head>

<body style="margin: 20px;">

<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
creditList" class="pure-menu-heading pure-menu-link">Lista</a>
<?php if (count($_smarty_tpl->tpl_vars['conf']->value->roles) > 0) {?>
	<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
logout" class="pure-menu-heading pure-menu-link">Wyloguj</a>
<?php } else { ?>	
	<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
loginShow" class="pure-menu-heading pure-menu-link">Zaloguj</a>
<?php }?>
</div>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1682915002626e7ddf184036_86322325', 'top');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_531634533626e7ddf184a83_89814334', 'messages');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1688974460626e7ddf185196_09850240', 'bottom');
?>


</body>

</html><?php }
/* {block 'top'} */
class Block_1682915002626e7ddf184036_86322325 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'top' => 
  array (
    0 => 'Block_1682915002626e7ddf184036_86322325',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php
}
}
/* {/block 'top'} */
/* {block 'messages'} */
class Block_531634533626e7ddf184a83_89814334 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'messages' => 
  array (
    0 => 'Block_531634533626e7ddf184a83_89814334',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php
}
}
/* {/block 'messages'} */
/* {block 'bottom'} */
class Block_1688974460626e7ddf185196_09850240 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'bottom' => 
  array (
    0 => 'Block_1688974460626e7ddf185196_09850240',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php
}
}
/* {/block 'bottom'} */
}
