<?php
/* Smarty version 3.1.30, created on 2018-09-27 12:08:51
  from "/Applications/XAMPP/xamppfiles/htdocs/symposium/php_libs/smarty/templates/message.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bac49c37e3778_82209370',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f130e72ccddaa626363d0f1f777bbf7465b04049' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/symposium/php_libs/smarty/templates/message.tpl',
      1 => 1532338832,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bac49c37e3778_82209370 (Smarty_Internal_Template $_smarty_tpl) {
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
