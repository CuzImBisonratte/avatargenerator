<?php

    // Get all the variables
    $color = $_POST['color'];
    $bg_color = $_POST['bg_color'];
    $size = $_POST['size'];
    $density = $_POST['density_slider'];
    $should_resize = $_POST['resize_radio'];
    $resize_size = $_POST['resize_size'];

    // Check if any of the variables are empty
    if (empty($color) || empty($bg_color) || empty($size) || empty($density) || empty($should_resize) || empty($resize_size)) {
        echo "Please fill in all the fields.";
        exit();
    } else {

        // Get height and width
        $height = $size;
        $width = $size;

        // Get the end image size
        if($should_resize == "yes") {
            $end_width = $resize_size;
            $end_height = $resize_size;
        } else {
            $end_width = $width;
            $end_height = $height;
        }

        // Get the pixel hex color
        $hex_color = str_replace("#", "", $color);

        // Get the background hex color
        $bg_hex_color = str_replace("#", "", $bg_color);

        // Get pixels
        $pixels = $width * $height;

        // Create the blank image
        $image = imagecreatetruecolor($width, $height);

        // Loop through the pixels
        for ($i = 0; $i < $pixels; $i++){

            // Create a random number between 0 and $density
            $rand = rand(0, $density-1);

            // turn everything thats not 0 into 1
            if ($rand != 0) {
                $rand = 1;
            }

            // If the random number is 0, create a pixel with the color
            // If the random number isn't 0, create a pixel with the background color
            if ($rand == 0) {
                
                $pixel = imagecolorallocate($image, hexdec(substr($hex_color, 0, 2)), hexdec(substr($hex_color, 2, 2)), hexdec(substr($hex_color, 4, 2)));
            } else {

                $pixel = imagecolorallocate($image, hexdec(substr($bg_hex_color, 0, 2)), hexdec(substr($bg_hex_color, 2, 2)), hexdec(substr($bg_hex_color, 4, 2)));
            }

            // Put the pixel on the image
            imagesetpixel($image, $i % $width, $i / $width, $pixel);
        }

        // Now the image has to be resized to $end_width x $end_height
        $image_resized = imagecreatetruecolor($end_width, $end_height);
        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $end_width, $end_height, $width, $height);

        // Save the image
        imagepng($image, "images/customgen.png");
        imagepng($image_resized, "images/customgen_resized.png");

        // Free up memory
        imagedestroy($image);

        // Show the image
        echo "<h1>Here is your avatar:</h1>";
        echo "<img style='margin:auto;border:5px red solid;'src='images/customgen_resized.png'>";
        echo "<p>You can download it by right clicking it and then click on \"Save Image\".</p>";

    }
?>