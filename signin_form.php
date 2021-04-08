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
                <div class="navbar-header navbar-brand"><font size=3>Connect Friends</div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <!-- データベースに記録していく -->
    <form method="POST" action="insert_user.php">
        <div class="jumbotron">
            <fieldset>
                <legend>Signin</legend>
                <label>Name：<input type="text" name="user_name"></label><br>
                <label>Login ID：<input type="text" name="user_id"></label><br>
                <label>Password：<input type="text" name="user_pw"></label><br>
                <input type="radio" name="kanri_flg" value=0 checked>一般ユーザー
                <input type="radio" name="kanri_flg" value=1>管理者ユーザー
                <input type="submit" value="Register">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
