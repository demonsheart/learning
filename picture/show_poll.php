<?php

//check we have the appropiate variable data
$vote = $_POST['vote'];

if (empty($vote)) {
    echo '<p>You have not voted for a politician.</p>';
    exit;
}

/****************************** 
Database query to get poll info
 *******************************/

//Log in to database 
include('E:/laragon/pass/pass1.php');
$db = new mysqli($db_server, $db_user, $db_password, 'test');
if (mysqli_connect_errno()) {
    echo '<p>Error: Cound not connect to database.</br>Please try again later.</p>';
    exit;
}

//Add the user's vote
$v_query = "UPDATE poll_results SET num_votes = num_votes + 1 WHERE candidate = ?";
$v_stmt = $db->prepare($v_query);
$v_stmt->bind_param('s', $vote);
$v_stmt->execute();
$v_stmt->free_result();

//Get current result of poll
$r_query = "SELECT candidate, num_votes FROM poll_results";
$r_stmt = $db->prepare($r_query);
$r_stmt->execute();
$r_stmt->store_result();
$r_stmt->bind_result($candidate, $num_votes);
$num_candidates = $r_stmt->num_rows;

//Calculate total number of votes so far
$total_votes = 0;

while ($r_stmt->fetch()) {
    $total_votes += $num_votes;
}

$r_stmt->data_seek(0); //return to the first row


/***************************
Initial caculation for graph  
 ****************************/

//Set up constants
// putenv('GDFONTPATH=C:\WINDOWS\Fonts');

$width = 500; //画布宽度
$left_margin = 50; //左边距
$right_margin = 50; //右边距
$bar_height = 40; //条形高度
$bar_spacing = $bar_height / 2; //条形间距
$font_name = 'C:/Windows/Fonts/arial.ttf'; //字体
$title_size = 16;
$main_size = 12;
$small_size = 12;
$text_indent = 10; //字体标签位置

//Set up initial point to draw from 
//基线的x,y
$x = $left_margin + 60;
$y = 50;
$bar_unit = ($width - ($x + $right_margin)) / 100; //百分之一单位

//caculate height of graph - bars plus gaps pius some margin
$height = $num_candidates * ($bar_height + $bar_spacing) + 50; //画布总高度


/****************
Set up base image 
 *****************/
//create a blank canvas
$im = imagecreatetruecolor($width, $height);

//Allocate colors
$white = imagecolorallocate($im, 255, 255, 255);
$blue = imagecolorallocate($im, 0, 64, 128);
$black = imagecolorallocate($im, 0, 0, 0);
$pink = imagecolorallocate($im, 255, 78, 243);

$text_color = $black;
$percent_color = $black;
$bg_color = $white;
$line_color = $black;
$bar_color = $blue;
$number_color = $pink;

//Create "canvas" to draw on
imagefilledrectangle($im, 0, 0, $width, $height, $bg_color);

// Draw outline around canvas
imagerectangle($im, 0, 0, $width - 1, $height - 1, $line_color);

//Add title
$title = 'Poll Results';
$title_dimensions = imagettfbbox($title_size, 0, $font_name, $title);
$title_length = $title_dimensions[2] - $title_dimensions[0];
$title_height = abs($title_dimensions[7] - $title_dimensions[1]);
$title_above_line = abs($title_dimensions[7]);
$title_x = ($width - $title_length) / 2;
$title_y = ($y - $title_height) / 2 + $title_above_line;
imagettftext($im, $title_size, 0, $title_x, $title_y, $text_color, $font_name, $title);

//draw a base line from a litle above first bar location to a little below last
imageline($im, $x, $y - 5, $x, $height - 15, $line_color);

/****************************
     Draw data into graph
 *****************************/

//Get each line of DB data and draw corresponding bars
while ($r_stmt->fetch()) {
    if ($total_votes > 0) {
        $percent = intval(($num_votes / $total_votes) * 100);
    } else {
        $percent = 0;
    }

    //display percent for this value
    $percent_dimensions = imagettfbbox($main_size, 0, $font_name, $percent . '%');

    $percent_length = $percent_dimensions[2] - $percent_dimensions[0];

    imagettftext($im, $main_size, 0, $width - $percent_length - $text_indent, $y + ($bar_height / 2), $percent_color, $font_name, $percent . '%');

    //length of bar for this value
    $bar_length = $x + ($percent * $bar_unit);

    //draw bar for this value
    imagefilledrectangle($im, $x, $y - 2, $bar_length, $y + $bar_height, $bar_color);

    //draw title for this value
    imagettftext($im, $main_size, 0, $text_indent, $y + ($bar_height / 2), $text_color, $font_name, $candidate);

    //Draw outline showing 100%
    imagerectangle($im, $bar_length + 1, $y - 2, ($x + (100 * $bar_unit)), $y + $bar_height, $line_color);

    //Display numbers
    imagettftext($im, $small_size, 0, $x + (100 * $bar_unit) - 50, $y + ($bar_height / 2), $number_color, $font_name, $num_votes . '/' . $total_votes);

    //Move down to next bar
    $y = $y + ($bar_height + $bar_spacing);
}
/****************************
    Display image
 *****************************/
header('Content-type: image/png');
imagepng($im);

//clean up
$r_stmt->free_result();
$db->close();
imagedestroy($im);
