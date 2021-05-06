<?php
    //admin
    require_once('lgndetails.php');
    $query = "SELECT st.MatricNo, st.Pword, st.firstname, st.lastname, st.email, st.phone, s.project_name 
                FROM student st JOIN studentexaminerassign s ON 
                st.MatricNo = s.matricid  ORDER BY st.lastname ASC";//work on dynamically calling the project name that was cliceked on review page by the admin by storug the project name in the session
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
        <title>students view</title>  
        <link rel="stylesheet" href="studentsview.css">
    </head>
    <body>
        <main>
            <section class="glass">
                <div class = games>
                    <div class="status">
                    <form class="fix"> 
                        <div class="prjna"><h2>View Students</h2>
                    </div>
                    <div class="front">
                    <table>
            <tr>
                <th>Matric Number</th>
                <th>Password</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-mail Address</th>
                <th>Phone</th>
                <th>Project Name</th>
            </tr>
            </form>
            <?php 
            if($no_rows>0){
                while ($row = $result->fetch_assoc()){
                    echo "<tr><td>". $row['MatricNo'] ."</td><td>". $row['Pword'] ."</td><td>". $row['firstname']. "</td><td>". $row['lastname']. "</td><td>". $row['email'] ."</td><td>". $row['phone']. "</td><td>". $row['project_name'] ."</td></tr>";
                }
                echo "</table>";
            }
            else{
                echo "this project has not been graded by any examiner";
            }
            ?>
        </table>
      
                    </div>
                    </div>
                </div>
            </section>

        </main>
        <div class="circle1"></div>
        <div class="circle2"></div>
    </body>
</html>