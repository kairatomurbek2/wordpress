<?php

session_start();
$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
require_once($parse_uri[0] . 'wp-load.php');
include_once 'securimage/securimage.php';

$securimage = new Securimage();


if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if ($securimage->check($_POST['captcha_code']) == false) {
        $return = array('error' => 1);
        die(json_encode($return));

    } else {
        $return = array('error' => 0);
        die(json_encode($return));
    }

}


if ($securimage->check($_POST['captcha_code']) == false) {
    echo "The security code entered was incorrect.<br /><br />";
    echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
    exit;
} else {
    saveSecondHandProduct($_POST);
    wp_redirect(home_url());
//    exit;
}

function saveSecondHandProduct()
{
    $post = array(
        'post_title' => $_POST['product_name'],
        'post_content' => $_POST['description'],
        'post_type' => 'second_hand_products',
        'post_status' => 'publish',
    );

    $new_post_id = wp_insert_post($post);

    add_post_meta($new_post_id, 'short_description', $_POST['short_description']);
    add_post_meta($new_post_id, 'price', $_POST['product_price']);
    add_post_meta($new_post_id, 'contact_information', $_POST['contact_information']);
    add_post_meta($new_post_id, 'seller_phone', $_POST['phone']);
    add_post_meta($new_post_id, 'seller_valuta', $_POST['seller_valuta']);
    add_post_meta($new_post_id, 'seller_users', wp_get_current_user()->display_name);

    wp_set_post_terms($new_post_id, $_POST['product_category'], 'second_hand_product_category');

    savePostFeaturedImage($new_post_id);
    wp_publish_post($new_post_id );
}

function savePostFeaturedImage($post_id)
{
    if (!function_exists('wp_handle_upload')) require_once(ABSPATH . 'wp-admin/includes/file.php');
    $uploadedfile = $_FILES['picture'];
    $upload_overrides = array('test_form' => false);
    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
    if ($movefile) {
        $wp_filetype = $movefile['type'];
        $filename = $movefile['file'];
        $wp_upload_dir = wp_upload_dir();
        $attachment = array(
            'guid' => $wp_upload_dir['url'] . '/' . basename($filename),
            'post_mime_type' => $wp_filetype,
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $attach_id = wp_insert_attachment($attachment, $filename);
    }
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
    wp_update_attachment_metadata($attach_id, $attach_data);
    add_post_meta($post_id, '_thumbnail_id', $attach_id);
}


