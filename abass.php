<?php
    //examiner grading page
    require_once('lgndetails.php');//connect to the database
    session_start();//start session
    $id =$_SESSION['sn'];
    //query to select all the values from the table
    $query = "SELECT * FROM studentexaminerassign WHERE SN =$id ";
    $res = $conn->query($query);
    //control check to see if the query executed completely
    if(!$res){
        var_dump("problem occured with the database");
        die();
    }
    else{//the query executed and produced some or no values
        $row = $res->fetch_array(MYSQLI_NUM);
        if ($row == 0){//if the query ran and no values were sent back display the echo statement below
            echo "an error occured from students submission, please check back";
            die();
        }
        else{
            $assignment_projectName = $row[2];
            //abstract holds 3 properties , abstract the name of the field from the database, mark_abstract-name of the checkbox and row[3] which is the value of the abstract in the database
            $assignment = [
                "abstract" => ["Abstract", "mark_abstract", $row[3]],
                "litrerature" => ["Literature Review", "mark_literature_review", $row[4]],
                "methodology" => ["Methodology", "mark_methodology", $row[5]],
                "analysis" => ["Analysis", "mark_analysis", $row[6]],
                "conclusion" => ["Conclusion", "mark_conclusion", $row[7]],
            ];

            //when the submit button is clicked by the examiner
            //collect the the details in single quote below(because they were passed from a form )
            if(isset($_POST['submit'])){
                $ma = $_POST['mark_abstract'];
                $ml = $_POST['mark_literature_review'];
                $mm = $_POST['mark_methodology'];
                $mal = $_POST['mark_analysis'];
                $mc = $_POST['mark_conclusion'];
        
                //query statemement for the database and do the query of updating the tables so that what the admin marked will be recorded on the database
                $query2 = "UPDATE studentexaminerassign 
                SET 
                    mark_abstract = '$ma',
                    mark_literature_review = '$ml',
                    mark_methodology = '$mm',
                    mark_analysis = '$mal',
                    mark_conclusion = '$mc'
                WHERE
                    SN = $id";
                //carry out the query statement and execute it
                $result = $conn->query($query2);
                if(!$result){//if there was a problem executing the query, echo the error statement and end the process
                    echo("there was a problem registering the grades, try again biko!!");
                    die();
                }
            }
        }
    }
    // the readmore feature that the examiner can click on to see the full section of that project
    function readmore($field_desc, $chars = 500){
        $field_desc = substr($field_desc, 0 , $chars);
        return $field_desc;
    }
    // $res->close();
    
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Grade Project</title>
    </head>
    <body>
        <nav>
            <?php
                foreach ($assignment as $key => $value) {
                    //the code below uses readmore function to get the first 3 characters and then use it as target to the key of the same page of #
                    echo "<p><a href='#".readmore($assignment[$key][0], 3)."'>".$assignment[$key][0]."</a></p>";
                }
            ?>
            
        </nav>
        <form action ="abass.php" method="POST">
            <h2><?php echo ($assignment_projectName) ?> </h2>

            <?php
                foreach ($assignment as $key => $value) {
                    //the code below 
                    echo "<p id='".readmore($assignment[$key][0], 3)."'>". $assignment[$key][0] ."<br>".readmore($assignment[$key][2]).
                    "<a href='#'>Read More...</a></p>
                    <div>
                        <label>poor <input type='radio' name='".$assignment[$key][1]."' value='poor'></label>
                        <label>good <input type='radio' name='".$assignment[$key][1]."' value='good'></label>
                        <label>very good <input type='radio' name='".$assignment[$key][1]."' value='Very good' checked='checked'></label>
                        <label>excellent <input type='radio' name='".$assignment[$key][1]."' value='Excellent'></label>
                    </div>";      
                }
            ?>
            <input type="submit" name="submit" value="submit">
        </form>

        <button type="button"  name="btnId" onclick="window.location.href ='logout.php'">Log out</button>
    </body>
</html>
