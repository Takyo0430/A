<!DOCTYPE html>
<html lang="ja">
<head>
  <title>{$title}</title>
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
          <br>
          <br>
        </td>
        <td>
          <p>[ <a href="{$SCRIPT_NAME}?type=smartphoneregist&action=form{$add_pageID}">新規登録</a> ]
            <br>

            <form {$form.attributes}>
              名前：<input type="text" name="search_key" value="{$search_key}">
              <input type="submit" name="submit" value="検索する">
              <input type="hidden" name="type" value="list">
              <input type="hidden" name="action" value="form">
            </form>



            検索結果は{$count}件です。<br>
            <br>
            {$links}
            {if ($data) }
            <table border="1">
              <tbody>
                <tr><th>番号</th><th>資産番号</th><th>名称</th><th>貸出状態</th><th>返却日</th><th>借りている人</th><th>　</th></tr>



                {foreach item=item from=$data}
                <tr>
                  <td>{$item.id}</td>
                  <td>{$item.asset_number|escape:"html"}</td>
                  <td>{$item.name|escape:"html"}</td>
                  <td>{$item.reservation|escape:"html"}</td>
                  <td>{$item.return_date|escape:"html"}</td>
                  <td>{$item.who|escape:"html"}</td>
                  <td>[<a href="{$SCRIPT_NAME}?type=smartphonemodify&action=form&id={$item.id}{$add_pageID}">更新</a>]</td>
                  <!--<td>[<a href="{$SCRIPT_NAME}?type=delete&action=confirm&id={$item.id}{$add_pageID}">削除</a>]</td>-->
                </tr>
                {/foreach}

              </tbody></table>
              {/if}

            </td>
          </tr>
        </table>
      </div>
      {if ($debug_str)}<pre>{$debug_str}</pre>{/if}
    </body>
    </html>
