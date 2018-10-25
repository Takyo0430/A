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
</head>

<body>
  <div style="text-align:center;">
    <hr>
    <strong>{$title}</strong>
    <hr>

    <table>
      <tr>
        <td style="vertical-align: top;">
          <br>
          <br>
        </td>
        <td>
          <br>
          <form {$form.attributes}>
            名前：<input type="text" name="search_key" value="{$search_key}">
            <input type="submit" name="submit" value="検索する">
            <input type="hidden" name="type" value="list">
            <input type="hidden" name="action" value="form">
          </form>

          検索結果は{$count}件です。
          <br>
          <br> {$links} {if ($data) }
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
                {foreach item=item from=$data}
                <tr>
                  <td>{$item.id}</td>
                  <td>{$item.asset_number|escape:"html"}</td>
                  <td>{$item.name|escape:"html"}</td>
                  <td>{$item.reservation|escape:"html"}</td>

                  {if $item.reservation eq "貸出可"}
                  <td>[<a href="{$SCRIPT_NAME}?type=loan&action=form&id={$item.id}{$add_pageID}">貸出</a>]</td>
                  {/if} {if $item.reservation eq "貸出中"}
                  <td>[<a href="{$SCRIPT_NAME}?type=return&action=form&id={$item.id}{$add_pageID}">返却</a>]</td>
                  {/if}
                  <td>{$item.return_date|escape:"html"}</td>
                  <td>{$item.who|escape:"html"}</td>
                  <td>[<a href="{$SCRIPT_NAME}?type=reserve&action=form&id={$item.id}{$add_pageID}">予約</a>]</td>
                </tr>
                {/foreach}
              </tbody>
            </table>
          </div>
          <br>
          <br>
          <br> {/if}
          <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=6sto53skk2pvq8tnlp94v16gf0%40group.calendar.google.com&amp;color=%2342104A&amp;ctz=Asia%2FTokyo" style="border-width:0" width="700" height="600"　align="middle"
            frameborder="0" scrolling="no"></iframe>
        </td>
      </tr>
    </table>
  </div>
  {if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>

</html>
