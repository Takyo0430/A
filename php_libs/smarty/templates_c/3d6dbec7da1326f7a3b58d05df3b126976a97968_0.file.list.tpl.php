<?php
/* Smarty version 3.1.30, created on 2018-08-08 18:03:30
  from "/Applications/XAMPP/xamppfiles/htdocs/symposium/php_libs/smarty/templates/list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b6ab1e2f2ae70_09770198',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d6dbec7da1326f7a3b58d05df3b126976a97968' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/symposium/php_libs/smarty/templates/list.tpl',
      1 => 1533712646,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b6ab1e2f2ae70_09770198 (Smarty_Internal_Template $_smarty_tpl) {
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
          <br>
          <br>
        </td>
        <td>
          <br>
          <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
            名前：<input type="text" name="search_key" value="<?php echo $_smarty_tpl->tpl_vars['search_key']->value;?>
">
            <input type="submit" name="submit" value="検索する">
            <input type="hidden" name="type" value="list">
            <input type="hidden" name="action" value="form">
          </form>

          検索結果は<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件です。
          <br>
          <br> <?php echo $_smarty_tpl->tpl_vars['links']->value;?>
 <?php if (($_smarty_tpl->tpl_vars['data']->value)) {?>
          <div class="container">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>番号</th>
                  <th>資産番号</th>
                  <th>名称</th>
                  <th>貸出状況</th>
                  <th> </th>
                  <th>返却予定日</th>
                  <th>借りている人</th>
                  <th> </th>
                </tr>
              </thead>

              <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
                <tr>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
                  <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['asset_number'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                  <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                  <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['reservation'], ENT_QUOTES, 'UTF-8', true);?>
</td>

                  <?php if ($_smarty_tpl->tpl_vars['item']->value['reservation'] == "貸出可") {?>
                  <td>[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=loan&action=form&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">貸出</a>]</td>
                  <?php }?> <?php if ($_smarty_tpl->tpl_vars['item']->value['reservation'] == "貸出中") {?>
                  <td>[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=return&action=form&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">返却</a>]</td>
                  <?php }?>
                  <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['return_date'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                  <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['who'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                  <td>[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=reserve&action=form&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">予約</a>]</td>
                </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

              </tbody>
            </table>
          </div>
          <br>
          <br>
          <br> <?php }?>
          <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=6sto53skk2pvq8tnlp94v16gf0%40group.calendar.google.com&amp;color=%2342104A&amp;ctz=Asia%2FTokyo" style="border-width:0" width="700" height="600"　align="middle"
            frameborder="0" scrolling="no"></iframe>
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
