<?php
//共通で使う関数を記述

// --------------------------------
//①XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

// --------------------------------
//②LOGIN認証チェック関数（セッションリジェネレーション）
function loginCheck(){
    session_start();
    if(
        // isset＝（）が存在してれば→ !をつけて逆の意味、存在していなければ
        // ①session idが入ってるかどうか ※check_sessionidは、セッション関数でlogin_act.phpで設定済み
    !isset($_SESSION["check_sessionid"]) ||
        // ②前ページのsession_idと同じかどうか
    $_SESSION["check_sessionid"]!=session_id()
    )
    {
        echo "LOGIN ERROR";
        // exit()付けないと、次の処理に進んでしまった
        exit();
    }else{
        // 現在のセッションを捨てて、新しいセッションを発行＝＞check_sessionid変数に入れる
        session_regenerate_id(true);
        $_SESSION["check_sessionid"] = session_id();
    }
}

// --------------------------------
// ③データベース接続
function dbConnect(){
    try {
        $pdo = new PDO('mysql:dbname=gs_friends_db;charset=utf8;host=localhost','root','root');
      } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
      }
    //   ＜関数化に伴い追加＞
    // 　関数化すると$pdoの値は関数内に閉じ込められる
    //   →returnで値を入れて関数の外に出す
      return $pdo;
}

?>