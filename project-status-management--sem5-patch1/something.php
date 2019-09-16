<?php
    session_start();
    include 'api/connection.php';

 $i = $_SESSION['user_email'];
    echo $i;
?>