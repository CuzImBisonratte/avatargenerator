<?php

    // Get all the variables
    $color = $_POST['color'];
    $theme = $_POST['theme'];
    $size = $_POST['size'];

    // Check if any of the variables are empty
    if (empty($color) || empty($theme) || empty($size)) {
        exit("You must fill in all the fields.");
    } else {
        
        // Get height and width
        $height = $size;
        $width = $size;

        // The end image size
        $end_width = $width * 100;
        $end_height = $height * 100;

        // Get the hex color
        $hex_color = str_replace("#", "", $color);

        // Get pixels
        $pixels = $width * $height;

        // Create the blank image
        $image = imagecreatetruecolor($width, $height);

        // Loop through the pixels
        for ($i = 0; $i < $pixels; $i++) {

            // Create a random number 0 - 3
            $rand = rand(0, 3);

            // turn 1,2,3 into 1
            if ($rand == 2 || $rand == 3) {
                $rand = 1;
            }

            // If the random number is 0, create a pixel with the color
            // If the random number isn't 0, create a pixel with the theme color (which is send as hex)
            if ($rand == 0) {
                $pixel = imagecolorallocate($image, hexdec(substr($hex_color, 0, 2)), hexdec(substr($hex_color, 2, 2)), hexdec(substr($hex_color, 4, 2)));
            } else {
                $pixel = imagecolorallocate($image, hexdec(substr($theme, 0, 2)), hexdec(substr($theme, 2, 2)), hexdec(substr($theme, 4, 2)));
            }

            // Put the pixel on the image
            imagesetpixel($image, $i % $width, $i / $width, $pixel);
        }

        // Now the image has to be resized to $end_width x $end_height
        $image_resized = imagecreatetruecolor($end_width, $end_height);
        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $end_width, $end_height, $width, $height);

        // Save the image
        imagepng($image, "images/simplegen.png");;
        imagepng($image_resized, "images/simplegen_resized.png");


        // Show the image
        echo "<img src='images/simplegen_resized.png'>";



    }

?>