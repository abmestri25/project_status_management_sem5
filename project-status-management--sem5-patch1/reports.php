<?php
    session_start();
    include 'api/connection.php';

    if(!isset($_SESSION['user_email'])){
        echo '<script>alert("Are You Lost Man?.Let me Redirect You to Login Page");</script>';
        echo "<script>window.open('index.php', '_self')</script>";
    }

    $user_email = $_SESSION['user_email'];

    echo '<h1>Reports Page</h1>';

    $getting_user_details_query = "select * from users where email='$user_email'";
    $run_getting_user_details_query = mysqli_query($db, $getting_user_details_query);
    $row = mysqli_fetch_array($run_getting_user_details_query);
    $user_id = $row['id'];
    $user_position = $row['position'];
        
    if($user_position == 'leader'){
        echo '<h3><a href="create_report.php">CREATE NEW REPORT<a/></h3>';
    
        $find_project_id_query = "select * from projects where leader_id='$user_id'";
        $run_find_project_id_query = mysqli_query($db, $find_project_id_query );
        $row = mysqli_fetch_array($run_find_project_id_query);
        $user_project_id = $row['project_id'];

        $find_user_reports_id_query = "select * from reports where project_id='$user_project_id'";
        $run_find_user_reports_id_query = mysqli_query($db, $find_user_reports_id_query );

        while($row = $run_find_user_reports_id_query->fetch_assoc()){
            $report_id = $row['report_id'];
            $report_title = $row['report_title'];
            $report_content = $row['report_content']; 
            $project_status = $row['project_status'];
            $hod_status = $row['hod_status'];
            $guide_status = $row['guide_status'];
            $pc_status = $row['pc_status'];
            $report_from = 'self';

            echo 'Title: '.$report_title.'<br>';
            echo 'Content: '.$report_content.'<br>';
            echo 'Project Status: '.$project_status.'<br>';
            echo '<table style="border:1px solid;">
                        <tr>
                            <td>SELF</td>
                            <td>GUIDE</td>
                            <td>PC</td>
                            <td>HOD</td>
                        </tr>
                        <tr>
                            <td>sent</td>
                            <td>'.$guide_status.'</td>
                            <td>'.$pc_status.'</td>
                            <td>'.$hod_status.'</td>
                        </tr>
                    </table>';
        } 
    } else if($user_position == 'guide'){

        $find_user_reports_id_query = "select * from reports where not guide_status='---'";
        $run_find_user_reports_id_query = mysqli_query($db, $find_user_reports_id_query );

        while($row = $run_find_user_reports_id_query->fetch_assoc()){
            $report_id = $row['report_id'];
            $project_id = $row['project_id'];
            $report_title = $row['report_title'];
            $report_content = $row['report_content']; 
            $project_status = $row['project_status'];
            $hod_status = $row['hod_status'];
            $guide_status = $row['guide_status'];
            $pc_status = $row['pc_status'];
            $created_date = $row['creation_date'];
            

            $find_leader_id_query = "select * from projects where project_id='$project_id'";
            $run_find_leader_id_query = mysqli_query($db, $find_leader_id_query );
            $roww = mysqli_fetch_array($run_find_leader_id_query);
            $report_from_id = $roww['leader_id'];
            
            $find_leader_name_query = "select * from users where id='$report_from_id'";
            $run_find_leader_name_query = mysqli_query($db, $find_leader_name_query );
            $roww = mysqli_fetch_array($run_find_leader_name_query);
            $report_from = $roww['username'];

            echo 'Title: '.$report_title.'<br>';
            echo 'From: '.$report_from.'<br>';
            echo 'Content: '.$report_content.'<br>';
            echo 'Project Status: '.$project_status.'<br>';

            if($guide_status == 'pending'){
                echo '<a href="approve.php?report_id='.$report_id.'" >Approve</a> ';
                echo '<a href="disapprove.php?report_id='.$report_id.'" >Disapprove</a>';
            }

            echo '<table style="border:1px solid;">
                        <tr>
                            <td>SELF</td>
                            <td>GUIDE</td>
                            <td>PC</td>
                            <td>HOD</td>
                        </tr>
                        <tr>
                            <td>sent</td>
                            <td>'.'self'.'</td>
                            <td>'.$pc_status.'</td>
                            <td>'.$hod_status.'</td>
                        </tr>
                    </table>
                <br><br><br>'
            ;
            
            
        } 
    } else if($user_position == 'pc'){

        $find_user_reports_id_query = "select * from reports where not pc_status='---'";
        $run_find_user_reports_id_query = mysqli_query($db, $find_user_reports_id_query );

        while($row = $run_find_user_reports_id_query->fetch_assoc()){
            $report_id = $row['report_id'];
            $project_id = $row['project_id'];
            $report_title = $row['report_title'];
            $report_content = $row['report_content']; 
            $project_status = $row['project_status'];
            $hod_status = $row['hod_status'];
            $guide_status = $row['guide_status'];
            $pc_status = $row['pc_status'];
            $created_date = $row['creation_date'];
            

            $find_leader_id_query = "select * from projects where project_id='$project_id'";
            $run_find_leader_id_query = mysqli_query($db, $find_leader_id_query );
            $roww = mysqli_fetch_array($run_find_leader_id_query);
            $report_from_id = $roww['leader_id'];
            
            $find_leader_name_query = "select * from users where id='$report_from_id'";
            $run_find_leader_name_query = mysqli_query($db, $find_leader_name_query );
            $roww = mysqli_fetch_array($run_find_leader_name_query);
            $report_from = $roww['username'];

            echo 'Title: '.$report_title.'<br>';
            echo 'From: '.$report_from.'<br>';
            echo 'Content: '.$report_content.'<br>';
            echo 'Project Status: '.$project_status.'<br>';

            if($pc_status == 'pending'){
                echo '<a href="approve.php?report_id='.$report_id.'" >Approve</a> ';
                echo '<a href="disapprove.php?report_id='.$report_id.'" >Disapprove</a>';
            }
            
            echo '<table style="border:1px solid;">
                        <tr>
                            <td>SELF</td>
                            <td>GUIDE</td>
                            <td>PC</td>
                            <td>HOD</td>
                        </tr>
                        <tr>
                            <td>sent</td>
                            <td>'.$guide_status.'</td>
                            <td>'.'self'.'</td>
                            <td>'.$hod_status.'</td>
                        </tr>
                    </table>
                <br><br><br>'
            ;
            
            
        }  
    }else if($user_position == 'hod'){

        $find_user_reports_id_query = "select * from reports where not hod_status='---'";
        $run_find_user_reports_id_query = mysqli_query($db, $find_user_reports_id_query );

        while($row = $run_find_user_reports_id_query->fetch_assoc()){
            $report_id = $row['report_id'];
            $project_id = $row['project_id'];
            $report_title = $row['report_title'];
            $report_content = $row['report_content']; 
            $project_status = $row['project_status'];
            $hod_status = 'self';
            $guide_status = $row['guide_status'];
            $pc_status = $row['pc_status'];
            $created_date = $row['creation_date'];
            

            $find_leader_id_query = "select * from projects where project_id='$project_id'";
            $run_find_leader_id_query = mysqli_query($db, $find_leader_id_query );
            $roww = mysqli_fetch_array($run_find_leader_id_query);
            $report_from_id = $roww['leader_id'];
            
            $find_leader_name_query = "select * from users where id='$report_from_id'";
            $run_find_leader_name_query = mysqli_query($db, $find_leader_name_query );
            $roww = mysqli_fetch_array($run_find_leader_name_query);
            $report_from = $roww['username'];

            echo 'Title: '.$report_title.'<br>';
            echo 'From: '.$report_from.'<br>';
            echo 'Content: '.$report_content.'<br>';
            echo 'Project Status: '.$project_status.'<br>';

            if($hod_status == 'pending'){
                echo '<a href="approve.php?report_id='.$report_id.'" >Approve</a> ';
                echo '<a href="disapprove.php?report_id='.$report_id.'" >Disapprove</a>';
            }
            
            echo '<table style="border:1px solid;">
                        <tr>
                            <td>SELF</td>
                            <td>GUIDE</td>
                            <td>PC</td>
                            <td>HOD</td>
                        </tr>
                        <tr>
                            <td>sent</td>
                            <td>'.$guide_status.'</td>
                            <td>'.$pc_status.'</td>
                            <td>'.'self'.'</td>
                        </tr>
                    </table>
                <br><br><br>'
            ;
            
            
        }  
    }else {
        echo "There's been an error with your Position in the system";
    }

?>