<?php
    $to = "theadmin@gmail.com";
    $subject = "student/examiner registration";
    $message = "you are establishing cotact with the admin\n Kindky attach your details to each line adn fill in your 'correct' details\n 
    1. Id - \n
    2. first name - \n
    3. last name - \n
    4. phone - \n
    Please note that your password will be your lastname in lower case and your account will be activated after 24 hours\n
    Thanks";
    $headers = "From: webmaster@example.com". "\r\n" ."CC: theadmin@gmail.com";
    mail($to,$subject,$message,$headers);
?>