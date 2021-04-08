<?php

// 共通関数読み込み　
include('funcs.php');
// --------------------------------
// ①ログイン認証
loginCheck();
// --------------------------------
// ②更新画面

// select_user.phpから渡されたidを、GETメソッドで取得 
$id = $_GET["id"];
// 1.  DB接続 
$pdo = dbConnect();

//２．データ取得SQL作成 ※WHEREで、friend_idが一致するデータを取得する
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
// ↓$friend_id　→ :friend_id　↑ WHERE friend_id = :friend_idに入る
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
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
                <div class="navbar-header"><a class="navbar-brand" href="select_user.php"><font size=3>▶︎Back to User list</a></div>
            </div>
        </nav>
    </header>
<!-- 更新データを表示し、書き換えられるようにする -->
<!-- $rowをvalueに追加 -->
<form method="POST" action="updateus.php">
        <div class="jumbotron">
            <fieldset>
                <legend>Update User?</legend>
                <p>Admin User = change kanri_flg:1</p>
                <p>Delete User = change life_flg:1</p>
                <label>User Name：<input type="text" name="user_name" value="<?=$row["user_name"]?>"></label><br>
                <label>kanri_flg：<input type="text" name="kanri_flg" value="<?=$row["kanri_flg"]?>"></label><br>
                <label>life_flg：<input type="text" name="life_flg" value="<?=$row["life_flg"]?>"></label><br>
                <!-- idをこっそり渡す -->
                <input type="hidden" name="id" value="<?=$row["id"]?>">
                <input type="submit" value="update!">
            </fieldset>
        </div>
        
    </form>
    <!-- Main[End] -->

</body>

</html>

