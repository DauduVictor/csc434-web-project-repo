<?php
    //admin
    require_once('lgndetails.php');
    $query = "SELECT st.MatricNo, st.Pword, st.firstname, st.lastname, st.email, st.phone, s.total_scores 
                FROM student st JOIN studentexaminerassign s ON 
                st.MatricNo = s.matricid";//work on dynamically calling the project name that was cliceked on review page by the admin by storug the project name in the session
    $result=$conn->query($query);
    if(!$result){
        var_dump("error bringing result");
        die();
    }
    else{
        $no_rows =$result->num_rows;
    }
    require_once("day.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>reviewed by</title>
    </head>
    <body>
        <table>
            <tr>
                <th>Matric number</th>
                <th>Password</th>
                <th>First name</th>
                <th>Last name</th>
                <th>E-mail address</th>
                <th>Phone</th>
                <th>Scores</th>
            </tr>
            <?php 
            if($no_rows>0){
                while ($row = $result->fetch_assoc()){
                    echo "<tr><td>". $row['MatricNo'] ."</td><td>". $row['Pword'] ."</td><td>". $row['firstname']. "</td><td>". $row['lastname']. "</td><td>". $row['email'] ."</td><td>". $row['phone']. "</td><td>". $row['total_scores'] ."</td></tr>";
                }
                echo "</table>";
            }
            else{
                echo "this project has not been graded by any examiner";
            }
            ?>
        </table>
    </body>
</html>