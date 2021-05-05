<?php
    require_once('lgndetails.php');

    if(isset($_POST['sign_in'])){
        if(isset($_POST['matricid']) && isset($_POST['password'])){
            if (strlen($_POST['matricid']) == 3) {
                $user_name = mysql_entities_fix_string($conn,$_POST['matricid']);
                $user_pass = mysql_entities_fix_string($conn, $_POST['password']);

                $query = "SELECT * FROM admin WHERE username = '$user_name'";
                $result = $conn->query($query);
                if(!$result) die($conn->error);
                elseif($result->num_rows){
                    $row = $result->fetch_array(MYSQLI_NUM);
                    $result->close();
    
                    if($user_pass == $row[1]) {
                        session_start();
                        $_SESSION['username']=$user_name;
                        header("Location: http://localhost/exercise/adminassign.php", TRUE, 302);
                        exit;

                    }
                    else {
                        var_dump("Invalid ID or password");
                        die();
                    }  
                }
            }
            if (strlen($_POST['matricid']) == 9) {
                $user_name = mysql_entities_fix_string($conn,$_POST['matricid']);
                $user_pass = mysql_entities_fix_string($conn, $_POST['password']);

                $query = "SELECT * FROM student WHERE MatricNo = '$user_name'";
                $result = $conn->query($query);
                if(!$result) die($conn->error);
                elseif($result->num_rows){
                    $row = $result->fetch_array(MYSQLI_NUM);
                    $result->close();
    
                    if($user_pass == $row[1]) {
                        session_start();
                        $_SESSION['username']=$user_name;
                        header("Location: http://localhost/exercise/submit.php", TRUE, 302);
                        exit;

                    }
                    else {
                        var_dump("Invalid ID or password");
                        die();
                    }  
                }
            }
            elseif (strlen($_POST['matricid']) == 5) {
                $user_name = mysql_entities_fix_string($conn,$_POST['matricid']);
                $user_pass = mysql_entities_fix_string($conn, $_POST['password']);

                $query = "SELECT * FROM Examiner WHERE ID = '$user_name'";
                $result = $conn->query($query);
                if(!$result) die($conn->error);
                elseif($result->num_rows){
                    $row = $result->fetch_array(MYSQLI_NUM);
                    $result->close();

                    if($user_pass == $row[1]){
                        session_start();
                        $_SESSION['username']=$user_name;
                        header("Location: http://localhost/exercise/examiner.php", TRUE, 302);
                        exit;
                    }
                    else var_dump("Invalid ID or password");
                    die();
                }
            else var_dump("Invalid ID or password");
            die();
            }
        else {
            var_dump("Invalid ID or password");
        die();
            }
        }
    }

    function mysql_entities_fix_string($conn,$string){
        // return htmlentities(mysql_fix_string($conn,$string));

        if(get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conn->real_escape_string($string);
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Authentication Login </title>
    </head>
    <body>
        <form method ="POST" action="login.php">
            <p>LOGIN</p>
            <fieldset>
                <p><label>ID <br><input type ="text" name ="matricid" required ="required" placeholder="Matric No or ID" minlength="3" maxlength="9" > </label></p><br>
                <p><label>Password <br><input type ="password" name ="password" required ="required" minlength="5"> </label></p><br>
                <p><input type="submit" name= "sign_in" value="sign in"></p>
            </fieldset>
        </form>
        <p></p>
    </body>
</html>