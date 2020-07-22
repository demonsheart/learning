<?php

//create short variable names
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$feedback = trim($_POST['feedback']);

//set up some static information
$toaddress = "2509875617@qq.com";

$subject = "Feedback from web site";

$mailcontent = "Customer name: " . str_replace("\r\n", "", $name) . "\n" .
    "Customer email: " . str_replace("\r\n", "", $email) . "\n" .
    "Customer comments:\n" . str_replace("\r\n", "", $feedback) . "\n";

$fromaddress = "From: webserver@example.com";

//invoke mail() function to send mail
//mail($toaddress, $subject, $mailcontent, $fromaddress);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Bob's Auto Parts - Feedback Submitted</title>
</head>

<body>
    <h1>Feedback Submitted</h1>
    <p>Your feedback has been sent.</p>
    <p><?php echo nl2br(htmlspecialchars($feedback)) ?></p>
</body>

</html>