<!DOCTYPE html>
<html>

<head>
    <title>Browse Directories</title>
</head>

<body>
    <h1>Browsing</h1>

    <?php
    $dir = dir("../upload_file/");

    echo '<p>Handle is ' . $dir->handle . '</p>';
    echo '<p>Upload directory is ' . $dir->path . '</p>';
    echo '<p>Directory Listing:</p><ul>';
    //The difference between 0 and false
    while (false !== ($file = $dir->read())) {
        if ($file != "." && $file != "..") { // .和..分别表示当前和上一级目录，需要过滤
            echo '<li>' . $file . '</li>';
        }
    }
    echo '</ul>';
    $dir->close();
    ?>
</body>

</html>