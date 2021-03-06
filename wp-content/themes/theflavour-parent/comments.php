<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to tfuse_comment() which is
 * located in the functions.php file.
 *
 */
?>
<div class="clear"></div>
<div id="comments" class="comment-list for_comment_form">

<?php if ( post_password_required() ) : ?>
    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'tfuse' ); ?></p>
</div><!-- #comments -->
<?php
    /* Stop the rest of comments.php from being processed,
    * but don't kill the script entirely -- we still have
    * to fully load the template.
    */
    return;
endif;
?>

<?php // You can start editing here -- including this comment! ?>

<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
if(is_user_logged_in()) $col_class = 'user_logged';
else $col_class = '';

$args = array(
    'id_form'           => 'addcomments',
    'id_submit'         => 'submit',
    'title_reply'       => __('LEAVE A REPLY:','tfuse'),
    'title_reply_to'    => __('Leave a Reply to %s','tfuse'),
    'cancel_reply_link' => __('Cancel Reply','tfuse'),
    'label_submit'      => __('SUBMIT COMMENT','tfuse'),

    'comment_field' => '
    <div class="right-colum '.$col_class.'">
        <div class="form-field_textarea">
            <label class="label_title" for="cooment">'.__('MESSAGE','tfuse').' *</label>
            <textarea name="comment" class="textarea required" id="comment" ' . $aria_req . '></textarea>
        </div>
    </div>',

    'must_log_in' => '<p class="must-log-in">' .
        sprintf(
            __( 'You must be <a href="%s">logged in</a> to post a comment.','tfuse'  ),
            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
        ) . '</p>',

    'logged_in_as' => '<p class="logged-in-as">' .
        sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','tfuse'  ),
            admin_url( 'profile.php' ),
            $user_identity,
            wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
        ) . '</p>',

    'comment_notes_before' => '',

    'comment_notes_after' => '',

    'fields' => apply_filters( 'comment_form_default_fields', array(

            'author' =>
            '<div class="left-colum">
            <div class="form-field_text">
                <label class="label_title" for="name">'.__('YOUR DISPLAY NAME','tfuse').' *</label>
                <input type="text" name="author" class="inputtext required" id="author" value="' . esc_attr( $commenter['comment_author'] ) .'" tabindex="1" ' . $aria_req . '/>
            </div>',

            'email' =>
            '<div class="form-field_text">
                <label class="label_title" for="email">'.__('YOUR EMAIL ADDRESS','tfuse').' *</label>
                <input type="text" name="email" class="inputtext required" id="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" tabindex="2" ' . $aria_req . '/>
                <span class="optional">'.__('(this will not be shared)','tfuse').'</span>
            </div>',

            'url' =>
            '<div class="form-field_text">
                <label class="label_title" for="website">'.__('YOUR WEBSITE','tfuse').'</label>
                <input type="text" class="inputtext"  id="url" name="url" value="' . esc_attr( $commenter['comment_author_url'] ) .'">
                <span class="optional">'.__('(optional field)','tfuse').'</span>
            </div>
            </div>',
        )
    ),
);
comment_form($args);
?>
</div><!-- /for commnets-template -->
<div class="divider-commentform"></div>

<section id="comments" class="comments-area">
    <ol class="commentlist">
        <?php
        /* Loop through and list the comments. Tell wp_list_comments()
        * to use tfuse_comment() to format the comments.
        * If you want to overload this in a child theme then you can
        * copy file comments-template.php to child theme or
        * define your own tfuse_comment() and that will be used instead.
        * See tfuse_comment() in comments-template.php for more.
        */
        get_template_part( 'comments', 'template' );
        wp_list_comments( array( 'callback' => 'tfuse_comment' ) );
        ?>
    </ol>
</section>

<?php if ( have_comments() ) : ?>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <div class="paginador-comentarios">
            <?php paginate_comments_links(); ?>
        </div>
    <?php endif; // check for comment navigation ?>

<?php elseif ( comments_open() ) : // If comments are open, but there are no comments ?>
    <p class="nocomments"><?php _e('No comments yet.', 'tfuse') ?></p>
<?php endif; ?>