<?php
session_start();
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );



include_once  'securimage/securimage.php';

	$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
    	  // the code was incorrect
	  // you should handle the error so that the form processor doesn't continue

	  // or you can use the following code if there is no validation or you do not know how
	  echo "The security code entered was incorrect.<br /><br />";
	  echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
	  exit;
	}

$post = array(
    'post_title'    => $_POST['product_name'] ,
    'post_content'  => $_POST['description'],
    'post_type'     => 'second_hand_products',

);

$new_post_id = wp_insert_post($post);

add_post_meta($new_post_id, 'short_description',  $_POST['short_description']);
add_post_meta($new_post_id, 'price',  $_POST['product_price']);
add_post_meta($new_post_id, 'contact_information',  $_POST['contact_information']);
add_post_meta($new_post_id, 'seller_phone',  $_POST['phone']);


if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
$uploadedfile = $_FILES['picture'];
$upload_overrides = array( 'test_form' => false );
$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
if ( $movefile ) {
    $wp_filetype = $movefile['type'];
    $filename = $movefile['file'];
    $wp_upload_dir = wp_upload_dir();
    $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . basename( $filename ),
        'post_mime_type' => $wp_filetype,
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $filename);
    //file is uploaded successfully. do next steps here.
}


require_once(ABSPATH . 'wp-admin/includes/image.php');
$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
wp_update_attachment_metadata( $attach_id, $attach_data );


add_post_meta($new_post_id, '_thumbnail_id', $attach_id);


