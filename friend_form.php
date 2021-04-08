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
                <div class="navbar-header"><a class="navbar-brand" href="select_friends.php"><font size=3>Connect Friends</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <!-- データベースに記録していく -->
    <!-- 友達を登録 -->
    <form method="POST" action="insert_friend.php">
        <div class="jumbotron">
            <fieldset>
            <legend>Add My Friend</legend>
                <label>Last Name：<input type="text" name="friend_lname"></label><br>
                <label>First Name：<input type="text" name="friend_fname"></label><br>
                <label>Birthday：<input type="text" name="friend_bd"></label><br>
                <select name="friend_status" id="friend_status">
                    <option>Choose Status</option>
                    <option value ="single">single</option>
                    <option value ="married">married</option>
                    <option value ="divorced">divorced</option>
                    <option value ="bereaved">bereaved</option>
                </select>
                <label>Location：<input type="text" name="friend_location"></label><br>
                <label><textArea name="friend_comment" rows="4" cols="40"></textArea></label><br>
                 <!-- こっそりuserのidを渡す -->
                 <input type="hidden" name="id" value="<?=$_SESSION["id"]?>"><br>
                <input type="submit" value="connect">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
