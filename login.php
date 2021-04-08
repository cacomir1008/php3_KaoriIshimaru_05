<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Login</title>
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<header>
        <nav class="navbar navbar-default bg-success">
            <div class="container-fluid">
                <div class="navbar-header"><span class="navbar-brand"><font size=3>Connect Friends</a></div>
            </div>
        </nav>
    </header>
<body>
<form method="POST" action="login_act.php">
        <div class="jumbotron">
            <fieldset>
                <legend>Login</legend>
                <label>Login ID：<input type="text" name="login_id"></label><br>
                <label>Password：<input type="text" name="login_pw"></label><br>
                <!-- こっそりid・kanri_flg・life_flgを渡す -->
                <input type="hidden" name="id" value="<?=$row["id"]?>"><br>
                <input type="hidden" name="life_flg" value="<?=$row["life_flg"]?>"><br>
                <input type="hidden" name="kanri_flg" value="<?=$row["kanri_flg"]?>"><br>
                <input type="submit" value="login">
            </fieldset>
        </div>
    </form>
</body>
</html>




