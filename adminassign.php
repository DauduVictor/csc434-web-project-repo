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
        <link rel="stylesheet" href="adminassign.css">
    </head>
    <body>
        <h2> Welcome Admin!!</h2>
        <?php
            if ($no_rows == 0) {
                echo "No projects have been submitted by any student";
            } 
            else{
                echo "<h2>Here are the submitted projects</h2>";
        ?>
        <div class="main">
            <section class="glass">
                <div class="games">
                    <div class="status">
                        <div class="front">
            <?php while ($rows = $result->fetch_assoc()){ 
                $pn = $rows['project_name'];
                $sn = $rows['SN'];
            ?>
            <form action="adminassign1.php" method="POST">
                <input type="hidden" name="sn" value="<?= $sn;?>">

                <p><?=$pn;?> assign to: </p>
                <select name="ln">
                <?php foreach($lecturer_name as $name){
                ?>
                    <option value="<?= $name['id']?>"><?= $name['firstname']." ".$name['lastname']; ?></option>
                <?php }?>
                </select>
                <br>
                <button  name ='assign' type="submit" href="adminassign1.php">assign</button>
            </form>
            <?php }?>
        <?php }?>
        <br>
        <button type="button" class="bts" name="btnId" onclick="window.location.href ='logout.php'">Log out</button>
                        </div>
                    </div>
                </div>
            </section>
                </main>            
        </div>
       
    </body>
</html>