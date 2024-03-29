<?php
/**
 * Template Name1: Testing
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 16/13/15
 * Time: 3:27 PM
 */
get_header();

echo houzez_apply_watermark_test('http://houzez.test/wp-content/uploads/2024/02/chicago-02.jpg', '/Users/waqasriaz/Herd/houzez/wp-content/uploads/2016/02/dreieck-immobiliare-logo-retina.png');

function houzez_apply_watermark_test($image_path, $watermark_path, $position = 'bottom-right', $size_percentage = 10) {
    // Load the image and watermark
    list($image_width, $image_height) = getimagesize($image_path);
    $image = imagecreatefromstring(file_get_contents($image_path));
    $watermark = imagecreatefrompng($watermark_path);

    // Calculate watermark size based on user preference
    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);
    $scale = ($image_width * ($size_percentage / 100.0)) / $watermark_width;
    $new_watermark_width = $watermark_width * $scale;
    $new_watermark_height = $watermark_height * $scale;

    // Create a new watermark with the scaled size
    $scaled_watermark = imagecreatetruecolor($new_watermark_width, $new_watermark_height);
    imagealphablending($scaled_watermark, false);
    imagesavealpha($scaled_watermark, true);
    imagecopyresampled($scaled_watermark, $watermark, 0, 0, 0, 0, $new_watermark_width, $new_watermark_height, $watermark_width, $watermark_height);

    // Calculate the position of the watermark
    switch ($position) {
        case 'top-left':
            $dest_x = 10;
            $dest_y = 10;
            break;
        case 'top-right':
            $dest_x = $image_width - $new_watermark_width - 10;
            $dest_y = 10;
            break;
        case 'bottom-left':
            $dest_x = 10;
            $dest_y = $image_height - $new_watermark_height - 10;
            break;
        case 'bottom-right':
            $dest_x = $image_width - $new_watermark_width - 10;
            $dest_y = $image_height - $new_watermark_height - 10;
            break;
        default:
            // Default to bottom-right
            $dest_x = $image_width - $new_watermark_width - 10;
            $dest_y = $image_height - $new_watermark_height - 10;
            break;
    }

    // Combine the images
    imagealphablending($image, true);
    imagesavealpha($image, true);
    imagecopy($image, $scaled_watermark, $dest_x, $dest_y, 0, 0, $new_watermark_width, $new_watermark_height);

    // Get WordPress upload directory info
	$upload_dir = wp_upload_dir();
	$local_path = str_replace(home_url('/wp-content/uploads/'), $upload_dir['basedir'] . '/', $image_path);

	// Ensure the directory exists and is writable
	if (!file_exists(dirname($local_path))) {
	    mkdir(dirname($local_path), 0777, true);
	}

    // Save the image back to the filesystem
    switch (strtolower(pathinfo($image_path, PATHINFO_EXTENSION))) {
        case 'jpeg':
        case 'jpg':
            //imagejpeg($image, $image_path);
            imagejpeg($image, $local_path); 
            break;
        case 'png':
            imagepng($image, $image_path);
            break;
        case 'gif':
            imagegif($image, $image_path);
            break;
        default:
            // Unsupported image type
            break;
    }

    echo '<pre>';
print_r($image);
echo '</pre>';

    // Clean up
    imagedestroy($image);
    imagedestroy($watermark);
    imagedestroy($scaled_watermark);
}

get_footer(); ?>