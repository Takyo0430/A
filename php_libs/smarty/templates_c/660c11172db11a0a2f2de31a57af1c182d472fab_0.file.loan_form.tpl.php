<?php
/* Smarty version 3.1.30, created on 2018-08-08 16:05:48
  from "/Applications/XAMPP/xamppfiles/htdocs/php_libs/smarty/templates/loan_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b6a964c9752a4_69139129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '660c11172db11a0a2f2de31a57af1c182d472fab' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/php_libs/smarty/templates/loan_form.tpl',
      1 => 1533711911,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b6a964c9752a4_69139129 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
  <!-- BootstrapのCSS読み込み -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery読み込み -->
  <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"><?php echo '</script'; ?>
>
  <!-- BootstrapのJS読み込み -->
  <?php echo '<script'; ?>
 src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
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
</div><br> <?php }?> <?php echo $_smarty_tpl->tpl_vars['form']->value['who']['html'];?>

                </td>
              </tr>
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
                  <?php if (($_smarty_tpl->tpl_vars['form']->value['submit2']['attribs']['value'] != '')) {?> <?php echo $_smarty_tpl->tpl_vars['form']->value['submit2']['html'];?>
　 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['form']->value['reset']['html'];?>
　 <?php }?> <?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>

                  <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
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
  <?php if ($_smarty_tpl->tpl_vars['form']->value['javascript']) {?> <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>
 <?php }?> <?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>

</html>
<?php }
}
