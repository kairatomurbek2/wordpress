<?php

function create_second_hand_product_post_type()
{
    register_post_type('second_hand_products',
        array(
            'labels' => array(
                'name' => 'Second Hand Products',
                'singular_name' => 'Second Hand Product',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Product',
                'edit' => 'Edit',
                'edit_item' => 'Edit Product',
                'new_item' => 'New Product',
                'view' => 'View',
                'view_item' => 'View Product',
                'search_items' => 'Search Product',
                'not_found' => 'No Products found',
                'not_found_in_trash' => 'No Second Hand Products found in Trash',
                'parent' => 'Parent Second Hand Product'
            ),
            'public' => true,
            'menu_position' => 15,
            'supports' => array('title', 'editor', 'comments', 'thumbnail'),
            'taxonomies' => array(''),
            'has_archive' => true
        )
    );
}

add_action('init', 'create_second_hand_product_post_type');





function add_second_hand_product_meta_box()
{
    add_meta_box('second_hand_product_meta_box',
        'Second Hand Product Details',
        'display_second_hand_product_meta_box',
        'second_hand_products', 'normal', 'high'
    );
}

add_action('admin_init', 'add_second_hand_product_meta_box');

function display_second_hand_product_meta_box($second_hand_product)
{
    $short_description = esc_html(get_post_meta($second_hand_product->ID, 'short_description', true));
    $price = intval(get_post_meta($second_hand_product->ID, 'price', true));
    $seller_phone = esc_html(get_post_meta($second_hand_product->ID, 'seller_phone', true));
    $contact_information = esc_html(get_post_meta($second_hand_product->ID, 'contact_information', true));
    include(SECOND_HAND_SHOP__PLUGIN_DIR.'/templates/add_product_form_admin.php');
}

add_action('save_post', 'add_second_hand_product_fields', 10, 2);

function add_second_hand_product_fields($second_hand_product_id, $second_hand_product)
{
    if ($second_hand_product->post_type == 'second_hand_products') {
        if (isset($_POST['second_hand_product_short_description']) && $_POST['second_hand_product_short_description'] != '') {
            update_post_meta($second_hand_product_id, 'short_description', $_POST['second_hand_product_short_description']);
        }
        if (isset($_POST['second_hand_product_price']) && $_POST['second_hand_product_price'] != '') {
            update_post_meta($second_hand_product_id, 'price', $_POST['second_hand_product_price']);
        }
        if (isset($_POST['second_hand_product_contact_information']) && $_POST['second_hand_product_contact_information'] != '') {
            update_post_meta($second_hand_product_id, 'contact_information', $_POST['second_hand_product_contact_information']);
        }
        if (isset($_POST['second_hand_product_seller_phone']) && $_POST['second_hand_product_seller_phone'] != '') {
            update_post_meta($second_hand_product_id, 'seller_phone', $_POST['second_hand_product_seller_phone']);
        }
        if (isset($_POST['second_hand_product_seller_valuta']) && $_POST['second_hand_product_seller_valuta'] != '') {
            update_post_meta($second_hand_product_id, 'seller_valuta', $_POST['second_hand_product_seller_valuta']);
        }
        if (isset($_POST['second_hand_product_seller_seller_users']) && wp_get_current_user()->display_name != '') {
            update_post_meta($second_hand_product_id, 'seller_users', wp_get_current_user()->display_name);
        }

    }
}

add_action('init', 'create_second_hand_product_taxonomies', 0);

function create_second_hand_product_taxonomies()
{
    register_taxonomy(
        'second_hand_product_category',
        'second_hand_products',
        array(
            'labels' => array(
                'name' => 'SH Product Category',
                'add_new_item' => 'Add New SH Product Category',
                'new_item_name' => "New SH Product Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );

}

add_shortcode('add_second_hand_product', 'second_hand_product_add_form');

function second_hand_product_add_form()
{
    wp_enqueue_script('bootstrap-validator', SECOND_HAND_SHOP__PLUGIN_URL . 'bootstrap-validator-master/dist/validator.js', array('jquery'));
    wp_enqueue_script('process-form', SECOND_HAND_SHOP__PLUGIN_URL . 'js/process_form.js');

    $args = array(
        'taxonomy' => 'second_hand_product_category',
        'hide_empty'=> 0,
    );
    $categories = get_categories($args);
    ob_start();
    include(SECOND_HAND_SHOP__PLUGIN_DIR."/templates/add_product_form.php");
    $html = ob_get_clean();

    return $html;
}

