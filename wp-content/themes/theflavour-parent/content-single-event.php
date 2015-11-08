<?php
/**
 * The template for displaying content in the single-event.php template.
 * To override this template in a child theme, copy this file
 * to your child theme's folder.
 *
 * @since The Flavour 1.0
 */
$permalink = get_permalink();
$date_post = tfuse_page_options('event_date');
if( isset($_GET['date']) && $_GET['date']!='' ) {
    $date_post = $_GET['date'];
    if(strpos($permalink, "?") === false){
        $permalink = $permalink.'?date='.$date_post;
    }
    else{
        $permalink = $permalink.'&date='.$date_post;
    }
}
$date = new DateTime($date_post);
$year = $date->format('Y');
$month = $date->format('F jS');
$event_hour = tfuse_page_options('event_hour_min', false, $post->ID);
if(!empty($event_hour)) $hour .= $event_hour['hour'].':'.$event_hour['minute'].' '.$event_hour['time'];
else $hour = '';
?>
<article class="post post-details">
    <header class="entry-header">
        <div class="entry-meta">
            <?php if(tfuse_options('enable_events_meta', true)){ ?>
                <span> <?php _e('Event on ','tfuse'); ?>
                    <span class="post_date"><?php echo $month; ?></span> , <?php echo $year; ?>, <?php echo $hour; ?>
                </span>
                <span class="author"> <?php _e('by','tfuse'); ?> <?php the_author_posts_link(); ?></span>
            <?php } ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </div>
    </header>

    <?php if ( has_post_thumbnail() ) { ?>
        <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false, '' ); ?>
        <div class="event-thumbnail">
            <a title="<?php the_title(); ?>" rel="prettyPhoto" data-rel="prettyPhoto" href="<?php echo $src[0]; ?>"><?php the_post_thumbnail( '' ); ?></a>
        </div>
    <?php } ?>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</article>

<!--Share Links-->
<section class="social-share-blog">
    <div class="twitter">
        <a href="https://twitter.com/share?url=<?php echo $permalink; ?>" target="_blank">
            <i class="tficon-twitter-postshare"></i><?php _e('Tweet','tfuse'); ?>
        </a>
    </div>
    <div class="facebook-share">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?>" target="_blank">
            <i class="tficon-facebook-postshare"></i><?php _e('Share','tfuse'); ?>
        </a>
    </div>
    <div class="pinterest">
        <a href="http://www.pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>" target="_blank">
            <i class="tficon-pinterest-postshare"></i><?php _e('Pin it','tfuse'); ?>
        </a>
    </div>
</section>

<div class="post_pagination"><?php wp_link_pages(); ?></div>