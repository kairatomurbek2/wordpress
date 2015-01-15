<?php
/**
 * Template for dispalying single post (read full post page).
 *
 * @package bootstrap-basic
 */

get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?>
<?php get_sidebar('left'); ?>

<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">

        <?php
        while (have_posts()) {
            the_post();

            get_template_part('sh_product_single_content', get_post_format());

            echo "\n\n";

            bootstrapBasicPagination();

            echo "\n\n";

            echo "\n\n";

        } //endwhile;
        ?>

</div>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>