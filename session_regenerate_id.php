<?php

session_start();

// 現在のセッションID取得
$old_sessionid = session_id();

// 新しいセッションID発行・old_sessionidは無効化
// session_regenerate_id ：現在のセッション情報を維持しながら、セッションIDだけを新しい値に置き換える
// 引数にtrue＝古いセッション情報を削除する（セキュリティの為にも推奨）
session_regenerate_id(true);
$new_sessionid = session_id();

echo "古いセッション:$old_sessionid<br />";
echo "新しいセッション:$new_sessionid<br />";
