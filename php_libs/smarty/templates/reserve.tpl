<!DOCTYPE html>
<html lang="ja">
<head>
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


<br>

この端末の予約は{$count}件です。<br>
<br>
{$links}
{if ($data) }
<table border="1">
<tbody>
<tr><th>番号</th><th>借用開始日</th><th>返却予定日</th><th>借りている人</th><th> </th></tr>



{foreach item=item from=$data}
<tr>
<td>{$item.smartid}</td>
<td>{$item.start_date|escape:"html"}</td>
<td>{$item.return_date|escape:"html"}</td>
<td>{$item.who|escape:"html"}</td>
<td>[<a href="{$SCRIPT_NAME}?type=reserve_cansel&action=deleate&id={$item.id}{$add_pageID}">取り消し</a>]</td>
</tr>
{/foreach}

</tbody></table>
<br>
<br>
<br>

{/if}



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
                  <div style="color:red; font-size: smaller;">{$form.who.error}</div><br>
                {/if}
                {$form.who.html}</td>
            </tr>
            <tr>
              <td><lable>予約日：</lable></td>
              <td>
                <div class="form-group">
                  <input id="calendar" class="group_select" data-mindate=today type="text" name="start_date" value="{$today}">
                </div>
              </td>
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
            {if ( $form.submit2.attribs.value != "" ) }
              {$form.submit2.html}　
            {else}
              {$form.reset.html}　
            {/if}
            {$form.submit.html}
            <input type="hidden" name="type"   value="{$type}">
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
{if $form.javascript}
    {$form.javascript}
{/if}
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
