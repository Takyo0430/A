<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{$title}</title>
  <!-- BootstrapのCSS読み込み -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- BootstrapのJS読み込み -->
  <script src="js/bootstrap.min.js"></script>
  <title>{$title}</title>
  <script type="text/javascript" src="js/quickform.js" async></script>

  	<!-- Calender -->
  	<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
  	<script src="https://unpkg.com/flatpickr"></script>

</head>

<body>
  <div style="text-align:center;">
    <hr>
    <strong>{$title}</strong>
    <hr>
    <table>
      <tr>
        <td style="vertical-align: top;">
          [ <a href="{$SCRIPT_NAME}">トップページへ</a> ]

          <br><br>

        </td>
        <td>
          {$message}
          <form {$form.attributes}>
            {$form.hidden}
            <table>
              <tr>
                <td style="vertical-align:top; text-align:right;">{$form.who.label}：</td>
                <td style="text-align:left;">
                  {if isset($form.who.error)}
                  <div style="color:red; font-size: smaller;">{$form.who.error}</div><br> {/if} {$form.who.html}
                </td>
              </tr>
              <tr>
                <td><lable>返却日：</lable></td>
                <td>
                  <div class="form-group">
                    <input id="calendar" class="group_select" data-mindate=today type="text" name="return_date" value="{$today}">
                  </div>
                </td>
                <script>
                  // flatpickr(カレンダー)の初期化
                  flatpickr( '#calendar' );
                </script>
              </tr>

              <tr>
                <td>&nbsp; </td>
                <td>
                  {if ( $form.submit2.attribs.value != "" ) } {$form.submit2.html}　 {else} {$form.reset.html}　 {/if} {$form.submit.html}
                  <input type="hidden" name="type" value="{$type}">
                  <input type="hidden" name="action" value="{$action}">
                </td>
              </tr>
            </table>
            <br>
          </form>
        </td>
      </tr>
    </table>
  </div>
  {if $form.javascript} {$form.javascript} {/if} {if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>

</html>
