<!DOCTYPE html>
<html>

<head>
    <title>Book-O-Rama - Book Entry Results</title>
</head>

<body>
    <h1>Book-O-Rama - Book Entry Results</h1>
    <?php
    include('E:/laragon/pass.php');
    //isset($val) 无效的问题
    if (
        !$_POST['ISBN'] || !$_POST['Author']
        || !$_POST['Title'] || !$_POST['Price']
    ) {
        echo "<p>You have not enter all the required details.<br />
                  Please go back and try again.</p>";
        exit;
    }

    //create variable names
    $isbn = $_POST['ISBN'];
    $author = $_POST['Author'];
    $title = $_POST['Title'];
    $price = $_POST['Price'];
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