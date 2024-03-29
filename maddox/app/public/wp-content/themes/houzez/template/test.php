<?php
/**
 * Template Name1: Testing
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 16/13/15
 * Time: 3:27 PM
 */
get_header();
apply_watermark_to_test_image();
function apply_watermark_to_test_image() {
    // Include WordPress functions
    require_once(ABSPATH . 'wp-load.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    
    // Hardcoded paths for testing
    $image_url = 'http://houzez.test/wp-content/uploads/2024/02/chicago-02.jpg';
    $watermark_url = 'http://houzez.test/wp-content/uploads/2016/02/dreieck-immobiliare-logo-retina.png';

    // Get the WordPress upload directory
    $upload_dir = wp_upload_dir();
    $image_path = $upload_dir['path'] . '/chicago-02-watermarked.jpg'; // The path where the new image will be saved

    // Download images from URLs - only for testing purposes
	$image_content = file_get_contents($image_url);
	if ($image_content === false) {
	    die('Failed to download main image');
	}

	// Save the content to a local file first
	file_put_contents($image_path, $image_content);
	// Check if the file is a valid JPEG before proceeding
	if (@imagecreatefromjpeg($image_path) === false) {
	    die('The downloaded file is not a valid JPEG image.');
	}

    $image = imagecreatefromjpeg($image_path);

    $watermark_content = file_get_contents($watermark_url);
    if ($watermark_content === false) {
        die('Failed to download watermark image');
    }



    $watermark_path = $upload_dir['path'] . '/downloaded-watermark.png';
    file_put_contents($watermark_path, $watermark_content);
    $watermark = imagecreatefrompng($watermark_path);

    // Get the dimensions of both
    $image_width = imagesx($image);
    $image_height = imagesy($image);
    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);

    // Calculate the position of the watermark - in this case, bottom right corner.
    $x = $image_width - $watermark_width - 10; // 10 pixels from the bottom right corner
    $y = $image_height - $watermark_height - 10;

    // Blend the watermark over the image
    imagecopy($image, $watermark, $x, $y, 0, 0, $watermark_width, $watermark_height);

    // Save the watermarked image back to the filesystem
    imagejpeg($image, $image_path);

    // Clear memory
    imagedestroy($image);
    imagedestroy($watermark);

    return $image_path; // Return the path of the watermarked image
}


add_filter('wp_generate_attachment_metadata', 'apply_watermark_to_image', 10, 2);

function apply_watermark_to_image($metadata, $attachment_id) { wp_die();
    // Get user ID from the post (image attachment)
    $post = get_post($attachment_id);
    $user_id = $post->post_author;

    // Get watermark image URL for user
    $watermark_image_url = get_user_meta($user_id, 'fave_watermark_image', true);

    if (!empty($watermark_image_url)) {
        // Apply watermark only if the watermark URL is found
        $upload_dir = wp_upload_dir(); // Get upload directory
        $image_path = $upload_dir['basedir'] . '/' . $metadata['file']; // Full path to the uploaded image
        $watermark_path = $watermark_image_url; // This should be a filesystem path, not a URL

        // This is your custom function to add watermark
        apply_watermark($image_path, $watermark_path);

        // Note: apply_watermark() is a function you'll need to define according to your watermarking process.
    }

    return $metadata; // Return the metadata unchanged if no watermark is applied
}


function apply_watermark($image_path, $watermark_path) {
    // Load the image and the watermark
    $image = imagecreatefrompng($image_path);
    $watermark = imagecreatefrompng($watermark_path);

    // Get the dimensions of both
    $image_width = imagesx($image);
    $image_height = imagesy($image);
    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);

    // Calculate the position of the watermark - in this case, bottom right corner.
    $x = $image_width - $watermark_width - 10; // 10 pixels from the bottom right corner
    $y = $image_height - $watermark_height - 10;

    // Blend the watermark over the image
    // The last parameter is the opacity. 100 = fully opaque, 0 = fully transparent
    imagecopy($image, $watermark, $x, $y, 0, 0, $watermark_width, $watermark_height);

    // Save the image back to the filesystem
    // This will overwrite the original image. Create a copy if the original should be preserved
    imagepng($image, $image_path);

    // Clear memory
    imagedestroy($image);
    imagedestroy($watermark);
}


get_footer(); ?>