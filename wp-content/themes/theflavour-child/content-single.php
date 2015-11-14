<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since The Flavour 1.0
 */
$permalink = get_permalink();
$categories_ids = wp_get_post_categories($post->ID);
$categories = '';
$post_type = tfuse_page_options('post_type','');
if(!empty($categories_ids)){
    $k = 0;
    foreach($categories_ids as $id){
        $k++;
        if($k!=1) $separator = ', ';
        else $separator = '';
        $cat = get_category($id);
        $categories .= $separator.'<a href="'.get_category_link($cat->term_id).'" title="'.__('View all posts in','tfuse').' '.$cat->name.'" rel="category tag">'.$cat->name.'</a>';
    }
}
?>
<article class="post post-details <?php echo $post_type; ?>">
    <header class="entry-header">
        <div class="entry-meta">
            <?php if(tfuse_options('enable_post_meta', true)){ ?>
                <time class="entry-date"><?php echo get_the_date('y M'); ?></time>
            <?php } ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="col-xs-2">
            <a href="#comments" class="link-comment">
                <span><?php comments_number('0','1','%'); ?></span>
            </a>
            <?php if( ($mini_description = tfuse_page_options('mini_description','') ) != '' ){ ?>
                <h4 class="min-descriptions"><?php echo $mini_description; ?></h4>
            <?php } ?>
            </div>
        </div>
    </header>

    <?php if ( has_post_thumbnail() ) { ?>
        <div class="post-thumbnail">
            <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false, '' ); ?>
            <a title="<?php the_title(); ?>" rel="prettyPhoto" data-rel="prettyPhoto" href="<?php echo $src[0]; ?>"><?php the_post_thumbnail( '' ); ?></a>
        </div>
    <?php } ?>

    <div class="entry-content col-xs-10">
        <?php the_content(); ?>
        <?php tfuse_get_recipe_options($post->ID); ?>
    </div>
</article>
<?php
//$tags = wp_get_post_tags($post->ID);
//if(!empty($tags)){
//    echo '<section class="tagcloud">';
//    foreach($tags as $tag){
//        echo '<a href="'.get_term_link($tag->term_id, 'post_tag').'">'.$tag->name.'</a>';
//    }
//    echo '</section>';
//}

get_template_part('content', 'author');
?>

<!--Share Links-->
<!--<section class="social-share-blog">
    <div class="twitter">
        <a href="https://twitter.com/share?url=<?php // echo $permalink; ?>" target="_blank">
            <i class="tficon-twitter-postshare"></i><?php // _e('Tweet','tfuse'); ?>
        </a>
    </div>
    <div class="facebook-share">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php // echo $permalink; ?>" target="_blank">
            <i class="tficon-facebook-postshare"></i><?php // _e('Share','tfuse'); ?>
        </a>
    </div>
    <div class="pinterest">
        <a href="http://www.pinterest.com/pin/create/button/?url=<?php // echo $permalink; ?>" target="_blank">
            <i class="tficon-pinterest-postshare"></i><?php // _e('Pin it','tfuse'); ?>
        </a>
    </div>
</section>-->

<!--<section class="blog-post-navigation">
    <?php // previous_post_link( '%link','<i class="tficon-shevron-left"></i><span>'.__('Previous Story','tfuse').'</span>%title' ); ?>
    <?php // next_post_link( '%link', '<i class="tficon-shevron-right"></i><span>'.__('NEXT Story','tfuse').'</span>%title' ); ?>
</section>-->

<?php // tfuse_show_similar_posts($tags, $post->ID); ?>