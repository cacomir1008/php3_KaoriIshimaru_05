<?php
// 共通関数読み込み　
include('funcs.php');
session_start();
// -------
// ①ログイン認証
loginCheck();
// --------------------------------
// ②登録済みの友達表示

//1.DB接続
$pdo = dbConnect();

//２．データ取得SQL作成 
// 自分が登録した　かつ　アクティブな友達（life_flg:0）のみ取得
$stmt = $pdo->prepare("SELECT * FROM gs_friend_table WHERE id = {$_SESSION["id"]} AND life_flg=0");
$status = $stmt->execute();

// friend_idと一致する家族の情報のみ取得
$stmt2 = $pdo->prepare("SELECT * FROM gs_family_table");
// -- WHERE friend_id = $friend_id");
$status = $stmt2->execute();

//３．データ表示
$view = "";
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . print_r($error, true));
}else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $friend_id = h($result['friend_id']);
    $friend_fname = h($result['friend_fname']);
    $friend_lname = h($result['friend_lname']);
    $friend_bd = h($result['friend_bd']);
    $friend_status = h($result['friend_status']);
    $friend_location = h($result['friend_location']);
    $friend_comment = h($result['friend_comment']);
    $life_flg = h($result['life_flg']);

    // 誕生日から年齢計算
    // 現在
    $now = date("Ymd");

    // 友達の年齢
    $birthday=str_replace("-", "", h($result['friend_bd']));
    $age =(int)(($now-$birthday)/10000).'歳';
        
       $view .= '<tr>';

       $view .= '<td>';
       $view .= $friend_lname;
       $view .= '</td>';

       $view .= '<td>';
       $view .= $friend_fname;
       $view .= '</td>';

       $view .= '<td>';
       $view .= $friend_bd;
       $view .= '</td>';

       $view .= '<td>';
       $view .= $age;
       $view .= '</td>';

       $view .= '<td>';
       $view .= $friend_status;
       $view .= '</td>';

       $view .= '<td>';
       $view .= $friend_location;
       $view .= '</td>';

       $view .= '<td>';
       $view .= $friend_comment;
       $view .= '</td>';

       //   $friend_idごとに詳細ページへリンク
       $view .= '<td>';
       $view .= '<a href="family_view.php?friend_id='.$result['friend_id'].'">'."Detail".'</a>';
       $view .= '</td>';

       //  削除ボタン
       //  $friend_id ごとに削除
       $view .= '<td>';
       $view .= '<a href="delete_view.php?friend_id='.$result['friend_id'].'">'."Delete".'</a>';
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
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
        <span class="navbar-brand"><font size=3><?= $_SESSION["user_name"] ?> is connecting friends...</span>
        <a class="navbar-brand" href="friend_form.php"><font size=3>▶︎Add my friend/</a>
        <!-- 管理者（kanri_flg=1）の人だけuser_listへのリンクが表示される -->
        <a class="navbar-brand" href="select_user.php" style="display:none" id="user_list"><font size=3><i class="fas fa-key"></i>User list/</a>
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
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Birthday</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th>Location</th>
                            <th>Comment</th>
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

// ④kanri_flg チェック（kanri_flg=1の人だけuser_listへのリンクが出る）
    if(<?=$_SESSION["kanri_flg"]?>!=0){
        $("#user_list").show(500)
    }

</script>
</body>

</html>
