<?php

// 共通関数読み込み　
include('funcs.php');

// --------------------------------
// ①ログイン認証
loginCheck();
// --------------------------------
// ②更新画面

// family_view.phpから渡されたidを、GETメソッドで取得 
$friend_id = $_GET["friend_id"];

// 1.  DB接続 
$pdo = dbConnect();

//２．データ取得SQL作成 ※WHEREで、friend_idが一致するデータを取得する
$stmt = $pdo->prepare("SELECT * FROM gs_family_table WHERE friend_id=:friend_id");
// ↓$friend_id　→ :friend_id　↑ WHERE friend_id = :friend_idに入る
$stmt->bindValue(':friend_id',$friend_id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示（idは1つなので、1レコードしか返ってこない）
$view = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . print_r($error, true));
}else{
    // 1レコードのみ抽出するため、whileでなくてOK
    $row = $stmt->fetch();
}
// ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Connect Friends</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default bg-success">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="family_view.php?friend_id=<?=$friend_id?>">Back to Family</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="select_friends.php"><font size=3>Connect Friends</a></div>
            </div>
        </nav>
    </header>
<!-- 更新データを表示し、書き換えられるようにする -->
<!-- $rowをvalueに追加 -->
<form method="POST" action="updatehb.php">
        <div class="jumbotron">
            <fieldset>
                <legend>Update family?</legend>
                <label>Husband：<input type="text" name="partner_name" value="<?=$row["partner_name"]?>"></label><br>
                <label><textArea name="family_comment" rows="4" cols="40"><?=$row["family_comment"]?></textArea></label><br>
                <!-- idをこっそり渡す（hidden） -->
                <input type="hidden" name="friend_id" value="<?=$row["friend_id"]?>">
                <input type="submit" value="update!">
            </fieldset>
        </div>
        
    </form>
    <!-- Main[End] -->

</body>

</html>

