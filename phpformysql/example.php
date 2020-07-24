<?php
$servername = "localhost";
$username = "root";
$password = "111111";
$dbname = "test";
// 创建连接
$mysqli = new mysqli($servername, $username, $password, $dbname);

// 检测连接
if ($mysqli->connect_error) {

    die("Connection failed: " . $mysqli->connect_error);

}
// 创建预编译对象
$stmt = $mysqli->prepare("INSERT INTO test (id, name) VALUES(?, ?)");
//参数绑定->给？号赋值 这里类型和顺序要一致,类型、赋值和？？的顺序要一致
//参数有以下四种类型:
//i - integer（整型）
//d - double（双精度浮点型）
//s - string（字符串）
//b - BLOB（binary large object:二进制大对象）
$stmt->bind_param("is", $id, $name);
// 设置参数
$id = "1";
$name = "Doe";
// 执行
$stmt->execute();
$id = "2";
$name = "asd";
$stmt->execute();

$id = "3";
$name = "gfh";
$stmt->execute();
//关闭预编译
$stmt->close();
//关闭数据库连接
$mysqli->close();
