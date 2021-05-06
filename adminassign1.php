<?php
    require_once('lgndetails.php');
    session_start();
    if(isset($_POST['assign'])){
        if(isset($_POST['sn'])&& isset($_POST['ln'])){
            $ln = $_POST['ln'];
            $sn = $_POST['sn'];
            $query = "SELECT lecturerID FROM studentexaminerassign WHERE SN=$sn";
            $result=$conn->query($query);
            $no_rows=$result->num_rows;
            while($rows=$result->fetch_assoc()){
                if($rows['lecturerID'] == $ln){
                    echo "cannot assign to a lecturer twice";
                    die();
                }
                else{
                    $query = "UPDATE studentexaminerassign SET lecturerID = '$ln' WHERE SN='$sn'";
                    $result1=$conn->query($query);
                    if(!$result1){
                        echo "could not assign the project to the examiner";
                    }
                    else{
                        echo "assigning successfull";
                    }
                }
            }
            
        }
    }
?>