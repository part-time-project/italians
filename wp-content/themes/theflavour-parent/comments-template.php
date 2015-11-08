<?php
if ( ! function_exists( 'tfuse_comment' ) ) :
    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own tfuse_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     */
    function tfuse_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;

        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
            ?>
    <li class="post pingback">
        <article id="li-comment-<?php comment_ID() ?>" class="comment-body">
            <div class="comment-avatar">
                <?php echo get_avatar( $comment, 64);?>
            </div>
            <div class="comment-aside">
                <p><?php _e( 'Pingback:', 'tfuse' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'tfuse' ), '<span class="edit-link">', '</span>' ); ?></p>
                <div class="comment-meta">
                    <span class="comment-author"><a href="#"><?php comment_author_link(); ?></a></span>
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
                <div class="comment-content">
                    <p><?php echo $comment->comment_content; ?></p>
                </div>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'tfuse' ); ?></em>
                    <br />
                <?php endif; ?>
            </div>
        </article>
        <?php
            break;
            default : ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <a name="comment-<?php comment_ID() ?>"></a>

                    <article id="li-comment-<?php comment_ID() ?>" class="comment-body">
                        <div class="comment-avatar">
                            <?php echo get_avatar( $comment, 64);?>
                        </div>

                        <div class="comment-aside">
                            <div class="comment-meta">
                                <span class="comment-author"><a href="#"><?php comment_author_link(); ?></a></span>
                                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                                <?php if(get_comment_reply_link(array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ))==null) echo '<br>'; ?>
                            </div>
                            <div class="comment-content">
                                <p><?php echo $comment->comment_content; ?></p>
                            </div>
                            <?php if ( $comment->comment_approved == '0' ) : ?>
                                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'tfuse' ); ?></em>
                                <br />
                            <?php endif; ?>
                        </div>

                        <div class="clear"></div>
                        <div id="comment-<?php comment_ID(); ?>"></div>
                        <div class="clear"></div>

                    </article><!-- /.comment-body-->
                <?php
                break;
        endswitch;
    }
endif; // ends check for tfuse_comment()