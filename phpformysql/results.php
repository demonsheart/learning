<!DOCTYPE html>
<html>

<head>
    <title>Book-O-Rama Search Results</title>
</head>

<body>
    <?php
    //create short variable names
    $searchtype = $_POST['searchtype'];
    $searchterm = trim($_POST['searchterm']);

    if (!$searchtype || !$searchterm) {
        echo '<p>You have not entered search details.<br />
             Please go back and try again.<p>';
        exit;
    }

    //whitelist the searchtype
    switch ($searchtype) {
        case 'Title':
        case 'Author':
        case 'ISBN':
            break;
        default:
            echo '<p>That is not a valid search type. <br />
             Please go back and try again.<p>';
            exit;
    }

    $db = new mysqli('localhost', '2509875617', 'xuezhiqian', 'books');
    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br />
             Please try again.<p>';
        exit;
    }

    //将查询模板与数据分开发送 防止SQL注入
    $query = "SELECT ISBN, Author, Title, Price FROM Books WHERE $searchtype = ?"; //查询模板 ?代表占位符
    $stmt = $db->prepare($query); //构造查询所需对象
    $stmt->bind_param('s', $searchterm);//占位符替换 s表示字符串 i表示整数 b表示blob类型... 依据?的多少顺序传参
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($isbn, $author, $title, $price);

    echo "<p>Number of books found: " . $stmt->num_rows . "</p>";

    while ($stmt->fetch()) {
        echo "<p><strong>Title: " . $title . "</strong>";
        echo "<br />Author: " . $author;
        echo "<br />ISBN" . $isbn;
        echo "<br />Price: \$" . number_format($price, 2) . "</p>";
    }

    $stmt->free_result();
    $db->close();
    ?>
</body>

</html>