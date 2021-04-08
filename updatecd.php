<?php
// 共通関数読み込み　
include('funcs.php');

// postでデータ取得
$friend_id = $_POST["friend_id"];
$child1_name = $_POST["child1_name"];
$child2_name = $_POST["child2_name"];
$child1_bd = $_POST["child1_bd"];
$child2_bd = $_POST["child2_bd"];

// データベース接続
$pdo = dbConnect();

// update文で更新(bindValue) book_idが一致するデータのみ
$sql = 'UPDATE gs_family_table 
SET child1_name=:child1_name,child2_name=:child2_name,child1_bd=:child1_bd,child2_bd=:child2_bd
WHERE friend_id =:friend_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':friend_id', $friend_id, PDO::PARAM_INT);  
$stmt->bindValue(':child1_name', $child1_name, PDO::PARAM_STR);  
$stmt->bindValue(':child2_name', $child2_name, PDO::PARAM_STR); 
$stmt->bindValue(':child1_bd', $child1_bd, PDO::PARAM_STR);  
$stmt->bindValue(':child2_bd', $child2_bd, PDO::PARAM_STR); 

//実行
$status = $stmt->execute();

//データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMessage:". print_r($error, true));
  }else{

// 一覧ページへリダイレクト
  $redirect= "family_view.php?friend_id=";
  header("Location:$redirect$friend_id");
  }

?>
