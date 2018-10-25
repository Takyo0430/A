<?php
/* Smarty version 3.1.30, created on 2018-07-23 18:40:33
  from "/Applications/XAMPP/xamppfiles/htdocs/php_libs/smarty/templates/message.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b55a291f3a959_64342511',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f410a0b69cea4b823e81fec2f2c6fcb1fc1af9bf' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/php_libs/smarty/templates/message.tpl',
      1 => 1532338832,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b55a291f3a959_64342511 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>
    <table>
      <tr>

      <td style="vertical-align: top;">
	[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]

	<br>
	<br>
      </td>

      <td>
  		<?php echo $_smarty_tpl->tpl_vars['message']->value;?>



        </td>
      </tr>
    </table>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
