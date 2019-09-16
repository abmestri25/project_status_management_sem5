<?php
    include 'connection.php';

    $notification_id = $_GET['notification_id'];

    $read_query = "update notifications set checked_status='1' where notification_id='$notification_id'";
    $run_read_query = $db->query($read_query);

    if($run_read_query){
        header('location: ../notifications.php');
    }else{
        echo "Oops! Something went wrong";
    }
?>