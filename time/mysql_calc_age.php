<!DOCTYPE html>
<html>

<head>
    <title>use mysql to calculate age base birthday</title>
</head>

<body>
    <?php
    include('E:\laragon\pass\pass.php');
    // an example birthday
    $day = 19;
    $month = 4;
    $year = 2002;

    //format birthday as an ISO 8601 date
    $bdayISO = date("c", mktime(0, 0, 0, $month, $day, $year));

    //use mysql
    $db = mysqli_connect($db_server, $db_user, $db_password);
    $res = mysqli_query($db, "select datediff(now(), '$bdayISO')");
    $age = mysqli_fetch_array($res);

    var_dump($age);
    echo '<br />';
    echo 'Current age is ' . floor($age[0] / 365.25) . '.';
    ?>
</body>

</html>