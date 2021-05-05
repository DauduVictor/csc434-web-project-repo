<?php //examiner
    require_once('lgndetails.php');
    session_start();  

    if(isset($_SESSION['username'])){
        $my_id = $_SESSION['username'];
        $query1 = "SELECT firstname, lastname FROM examiner WHERE Id=$my_id";
        $result=$conn->query($query1);
        $rows = $result->fetch_array();//this is to select the lecturer name and display it

        $query2 = "SELECT  SN, project_name FROM studentexaminerassign WHERE lecturerID =$my_id";
        $result2=$conn->query($query2);
        $no_rows = $result2->num_rows;//ill need to use assoc here 

        if(!$result){ //if examiner does not exist, just for proof reading
            echo "unfortunately you are not permitted to grade any result at the moment";
            die();
        }
        $store_projectname = [];
        while($rows=$result2->fetch_assoc()){
        array_push($store_projectname, $rows);//array here is the $lecturer_name//
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Examiner's Page</title>
    </head>
    <body>
        <p> Welcome <?php echo $rows['firstname']." ".$rows['lastname'] ?></p>
        <?php
            if ($no_rows == 0) {
                echo "you have not been assigned any project yet";
                die();
            }
            else{
                echo "<h2>Here are your assigned projects</h2>";
        ?>
            <?php foreach($store_projectname as $name){
                ?>
                <?php $pn =$name['project_name'];
                $_SESSION['sn']=$name['SN'];?>
            
            <div>
                <p><?=$pn;?>
                <button type='button' name ='grade'  onclick='window.location.href="abass.php"'>grade</button></p>
            </div>
            <?php }?>
        <?php }?>    
        <br>
        <button type="button"  name="btnId" onclick="window.location.href ='logout.php'">Log out</button>
    </body>  
</html>