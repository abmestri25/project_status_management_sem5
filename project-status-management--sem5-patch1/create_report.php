<?php
    session_start();

    if(!isset($_SESSION['user_email'])){
        echo '<script>alert("Are You Lost Man?.Let me Redirect You to Login Page");</script>';
        echo "<script>window.open('index.php', '_self')</script>";
    }

    include 'api/connection.php';
    echo '<h1>Create Report</h1>';

    $user_email = $_SESSION['user_email'];
    $getting_user_details_query = "select * from users where email='$user_email'";
    $run_getting_user_details_query = mysqli_query($db, $getting_user_details_query); 
    $row = mysqli_fetch_array($run_getting_user_details_query);
    $user_id = $row['id'];
    $user_position = $row['position'];
    
    if($user_position == 'leader'){

        $getting_user_details_query = "select * from projects, users where projects.leader_id=users.id and users.email='$user_email'";
        $run_getting_user_details_query = mysqli_query($db, $getting_user_details_query); 
        $row = mysqli_fetch_array($run_getting_user_details_query);
        $project_id = $row['project_id'];

        if(isset($_POST['report_submit'])){
            $report_title = $_POST['report_title'];
            $report_content = $_POST['report_content'];
            $report_project_status = $_POST['report_project_status'];

            $report_create_query = "insert into reports (project_id, report_title, report_content, project_status) values ('$project_id', '$report_title', '$report_content', '$report_project_status')";
            $run_report_create_query = mysqli_query($db, $report_create_query);

            $last_report_id = mysqli_insert_id($db);//testing

            if($run_report_create_query){
                echo '<script>alert("Report Successfully Created")</script>';
            } else {
                echo '<script>alert("php is shit")</script>';
            }

            $get_guide_id = "select * from users where position='guide'";
            $run_get_guide_id = mysqli_query($db, $get_guide_id); 
            $row = mysqli_fetch_array($run_get_guide_id);
            $guide_id = $row['id'];

            //send the notification to guide
            $notification_query = "insert into notifications (report_id, to_user_id, from_user_id, message) values ('$last_report_id', '$guide_id', '$user_id', 'You Have A New Report')";
            $run_notification_query = mysqli_query($db, $notification_query); 
            if($run_notification_query){
                echo "Notification send successfully";
            }
        }
    } else if($user_position == 'guide' || $user_position == 'pc'|| $user_position == 'hod'){
        echo 'aab kya gaand se akrod todega';
        echo '<script>alert("How did you get here...You lost Man? Let Me Redirect You To Homepage... Hang On")</script>';
        sleep(3);
        header('location: homepage.php');
    } else {
        echo '<script>alert("You Need To Login First")</script>';
        sleep(3);
        echo "<script>window.open('index.php', '_self')</script>";
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
    <form action="" method="post">
        <input type="text" placeholder="Report Title" name="report_title" required="required"><br>
        <input type="textbox" placeholder="Report Content" name="report_content" required="required"><br>
        <input type="number" placeholder="Project Status" name="report_project_status" required="required"><br>
        <button name="report_submit">Submit</button>
    </form>
</body>
</html>