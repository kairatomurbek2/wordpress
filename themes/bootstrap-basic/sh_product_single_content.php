<?php
$price = number_format(get_post_meta(get_the_ID(), 'price', true));
$short_description = esc_html(get_post_meta(get_the_ID(), 'short_description', true));
$seller_phone = esc_html(get_post_meta(get_the_ID(), 'seller_phone', true));
$contact_information = esc_html(get_post_meta(get_the_ID(), 'contact_information', true));
?>


<section id="primary" class="span9">
    <div id="content" role="main">
        <div id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
            <article>
                <div class="span4">
                    <div class="thumbnail col-md-6">
                        <?php the_post_thumbnail(array(600, 600)); ?>

<!--                        --><?php //if ( has_post_thumbnail() ) {
//                            the_post_thumbnail();
//                        } else { ?>
<!--                            <img src="--><?php //echo SECOND_HAND_SHOP__PLUGIN_URL ?><!--/img/no.png" />-->
<!--                        --><?php //} ?>
                    </div>
                </div>

                <div class="span4">
                    <h4 class="text-info"><?php the_title(); ?></h4>
                    <h4 class="text-success">Цена: <?php echo $price; ?> сом</h4>
                    <h4 class="text-success">Телефон продавца: <?php echo $seller_phone;  ?> </h4>
                    <h4 class="text-success">Контактная информация: <?php echo $contact_information;  ?> </h4>
                </div>
                <div class="clearfix"></div>

                <div class="span8">
                    <h3>Описание товара</h3>

                    <?php the_content(); ?>
                </div>
            </article>

        </div>

    </div><!-- #content -->
</section>



