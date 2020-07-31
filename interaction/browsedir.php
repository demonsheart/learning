<!DOCTYPE html>
<html>

<head>
    <title>Browse Directories</title>
</head>

<body>
    <h1>Browsing</h1>

    <?php
    $current_dir = $_SERVER['DOCUMENT_ROOT'] . '/learning/upload_file/';
    $dir = opendir($current_dir);
    $adr = str_replace($_SERVER['DOCUMENT_ROOT'], " ", $current_dir);
    echo '<p>Upload directory is ' . $adr . ' </p>';
    echo '<p>Directory Listing:</p><ul>';
    //The difference between 0 and false
    while (false !== ($file = readdir($dir))) {
        if ($file != "." && $file != "..") { // .和..分别表示当前和上一级目录，需要过滤
            echo '<li>' . $file . '</li>';
        }
    }
    echo '</ul>';
    closedir($dir);
    ?>
</body>

</html>