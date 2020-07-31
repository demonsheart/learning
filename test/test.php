<?php

$string = "I love all about you";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Your name</title>
</head>

<body>
    <?php
    // $token = strtok($string, " ");
    // while ($token != "") {
    //     echo $token . " ";
    //     $token = strtok(" ");
    // }
    // echo "<br />";
    // $str = str_replace(" ", "#", $string);
    // echo $string . "<br />" . $str . "<br />";

    // echo phpinfo() . "<br />";
    // $c = array(
    //     array('1', 'Tom'),
    //     array('2', 'Mary'),
    //     array('3', 'Peter'),
    //     array('4', 'Jack')
    // );
    // foreach ($c as $ar) {
    //     foreach ($ar as $key => $value) {
    //         echo $key." ".$value . "<br />";
    //     }
    // }
    // $a = $_POST['data'];
    var_dump($_POST['data']);
    echo "<br />";
    print_r($_POST['data']);
    $hash = password_hash("pass", PASSWORD_DEFAULT);
    var_dump(password_verify("pass", $hash));
    echo "<br />" . $hash . "<br />";
    ?>
</body>

</html>