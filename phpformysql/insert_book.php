<!DOCTYPE html>
<html>

<head>
    <title>Book-O-Rama - Book Entry Results</title>
</head>

<body>
    <h1>Book-O-Rama - Book Entry Results</h1>
    <?php
    include('E:/laragon/pass/pass.php');

    //注意判断 对比 !trim($_POST['ISBN']);
    if (
        !(isset($_POST['ISBN']) && strlen(trim($_POST['ISBN'])) > 0) ||
        !(isset($_POST['Author']) && strlen(trim($_POST['Author'])) > 0) ||
        !(isset($_POST['Title']) && strlen(trim($_POST['Title'])) > 0) ||
        !(isset($_POST['Price']) && strlen(trim($_POST['Price'])) > 0)
    ) {
        echo "<p>You have not enter all the required details.<br />
                  Please go back and try again.</p>";
        exit;
    }

    //create variable names
    $isbn = trim($_POST['ISBN']);
    $author = trim($_POST['Author']);
    $title = trim($_POST['Title']);
    $price = trim($_POST['Price']);
    $price = doubleval($price);

    $db = new mysqli($db_server, $db_user, $db_password, $db_name);
    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br />
             Please try again.<p>';
        exit;
    }

    $query = "INSERT INTO Books VALUE (?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssd', $isbn, $author, $title, $price);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p>Book inserted successfully.</p>";
    } else {
        echo "<p>An error has occurred.<br />
                The item was not added.</p>";
    }

    $db->close();
    ?>
</body>

</html>