<?php
    //this code implements the calculator to be used the admins page
    $output = 0;
    if(isset($_POST['abs'])&& isset($_POST['lit'])&&isset($_POST['met'])&&isset($_POST['anyls'])&&isset($_POST['cln'])){
        $abstract = $_POST['abs'];
        $litreview = $_POST['lit'];
        $methodology = $_POST['met'];
        $analysis = $_POST['anyls'];
        $conclusion = $_POST['cln'];
        $output = $abstract + $litreview + $methodology + $analysis + $conclusion;
    }
?> 