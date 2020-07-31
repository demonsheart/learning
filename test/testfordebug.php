<?php
$db = @mysqli_connect('localhost', 'root', '', 'test_db') or die("无法连接服务器");
mysqli_query($db, "set names utf8");
$sq = "select * from user";
$result = mysqli_query($db, $sq);
?>
<table width="370" border="1" cellspacing="0" cellpadding="0">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }
    mysqli_close($db);
    ?>
</table>