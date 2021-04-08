<?php
// 共通関数読み込み　
include('funcs.php');

// postでデータ取得
$friend_id = $_POST["friend_id"];
$friend_fname = $_POST["friend_fname"];
$friend_lname = $_POST["friend_lname"];
$friend_bd = $_POST["friend_bd"];
$friend_status = $_POST["friend_status"];
$friend_location = $_POST["friend_location"];
$friend_comment = $_POST["friend_comment"];
// $life_flg = $_POST['life_flg'];

// データベース接続
$pdo = dbConnect();

// update文で更新(bindValue) friend_idが一致するデータのみ
$sql = 'UPDATE gs_friend_table 
SET friend_fname=:friend_fname,friend_lname=:friend_lname,friend_bd=:friend_bd,friend_location=:friend_location,
friend_status=:friend_status,friend_comment=:friend_comment
WHERE friend_id =:friend_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':friend_id', $friend_id, PDO::PARAM_INT);  
$stmt->bindValue(':friend_fname', $friend_fname, PDO::PARAM_STR);  
$stmt->bindValue(':friend_lname', $friend_lname, PDO::PARAM_STR); 
$stmt->bindValue(':friend_bd', $friend_bd, PDO::PARAM_STR);  
$stmt->bindValue(':friend_status', $friend_status, PDO::PARAM_STR);  
$stmt->bindValue(':friend_location', $friend_location, PDO::PARAM_STR); 
$stmt->bindValue(':friend_comment', $friend_comment, PDO::PARAM_STR); 

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
