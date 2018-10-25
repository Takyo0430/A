<?php
/* Smarty version 3.1.30, created on 2018-10-25 10:59:26
  from "/Applications/XAMPP/xamppfiles/htdocs/symposium/php_libs/smarty/templates/system_top.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5bd1237e91cbf4_98605351',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7ac100ac32100d75c19ce7ab0a463c9c858be07' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/symposium/php_libs/smarty/templates/system_top.tpl',
      1 => 1540432763,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bd1237e91cbf4_98605351 (Smarty_Internal_Template $_smarty_tpl) {
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

            <td sytyle align="left">
              <br><br>
                [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=smartphonelist&action=form">スマートフォン一覧</a> ]   スマートフォンの検索・更新・削除を行います。<br>
                [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=memberlist&action=form">メンバーの一覧</a> ]  メンバーの検索・更新・削除を行います。<br>
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
