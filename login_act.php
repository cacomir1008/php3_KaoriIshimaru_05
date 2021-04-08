<?php
// 共通関数読み込み　
include('funcs.php');

// session変数（サーバーに変数を持たせる、ページをまたいで使える）
session_start();
// login.phpのフォームから飛んでくるlogin_idとlogin_pwを受け取り、変数に入れる
$login_id = $_POST["login_id"];
$login_pw = $_POST["login_pw"];
// こっそり渡されたid・kanri_flg・life_flgも受け取っておく
$id = $_POST["id"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];

// データベース接続
$pdo = dbConnect();

// SQL作成・データ登録（user_idとuser_pwの両方が等しく、Active（life_flgが1）のデータ）
$sql = "SELECT * FROM gs_user_table WHERE user_id= :login_id AND user_pw = :login_pw AND life_flg =0";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':login_id', $login_id, PDO::PARAM_STR);  
$stmt->bindValue(':login_pw', $login_pw, PDO::PARAM_STR);  
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . print_r($error, true));
}

// 抽出したデータ数を取得
// ID・PWが一致した1レコードだけ、fetch関数で取得（配列で$valに）
$val = $stmt->fetch();

// 該当レコード→SESSION関数に値を代入
// id(Auto Increment）が空でなければ（idが存在していれば）{}内を実行する
if($val["id"]!=""){
    // sessionが始まるとユニークキーが発行される→session_id関数で受け取りセッション変数へ
    $_SESSION["check_sessionid"] = session_id();
    // データベースのuser_nameをサーバーに持たせる　「〜さん　ようこそ」など表示で使える
    $_SESSION["user_name"] = $val['user_name'];
    // 管理者ページを表示させる用に、kanri_flgも持たせる
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    // 他のデータベースに渡せるよう、SESSION IDでuserのidを受け取っておく
    $_SESSION["id"] = $val['id'];
    // Login処理に成功→select_book.phpへ
    header("Location:select_friends.php");
}else{
    header("location:login.php");
    exit;
}
?>