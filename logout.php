<?php
    //php code to log out any of the examiner, student or admin
    session_start();
    session_destroy();
    header('Location:login.php');
?>