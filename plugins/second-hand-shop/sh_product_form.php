<?php

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );


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

