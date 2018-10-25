<?php
/* Smarty version 3.1.30, created on 2018-08-08 15:43:26
  from "/Applications/XAMPP/xamppfiles/htdocs/php_libs/smarty/templates/reserve.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b6a910e37e1c6_82817170',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9de2925a549904783121a4b77959a8d0fb587525' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/php_libs/smarty/templates/reserve.tpl',
      1 => 1533710601,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b6a910e37e1c6_82817170 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<?php echo '<script'; ?>
 type="text/javascript" src="js/quickform.js" async><?php echo '</script'; ?>
>
<!-- Calender -->
<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
<?php echo '<script'; ?>
 src="https://unpkg.com/flatpickr"><?php echo '</script'; ?>
>

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

	<br><br>


<br>

この端末の予約は<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件です。<br>
<br>
<?php echo $_smarty_tpl->tpl_vars['links']->value;?>

<?php if (($_smarty_tpl->tpl_vars['data']->value)) {?>
<table border="1">
<tbody>
<tr><th>番号</th><th>借用開始日</th><th>返却予定日</th><th>借りている人</th><th> </th></tr>



<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
<tr>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['smartid'];?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['start_date'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['return_date'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['who'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td>[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=reserve_cansel&action=deleate&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">取り消し</a>]</td>
</tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


</tbody></table>
<br>
<br>
<br>

<?php }?>



      </td>
      <td>
	<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

        <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
          <?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>

          <table>
            <tr>
              <td style="vertical-align:top; text-align:right;"><?php echo $_smarty_tpl->tpl_vars['form']->value['who']['label'];?>
：</td>
              <td style="text-align:left;">
                <?php if (isset($_smarty_tpl->tpl_vars['form']->value['who']['error'])) {?>
                  <div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['who']['error'];?>
</div><br>
                <?php }?>
                <?php echo $_smarty_tpl->tpl_vars['form']->value['who']['html'];?>
</td>
            </tr>
            <tr>
              <td><lable>予約日：</lable></td>
              <td>
                <div class="form-group">
                  <input id="calendar" class="group_select" data-mindate=today type="text" name="start_date" value="<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
">
                </div>
              </td>
            <tr>
              <td><lable>返却日：</lable></td>
              <td>
                <div class="form-group">
                  <input id="calendar" class="group_select" data-mindate=today type="text" name="return_date" value="<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
">
                </div>
              </td>
              <?php echo '<script'; ?>
>
                // flatpickr(カレンダー)の初期化
                flatpickr( '#calendar' );
              <?php echo '</script'; ?>
>
            </tr>

            <tr>
            <td>&nbsp; </td>
            <td>
            <?php if (($_smarty_tpl->tpl_vars['form']->value['submit2']['attribs']['value'] != '')) {?>
              <?php echo $_smarty_tpl->tpl_vars['form']->value['submit2']['html'];?>
　
            <?php } else { ?>
              <?php echo $_smarty_tpl->tpl_vars['form']->value['reset']['html'];?>
　
            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>

            <input type="hidden" name="type"   value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
            <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
            </td>
            </tr>
          </table>
          <br>
        </form>
        </td>
      </tr>
    </table>
</div>
<?php if ($_smarty_tpl->tpl_vars['form']->value['javascript']) {?>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>

<?php }
if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
