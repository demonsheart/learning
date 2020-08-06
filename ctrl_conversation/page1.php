<?php
session_start();

$_SESSION['session_var'] = "Hello world!";

echo $_SESSION['session_var'] . '</br>';
?>
<a href="page2.php">Next page</a>