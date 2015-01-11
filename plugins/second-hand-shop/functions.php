<?php

function create_second_hand_product_post_type() {
    register_post_type( 'second_hand_products',
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
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail' ),
            'taxonomies' => array( '' ),
            'has_archive' => true
        )
    );
}

add_action( 'init', 'create_second_hand_product_post_type' );


function add_second_hand_product_meta_box() {
    add_meta_box( 'second_hand_product_meta_box',
        'Second Hand Product Details',
        'display_second_hand_product_meta_box',
        'second_hand_products', 'normal', 'high'
    );
}

add_action( 'admin_init', 'add_second_hand_product_meta_box' );

function display_second_hand_product_meta_box( $second_hand_product ) {

    $short_description = esc_html( get_post_meta( $second_hand_product->ID, 'short_description', true ) );
    $price = intval( get_post_meta( $second_hand_product->ID, 'price', true ) );
    $seller_phone = esc_html( get_post_meta( $second_hand_product->ID, 'seller_phone', true ) );
    $contact_information = esc_html( get_post_meta( $second_hand_product->ID, 'contact_information', true ) );
    ?>

    <table>
        <tr>
            <td style="width: 100%">Short Description</td>
            <td><textarea size="80" name="second_hand_product_short_description"><?php echo $short_description; ?></textarea></td>
        </tr>
        <tr>
            <td style="width: 150px">Prodict Price</td>
            <td>
                <input type="text" size="30" name="second_hand_product_price" value="<?php echo $price; ?>" />

            </td>
        </tr>
        <tr>
            <td style="width: 150px">Contact information</td>
            <td><textarea size="80" name="second_hand_product_contact_information" ><?php echo $contact_information; ?></textarea></td>
        </tr>
        <tr>
            <td style="width: 100%">Seller phone</td>
            <td><input type="text" size="30" name="second_hand_product_seller_phone" value="<?php echo $seller_phone; ?>" /></td>
        </tr>

    </table>
<?php
}

add_action( 'save_post', 'add_second_hand_product_fields', 10, 2 );

function add_second_hand_product_fields( $second_hand_product_id, $second_hand_product ) {
    if ( $second_hand_product->post_type == 'second_hand_products' ) {
        if ( isset( $_POST['second_hand_product_short_description'] ) && $_POST['second_hand_product_short_description'] != '' ) {
            update_post_meta( $second_hand_product_id, 'short_description', $_POST['second_hand_product_short_description'] );
        }
        if ( isset( $_POST['second_hand_product_price'] ) && $_POST['second_hand_product_price'] != '' ) {
            update_post_meta( $second_hand_product_id, 'price', $_POST['second_hand_product_price'] );
        }
        if ( isset( $_POST['second_hand_product_contact_information'] ) && $_POST['second_hand_product_contact_information'] != '' ) {
            update_post_meta( $second_hand_product_id, 'contact_information', $_POST['second_hand_product_contact_information'] );
        }
        if ( isset( $_POST['second_hand_product_seller_phone'] ) && $_POST['second_hand_product_seller_phone'] != '' ) {
            update_post_meta( $second_hand_product_id, 'seller_phone', $_POST['second_hand_product_seller_phone'] );
        }

    }
}


add_action( 'init', 'create_second_hand_product_taxonomies', 0 );

function create_second_hand_product_taxonomies() {
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


add_shortcode( 'add_second_hand_product', 'second_hand_product_add_form' );

function second_hand_product_add_form(){




$args = array(
        'taxonomy' => 'second_hand_product_category',
    );

    $categories = get_categories( $args );

    $html = '
    	<form role="form" enctype="multipart/form-data" method="post"  action="'.SECOND_HAND_SHOP__PLUGIN_URL . 'sh_product_form.php'.'" >
    	    <div class="form-group">
    	        <label for="products">Наименование продукта:</label>
    	        <input type="text" class="form-control" id="products" name="product_name" placeholder="Наименование продукта"/>
    	    </div>
            <div class="form-group">
    	        <label for="katygory">Категория:</label>

    	        <select name="product_category" id="katygory" class="form-control">
    	        <option value=""></option>
    	        ' ;

    if($categories) {
        foreach ($categories as $category) {

            $html.='<option value="'.$category->name.'">'.$category->name.'</option>' ;

        }
    }

        $html.= '
    	        </select>
    	    </div>
            <div class="form-group">
    	        <label for="">Короткое описание:</label>
    	        <textarea name="short_description" id="" cols="30" rows="3" placeholder="Короткое описание:" class="form-control"></textarea>
    	    </div>

            <div class="form-group">
    	        <label for="">Полное описание:</label>
    	        <textarea name="description" id="" cols="30" rows="9" placeholder="Полное описание:" class="form-control"></textarea>
    	    </div>

           <div class="form-group">
    	        <label for="price">Цена:</label>
    	        <input type="text" class="form-control" id="price" placeholder="Цена:" name="product_price"/>
    	    </div>
            <div class="form-group">
    	        <label for="contacts">Контактная информация:</label>
    	         <textarea name="contact_information" id="" cols="30" rows="9" placeholder="Контактная информация:" class="form-control"></textarea>

    	    </div>
            <div class="form-group">
    	        <label for="tel">Телефон:</label>
    	        <input type="tel" class="form-control" id="tel" placeholder="Телефон:" name="phone"/>
    	    </div>
    	    <div class="form-group">
    	       <label for="example-jpg-file">Select File To Upload:	</label>
	<input type="file" class="form-control"  id="example-jpg-file" name="picture" value="" />



    	    </div>
    	    <div>

<img id="captcha" src="'.SECOND_HAND_SHOP__PLUGIN_URL.'securimage/securimage_show.php" alt="CAPTCHA Image" />
<input type="text" name="captcha_code" size="10" maxlength="6" />
    <a href="#" onclick="document.getElementById('."'".'captcha'."'".').src = '."'".'/securimage/securimage_show.php?'."".' + Math.random(); return false">[ Different Image ]</a>


            </div>

    	    <button class="btn btn-primary" >Отправить заявку</button>

		</form>
    ';

    return $html;


}