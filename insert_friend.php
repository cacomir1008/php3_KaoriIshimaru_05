<?php

// 共通関数読み込み　
include('funcs.php');

// --------------------------------
// ①ログイン認証
loginCheck();

session_start();

//1. POSTデータ取得
$friend_fname = $_POST['friend_fname'];
$friend_lname = $_POST['friend_lname'];
$friend_bd = $_POST['friend_bd'];
$friend_status = $_POST['friend_status'];
$friend_location = $_POST['friend_location'];
$friend_comment = $_POST['friend_comment'];

//2. DB接続

$pdo = dbConnect();

//３．データ登録SQL作成

// ①.SQL文を用意
// $stmt = statementの略（そのSQLを指す）他の変数名でも良いが、慣習としてstmtが使われている
// :〜　仮の変数（SQL無効化　フォームから送られて来る内容をそのまま書くのではなく、一旦バインド変数に入れる）
// prepare()関数を使用するためには、Pdoオブジェクトを生成する必要がある
// $pdo->prepare() 接続したDBに対して、実行するプリペアドステートメントのSQLをセット
// life_flg=デフォルト0（アクティブ）
$stmt = $pdo->prepare(
  "INSERT INTO
  gs_friend_table(friend_id,id,friend_fname,friend_lname,friend_bd,friend_status,friend_location,friend_comment,life_flg)
 VALUES(
   NULL,:id,:friend_fname,:friend_lname,:friend_bd,:friend_status,:friend_location,:friend_comment,0)"
 );

//  ②.バインド変数（SQL文に埋め込む変数）を用意　仮の変数（:~）をここに入れる
$stmt->bindValue(':friend_fname', $friend_fname, PDO::PARAM_STR);  
$stmt->bindValue(':friend_lname', $friend_lname, PDO::PARAM_STR);  
$stmt->bindValue(':friend_bd', $friend_bd, PDO::PARAM_STR);  //INT型ではなかった驚き
$stmt->bindValue(':friend_status', $friend_status, PDO::PARAM_STR);  
$stmt->bindValue(':friend_location', $friend_location, PDO::PARAM_STR);  
$stmt->bindValue(':friend_comment', $friend_comment, PDO::PARAM_STR);  
$stmt->bindValue(':id', $_SESSION["id"], PDO::PARAM_INT);  //こっそり受け取ったuserのidをデータベースに格納
//  ③.実行
$status = $stmt->execute();

//  ④データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:". print_r($error, true));
}else{
  //⑤select_book.phpへリダイレクト→SESSIONの問題かLoginエラーになったので、再度ログイン画面へ
  header('Location:select_friends.php');
  exit;
}
?>
