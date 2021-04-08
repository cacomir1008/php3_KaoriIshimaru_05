<?php

// 共通関数読み込み　
include('funcs.php');

// --------------------------------
// ①ログイン認証
// loginCheck();

//1. POSTデータ取得
$user_name = $_POST['user_name'];
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];
$kanri_flg = $_POST['kanri_flg'];


//2. DB接続

$pdo = dbConnect();

//３．データ登録SQL作成

// ①.SQL文を用意（sysdateは関数なので()必要）
// $stmt = statementの略（そのSQLを指す）他の変数名でも良いが、慣習としてstmtが使われている
// :〜　仮の変数（SQL無効化　フォームから送られて来る内容をそのまま書くのではなく、一旦バインド変数に入れる）
// prepare()関数を使用するためには、Pdoオブジェクトを生成する必要がある
// $pdo->prepare() 接続したDBに対して、実行するプリペアドステートメントのSQLをセット
// life_flg、kanri_flg：デフォルト0（アクティブ、ノーマル権限）
$stmt = $pdo->prepare(
  "INSERT INTO
  gs_user_table(id,user_name,user_id,user_pw,life_flg,kanri_flg)
 VALUES(
   NULL,:user_name,:user_id,:user_pw,0,:kanri_flg)"
 );

//  ②.バインド変数（SQL文に埋め込む変数）を用意　仮の変数（:~）をここに入れる
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR); 
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);  
$stmt->bindValue(':user_pw', $user_pw, PDO::PARAM_STR);  
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  


//  ③.実行
$status = $stmt->execute();

//  ④データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:". print_r($error, true));
}else{
  //⑤select_book.phpへリダイレクト→SESSIONの問題かLoginエラーになったので、再度ログイン画面へ
  header('Location:login.php');
  exit;
}
?>
