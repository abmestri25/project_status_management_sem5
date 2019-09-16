<?php
    session_start();

    if(!isset($_SESSION['user_email'])){
        echo '<script>alert("Are You Lost Man?.Let me Redirect You to Login Page");</script>';
        echo "<script>window.open('index.php', '_self')</script>";
    }

    echo "<h1>This is Homepage</h1>";

    include 'api/connection.php';

    $user_email = $_SESSION['user_email'];

    //getting users details
    $getting_user_details_query = "select * from users where email='$user_email'";
    $run_getting_user_details_query = mysqli_query($db, $getting_user_details_query);
    $row = mysqli_fetch_array($run_getting_user_details_query);

    $user_id = $row['id'];
    $username = $row['username'];
    $email = $row['email'];
    $user_position = $row['position'];

    echo '<div style="height:200px; width:200px; border-radius:100px; background-color:red"></div>';
    echo '<h1>USERNAME: '.$username.' </h1>';
    echo '<h4>Your Position: '.$user_position.'</h4>';

    if($user_position == 'leader'){
        $get_project_query = "select * from projects where leader_id='$user_id'";
        $run_get_project_query = mysqli_query($db, $get_project_query );
        $row = mysqli_fetch_array($run_get_project_query);
        $project_status = $row['project_status'];

        echo '<h4>Project Status: '.$project_status.'%</h4>';

    } else if ($user_position == 'guide' || $user_position == 'pc' || $user_position == 'hod'){

        echo '<h4>Project Status: <br>';

        $get_project_query = "select * from projects";
        $run_get_project_query = mysqli_query($db, $get_project_query );
        while($row = $run_get_project_query->fetch_assoc()){
            $project_name = $row['project_name'];
            $project_status = $row['project_status'];
            echo '<div style="margin:10px;height:50px;width:100px;background-color:grey;display: inline-block;text-align: center;">'.$project_name.'<br>'.$project_status.'%</div> &#9';
        } 
        echo "<br>";
    }
    echo '<a href="reports.php">Reports<br></a>';
    echo '<a href="notifications.php">Notifications<br></a>';
    echo '<a href="settings.php">Setting<br></a>';
?>

