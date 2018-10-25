<?php
/* Smarty version 3.1.30, created on 2018-07-23 19:26:07
  from "/Applications/XAMPP/xamppfiles/htdocs/php_libs/smarty/templates/system_top.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b55ad3fa24f10_68993697',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a5e93d116da9f2236e0a2f6f0a99e615d0ca7bda' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/php_libs/smarty/templates/system_top.tpl',
      1 => 1532341565,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b55ad3fa24f10_68993697 (Smarty_Internal_Template $_smarty_tpl) {
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
?type=logout">ログアウト</a> ]
	<br>
	<br>
      </td>

      <td>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=list&action=form">会員一覧</a> ]   会員の検索・更新・削除を行います。<br><br>
        <br>
        <br>

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
