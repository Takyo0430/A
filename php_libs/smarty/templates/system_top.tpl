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
                [ <a href="{$SCRIPT_NAME}?type=logout">ログアウト</a> ]
                <br>
                <br>
            </td>

            <td sytyle align="left">
              <br><br>
                [ <a href="{$SCRIPT_NAME}?type=smartphonelist&action=form">スマートフォン一覧</a> ]   スマートフォンの検索・更新・削除を行います。<br>
                [ <a href="{$SCRIPT_NAME}?type=memberlist&action=form">メンバーの一覧</a> ]  メンバーの検索・更新・削除を行います。<br>
                <br>

            </td>
        </tr>
    </table>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
