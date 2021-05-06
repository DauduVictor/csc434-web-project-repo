<?php
    //admin
    require_once('lgndetails.php');
    $query = "SELECT e.firstname,e.lastname, s.mark_abstract,s.mark_literature_review,s.mark_methodology,s.mark_analysis,s.mark_conclusion 
                FROM examiner e JOIN studentexaminerassign s ON 
                e.Id = s.lecturerID
                WHERE project_name LIKE('lagud%')";//work on dynamically calling the project name that was cliceked on review page by the admin by storug the project name in the session
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
        <title>Grade Calculator</title>
        <link rel="stylesheet" href="reviewedby.css">
    </head>
    <body>
        <h2>Grades</h2>
    <table>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Astract</th>
                <th>Literature review</th>
                <th>Methodology</th>
                <th>Analysis</th>
                <th>Conclusion</th>
            </tr>
            <?php 
            if($no_rows>0){
                while ($row = $result->fetch_assoc()){
                    echo "<tr><td>". $row['firstname'] ."</td><td>". $row['lastname'] ."</td><td>". $row['mark_abstract']. "</td><td>". $row['mark_literature_review']. "</td><td>". $row['mark_methodology'] ."</td><td>". $row['mark_analysis']. "</td><td>". $row['mark_conclusion'] ."</td></tr>";
                }
                echo "</table>";
            }
            else{
                echo "this project has not been graded by any examiner";
            }
            ?>
        </table><br>
        <main>
            <sectio class="glass">
                <div class="dashboard">
                    <div class="games">
                        <div class="status">
                            <div class="front">
                                <form method = 'POST' action = 'reviewedby.php'>
                                        <div class="card1">
                                            <p><label>Abstract <input type ="number" name= "abs" required ='required' min='5' max='20' step ='5'></label></p>
                                            <p><label>Literature Review<input type ="number" name= "lit" required = 'required' min='5' max='20' step ='5'></label></p>
                                            <p><label>Methodology <input type ="number" name= "met" required = 'required' min='5' max='20' step ='5'></label></p>
                                            <p><label>Analysis <input type ="number" name= "anyls" required = 'required' min='5' max='20' step ='5'></label></p>
                                            <p><label>Conclusion <input type ="number" name= "cln" required = 'required' min='5' max='20' step ='5'></label></p>
                                        </div>

                                    <p><input type = "submit" name = "submit" value = "Calculate" class="btn"></p>

                                    <p>Total score:<b> <?php echo"$output" ?> </b></p>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </sectio>
        </main>
        <div class="circle1"></div>
        <div class="circle2"></div>
    </body>
</html>