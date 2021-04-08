<?php
include('funcs.php');

//1.DB接続
$pdo = dbConnect();


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Connect Friends!!</title>
<link rel="stylesheet" href="css/range.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.css" type="text/css" media="all" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
    <nav class="navbar navbar-default bg-success">
    <div class="container-fluid row">
        <!-- <img src="img/flowers.jpg"> -->
        <div class="col-6 navbar-brand"><font size="3"><i class="fas fa-users faa-shake animated"></i> Connect Friends!!</div>
        <div class="navbar-header col-6"><a class="navbar-text" href="signin_form.php">Register</a></div>
        <div class="navbar-header col-6"><a class="navbar-text" href="login.php">Login</a></div>
        </div>
    </div>
    </nav>
</header>
<!-- Head[End] -->
<div class="container">
<div class="border border-success rounded" >
<p class="text-center"><font size="3">Have you ever experienced trouble that you forgot name or birthday of your friend's partner and children?</p>
<p class="text-center"><font size="3">Don't worry anymore with "Connect Friends!!! </p> </div>


    <table>
        <tr>
        <th><font size="2">1.Add your friend</th>
        <th><img src="img/friends.jpg" width=400></th>
        <th><font size="2">2.Add your friend's family</th>
        </tr>
        <tr>
        <th><font size="2">3.You can get your friend's family information!</th>
        <th><img src="img/family.jpg" width=400></th>
        <th><font size="2">4.You can get their age and size of kids' clothes automatically!</th>
        </tr>
    </table>
<!-- Main[End] -->

</body>
</html>
