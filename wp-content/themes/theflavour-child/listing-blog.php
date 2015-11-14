<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since The Flavour 1.0
 */
global $more, $post;
$more = apply_filters('tfuse_more_tag',0);
$permalink = get_permalink();
$post_type = tfuse_page_options('post_type','');
$categories_ids = wp_get_post_categories($post->ID);
$categories = '';
if(!empty($categories_ids)){
    foreach($categories_ids as $id){
        $cat = get_category($id);
        $categories .= '<a href="'.get_category_link($cat->term_id).'" title="'.__('View all posts in','tfuse').' '.$cat->name.'" rel="category tag">'.$cat->name.'</a> ';
    }
}
?>
<div class="col-md-offset-3">
    <article class="post <?php echo $post_type; ?>" <?php post_class(); ?>>
        <div class="inner">
            <?php if ( has_post_thumbnail() && $post_type != 'post-style-7') { ?>
                <a href="<?php echo $permalink; ?>" class="post-thumbnail">
                    <?php
                        if($post_type == 'post-style-6') the_post_thumbnail( '' );
                        else the_post_thumbnail( 'post-thumb1' );
                    ?>
                </a>
            <?php } ?>
            <div class="entry-aside">
                <header class="entry-header">
                    <div class="entry-meta">
                        <time class="entry-date"><?php echo get_the_date('y M'); ?></time>
<!--                        <span class="author"> <?php // _e('by','tfuse'); ?> <?php // the_author_posts_link(); ?></span>
                        <span class="cat-links"> <?php // _e('in','tfuse'); ?> <?php // echo $categories; ?></span>-->
                        <p style="margin-bottom: 30px; margin-top: 30px;"><strong><a style="color: #153758 !important; font-size: 18px;" href="<?php echo $permalink; ?>"><?php the_title(); ?></a></strong></p>
                    </div>
                    <?php
                        if($post_type=='post-style-7'){
                            if ( has_post_thumbnail() ) { ?>
                                <a href="<?php echo $permalink; ?>" class="post-thumbnail"><?php the_post_thumbnail( '' ); ?></a>
                            <?php }
                        }
                    ?>
                </header>
                <div class="entry-content">
                    <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
                </div>
                <footer class="entry-meta">
                    <a href="<?php echo $permalink; ?>" class="btn btn-black-transparent btn-xs"><span><?php _e('leggi di piu','tfuse'); ?></span></a>
                    <a href="<?php echo $permalink.'#comments'; ?>" class="link-comment">
                        <span><?php comments_number('0','1','%'); ?></span>
                    </a>
                </footer>
            </div>
        </div>
    </article>
</div>