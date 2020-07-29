<?php
include('E:/laragon/pass/pass1.php');
if (!$_POST['name'] || !$_POST['password']) {
    echo "You have not gave some details";
    exit;
}
$name = $_POST['name'];
$pass = $_POST['password'];
//从数据库中获取对应的散列值
$db = new mysqli($db_server, $db_user, $db_password, $db_name);
if ($db->connect_error) {
    echo '<p>Error: Could not connect to database.<br />
             Please try again.<p>';
    exit;
}
$query = "SELECT password FROM message WHERE user = ?"; //查询模板 ?代表占位符
$stmt = $db->prepare($query); //构造查询所需对象
$stmt->bind_param('s', $name); //占位符替换 s表示字符串 i表示整数 b表示blob类型... 依据?的多少顺序传参
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hash);
while ($stmt->fetch()) {
    if (password_verify($pass, $hash)) {//散列值验证
        echo '<h1>Here it is!</h1><p>I bet you are glad you can see this secret page.</p>';
    } else {
        echo '<h1>Sorry!</h1><p>You are not allowed to view these sources!</p>';
    }
}
$stmt->free_result();
$db->close();
