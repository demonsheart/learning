<?php
session_start();

echo $_SESSION['session_var'] . '</br>';

unset($_SESSION['session_var']);
?>
<a href="page3.php">Next page</a>