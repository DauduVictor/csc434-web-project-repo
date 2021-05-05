<?php
    //admin
    require_once('lgndetails.php');
    session_start();

    $conn = new mysqli($sn,$un,$pw,$db);
    if($conn->connect_error){
        vardump($conn->connect_error);
        die();
    }
        $query = "SELECT DISTINCT(project_name), SN from studentexaminerassign GROUP BY project_name";
        $result=$conn->query($query);
        $no_rows =$result->num_rows;

        $query1 = "SELECT firstname, lastname, id FROM examiner";
        $result1 =$conn->query($query1);
        
    $lecturer_name = [];
    while($rows=$result1->fetch_assoc()){
        array_push($lecturer_name, $rows);//array here is the $lecturer_name//
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin assigns page</title>
    </head>
    <body>
        <p> Welcome Admin!!</p>
        <?php
            if ($no_rows == 0) {
                echo "No projects have been submitted by any student";
            } 
            else{
                echo "<h2>Here are the submitted projects</h2>";
        ?>
            <?php while ($rows = $result->fetch_assoc()){ 
                $pn = $rows['project_name'];
            ?>
            <div>
                <p><?=$pn;?> assign to: 
                <select>
                <?php foreach($lecturer_name as $name){
                ?>
                    <option value=<?php $name['id']?>><?= $name['firstname']." ".$name['lastname']; ?></option>
                <?php }?>
                </select>
                <button type='button' name ='assign'  onclick='window.location.href=\"\"'>assign</button></p>
            </div>
            <?php }?>
        <?php }?>
        <br>
        <button type="button"  name="btnId" onclick="window.location.href ='logout.php'">Log out</button>
    </body>
</html>