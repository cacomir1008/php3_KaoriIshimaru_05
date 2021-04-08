<?php
// 共通関数読み込み　
include('funcs.php');
session_start();
// --------------------------------
// ①ログイン認証
loginCheck();
// --------------------------------
// ②登録済みの友達表示

//1.DB接続
$pdo = dbConnect();

//２．データ取得SQL作成 
// 全ユーザー情報取得
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . print_r($error, true));
}else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $user_name = h($result['user_name']);
    $user_id = h($result['user_id']);
    $kanri_flg = h($result['kanri_flg']);
    $life_flg = h($result['life_flg']);
    $id = h($result['id']);
        
       $view .= '<tr>';

       $view .= '<td>';
       $view .= $id;
       $view .= '</td>';

       $view .= '<td>';
       $view .= $user_name;
       $view .= '</td>';

       $view .= '<td>';
       $view .= $user_id;
       $view .= '</td>';

       $view .= '<td>';
       $view .= $kanri_flg;
       $view .= '</td>';

       $view .= '<td>';
       $view .= $life_flg;
       $view .= '</td>';

       //   $user_idごとに編集
       $view .= '<td>';
       $view .= '<a href="editus_view.php?id='.$result["id"].'">'."Admin".'</a>';
       $view .= '</td>';
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Connect Friends</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
    <nav class="navbar navbar-default bg-success">
    <div class="container-fluid">
        <div class="navbar-header">
        <span class="navbar-brand"><font size=3><?= $_SESSION["user_name"] ?></span>
        <a class="navbar-brand" href="select_friends.php"><font size=3>Back to connect friend/</a>
        <a class="navbar-brand" href="logout.php"><font size=3>Logout</a>
        </div>
    </div>
    </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

    <!-- View all friends -->

        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Login ID</th>
                            <th>Kanri_flg</th>
                            <th>Life_flg</th>
                        </tr> 
                    </thead>
                <tbody>
                    <?= $view ?>
                </tbody>
                </table>
            </div>
        </div>

<!-- Main[End] -->

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
</script>
</body>

</html>
