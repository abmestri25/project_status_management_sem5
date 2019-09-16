<?php
    include 'connection.php';

    $notification_id = $_GET['notification_id'];

    $delete_query = "delete from notifications where notification_id = '$notification_id'";
    $run_delete_query = $db->query($delete_query);

    if($run_delete_query){
        echo "successfully deleted";
        header('location: ../notifications.php');
    }else{
        echo "Oops! Something went wrong";
    }
?>