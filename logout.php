<!-- ログアウトはこのphpを使いまわせる！ -->
<?php
session_start();

// $SESSIONに入っている変数を、配列で全て初期化（$_SESSIONが空っぽに）
$_SESSION = array();

// Cookieに保存してあるSessionIDの保存期間を過去に→無効化して破棄する
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-42000,'/');
}
// サーバー側：SesshonID破棄
session_destroy();

// リダイレクト
header("Location:index.php");
exit();

?>