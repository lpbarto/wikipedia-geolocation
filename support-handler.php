<?php
    


    $visitor_email = $_POST['email'];
    $name = $_POST['name'] ;
    $surname = $_POST['surname'];
    $message = $_POST['message'];

    $email_from = 'donaldkpj@gmail.com';

    $email_subject = "New Form Submission";

    $email_body = "User Name: $name $surname.\n ".
                  "User Email: $visitor_email.\n".
                  "User Message: $message.\n";

    $to = 'infowikimaps@gmail.com';

    $headers = "From: $email_from \r\n";
 
    $headers .= "Reply-To: $visitor_email \r\n";

    mail($to,$email_subject,$email_body,$headers);

    header("Location: support.html");

?>
