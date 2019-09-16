<?php 
    session_start();
    include 'api/connection.php'; 

    //When pressed button with name 'login'
    if(isset($_POST['login'])){
        $user_email = $_POST['u_email'];
        $user_password = $_POST['u_password'];

        $select_user_query = "select * from users where email='$user_email' AND password_hash='$user_password' ";
        $run_select_user_query = mysqli_query($db, $select_user_query);
        $rows = mysqli_num_rows($run_select_user_query);
        
        if($rows == 1){
            $_SESSION['user_email'] = $user_email;
            //echo '<script>alert("login successfyl!")</script>';
            //echo "<script>window.open('something.php', '_self')</script>";
            header('location: homepage.php');

        } else {
            if($rows > 1) echo "there are multiple accounts with same email & password";
            echo "invalid authentication";
        }
    }
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
    <h1>Login</h1>
    <form action="" method="post">
        <input type="text" placeholder="E-mail" name="u_email" required="required">
        <input type="password" placeholder="Password" name="u_password" required="required">
        <button id="log_in" name="login">Submit</button>
    </form>
</body>
</html>