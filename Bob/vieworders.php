<?php
// create short variable name
$document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Bob's Auto Parts - Order Results</title>
</head>

<body>
    <h1>Bob's Auto Parts</h1>
    <h2>Customer Orders</h2>
    <?php
    @$fp = fopen("$document_root/learning/Bob/orders.txt", 'rb');
    /*method 1*/
    // flock($fp, LOCK_SH); // lock file for reading

    // if (!$fp) {
    //     echo "<p><strong>No orders pending.<br />Please try again later.</strong></p>";
    //     exit;
    // }
    // while (!feof($fp)) {
    //     $order = fgets($fp);
    //     echo htmlspecialchars($order) . "<br />";
    // }

    // flock($fp, LOCK_UN); // release read lock
    // fclose($fp);

    /*method 2*/
    //fpassthru($fp); //将指向文件内容发送到标准输出 然后关闭文件 注意输出将不会产生换行

    /*method 3*/
    echo nl2br(fread($fp, filesize("$document_root/learning/Bob/orders.txt")));
    fclose($fp);
    ?>
</body>

</html>