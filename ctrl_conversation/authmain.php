<?php
session_start();
include('E:\laragon\pass\pass1.php');
if (isset($_POST['userid']) && isset($_POST['password'])) {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    $db_conn = new mysqli($db_server, $db_user, $db_password, 'test');

    if (mysqli_connect_errno()) {
        echo 'Connection to database failed:' . mysqli_connect_error();
        exit;
    }
    // This place needs to be encrypted
    $query = "select * from authorized_users where name='" . $userid . "' and password='" . $password . "'";
    $result =  $db_conn->query($query);
    if ($result->num_rows) {
        //if they are in the database, register the user id
        $_SESSION['valid_user'] = $userid;
    }
    $db_conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <style type="text/css">
        fieldset {
            width: 50%;
            border: 2px solid #ff0000;
        }

        legend {
            font-weight: bold;
            font-size: 125%;
        }

        label {
            width: 125px;
            float: left;
            text-align: left;
            font-weight: bold;
        }

        input {
            border: 1px solid #000;
            padding: 3px;
        }

        button {
            margin-top: 12px;
        }
    </style>
</head>

<body>
    <h1>Home Page</h1>
    <?php
    if (isset($_SESSION['valid_user'])) {
        echo '<p>You are logged in as: ' . $_SESSION['valid_user'] . ' </br>';
        echo '<a href="logout.php">Log out</a></p>';
    } else {
        if (isset($userid)) {
            //if they've tried and failed to log in
            echo '<p>Cound not log you in.</p>';
        } else {
            // they've not tried to log in yet or have logged out
            echo '<p>You are not logged in.</p>';
        }

        //provide form to log in
        $str = ' <form action="authmain.php" method="POST">
                    <fieldset>
                        <legend>Login Now!</legend>
                        <p>
                            <label for="userid">UserID:</label>
                            <input type="text" name="userid" id="userid" size="30" />
                        </p>
                        <p>
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" size="30" />
                        </p>
                    </fieldset>
                    <button type="submit" name="login">Login</button>
                </form>';
        echo $str;
    }
    ?>
    <p><a href="members_only.php">Go to Members Section</a></p>
</body>

</html>