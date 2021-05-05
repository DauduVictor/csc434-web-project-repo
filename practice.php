<?php
    //admin -registers student or examiner
    require_once('lgndetails.php');
    
    //Verifying that user inputs details in all the required fields and then executing the sql query using prepared statement and placeholders
    if(isset($_POST['submit'])){
        if(isset($_POST['matricid']) && isset($_POST['password']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['choice'])){
            //depending on the radio button choosen, if it is student- use this code below
            if ($_POST['choice'] == 'student'){
                $stmt = $conn->prepare('INSERT INTO student VALUES(?,?,?,?,?,?)');
    
                //bind parameters to the prepared statement
                $stmt->bind_param('sssssi', $MatricNo ,$pword, $firstname, $lastname ,$email, $phone);
    
                //set the parameters
                $MatricNo = mysql_fix_string($conn,$_POST['matricid']); //mn is matric no
                $pword = mysql_fix_string($conn,$_POST['password']);
                $firstname = mysql_fix_string($conn,$_POST['first_name']);
                $lastname = mysql_fix_string($conn,$_POST['last_name']);
                $email = mysql_fix_string($conn,$_POST['email']);
                $phone = mysql_fix_string($conn,$_POST['phone']);
                
                //execute prepared statement
                $stmt->execute();
                $stmt->close();
                
            }
            //if choice of the radio button is Examiner, use this code below-
            elseif ($_POST['choice'] == 'Examiner'){
                $stmt = $conn->prepare('INSERT INTO examiner VALUES(?,?,?,?,?,?)');
    
                //bind parameters to the prepared statement
                $stmt -> bind_param('sssssi', $Id ,$pword, $firstname, $lastname, $email, $phone);
                //set the parameters
                $Id = mysql_fix_string($conn,$_POST['matricid']);
                $pword = mysql_fix_string($conn,$_POST['password']);
                $firstname = mysql_fix_string($conn,$_POST['first_name']);
                $lastname = mysql_fix_string($conn,$_POST['last_name']);
                $email = mysql_fix_string($conn,$_POST['email']);
                $phone = mysql_fix_string($conn,$_POST['phone']);
    
                //execute prepared statement
                $stmt->execute();
                $stmt->close();
            }
            else{
                var_dump("your choice doesn't exist");
                die();
            }
        }
        else{
            var_dump("!!all fields from the form is required!!");
            die();
        }
    }
    //closing the parameters / objects that have their memory opened
    $conn->close();
    
    //function to crosscheck the inputs made by the admin
    function mysql_fix_string($conn,$string){
        // return htmlentities(mysql_entities_fix_string($conn,$string));

        if(get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conn->real_escape_string($string);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
    </head>
    <body>
        <form method="POST" action="practice.php"  autocomplete="on">
            <p>Register Student Here</p>
            <fieldset>
                <p>Student or Examiner:</p>
                <ul>
                    <li><input type="radio" name="choice" value="student" checked>Student</li>
                    <li><input type="radio" name="choice" value="Examiner">Examiner</li>
                </ul>
                <p><label>Matric No: <br><input type ="text" name ="matricid" required ="required" placeholder="Matric No or ID" minlength="5" maxlength="9" > </label></p><br>
                <p><label>Password: <br><input type ="password" name ="password" required ="required" minlength="5"> </label></p><br>
                <p><label>First Name: <br><input type ="text" name ="first_name" required ="required" > </label></p><br>
                <p><label>Last Name: <br><input type ="text" name ="last_name" required ="required" > </label></p><br>
                <p><label>Email: <br><input type ="email" name ="email" required ="required"> </label></p><br>
                <p><label>Phone Number: <br><input type ="tel" name ="phone" required ="required"> </label></p><br>
                <p><input type="submit" name="submit"></p>
            </fieldset>
        </form>
    </body>
</html>