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
$stmt = $pdo->prepare("SELECT * FROM gs_friend_table WHERE friend_id=:friend_id");
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
                <div class="navbar-header"><a class="navbar-brand" href="select_friends.php"><font size=3>▶︎Back to friend list</a></div>
            </div>
        </nav>
    </header>
<!-- 更新データを表示し、書き換えられるようにする -->
<!-- $rowをvalueに追加 -->
<form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>Update friend?</legend>
                <label>Last Name：<input type="text" name="friend_lname" value="<?=$row["friend_lname"]?>"></label><br>
                <label>First Name：<input type="text" name="friend_fname" value="<?=$row["friend_fname"]?>"></label><br>
                <label>Birth Day：<input type="text" name="friend_bd" value="<?=$row["friend_bd"]?>"></label><br>
                <label>Location：<input type="text" name="friend_location" value="<?=$row["friend_location"]?>"></label><br>
                <label>Status：<select name="friend_status" id="friend_status" value="<?=$row["friend_status"]?>">
                    <option>Choose Status</option>
                    <option value ="single">single</option>
                    <option value ="married">married</option>
                    <option value ="divorced">divorced</option>
                    <option value ="bereaved">bereaved</option>
                </select>
                </label><br>
                <label><textArea name="friend_comment" rows="4" cols="40"><?=$row["friend_comment"]?></textArea></label><br>
                <!-- idをこっそり渡す（hidden） -->
                <input type="hidden" name="friend_id" value="<?=$row["friend_id"]?>">
                <input type="submit" value="update!">
            </fieldset>
        </div>
        
    </form>
    <!-- Main[End] -->

</body>

</html>

