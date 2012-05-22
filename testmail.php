<?php
    $to = "devilred101@gmail.com";
    $subject = "Test Email";
    $body="This is a test email";
    $headers = "From: Ed the Loon <noreply@edtheloon.com>\r\n";
    
    mail($to, $subject, $body, $headers);
?>