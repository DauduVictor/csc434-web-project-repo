<?php
    //admin
    require_once('lgndetails.php');
    session_start();
    $query = "SELECT project_name, SN from studentexaminerassign GROUP BY project_name ORDER BY project_name DESC";
    $result=$conn->query($query);
    if(!$result){
        echo("error bringing result");
        die();
    }
    else{
        $no_rows =$result->num_rows;
    }   
?>
   
<!DOCTYPE html>
<html>
    <head>
        <title>Admin reviews</title>
    </head>
    <body>
        <h2> Here are the reviewed projects by the examiners</h2>  
        <p> <?php while ($row = $result->fetch_assoc()){
            echo"<a href='reviewedby.php?id='".$row['project_name']." target='_blank'>".strtoupper($row['project_name'])."</a></br><br>";}?></p>
    </body>
</html>
