<?php
//check we have appropriate data

$button_text = $_POST['button_text'];
$button_color = $_POST['button_color'];

if (empty($button_text) || empty($button_color)) {
    echo '<p>Cound not create image: form not filled out correctly</p>';
    exit;
}

//Create an image using the right color of the button, and check the size
$im = imagecreatefrompng($button_color . '-button.png');

$width_image = imagesx($im);
$height_image = imagesy($im);

//Our images need an 18 pixel margin in from the edge of the image
$width_image_wo_margins = $width_image - (2 * 18);
$height_image_wo_margins = $height_image - (2 * 18);

//Tell GD2 where the font you want to use resides

//Windows
// putenv('GDFONTPATH=C:\WINDOWS\Fonts');

$font_name = 'C:\Windows\Fonts\arial.ttf';

$font_size = 33;

do {
    $font_size--;

    // Find out the size of the text at that font size
    $bbox = imagettfbbox($font_size, 0, $font_name, $button_text);

    $right_text = $bbox[2];
    $left_text = $bbox[0];
    $width_text = $right_text - $right_text;
    $height_text = abs($bbox[7] - $bbox[1]);
} while ($font_size > 8 && ($height_text > $height_image_wo_margins || $width_text > $width_image_wo_margins));

if ($height_text > $height_image_wo_margins || $width_text > $width_image_wo_margins) {
    echo '<p>Text given will not fit on button.</p>';
} else {
    $text_x = $width_image / 2.0 - $width_text / 2.0;
    $text_y = $height_image / 2.0 - $height_text / 2.0;

    if ($left_text < 0) {
        $text_x += abs($left_text);
    }

    $above_line_text = abs($bbox[7]);
    $text_y += $above_line_text;
    $text_y -= 2;
    $white = imagecolorallocate($im, 255, 255, 255);

    imagettftext($im, $font_size, 0, $text_x, $text_y, $white, $font_name, $button_text);

    header('Content-Type: image/png');
    imagepng($im);
}
imagedestroy($im);
