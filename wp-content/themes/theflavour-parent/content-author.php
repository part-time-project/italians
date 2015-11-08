<?php
/**
 * The template for displaying content-author in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since The Flavour 1.0
 */

$author_description = get_the_author_meta('description');
$enable_author_info = tfuse_options('enable_author_info', true);

if ( $enable_author_info && !empty($author_description) ) { ?>
    <section class="author-description">
        <div class="author-image">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), '164' ); ?>
        </div>
        <div class="author-text">
            <h2 class="author-name"><?php _e('Article by','tfuse'); ?> <span><?php the_author(); ?></span></h2>
            <p><?php echo $author_description; ?></p>
        </div>
    </section>
<?php } ?>