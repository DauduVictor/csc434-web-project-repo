<?php //student
    require_once('lgndetails.php');
    session_start();
    //we need to call the session we used when collecting information from the login page
    if (isset($_SESSION['username'])){
        $my_id = $_SESSION['username'];

        //+details that will be inserted into the database
        $matricid = $my_id;
        $project_name = $_POST['pn'];
        $Abstract = $_POST['abstract'];
        $literature_review = $_POST['lit'];
        $methodology = $_POST['met'];
        $analysis = $_POST['anyls'];
        $conclusion = $_POST['cln'];

        if (isset($_POST['submit'])){
            $query = "SELECT * FROM studentexaminerassign WHERE matricid='$matricid'";
            $result1 = $conn->query($query);
            if(!$result1){
                var_dump("cant write into the database");
                die();
            }
            else{
                $row = $result1->fetch_array(MYSQLI_NUM);
                if ($row == 0){
                    //check the insert statement and change it to update, also check the session variable repeating its self
                    $query = "INSERT INTO studentexaminerassign (matricid, project_name, Abstracts, literature_review, methodology,analysis, conclusion) VALUES('$matricid','$project_name','$Abstract','$literature_review','$methodology','$analysis','$conclusion')";
                    $result2 = $conn->query($query);
                }
                else{
                    var_dump("cannot submit twice");
                    die();
                }
            }
        }
        //we need to call the saved session from login.php so we can use the username(matric number ) as an input into this new table.
        //no need to use isset here because in the html, we already have a required constraint.  
    }
    else{
        var_dump("you are not logged in, please try again");
        die();
    }
    $conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Authentication Login </title>
    </head>
    <body>
        <form method ="POST" action="submit.php" autocomplete="on">
                <p><label><b>Project Name</b><br> <textarea name="pn" required="required" rows="5" cols="70" ></textarea></label></p><br>

                <p><label><b>Abstract (not more than 800 words):</b><br> <textarea name="abstract" required="required" rows="10" cols="135" maxlength="4000" ></textarea></label></p><br>

                <p><label><b>Literature Review (not more than 800 words):</b><br> <textarea name="lit" required="required" rows="10" cols="135" maxlength="4000"></textarea></label></p><br>

                <p><label><b>Methodology (not more than 800 words):</b><br> <textarea name="met" required="required" rows="10" cols="135" maxlength="4000"></textarea></label></p><br>

                <p><label><b>Analysis (not more than 800 words):</b><br> <textarea name="anyls" required="required" rows="10" cols="135" maxlength="4000"></textarea></label></p><br>

                <p><label><b>Conclusion (not more than 400 words):</b><br> <textarea name="cln" required="required" rows="10" cols="135" maxlength="2000"></textarea></label></p><br>

                <input type="submit" name ="submit" value ="submit">
        </form>
        <button type="button"  name="btnId" onclick="window.location.href ='logout.php'">Log out</button>
    </body>
</html>
