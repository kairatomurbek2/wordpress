<article class="thumbnail col-md-3 product_block" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

        <div class="thumbnail  ">
            <div class="product-image">
               <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(150, 150)); ?></a>
            </div>
        </div>

        <a href="<?php the_permalink(); ?>" class="product_title" rel="bookmark"><?php the_title(); ?></a><br>

        Цена:
        <?php
        $price = number_format(get_post_meta(get_the_ID(), 'price', true));
        echo $price;
        ?>

        <?php if ('post' == get_post_type()) { ?>
            <div class="entry-meta">
                <?php bootstrapBasicPostOn(); ?>
            </div><!-- .entry-meta -->
        <?php } //endif; ?>
    </header>
    <!-- .entry-header -->


    <?php if (is_search()) { // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
            <div class="clearfix"></div>
        </div><!-- .entry-summary -->
    <?php } else { ?>
        <div class="entry-content">

            <?php
            $short_description = esc_html(get_post_meta(get_the_ID(), 'short_description', true));
            echo $short_description;
            ?>
            <br>

            <div class="clearfix"></div>
            <?php
            /**
             * This wp_link_pages option adapt to use bootstrap pagination style.
             * The other part of this pager is in inc/template-tags.php function name bootstrapBasicLinkPagesLink() which is called by wp_link_pages_link filter.
             */
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', 'bootstrap-basic') . ' <ul class="pagination">',
                'after' => '</ul></div>',
                'separator' => ''
            ));
            ?>
        </div><!-- .entry-content -->
    <?php } //endif; ?>
    <br>

</article><!-- #post-## -->