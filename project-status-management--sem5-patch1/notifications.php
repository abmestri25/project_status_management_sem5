<?php
    session_start();

    if(!isset($_SESSION['user_email'])){
        echo '<script>alert("Are You Lost Man?.Let me Redirect You to Login Page");</script>';
        echo "<script>window.open('index.php', '_self')</script>";
    }

    include 'api/connection.php';

    $user_email = $_SESSION['user_email'];
    echo '<h1>Notification Pages</h1>';

    $getting_user_details_query = "select * from users where email='$user_email'";
    $run_getting_user_details_query = mysqli_query($db, $getting_user_details_query); //this is procedural oriented syntax
    //$run_getting_user_details_query = $db->query($getting_user_details_query); //this is oop oriented syntax... does the same thing
    $row = mysqli_fetch_array($run_getting_user_details_query);

    $u_id = $row['id'];

    $getting_user_details_query = "select * from notifications where to_user_id='$u_id'";
    $run_getting_user_details_query = mysqli_query($db, $getting_user_details_query);

    //fetching the notification and displaying them one by one
    while($row = $run_getting_user_details_query->fetch_assoc()){
        if(!$row['checked_status']){
            //if the notifications are not checked, then
            $notification_id = $row['notification_id'];
            $report_id = $row['report_id'];
            $notification_message = $row['message'];
            $from_user_id = $row['from_user_id']; //need to find the user name...
            //$to_user_id = $row['to_user_id'];
            $created_date = $row['creation_date'];

            //findinf report title
            $find_report_title_query = "select * from reports where report_id='$report_id'";
            $run_find_report_title_query = mysqli_query($db, $find_report_title_query);
            $find_report_title = mysqli_fetch_array($run_find_report_title_query);
            $report_title = $find_report_title['report_title'];

            //find the username from from_user_id
            $find_sender_query = "select * from users where id='$from_user_id'";
            $run_find_sender_query = mysqli_query($db, $find_sender_query);
            $find_user_user = mysqli_fetch_array($run_find_sender_query);
            $from_user_name = $find_user_user['username'];
            
            echo 'Title:'.$report_title.' >> '.$notification_message.' from '.$from_user_name.' '.$created_date.' <a href="api/read_notification.php?notification_id='.$notification_id.'">READ</a>  <a href="api/delete_notification.php?notification_id='.$notification_id.'">DELETE</a><br>';
        }
    }
?>