<!DOCTYPE html>
<html>

<head>
    <title>test for time</title>
</head>

<body>
    <?php
    ini_set('date.timezone', 'PRC');
    $timestamp = time();
    echo '<h1>' . $timestamp . '</h1>';

    $today = getdate();
    print_r($today);
    echo '<br/>';

    var_dump(checkdate(2, 29, 2007));
    echo '<br/>';

    echo strftime('%A<br />');
    echo strftime('%x<br />');
    echo strftime('%c<br />');
    echo strftime('%Y<br />');
    echo strftime('%F<br />');

    ?>
</body>

</html>