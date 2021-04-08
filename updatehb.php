<?php
// 共通関数読み込み　
include('funcs.php');

// postでデータ取得
$friend_id = $_POST["friend_id"];
$partner_name = $_POST["partner_name"];
$family_comment = $_POST["family_comment"];

// データベース接続
$pdo = dbConnect();

// update文で更新(bindValue) book_idが一致するデータのみ
$sql = 'UPDATE gs_family_table 
SET partner_name=:partner_name,family_comment=:family_comment
WHERE friend_id =:friend_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':friend_id', $friend_id, PDO::PARAM_INT);  
$stmt->bindValue(':partner_name', $partner_name, PDO::PARAM_STR);  
$stmt->bindValue(':family_comment', $family_comment, PDO::PARAM_STR); 

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
