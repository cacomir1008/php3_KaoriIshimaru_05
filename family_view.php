<?php
include('funcs.php');

// --------------------------------
// ①ログイン認証
loginCheck();
// --------------------------------
// ②家族の表示

// insert_family.phpから渡されたidを、GETメソッドで取得 
$friend_id = $_GET["friend_id"];

//1.DB接続
$pdo = dbConnect();

//２．データ取得SQL作成 
// ①友達の情報：friend_idと一致する情報のみ取得
$stmt = $pdo->prepare("SELECT * FROM gs_friend_table WHERE friend_id=:friend_id");
// ↓$friend_id　→ :friend_id　↑ WHERE friend_id = :friend_idに入る
$stmt->bindValue(':friend_id',$friend_id, PDO::PARAM_INT);
$status = $stmt->execute();

// ②家族の情報：friend_idと一致する情報のみ取得
$stmt2 = $pdo->prepare("SELECT * FROM gs_family_table WHERE friend_id=:friend_id");
// ↓$friend_id　→ :friend_id　↑ WHERE friend_id = :friend_idに入る
$stmt2->bindValue(':friend_id',$friend_id, PDO::PARAM_INT);
$status = $stmt2->execute();

//３．データ表示
// ①友達の情報
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . print_r($error, true));
}else{
    // 1レコードのみ抽出するため、whileでなくてOK
    $row = $stmt->fetch();
}
// ②家族の情報
if ($status == false) {
    $error = $stmt2->errorInfo();
    exit('ErrorQuery:' . print_r($error, true));
}else{
    // 1レコードのみ抽出するため、whileでなくてOK
    $row2 = $stmt2->fetch();
}
// ----------------------------------------------------------------
// 誕生日計算
// 現在の年日時
$now = date("Ymd");

// 友達の誕生日
$birthday=str_replace("-", "", $row['friend_bd']);
$age =(int)(($now-$birthday)/10000).'歳';
// child1の誕生日
$cd1_birthday=str_replace("-", "", $row2['child1_bd']);
$cd1_age =(int)(($now-$cd1_birthday)/10000).'歳';
// child2の誕生日
$cd2_birthday=str_replace("-", "", $row2['child2_bd']);
$cd2_age =(int)(($now-$cd2_birthday)/10000).'歳';

// ----------------------------------------------------------------
// 服のサイズ計算（関数化）
function calSize($cd_age){
    if ($cd_age ==0){
        $size = "50〜70";
    }else if ($cd_age<2){
        $size = "80~90";
    }else if ($cd_age<3){
        $size = "90~95";
    }else if ($cd_age<4){
        $size = "95~100";
    }else if ($cd_age<5){
        $size = "100~110";
    }else if ($cd_age<6){
        $size = "110~120";
    }else{
        $size = "more than 120";
    }
    return $size;
}

$size1 = calSize($cd1_age);
$size2 = calSize($cd2_age);

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
        <a class="navbar-brand" href="select_friends.php"><font size=3>▶︎Back to friend list</a>
        <a class="navbar-brand" href="logout.php"><font size=3>Logout</a>
        </div>
    </div>
    </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->

    <!-- View all friends -->
    <button id="family">Add Family</button>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th class="bd">Birthday</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th>Location</th>
                            <th>Comment</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <tr>
                            <th><?=$row['friend_lname']?></th>
                            <th><?=$row['friend_fname']?></th>
                            <th><?=$row['friend_bd']?></th>
                            <th><?php echo floor(($now-$birthday)/10000);?>歳</th>
                            <th><?=$row['friend_status']?></th>
                            <th><?=$row['friend_location']?></th>
                            <th><?=$row['friend_comment']?></th>
                            <th><a href="edit_view.php?friend_id=<?=$friend_id?>" id="edit_friend">Edit</a></th>
                        </tr> 
                     </tbody>
                </table>
            </div>

            <!-- Friend's Family Add Form （button clickで表示）-->
            <form method="POST" action="insert_family.php" id="family_form" style="display:none">
                <div class="jumbotron">
                    <fieldset>
                        <legend>Friend's Family</legend>
                            <label>Partner：<input type="text" name="partner_name"></label><br>
                            <label>Child1：<input type="text" name="child1_name"></label><br>
                            <label>Child1 BirthDay：<input type="text" name="child1_bd"></label><br>
                            <label>Child2：<input type="text" name="child2_name"></label><br>
                            <label>Child2 BirthDay：<input type="text" name="child2_bd"></label><br>
                            <label><textArea name="family_comment" rows="4" cols="40"></textArea></label><br>
                            <input type="hidden" name="friend_id" value="<?=$friend_id?>"><br>
                            <input type="submit" value="send">
                    </fieldset>
                </div>
            </form>

            <!-- partner Information(button clickで表示) -->
            <div class="table-responsive">
                <button id="partner">partner</button>
                <a href="edithb_view.php?friend_id=<?=$friend_id?>" id="edit_partner" style="display:none">Edit</a>
                <table class="table table-striped" id="partner_info" style="display:none">
                    <thead>
                        <tr>
                            <th>Partner Name：</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><?=$row2['partner_name']?></th>
                            <th><?=$row2['family_comment']?></th>
                        </tr>
                    </tbody>
                </table>

                <!-- Children Information（button clickで表示） -->
                <button id="children">Children</button>
                <a href="editcd_view.php?friend_id=<?=$friend_id?>" id="edit_children" style="display:none">Edit</a>
                <table class="table table-striped" id="children_info" style="display:none">
                    <thead>
                        <tr>
                            <th>Child1 Name：</th>
                            <th><?=$row2['child1_name']?> 's Birthday：</th>
                            <th><?=$row2['child1_name']?> 's Age:</th>
                            <th><?=$row2['child1_name']?> 's Size:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><?=$row2['child1_name']?></th>
                            <th><?=$row2['child1_bd']?></th>
                            <th><?php echo floor(($now-$cd1_birthday)/10000);?>歳</th>
                            <th><?=$size1?></th>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>    
                            <th>Child2 Name：</th>
                            <th><?=$row2['child2_name']?> 's Birthday：</th>
                            <th><?=$row2['child2_name']?> 's Age:</th>
                            <th><?=$row2['child2_name']?> 's Size:</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <tr>
                            <th><?=$row2['child2_name']?></th>
                            <th><?=$row2['child2_bd']?></th>
                            <th><?php echo floor(($now-$cd2_birthday)/10000);?>歳</th>
                            <th><?=$size2?></th>
                        </tr>  
                    </tbody>
 
                 </table>
            </div>
        </div>

    
<!-- Main[End] -->

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
$("#children").on("click",function(){
    $("#children_info").fadeToggle();
    $("#edit_children").fadeToggle();
})

$("#partner").on("click",function(){
    $("#partner_info").fadeToggle();
    $("#edit_partner").fadeToggle();
})

$("#family").on("click",function(){
    $("#family_form").fadeToggle();
})
</script>
</body>

</html>
