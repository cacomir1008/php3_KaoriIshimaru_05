<?php
// 共通関数読み込み　
include('funcs.php');

// postでデータ取得
$user_name = $_POST['user_name'];
$kanri_flg= $_POST['kanri_flg'];
$life_flg = $_POST['life_flg'];
$id = $_POST['id'];

// データベース接続
$pdo = dbConnect();

// update文で更新(bindValue) 
$sql = 'UPDATE gs_user_table 
SET user_name=:user_name,kanri_flg=:kanri_flg,life_flg=:life_flg
WHERE id =:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  
$stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);  
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT); 

//実行
$status = $stmt->execute();

//データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMessage:". print_r($error, true));
  }else{

// 一覧ページへリダイレクト

  header('Location:select_user.php');
  }

?>
