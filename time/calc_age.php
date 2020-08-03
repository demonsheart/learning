<!DOCTYPE html>
<html>

<head>
    <title>calculate age base birthday</title>
</head>

<body>
    <?php
    // an example birthday
    $day = 19;
    $month = 4;
    $year = 2002;

    //transform to timestamp
    $bdayunix = mktime(0, 0, 0, $month, $day, $year);
    $nowunix = time();
    $ageunix = $nowunix - $bdayunix;
    $age = floor($ageunix / (365 * 24 * 60 * 60));//没有考虑闰年

    echo '<h1>Current age is ' . $age . '.</h1>';

    ?>
</body>

</html>