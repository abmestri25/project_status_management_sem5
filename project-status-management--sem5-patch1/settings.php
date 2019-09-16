<?php
    session_start();

    if(!isset($_SESSION['user_email'])){
        echo '<script>alert("Are You Lost Man?.Let me Redirect You to Login Page");</script>';
        echo "<script>window.open('index.php', '_self')</script>";
    }

    echo '<h1>Setting Page</h1>';


    $user_email = $_SESSION['user_email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        Username: <input type="text"  name="setting_username"><br>
        Email: <input type="text" name="setting_email"><br>
        Change Password: <input type="text" name="setting_password"><br>
        Re-Enter Password: <input type="text" name="setting_re_password"><br>
        Receive Emain Notification: <input type="checkbox" name="receive_notification"><br>
        <button name="setting_submit" >Submit</button>
    </form>
</body>
</html>