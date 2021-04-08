<?php

// 共通関数読み込み　
include('funcs.php');

// --------------------------------
// ①ログイン認証
loginCheck();

session_start();

//1. POSTデータ取得
$partner_name = $_POST['partner_name'];
$child1_name = $_POST['child1_name'];
$child1_bd = $_POST['child1_bd'];
$child2_name = $_POST['child2_name'];
$child2_bd = $_POST['child2_bd'];
$family_comment = $_POST['family_comment'];
// こっそり渡されたfriend_idも受け取っておく
$friend_id = $_POST["friend_id"];

//2. DB接続

$pdo = dbConnect();

//３．データ登録SQL作成

// ①.SQL文を用意
$stmt = $pdo->prepare(
  "INSERT INTO
  gs_family_table(family_id,friend_id,partner_name,child1_name,child1_bd,child2_name,child2_bd,family_comment)
 VALUES(
   NULL,:friend_id,:partner_name,:child1_name,:child1_bd,:child2_name,:child2_bd,:family_comment)"
 );

//  ②.バインド変数（SQL文に埋め込む変数）を用意　仮の変数（:~）をここに入れる
$stmt->bindValue(':partner_name', $partner_name, PDO::PARAM_STR);  
$stmt->bindValue(':child1_name', $child1_name, PDO::PARAM_STR);  
$stmt->bindValue(':child1_bd', $child1_bd, PDO::PARAM_STR);  
$stmt->bindValue(':child2_name', $child2_name, PDO::PARAM_STR);  
$stmt->bindValue(':child2_bd', $child2_bd, PDO::PARAM_STR);  
$stmt->bindValue(':family_comment', $family_comment, PDO::PARAM_STR);  
$stmt->bindValue(':friend_id', $friend_id, PDO::PARAM_INT);  //option valueで受け取ったvalueをfriend_idとしてデータベースに格納
//  ③.実行
$status = $stmt->execute();

//  ④データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:". print_r($error, true));
}else{
  //⑤friendごとのfamily_view.phpへリダイレクト
  $redirect= "family_view.php?friend_id=";
  header("Location:$redirect$friend_id");
  exit;
}
?>
