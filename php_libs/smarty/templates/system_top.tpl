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
                {$disp_login_state}
            </td>

            <td sytyle align="left">
                [ <a href="{$SCRIPT_NAME}?type=list&action=form">会員一覧</a> ]   会員の検索・更新・削除を行います。<br>
                [ <a href="{$SCRIPT_NAME}?type=notice&action=form">お知らせ</a> ]   会員トップページのお知らせを更新します。<br>
                <br>

            </td>
        </tr>
    </table>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
