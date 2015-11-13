<?php
if ( ! isset( $content_width ) ) $content_width = 900;

if (!function_exists('tfuse_get_menu')) :
    function tfuse_get_menu(){
        $menu_position = tfuse_options('logo_position','center');
        if($menu_position=='left' || $menu_position=='right'){ ?>
            <div class="col-sm-3 logo-<?php echo $menu_position; ?>">
                <div class="site-logo" id="site-logo">
                    <a href="<?php echo home_url(); ?>">
                        <?php if(tfuse_options('logo_type','text')=='text'){
                            echo '<i><span>'.tfuse_options('logo_text','').'</span></i>';
                            echo '<span>'.tfuse_options('logo_text_bottom','').'</span>';
                        } else{ ?>
                            <img src="<?php echo tfuse_logo(); ?>" alt="<?php bloginfo('name'); ?>">
                        <?php } ?>
                    </a>
                </div>
            </div>
            <div class="col-sm-11 col-sm-offset-1 tf-menu-<?php echo $menu_position; ?>">
                <?php tfuse_menu('primary'); ?>
            </div>
        <?php } else{ ?>
            <div class="text-center">
                <div class="site-logo" id="site-logo">
                    <a href="<?php echo home_url(); ?>">
                        <?php if(tfuse_options('logo_type','text')=='text'){
                            echo '<i><span>'.tfuse_options('logo_text','').'</span></i>';
                            echo '<span>'.tfuse_options('logo_text_bottom','').'</span>';
                        } else{ ?>
                            <img src="<?php echo tfuse_logo(); ?>" alt="<?php bloginfo('name'); ?>">
                        <?php } ?>
                    </a>
                </div>
            </div>
            <div class="col-xs-offset-2">
                <div class="text-center">
                    <?php tfuse_menu('primary'); ?>
                </div>
            </div>
    <?php }
    }
endif;

if (!function_exists('tfuse_class')) :
    /* This Function Add the classes for middle container
     * To override tfuse_class() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
    */

    function tfuse_class($param, $return = false) {
        $tfuse_class = '';
        $sidebar_position = tfuse_sidebar_position();
        if ($param == 'middle')
        {
            if ($sidebar_position == 'left')
                $tfuse_class = ' class="container sidebar-left"';
            elseif($sidebar_position == 'right')
                $tfuse_class = ' class="container sidebar-right"';
            else
                $tfuse_class = ' class="container full-width"';
        }

        if ($return)
            return $tfuse_class;
        else
            echo $tfuse_class;
    }
endif;


if (!function_exists('tfuse_sidebar_position')):
    /* This Function Set sidebar position
     * To override tfuse_sidebar_position() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
    */
    function tfuse_sidebar_position() {
        global $TFUSE;
        $sidebar_position = $TFUSE->ext->sidebars->current_position;
        if ( empty($sidebar_position) ) $sidebar_position = 'full';
        return $sidebar_position;
    }

// End function tfuse_sidebar_position()
endif;


if (!function_exists('tfuse_count_post_visits')) :
    /**
     * To override tfuse_count_post_visits() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_count_post_visits()
    {
        if ( !is_single() ) return;
        global $post;
        $views = get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', true);
        $views = intval($views);
        tf_update_post_meta( $post->ID, TF_THEME_PREFIX . '_post_viewed', ++$views);
    }
    add_action('wp_head', 'tfuse_count_post_visits');

// End function tfuse_count_post_visits()
endif;


if (!function_exists('tfuse_custom_title')):
    function tfuse_custom_title($customID = false,$return = false) {
        global $post;
        if (is_numeric($customID))
            $ID = $customID;
        else
            $ID = $post->ID;

        $tfuse_title_type = tfuse_page_options('page_title', '', $ID);

        if ($tfuse_title_type == 'default_title'){
            $before_title = '';
            $title = get_the_title($ID);
        }
        elseif ($tfuse_title_type == 'custom_title'){
            $before_title = tfuse_page_options('before_title', '', $ID);
            $title = tfuse_page_options('custom_title', '', $ID);
        }
        else{
            $before_title = $title = '';
        }

        if( $return ) {
            $arr = array(
                'title' => $title,
                'before_title' => $before_title,
            );
            return $arr;
        }

        echo ( $before_title ) ? '<h2 class="page-title-before">' . $before_title . '</h2>' : '';
        echo ( $title ) ? '<h1 class="page-title">' . $title . '</h1>' : '';
    }
endif;


if (!function_exists('tfuse_custom_cat_title')):
    function tfuse_custom_cat_title($customID = false, $tax = 'category', $return = false) {
        global $post;
        if (is_numeric($customID))
            $ID = $customID;
        else
            $ID = $post->ID;

        $tfuse_title_type = tfuse_options('page_title', '', $ID);
        $term = get_term_by('id', $ID, $tax);

        if ($tfuse_title_type == 'default_title'){
            $before_title = '';
            $title = $term->name;
        }
        elseif ($tfuse_title_type == 'custom_title'){
            $before_title = tfuse_options('before_title', '', $ID);
            $title = tfuse_options('custom_title', '', $ID);
        }
        else{
            $before_title = $title = '';
        }

        if( $return ) {
            $arr = array(
                'title' => $title,
                'before_title' => $before_title,
            );
            return $arr;
        }

        echo ( $before_title ) ? '<h2 class="page-title-before">' . $before_title . '</h2>' : '';
        echo ( $title ) ? '<h1 class="page-title">' . $title . '</h1>' : '';
    }
endif;


if (!function_exists('tfuse_user_profile')) :
    /**
     * Retrieve the requested data of the author of the current post.
     *
     * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
     * @return null|array The author's spefified fields from the current author's DB object.
     */
    function tfuse_user_profile( $fields = array() )
    {
        $tfuse_meta = null;

        // Get stnadard user contact info
        $standard_meta = array(
            'first_name' => get_the_author_meta('first_name'),
            'last_name' => get_the_author_meta('last_name'),
            'email'     => get_the_author_meta('email'),
            'url'       => get_the_author_meta('url'),
            'aim'       => get_the_author_meta('aim'),
            'yim'       => get_the_author_meta('yim'),
            'jabber'    => get_the_author_meta('jabber')
        );

        // Get extended user info if exists
        $custom_meta = (array) get_the_author_meta('theme_fuse_extends_user_options');

        $_meta = array_merge($standard_meta,$custom_meta);

        foreach ($_meta as $key => $item) {
            if ( !empty($item) && in_array($key, $fields) ) $tfuse_meta[$key] = $item;
        }

        return apply_filters('tfuse_user_profile', $tfuse_meta, $fields);
    }
endif;


if (!function_exists('tfuse_action_comments')) :
    /**
     *  This function disable post commetns.
     *
     * To override tfuse_action_comments() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_action_comments() {
        global $post;

        if (!tfuse_page_options('disable_comments') && isset($post) && $post->comment_status == 'open')
            comments_template( '', true );
    }

    add_action('tfuse_comments', 'tfuse_action_comments');
endif;


if (!function_exists('tfuse_get_comments')):
    /**
     *  Get post comments for a specific post.
     *
     * To override tfuse_get_comments() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_get_comments($return = TRUE, $post_ID) {
        $num_comments = get_comments_number($post_ID);

        if (comments_open($post_ID)) {
            if ($num_comments == 0) {
                $comments = __('No Comments','tfuse');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . __(' Comments','tfuse');
            } else {
                $comments = __('1 Comment','tfuse');
            }
            $write_comments = '<a class="link-comments" href="' . get_comments_link($post_ID) . '">' . $comments . '</a>';
        } else {
            $write_comments = __('Comments are off','tfuse');
        }
        if ($return)
            return $write_comments;
        else
            echo $write_comments;
    }
endif;


if (!function_exists('tfuse_shortcode_content')) :
    /**
     *  Get post comments for a specific post.
     *
     * To override tfuse_shortcode_content() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_shortcode_content($position, $return = false)
    {
        global $is_tf_blog_page,$is_tf_front_page,$TFUSE;
        $page_shortcodes = '';
        if($is_tf_blog_page){
            $page_shortcodes = tfuse_options('content_'.$position.'_blog', '');
        }
        elseif($is_tf_front_page){
            if(tfuse_options('homepage_category','') == 'page' && tfuse_options('use_page_options','') == true)
                $page_shortcodes = tfuse_page_options('content_'.$position, '');
            else
                $page_shortcodes = tfuse_options('content_'.$position, '');
        }
        elseif (is_search()) {
            $page_shortcodes = tfuse_options('content_'.$position.'_search', '');
        }
        elseif (is_404()) {
            $page_shortcodes = tfuse_options('content_'.$position.'_404', '');
        }
        elseif (is_tag()) {
            $page_shortcodes = tfuse_options('content_'.$position.'_tag', '');
        }
        elseif (is_singular()) {
            global $wp_query;
            $ID = $wp_query->queried_object->ID;
            $page_shortcodes = tfuse_page_options('content_'.$position, '', $ID);
        }
        elseif ( is_tax() )
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $ID = $term->term_id;
            $page_shortcodes = tfuse_options('content_'.$position, '', $ID);
        }
        elseif(is_category()){
            $ID = get_query_var('cat');
            $page_shortcodes = tfuse_options('content_'.$position, '', $ID);
        }
        elseif(is_archive()){
            $page_shortcodes = tfuse_options('content_'.$position.'_archive', '');
        }

        $page_shortcodes = tfuse_qtranslate($page_shortcodes);
        $page_shortcodes = apply_filters('themefuse_shortcodes', $page_shortcodes);

        if ($return && $page_shortcodes!='')
            return $page_shortcodes;
        else
            echo $page_shortcodes;
    }

// End function tfuse_shortcode_content()
endif;


if (!function_exists('tfuse_category_on_front_page')) :
    /**
     * Dsiplay homepage category
     *
     * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_category_on_front_page()
    {
        if ( !is_front_page() ) return;

        global $is_tf_front_page,$homepage_categ;
        $is_tf_front_page = false;

        $homepage_category = tfuse_options('homepage_category');
        $homepage_category = explode(",",$homepage_category);
        foreach($homepage_category as $homepage)
        {
            $homepage_categ = $homepage;
        }

        if($homepage_categ == 'specific')
        {
            $is_tf_front_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $specific = tfuse_options('categories_select_categ');
            $ids = explode(",",$specific);
            $posts = array();
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'cat' => $specific,
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);
            include_once(locate_template($archive));
            return;
        }
        elseif($homepage_categ == 'page')
        {
            global $front_page;
            $is_tf_front_page = true;
            $front_page = true;
            $archive = 'page.php';
            $page_id = tfuse_options('home_page');
            $args=array(
                'page_id' => $page_id,
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'ignore_sticky_posts'=> 1
            );
            query_posts($args);
            include_once(locate_template($archive));
            wp_reset_query();
            return;
        }
        else
        {
            $archive = 'archive.php';
            $is_tf_front_page = true;
            wp_reset_postdata();
            include_once(locate_template($archive));
            return;
        }
    }
// End function tfuse_category_on_front_page()
endif;


if ( !function_exists('tfuse_footer_social')):
    function tfuse_footer_social(){
        if(tfuse_options('social_facebook')!='' || tfuse_options('social_twitter')!='' || tfuse_options('social_pinterest')!='' || tfuse_options('social_trip_advisor')!='' || tfuse_options('social_instagram')!='')
            echo '<span class="social-icons">';
            if(tfuse_options('social_facebook')!='') { ?>
                <a href="<?php echo tfuse_options('social_facebook'); ?>" title="Facebook" target="_blank">
                    <i class="tficon-facebook"></i>
                </a>
            <?php }
            if(tfuse_options('social_twitter')!='') { ?>
                <a href="<?php echo tfuse_options('social_twitter'); ?>" title="Twitter" target="_blank">
                    <i class="tficon-twitter"></i>
                </a>
            <?php }
            if(tfuse_options('social_pinterest')!='') { ?>
                <a href="<?php echo tfuse_options('social_pinterest'); ?>" title="Pinterest" target="_blank">
                    <i class="tficon-pinterest"></i>
                </a>
            <?php }
            if(tfuse_options('social_trip_advisor')!='') { ?>
                <a href="<?php echo tfuse_options('social_trip_advisor'); ?>" title="Trip Advisor" target="_blank">
                    <i class="tficon-trip-advisor"></i>
                </a>
            <?php }
            if(tfuse_options('social_instagram')!='') { ?>
                <a href="<?php echo tfuse_options('social_instagram'); ?>" title="Instagram" target="_blank">
                    <i class="tficon-instagram"></i>
                </a>
            <?php }
        if(tfuse_options('social_facebook')!='' || tfuse_options('social_twitter')!='' || tfuse_options('social_pinterest')!='' || tfuse_options('social_trip_advisor')!='' || tfuse_options('social_instagram')!='')
            echo '</span>';
    }
endif;


if (!function_exists('encodeURIComponent')) :
    /**
     * To override encodeURIComponent() in a child theme, add your own encodeURIComponent()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function encodeURIComponent($str) {
        $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
        return strtr(rawurlencode($str), $revert);
    }

endif;


if (!function_exists('tfuse_pagination')) :
    /**
     * Display pagination to next/previous pages when applicable.
     *
     * To override tfuse_pagination() in a child theme, add your own tfuse_pagination()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */
    function tfuse_pagination($query = '', $args = array()){
        global $wp_rewrite, $wp_query;

        if ( $query ) {
            $wp_query = $query;
        } // End IF Statement

        /* If there's not more than one page, return nothing. */
        if ( 1 >= $wp_query->max_num_pages )
            return false;

        /* Get the current page. */
        $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

        /* Get the max number of pages. */
        $max_num_pages = intval( $wp_query->max_num_pages );

        /* Set up some default arguments for the paginate_links() function. */
        $defaults = array(
            'base' => esc_url(add_query_arg( 'paged', '%#%' )),
            'format' => '',
            'total' => $max_num_pages,
            'current' => $current,
            'prev_next' => false,
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 1,
            'add_fragment' => '',
            'type' => 'plain',
            'before' => '',
            'after' => '',
            'echo' => true,
        );

        /* Add the $base argument to the array if the user is using permalinks. */
        if( $wp_rewrite->using_permalinks() )
            $defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

        /* If we're on a search results page, we need to change this up a bit. */
        if ( is_search() ) {
            $search_permastruct = $wp_rewrite->get_search_permastruct();
            if ( !empty( $search_permastruct ) )
                $defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
        }

        /* Merge the arguments input with the defaults. */
        $args = wp_parse_args( $args, $defaults );

        /* Don't allow the user to set this to an array. */
        if ( 'array' == $args['type'] )
            $args['type'] = 'plain';

        /* Get the paginated links. */
        $page_links = paginate_links( $args );

        /* Remove 'page/1' from the entire output since it's not needed. */
        $page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

        /* Wrap the paginated links with the $before and $after elements. */
        $page_links = $args['before'] . $page_links . $args['after'];

        /* Return the paginated links for use in themes. */
        if ( $args['echo'] )
        { ?>
            <!-- pagination -->
            <nav class="navigation paging-navigation" role="navigation">
                <div class="pagination loop-pagination">
                    <?php $prev_posts = get_previous_posts_link('<i class="tficon-shevron-left"></i>'); ?>
                    <?php if ($prev_posts != '') { echo $prev_posts;} else { echo '<a class="page_prev" href="javascript:void(0);"><i class="tficon-shevron-left"></i></a>'; }?>
                    <div class="page-number">
                        <span><?php echo $current; ?></span> <?php _e('of','tfuse'); ?> <span><?php echo $max_num_pages; ?></span>
                    </div>
                    <?php $next_posts = get_next_posts_link('<i class="tficon-shevron-right"></i>'); ?>
                    <?php if ($next_posts != '') { echo $next_posts;} else { echo '<a class="page_next" href="javascript:void(0);"><i class="tficon-shevron-right"></i></a>'; } ?>
                    <?php //echo $page_links; ?>
                </div>
            </nav>
            <!-- /pagination -->
        <?php
        }
        else
            return $page_links;
    }
endif; // tfuse_pagination


if (!function_exists('next_posts_link_css')) :
    /**
     * Display pagination to next/previous pages when applicable.
     *
     * To override next_posts_link_css() in a child theme, add your own next_posts_link_css()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */
    function next_posts_link_css() {
        return 'class="page_next"';
    }
    add_filter('next_posts_link_attributes', 'next_posts_link_css' );
endif;


if (!function_exists('previous_posts_link_css')) :
    /**
     * Display pagination to next/previous pages when applicable.
     *
     * To override previous_posts_link_css() in a child theme, add your own previous_posts_link_css()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */
    function previous_posts_link_css() {
        return 'class="page_prev"';
    }
    add_filter('previous_posts_link_attributes', 'previous_posts_link_css' );
endif; // tfuse_pagination


if (!function_exists('tfuse_enqueue_comment_reply')) :
    /**
     * To override tfuse_enqueue_comment_reply() in a child theme, add your own tfuse_enqueue_comment_reply()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */
    function tfuse_enqueue_comment_reply() {
        // on single blog post pages with comments open and threaded comments
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            // enqueue the javascript that performs in-link comment reply fanciness
            wp_enqueue_script( 'comment-reply' );
        }
    }
    // Hook into wp_enqueue_scripts
    add_action( 'wp_head', 'tfuse_enqueue_comment_reply' );
endif;


if (!function_exists('tfuse_new_excerpt_more')) :
    /**
     * To override tfuse_new_excerpt_more() in a child theme, add your own tfuse_new_excerpt_more()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */
    function tfuse_new_excerpt_more() {
        return '...';
    }
    add_filter('excerpt_more', 'tfuse_new_excerpt_more' );
endif;


if (!function_exists('tfuse_custom_excerpt_length')) :
    /**
     * To override tfuse_custom_excerpt_length() in a child theme, add your own tfuse_custom_excerpt_length()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */
    function tfuse_custom_excerpt_length( $length) {
        return 144;
    }
    add_filter( 'excerpt_length', 'tfuse_custom_excerpt_length', 99 );
endif;


if (!function_exists('tfuse_custom_excerpt_length_short')) :
    /**
     * To override tfuse_custom_excerpt_length_short() in a child theme, add your own tfuse_custom_excerpt_length()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */
    function tfuse_custom_excerpt_length_short( $length) {
        return 18;
    }
endif;


if (!function_exists('tfuse_get_archive_link')) :
    /**
     * To override tfuse_get_archive_link() in a child theme, add your own tfuse_get_archive_link()
     * to your child theme's file.
     */
    function tfuse_get_archive_link ($link_html) {
        $link_html = str_replace('</a>','',$link_html);
        $link_html = str_replace('</li>','</a></li>',$link_html);
        return $link_html;
    }
    add_filter("get_archives_link", "tfuse_get_archive_link");
endif;
//add_filter( 'show_recent_comments_widget_style', '__return_false' );


if (!function_exists('tfuse_category_on_blog_page')) :
    /**
     * Dsiplay blogpage category
     *
     * To override tfuse_category_on_blog_page() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_category_on_blog_page()
    {
        global $is_tf_blog_page;
        $blogpage_categ ='';
        if ( !$is_tf_blog_page ) return;
        $is_tf_blog_page = false;

        $blogpage_category = tfuse_options('blogpage_category');
        $blogpage_category = explode(",",$blogpage_category);
        foreach($blogpage_category as $blogpage)
        {
            $blogpage_categ = $blogpage;
        }
        if($blogpage_categ == 'specific')
        {
            $is_tf_blog_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $specific = tfuse_options('categories_select_categ_blog');
            $ids = explode(",",$specific);
            $posts = array();
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }
            $args = array(
                'cat' => $specific,
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);
            include_once(locate_template($archive));
            return;
        }
        else
        {
            $is_tf_blog_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $categories = get_categories();
            $ids = array();
            foreach($categories as $cats){
                $ids[] = $cats -> term_id;
            }
            $posts = array();

            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }
            $args = array(
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);
            include_once(locate_template($archive));
            return;
        }
    }
// End function tfuse_category_on_blog_page()
endif;


function tfuse_change_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/','/ class="submenu-1" id="submenu-1" /',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','tfuse_change_submenu_class');


if(!function_exists('tfuse_feedFilter')) :
    function tfuse_feedFilter($query) {
        if ($query->is_feed) {
            add_filter('the_content', 'tfuse_feedContentFilter');
        }
        return $query;
    }
    add_filter('pre_get_posts','tfuse_feedFilter');
    function tfuse_feedContentFilter($content) {
        global $post;
        $thumb = tfuse_page_options('single_image');
        $image = '';
        if($thumb) {
            $image = '<a href="'.get_permalink().'"><img align="left" src="'. $thumb .'" width="200px" height="150px" /></a>';
            echo $image;
        }
        $content = $image . $content;
        return $content;
    }
endif;


if( !function_exists('tfuse_set_blog_page') ):
function tfuse_set_blog_page(){
    global $wp_query,$is_tf_blog_page;
        $id_post = 0;
        $blog_page_id = tfuse_options('blog_page','');
        if(isset($wp_query->queried_object) && isset($wp_query->queried_object->ID)) {
            $id_post = $wp_query->queried_object->ID;
        }
        elseif(isset($wp_query->query['page_id'])) {
            $id_post = $wp_query->query['page_id'];
        }
        if(function_exists('icl_object_id')){
            $id_post = icl_object_id($id_post, 'page', false, 'en');
        }
        if($blog_page_id != 0 && $id_post == $blog_page_id) {
            $is_tf_blog_page = true;
        }
}
add_action('wp_head','tfuse_set_blog_page');
endif;


if(!function_exists('tfuse_get_term_id')){
    function tfuse_get_term_id(){
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        $ID = $term->term_id;
        return $ID;
    }
}


if (!function_exists('tfuse_user_has_gravatar')){
    function tfuse_user_has_gravatar( $email_address ) {
        // Build the Gravatar URL by hasing the email address
        $url = 'http://www.gravatar.com/avatar/' . md5( strtolower( trim ( $email_address ) ) ) . '?d=404';
        // Now check the headers
        $headers = @get_headers( $url );
        // If 200 is found, the user has a Gravatar; otherwise, they don't.
        return preg_match( '|200|', $headers[0] ) ? true : false;
    }
}


if (!function_exists('tfuse_filter_get_avatar')){
    function tfuse_filter_get_avatar($avatar, $id_or_email, $size, $default, $alt){
        $avatar_src = tfuse_options('default_avatar', false);
        if(empty($avatar_src)) {
            return $avatar;
        }

        $email = '';
        if ( is_numeric($id_or_email) ) {
            $id = (int) $id_or_email;
            $user = get_userdata($id);
            if ( $user )
                $email = $user->user_email;
        } elseif ( is_object($id_or_email) ) {
            // No avatar for pingbacks or trackbacks
            $allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
            if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
                return false;

            if ( !empty($id_or_email->user_id) ) {
                $id = (int) $id_or_email->user_id;
                $user = get_userdata($id);
                if ( $user)
                    $email = $user->user_email;
            } elseif ( !empty($id_or_email->comment_author_email) ) {
                $email = $id_or_email->comment_author_email;
            }
        } else {
            $email = $id_or_email;
        }

        if(!tfuse_user_has_gravatar($email)){
            $avatar = "<img alt='' src='".TF_GET_IMAGE::get_src_link($avatar_src, $size, $size)."' class='avatar avatar-".$size." photo avatar-default' height='".$size."' width='".$size."' />";
        }

        return $avatar;
    }
    add_filter('get_avatar', 'tfuse_filter_get_avatar',10,5);
}


if(!function_exists('tfuse_my_submit_comment_message'))
{
    function tfuse_my_submit_comment_message($result){
        return $result.'<div class="form-reset">
            <a href="#" onclick="document.getElementById(&#39;addcomments&#39;).reset();return false" class="btn btn-black-transparent btn-reset"><span>'.__('reset fields','tfuse').'</span></a>
        </div>';
    }
    add_filter("comment_id_fields","tfuse_my_submit_comment_message");
}


if(!function_exists('tfuse_update_reservation_forms'))
{
    function tfuse_update_reservation_forms()
    {
        $forms = get_terms( 'reservations', array(
            'orderby'    => 'count',
            'hide_empty' => 0
        ) );

        $args = array(
            '0' =>  'text',
            '1' =>  'textarea',
            '2' =>  'radio',
            '3' =>  'checkbox',
            '4' =>  'select',
            '5' =>  'email',
            '6' =>  'captcha',
            '7' =>  'date_in',
            '8' =>  'date_out',
            '9' =>  'res_email',
        );

        foreach($forms as $form)
        {
            $check_option = get_option( 'tfuse_update_reservation_forms', 'none' );
            if($check_option == 'set')
            {
                return;
            }
            $description = unserialize($form->description);
            if(isset($description['version']) AND $description['version'] == '1.1')
                continue;

            foreach($description['input'] as $key => $input)
            {
                if(isset($args[$input['type']]))
                    $input['type'] = $args[$input['type']];
                $description['input'][$key]['type'] = $input['type'];
            }
            $description['version'] = '1.1';
            wp_update_term($form->term_id, 'reservations', array('description' => serialize($description)));
            add_option('tfuse_update_reservation_forms', 'set');
        }
    }
    add_action('wp_head', 'tfuse_update_reservation_forms');
}


if( !function_exists('tfuse_is_date') )
{
    /**
     * The function is_date() validates the date and returns true or false
     * @param $str sting expected valid date format
     * @return bool returns true if the supplied parameter is a valid date
     * otherwise false
     */
    function tfuse_is_date( $str ) {
        try {
            $dt = new DateTime( trim($str) );
        }
        catch( Exception $e ) {
            return false;
        }
        $month = $dt->format('m');
        $day = $dt->format('d');
        $year = $dt->format('Y');
        if( checkdate($month, $day, $year) ) {
            return true;
        }
        else {
            return false;
        }
    }
}


function tfuse_feedburner_url($output, $feed)
{
    $feedburner_url = tfuse_options('feedburner_url');
    if($feedburner_url && (($feed == 'rss2') || ($feed == '' && false === strpos($output, '/comments/feed/'))) )
        return $feedburner_url;
    return $output;
}
add_filter('feed_link','tfuse_feedburner_url',10,2);


if ( !function_exists('tfuse_show_blog_filter')):
    function tfuse_show_blog_filter(){
        global $post;
        if(tfuse_options('enable_blog_filter') && !empty($post)){
            $post_type = get_post_type();
            if($post_type=='post') $term = get_category(get_query_var('cat'),false);
            else $term = false;

            if((isset($term->errors) && $term->errors) || $term == false) {
                return;
            };
            $group = $term->taxonomy;
            $term_id = $term->term_id;
            $template_slug = $term->slug;
            $template_parent = $term->parent;
            $args = array( 'taxonomy' => $group );
            $terms = get_terms($group, $args);
            $count = count($terms);
            $i = 0;
            if($template_parent==0) $template_parent = $term_id;
            echo '<section class="sec-blog-categories">
                <div class="wrapp-categories">
			        <div class="categories-slider blog">
                        <div class="caroufredsel_wrapper">
                            <ul id="categories-slider" class="blog-categories">';
            if ($count > 0)
            {
                $term_list = $term_list_view_all = '';
                foreach ($terms as $term){
                    $i++;
                    if($template_parent != $term->parent){
                        if($term->slug==$template_slug){
                            $permalink = get_term_link( $term->slug, $group );
                            $term_list_view_all .= '<li class="categories-item active">
                                <a href="'.$permalink.'"><div class="check-category"><span></span></div>'.$term->name.'</a>
                            </li>';
                        }
                        elseif($template_parent==$term->term_id){
                            $permalink = get_term_link( $term->slug, $group );
                            $term_list_view_all .= '<li class="categories-item">
                                <a href="'.$permalink.'"><div class="check-category"><span></span></div>'.$term->name.'</a>
                            </li>';
                        }
                    }
                    elseif( $template_parent==$term->parent){
                        if($term->slug == $template_slug){
                            $permalink = get_term_link( $term->slug, $group );
                            $term_list .= '<li class="categories-item active">
                                <a href="'.$permalink.'"><div class="check-category"><span></span></div>'.$term->name.'</a>
                            </li>';
                        }
                        else{
                            $permalink = get_term_link( $term->slug, $group );
                            $term_list .= '<li class="categories-item">
                                <a href="'.$permalink.'"><div class="check-category"><span></span></div>'.$term->name.'</a>
                            </li>';
                        }
                    }
                }
                echo $term_list_view_all.$term_list;
            }
            echo '</ul>
                        </div>
                        <a class="prev" id="categories-prev" href="#"><i class="tficon-shevron-left"></i></a>
                        <a class="next" id="categories-next" href="#"><i class="tficon-shevron-right"></i></a>
		            </div>
	            </div>
            </section>';
        }
    }
endif;


if ( !function_exists('tfuse_show_similar_posts')):
    function tfuse_show_similar_posts($tags, $id){
        if(!empty($tags)){
            $tags_ids = array();
            foreach($tags as $tag){
                $tags_ids[] = $tag->term_id;
            }

            $query = new WP_Query(
                array(
                    'tag__in' => $tags_ids,
                    'posts_per_page' => 3,
                    'post__not_in' => array($id),
                )
            );
            if(!empty($query->posts)){ ?>
                <section class="post-similar">
                    <h1 class="title"><?php _e('You may also','tfuse'); ?> <span><?php _e('like these posts:','tfuse'); ?></span></h1>
                    <?php foreach($query->posts as $item){
                        if(has_post_thumbnail( $item->ID ))
                            echo '<a href="'.get_permalink($item->ID).'">'.get_the_post_thumbnail($item->ID, 'post-thumb1').'<span>'.$item->post_title.'</span></a>';
                    } ?>
                </section>
            <?php }
        }
    }
endif;


if( !function_exists('tf_events_calendar_options') )
{
    function tf_events_calendar_options()
    {
        $date = mysql2date( get_option( 'date_format' ), 'F j, Y' );
        $general_opts['up_button']          = __( 'up', 'tfuse');
        $general_opts['down_button']        = __( 'down', 'tfuse');
        $general_opts['datepicker_opts']    = array(
            'firstDay'          => 0,
            'currentText'       => __('Today', 'tfuse'),
            'monthNames'        => array(__('January', 'tfuse'), __('February', 'tfuse'), __('March', 'tfuse'), __('April', 'tfuse'), __('May', 'tfuse'), __('June', 'tfuse'), __('July', 'tfuse'), __('August', 'tfuse'), __('September', 'tfuse'), __('October', 'tfuse'),__('November', 'tfuse'), __('December', 'tfuse')),
            'monthNamesShort'   => array(__('Jan', 'tfuse'), __('Feb', 'tfuse'), __('Mar', 'tfuse'), __('Apr', 'tfuse'), __('May', 'tfuse'), __('Jun', 'tfuse'), __('Jul', 'tfuse'), __('Aug', 'tfuse'), __('Sep', 'tfuse'), __('Oct', 'tfuse'), __('Nov', 'tfuse'), __('Dec', 'tfuse')),
            'dayNames'          => array(__('Sunday', 'tfuse'), __('Monday', 'tfuse'), __('Tuesday', 'tfuse'), __('Wednesday', 'tfuse'), __('Thursday', 'tfuse'), __('Friday', 'tfuse'), __('Saturday', 'tfuse')),
            'dayNamesMin'       => array(__('Sun', 'tfuse'), __('Mon', 'tfuse'), __('Tue', 'tfuse'), __('Wed', 'tfuse'), __('Thu', 'tfuse'), __('Fri', 'tfuse'), __('Sat', 'tfuse')),
            'dayNamesShort'     => array(__('Su', 'tfuse'), __('Mo', 'tfuse'), __('Tu', 'tfuse'), __('We', 'tfuse'), __('Th', 'tfuse'), __('Fr', 'tfuse'),__('Sa', 'tfuse')),
            'weekHeader'        => __('Wk', 'tfuse'),
            'prevText'          => __('PREVIOUS &#77;&#79;NTH','tfuse'),
            'nextText'          => __('NEXT &#77;&#79;NTH','tfuse'),
            'dateFormat'        => apply_filters('tf_events_dateFormat', $date)
        );

        $opts = apply_filters('tf_events_general_eventsjs', $general_opts);

        wp_localize_script('general', 'tf_calendar', apply_filters('tf_events_generaljs', $opts));
        wp_localize_script('events', 'tf_calendar', apply_filters('tf_events_eventsjs', $opts));
    }
    add_action('tf_scripts_added', 'tf_events_calendar_options');
}


if( !function_exists('tfuse_show_gallery_filter') )
{
    function tfuse_show_gallery_filter(){
        if(tfuse_options('enable_portfolio_filter', true)){
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $group = $term->taxonomy;
            $term_id = $term->term_id;
            $template_slug = $term->slug;
            $template_parent = $term->parent;
            $args = array( 'taxonomy' => $group );
            $terms = get_terms($group, $args);
            $count = count($terms);
            $i = 0;
            if($template_parent==0) $template_parent = $term_id;
            echo '<div class="wrapp-categories-gallery portfolio-archive">
                <ul id="categories-filter" class="gallery-categories">';
            if ($count > 0)
            {
                $term_list = $term_list_view_all = '';
                foreach ($terms as $term){
                    $i++;
                    if($template_parent != $term->parent){
                        if($term->slug==$template_slug){
                            $permalink = get_term_link( $term->slug, $group );
                            $term_list_view_all .= '<li class="categories-item active" data-category="'.$template_slug.'"><a href="'.$permalink.'" class="check-category"><span></span></a><a href="'.$permalink.'">'.$term->name.'</a></li>';
                        }
                        elseif($template_parent==$term->term_id){
                            $permalink = get_term_link( $term->slug, $group );
                            $term_list_view_all .= '<li class="categories-item" data-category="'.$term->slug.'"><a href="'.$permalink.'" class="check-category"><span></span></a><a href="'.$permalink.'">'.$term->name.'</a></li>';
                        }
                    }
                    elseif( $template_parent==$term->parent){
                        if($term->slug == $template_slug){
                            $permalink = get_term_link( $term->slug, $group );
                            $term_list .= '<li class="categories-item active" data-category="'.$template_slug.'"><a href="'.$permalink.'" class="check-category"><span></span></a><a href="'.$permalink.'">'.$term->name.'</a></li>';
                        }
                        else{
                            $permalink = get_term_link( $term->slug, $group );
                            $term_list .= '<li class="categories-item" data-category="'.$term->slug.'"><a href="'.$permalink.'" class="check-category"><span></span></a><a href="'.$permalink.'">'.$term->name.'</a></li>';
                        }
                    }
                }
                echo $term_list_view_all.$term_list;
            }
            echo '</ul>
                <a class="prev" id="categories-filter-prev" href="#"><i class="tficon-shevron-left"></i></a>
                <a class="next" id="categories-filter-next" href="#"><i class="tficon-shevron-right"></i></a>
            </div>';
        }
    }
}


if( !function_exists('tfuse_get_portfolio_columns') )
{
    function tfuse_get_portfolio_columns(){
        $columns = 'three-column';
        if(isset($_GET['columns'])){
            /* only for demo presentation used */
            if($_GET['columns']=='two-column'){
                $columns = $_GET['columns'];
            }
            elseif($_GET['columns']=='four-column'){
                $columns = $_GET['columns'];
            }
            return $columns;
        }
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        if(isset($term->term_id)){
            $term_id = $term->term_id;
            $columns = tfuse_options('columns','three-column',$term_id);
        }

        return $columns;
    }
}


if( !function_exists('tfuse_get_portfolio_thumbnail') ){
    function tfuse_get_portfolio_thumbnail($post_id, $columns){
        if( has_post_thumbnail($post_id) ){
            if($columns == 'two-column'){
                $width = 535;
                $height = 381;
            }
            elseif($columns == 'four-column'){
                $width = 263;
                $height = 187;
            }
            else{
                $width = 340;
                $height = 242;
            }
            $title = get_the_title($post_id);
            $src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), '', false, '' );
            $image = new TF_GET_IMAGE();
            $image->removeSizeParams = true;
            $img = $image->width($width)->height($height)->src($src[0])->get_img();
            if(tfuse_options('enable_portfolio_prettyphoto', true)){
                $output = '<a href="'.$src[0].'" class="see-more" data-rel="prettyPhoto['.$post_id.']" title="'.$title.'">
                    <span class="title">'.$title.'</span>
                </a>';
            }
            else {
                $permalink = get_permalink($post_id);
                $output = '<a href="'.$permalink.'" class="see-more"><span class="title">'.$title.'</span></a>';
            }
            $output .= $img;
            return $output;
        }
    }
}


if( !function_exists('tfuse_get_portfolio_gallery') )
{
    function tfuse_get_portfolio_gallery($post_id){
        $output = '';
        if(tfuse_options('enable_portfolio_prettyphoto', true)){
            $title = get_the_title($post_id);
            $images = tfuse_page_options('gallery',array(),$post_id);
            $output.='<div class="gallery-array">';
            if(!empty($images)){
                foreach($images as $image){
                    $output.='<a href="'.$image['url'].'" class="see-more" data-rel="prettyPhoto['.$post_id.']" title="'.$title.'"> </a>';
                }
            }
            $output.='</div>';
        }

        return $output;
    }
}


if( !function_exists('tfuse_get_portfolio_singe_gallery') )
{
    function tfuse_get_portfolio_singe_gallery($post_id){
        $output = '';
        $uniq = rand(100,200);
        $width = 600;
        $height = 291;
        $images = tfuse_page_options('gallery',array(),$post_id);

        $output .= '<div class="slider slider_medium">
            <div class="slider_container clearfix" id="slider'.$uniq.'">';
            if ( has_post_thumbnail($post_id) ) {
                $src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), '', false, '' );
                $getimage = new TF_GET_IMAGE();
                $img = $getimage->width($width)->height($height)->src($src[0])->get_img();
                $output .= '<div class="slider-item">'.$img .'</div>';
            }

            if(!empty($images)){
                foreach($images as $item){
                    $getimage = new TF_GET_IMAGE();
                    $img = $getimage->width($width)->height($height)->src($item['url'])->get_img();
                    $output .= '<div class="slider-item">'.$img .'</div>';
                }
            }
            $output .= '</div><div class="slider_pagination" id="slider'.$uniq.'_pag"></div></div>
        <script>
            jQuery(document).ready(function() {
                jQuery("#slider'.$uniq.'").carouFredSel({
                    pagination : "#slider'.$uniq.'_pag",
                    infinite: false,
                    auto: false,
                    height: "auto",
                    items: 1,
                    scroll: {
                        fx: "fade",
                        duration: 200
                    }
                });
            });
        </script>';

        return $output;
    }
}


if( !function_exists('tfuse_get_portfolio_categories_list') )
{
    function tfuse_get_portfolio_categories_list($post_id){
        $terms = wp_get_post_terms($post_id, 'group');
        $list = '';
        $checked = false;
        foreach($terms as $term){
            if($term->parent==0){
                /* if is checked parent category */
                $list .= $term->slug.', ';
                $checked = true;
            }
            else{
                $list .= $term->slug.', ';
                $parent_id = $term->parent;
            }
        }

        if(!$checked){
            /* if is not checked parent category extract this parent */
            $term = get_term_by('id', $parent_id, 'group');
            $list .= $term->slug.', ';
        }

        return $list;
    }
}


if( !function_exists('tfuse_return_term_id') ){
    function tfuse_return_term_id(){
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        if(isset($term->term_id)){
            $ID = $term->term_id;
        }
        else{
            $ID = false;
        }
        return $ID;
    }
}


if( !function_exists('tfuse_get_recipe_options') ){
    function tfuse_get_recipe_options($post_id){
        $out = '';
        $recipe_title = tfuse_page_options('recipe_title','',$post_id);
        $recipe_description = tfuse_page_options('recipe_description','',$post_id);
        $recipe_ingredients = tfuse_page_options('recipe_ingredients','',$post_id);
        $recipe_method = tfuse_page_options('recipe_method','',$post_id);
        if($recipe_title!='' || $recipe_description!='' || $recipe_method!=''){
            $out .= '<div class="recipe">';
            if($recipe_title!='') $out .= '<h1>'.$recipe_title.'</h1>';
            if($recipe_description!='') $out .= '<h2>'.$recipe_description.'</h2>';
            if(!empty($recipe_ingredients)) {
                $out .= '<h3>'.__('Ingredients','tfuse').'</h3>';
                $out .= '<ul>';
                foreach($recipe_ingredients as $item){
                    if($item['tab_title']!='') $out .= '<li>'.$item['tab_title'].'</li>';
                }
                $out .= '</ul>';
            }
            if($recipe_method!='') $out .= '<h3>'.__('method','tfuse').'</h3>'.$recipe_method;
            $out .= '</div>';
        }
        echo $out;
    }
}


if( !function_exists('tfuse_get_post_excerpt') ){
    function tfuse_get_post_excerpt($post_id){
        $this_post = get_post($post_id);
        if($this_post->post_excerpt!=''){
            $excerpt = $this_post->post_excerpt;
        }
        else{
            $excerpt = substr($this_post->post_content, 0, 180);
        }
        return $excerpt;
    }
}


if( !function_exists('tfuse_get_menus_listing') ){
    function tfuse_get_menus_listing($post_id, $currency_symbol, $symbol_position){
        $title = get_the_title($post_id);
        $price = tfuse_page_options('price','',$post_id);
        $separator = ".";
        $price_array = explode($separator, $price);
        $single_menu = tfuse_options('single_menu', false);
        ?>
        <li>
            <?php if ( has_post_thumbnail($post_id) ) { ?>
                <div class="dishes-thumbnail">
                    <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 0, false, '' ); ?>
                    <a title="<?php echo $title; ?>" rel="prettyPhoto" data-rel="prettyPhoto" href="<?php echo $src[0]; ?>"><?php echo get_the_post_thumbnail( $post_id, 'thumbnail' ); ?></a>
                </div>
            <?php } ?>
            <div class="dishes-content">
                <h2 class="dishes-content-title">
                    <span>
                        <?php if($single_menu){ ?>
                            <a href="<?php echo get_permalink($post_id); ?>"><?php echo $title; ?></a>
                        <?php }else{
                            echo $title;
                        } ?>
                    </span>
                    <?php if($symbol_position=='left'){ ?>
                        <span class="price"><?php echo $currency_symbol; ?><?php echo $price_array[0]; ?><sup><?php if(isset($price_array[1])) echo $separator.$price_array[1]; ?></sup></span>
                    <?php } else{ ?>
                        <span class="price"><?php echo $price_array[0]; ?><sup><?php if(isset($price_array[1])) echo $separator.$price_array[1]; ?></sup><?php echo $currency_symbol; ?></span>
                    <?php } ?>
                </h2>
                <p><?php echo tfuse_get_post_excerpt($post_id); ?></p>
            </div>
        </li>
    <?php
    }
}

if( !function_exists('tfuse_get_menus_listing2') ){
    function tfuse_get_menus_listing2($post_id, $currency_symbol, $symbol_position){
        $title = get_the_title($post_id);
        $price = tfuse_page_options('price','',$post_id);
        $separator = ".";
        $price_array = explode($separator, $price);
        $single_menu = tfuse_options('single_menu', false);
        ?>
        <li class="drinks_without_image">
            <div class="dishes-content">
                <h2 class="dishes-content-title">
                    <?php if($single_menu){ ?>
                        <a href="<?php echo get_permalink($post_id); ?>"><?php echo $title; ?></a>
                    <?php }else{
                        echo $title;
                    } ?>
                    <div class="menu_excerpt"><p><?php echo tfuse_get_post_excerpt($post_id); ?></p></div>
                </h2>
                <?php if($symbol_position=='left'){ ?>
                    <span class="price"><?php echo $currency_symbol; ?><?php echo $price_array[0]; ?><sup><?php if(isset($price_array[1])) echo $separator.$price_array[1]; ?></sup></span>
                <?php } else{ ?>
                    <span class="price"><?php echo $price_array[0]; ?><sup><?php if(isset($price_array[1])) echo $separator.$price_array[1]; ?></sup><?php echo $currency_symbol; ?></span>
                <?php } ?>
            </div>
        </li>
    <?php
    }
}


if( !function_exists('tfuse_get_menu_subcategories_terms') ){
    function tfuse_get_menu_subcategories_terms($term_id){
        $args = array(
            'orderby'  => 'id',
            'child_of' => $term_id,
        );
        $child_terms = get_terms('list-menus', $args);
        return $child_terms;
    }
}

if( !function_exists('tfuse_menu_class') ){
    function tfuse_menu_class(){
        $menu = tfuse_options('site_menu_type','');
        if(isset($_GET['sticky_menu'])) $menu = 'sticky';
        if($menu=='sticky'){
            echo 'sticky';
        }
        else{
            echo '';
        }
    }
}

if ( !function_exists('tfuse_render_view')):
    function tfuse_render_view($file_path, $view_variables = array()) {
        extract($view_variables, EXTR_REFS);
        ob_start();
        require $file_path;
        return ob_get_clean();
    }
endif;


if( !function_exists('tfuse_theme_styles') )
{
    function tfuse_theme_styles($values = array(),$options = array())
    {
        if (empty($options))
            return;

        $output = '';
        $h_font = $options[TF_THEME_PREFIX . '_hand_font'];
        $titles_font = $options[TF_THEME_PREFIX . '_titles_font'];
        $body_font = $options[TF_THEME_PREFIX . '_body_font'];
        $top_logo_font = $options[TF_THEME_PREFIX . '_top_logo_font'];
        $bottom_logo_font = $options[TF_THEME_PREFIX . '_bottom_logo_font'];
        $logo_letter_spacing = $options[TF_THEME_PREFIX . '_logo_letter_spacing'];

        if(!empty($body_font))
        {
            switch ($body_font) {
                case 'intro_inline':
                    $font = '';
                    $b_family ='"Intro Inline"';
                    break;
                case 'great_vibes':
                    $font = 'http://fonts.googleapis.com/css?family=Great+Vibes&subset=latin,latin-ext';
                    $b_family ='"Great Vibes"';
                    break;
                case 'roboto':
                    $font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $b_family ='"Roboto Slab", serif';
                    break;
                case 'cabin':
                    $font = 'http://fonts.googleapis.com/css?family=Cabin';
                    $b_family ='"Cabin", sans-serif';
                    break;
                case 'droid_sans':
                    $font = 'http://fonts.googleapis.com/css?family=Droid+Sans';
                    $b_family ="'Droid Sans', sans-serif";
                    break;
                case 'gafata':
                    $font = 'http://fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $b_family = '"Gafata", sans-serif';
                    break;
                case 'oxygen':
                    $font = 'http://fonts.googleapis.com/css?family=Oxygen';
                    $b_family ="'Oxygen', sans-serif";
                    break;
                case 'philosopher':
                    $font = 'http://fonts.googleapis.com/css?family=Philosopher';
                    $b_family ="'Philosopher', sans-serif";
                    break;
                case 'questrial':
                    $font = 'http://fonts.googleapis.com/css?family=Questrial';
                    $b_family ="'Questrial', sans-serif";
                    break;
                case 'raleway':
                    $font = 'http://fonts.googleapis.com/css?family=Raleway:400,600,700,800,900,500,300,200,100';
                    $b_family ="'Raleway', sans-serif";
                    break;
                case 'signika':
                    $font = 'http://fonts.googleapis.com/css?family=Signika';
                    $b_family ="'Signika', sans-serif";
                    break;
                case 'ubuntu':
                    $font = 'http://fonts.googleapis.com/css?family=Ubuntu';
                    $b_family ="'Ubuntu', sans-serif";
                    break;
                case 'georgia':
                    $font = '';
                    $b_family ="'Georgia', serif";
                    break;
                case 'arial':
                    $font = '';
                    $b_family ="'Arial', sans-serif";
                    break;
                case 'arbutus':
                    $font = 'http://fonts.googleapis.com/css?family=Arbutus+Slab';
                    $b_family ="'Arbutus Slab', serif";
                    break;
                case 'bitter':
                    $font = 'http://fonts.googleapis.com/css?family=Bitter';
                    $b_family ="'Bitter', serif";
                    break;
                case 'coustard':
                    $font = 'http://fonts.googleapis.com/css?family=Coustard';
                    $b_family ="'Coustard', serif";
                    break;
                case 'droid_serif':
                    $font = 'http://fonts.googleapis.com/css?family=Droid+Serif';
                    $b_family ="'Droid Serif', serif";
                    break;
                case 'eb':
                    $font = 'http://fonts.googleapis.com/css?family=EB+Garamond';
                    $b_family ="'EB Garamond', serif";
                    break;
                case 'goudy':
                    $font = 'http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911';
                    $b_family ="'Goudy Bookletter 1911', serif";
                    break;
                case 'kotta':
                    $font = 'http://fonts.googleapis.com/css?family=Kotta+One';
                    $b_family ="'Kotta One', serif";
                    break;
                case 'playfair':
                    $font = 'http://fonts.googleapis.com/css?family=Playfair+Display';
                    $b_family ="'Playfair Display', serif";
                    break;
                case 'vidaloka':
                    $font = 'http://fonts.googleapis.com/css?family=Vidaloka';
                    $b_family ="'Vidaloka', serif";
                    break;
                case 'pacifico':
                    $font = 'http://fonts.googleapis.com/css?family=Pacifico';
                    $b_family ="'Pacifico', cursive";
                    break;
                case 'dancing_script':
                    $font = 'http://fonts.googleapis.com/css?family=Dancing+Script';
                    $b_family ="'Dancing Script', cursive";
                    break;
                case 'gloria_hallelujah':
                    $font = 'http://fonts.googleapis.com/css?family=Gloria+Hallelujah';
                    $b_family ="'Gloria Hallelujah', cursive";
                    break;
                case 'satisfy':
                    $font = 'http://fonts.googleapis.com/css?family=Satisfy';
                    $b_family ="'Satisfy', cursive";
                    break;
                case 'bad_script':
                    $font = 'http://fonts.googleapis.com/css?family=Bad+Script';
                    $b_family ="'Bad Script', cursive";
                    break;
                case 'allura':
                    $font = 'http://fonts.googleapis.com/css?family=Allura';
                    $b_family ="'Allura', cursive";
                    break;
                default:
                    $font = 'http://fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $b_family = '"Gafata", sans-serif';
                    break;
            }
        }
        else
        {
            $output .= '
                    // Load Custom Fonts
                    @import url(http://fonts.googleapis.com/css?family=Roboto+Slab:400,700|Gafata|Lato:300,700);
                    @font-family-sans-serif:  "Gafata", sans-serif;
                    @font-family-serif:       "Roboto Slab", serif;';
        }

        if(!empty($h_font))
        {
            switch ($h_font) {
                case 'intro_inline':
                    $hand_font = '';
                    $h_family ='"Intro Inline"';
                    break;
                case 'great_vibes':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Great+Vibes&subset=latin,latin-ext';
                    $h_family ='"Great Vibes"';
                    break;
                case 'roboto':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $h_family ='"Roboto Slab", serif';
                    break;
                case 'cabin':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Cabin';
                    $h_family ='"Cabin", sans-serif';
                    break;
                case 'droid_sans':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Droid+Sans';
                    $h_family ="'Droid Sans', sans-serif";
                    break;
                case 'gafata':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $h_family = '"Gafata", sans-serif';
                    break;
                case 'oxygen':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Oxygen';
                    $h_family ="'Oxygen', sans-serif";
                    break;
                case 'philosopher':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Philosopher';
                    $h_family ="'Philosopher', sans-serif";
                    break;
                case 'questrial':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Questrial';
                    $h_family ="'Questrial', sans-serif";
                    break;
                case 'raleway':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Raleway:400,600,700,800,900,500,300,200,100';
                    $h_family ="'Raleway', sans-serif";
                    break;
                case 'signika':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Signika';
                    $h_family ="'Signika', sans-serif";
                    break;
                case 'ubuntu':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Ubuntu';
                    $h_family ="'Ubuntu', sans-serif";
                    break;
                case 'georgia':
                    $hand_font = '';
                    $h_family ="Georgia, serif";
                    break;
                case 'arial':
                    $hand_font = '';
                    $h_family ="Arial, sans-serif";
                    break;
                case 'arbutus':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Arbutus+Slab';
                    $h_family ="'Arbutus Slab', serif";
                    break;
                case 'bitter':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Bitter';
                    $h_family ="'Bitter', serif";
                    break;
                case 'coustard':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Coustard';
                    $h_family ="'Coustard', serif";
                    break;
                case 'droid_serif':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Droid+Serif';
                    $h_family ="'Droid Serif', serif";
                    break;
                case 'eb':
                    $hand_font = 'http://fonts.googleapis.com/css?family=EB+Garamond';
                    $h_family ="'EB Garamond', serif";
                    break;
                case 'goudy':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911';
                    $h_family ="'Goudy Bookletter 1911', serif";
                    break;
                case 'kotta':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Kotta+One';
                    $h_family ="'Kotta One', serif";
                    break;
                case 'playfair':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Playfair+Display';
                    $h_family ="'Playfair Display', serif";
                    break;
                case 'vidaloka':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Vidaloka';
                    $h_family ="'Vidaloka', serif";
                    break;
                case 'pacifico':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Pacifico';
                    $h_family ="'Pacifico', cursive";
                    break;
                case 'dancing_script':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Dancing+Script';
                    $h_family ="'Dancing Script', cursive";
                    break;
                case 'gloria_hallelujah':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Gloria+Hallelujah';
                    $h_family ="'Gloria Hallelujah', cursive";
                    break;
                case 'satisfy':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Satisfy';
                    $h_family ="'Satisfy', cursive";
                    break;
                case 'bad_script':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Bad+Script';
                    $h_family ="'Bad Script', cursive";
                    break;
                case 'allura':
                    $hand_font = 'http://fonts.googleapis.com/css?family=Allura';
                    $h_family ="'Allura', cursive";
                    break;
                default:
                    $hand_font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $h_family ='"Roboto Slab", serif';
                    break;
            }
        }

        if(!empty($titles_font))
        {
            switch ($titles_font) {
                case 'intro_inline':
                    $t_font = '';
                    $t_family ='"Intro Inline"';
                    break;
                case 'great_vibes':
                    $t_font = 'http://fonts.googleapis.com/css?family=Great+Vibes&subset=latin,latin-ext';
                    $t_family ='"Great Vibes"';
                    break;
                case 'roboto':
                    $t_font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $t_family ='"Roboto Slab", serif';
                    break;
                case 'cabin':
                    $t_font = 'http://fonts.googleapis.com/css?family=Cabin';
                    $t_family ='"Cabin", sans-serif';
                    break;
                case 'droid_sans':
                    $t_font = 'http://fonts.googleapis.com/css?family=Droid+Sans';
                    $t_family ="'Droid Sans', sans-serif";
                    break;
                case 'gafata':
                    $t_font = 'http://fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $t_family = '"Gafata", sans-serif';
                    break;
                case 'oxygen':
                    $t_font = 'http://fonts.googleapis.com/css?family=Oxygen';
                    $t_family ="'Oxygen', sans-serif";
                    break;
                case 'philosopher':
                    $t_font = 'http://fonts.googleapis.com/css?family=Philosopher';
                    $t_family ="'Philosopher', sans-serif";
                    break;
                case 'questrial':
                    $t_font = 'http://fonts.googleapis.com/css?family=Questrial';
                    $t_family ="'Questrial', sans-serif";
                    break;
                case 'raleway':
                    $t_font = 'http://fonts.googleapis.com/css?family=Raleway:400,600,700,800,900,500,300,200,100';
                    $t_family ="'Raleway', sans-serif";
                    break;
                case 'signika':
                    $t_font = 'http://fonts.googleapis.com/css?family=Signika';
                    $t_family ="'Signika', sans-serif";
                    break;
                case 'ubuntu':
                    $t_font = 'http://fonts.googleapis.com/css?family=Ubuntu';
                    $t_family ="'Ubuntu', sans-serif";
                    break;
                case 'georgia':
                    $t_font = '';
                    $t_family ="Georgia, serif";
                    break;
                case 'arial':
                    $t_font = '';
                    $t_family ="Arial, sans-serif";
                    break;
                case 'arbutus':
                    $t_font = 'http://fonts.googleapis.com/css?family=Arbutus+Slab';
                    $t_family ="'Arbutus Slab', serif";
                    break;
                case 'bitter':
                    $t_font = 'http://fonts.googleapis.com/css?family=Bitter';
                    $t_family ="'Bitter', serif";
                    break;
                case 'coustard':
                    $t_font = 'http://fonts.googleapis.com/css?family=Coustard';
                    $t_family ="'Coustard', serif";
                    break;
                case 'droid_serif':
                    $t_font = 'http://fonts.googleapis.com/css?family=Droid+Serif';
                    $t_family ="'Droid Serif', serif";
                    break;
                case 'eb':
                    $t_font = 'http://fonts.googleapis.com/css?family=EB+Garamond';
                    $t_family ="'EB Garamond', serif";
                    break;
                case 'goudy':
                    $t_font = 'http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911';
                    $t_family ="'Goudy Bookletter 1911', serif";
                    break;
                case 'kotta':
                    $t_font = 'http://fonts.googleapis.com/css?family=Kotta+One';
                    $t_family ="'Kotta One', serif";
                    break;
                case 'playfair':
                    $t_font = 'http://fonts.googleapis.com/css?family=Playfair+Display';
                    $t_family ="'Playfair Display', serif";
                    break;
                case 'vidaloka':
                    $t_font = 'http://fonts.googleapis.com/css?family=Vidaloka';
                    $t_family ="'Vidaloka', serif";
                    break;
                case 'pacifico':
                    $t_font = 'http://fonts.googleapis.com/css?family=Pacifico';
                    $t_family ="'Pacifico', cursive";
                    break;
                case 'dancing_script':
                    $t_font = 'http://fonts.googleapis.com/css?family=Dancing+Script';
                    $t_family ="'Dancing Script', cursive";
                    break;
                case 'gloria_hallelujah':
                    $t_font = 'http://fonts.googleapis.com/css?family=Gloria+Hallelujah';
                    $t_family ="'Gloria Hallelujah', cursive";
                    break;
                case 'satisfy':
                    $t_font = 'http://fonts.googleapis.com/css?family=Satisfy';
                    $t_family ="'Satisfy', cursive";
                    break;
                case 'bad_script':
                    $t_font = 'http://fonts.googleapis.com/css?family=Bad+Script';
                    $t_family ="'Bad Script', cursive";
                    break;
                case 'allura':
                    $t_font = 'http://fonts.googleapis.com/css?family=Allura';
                    $t_family ="'Allura', cursive";
                    break;
                default:
                    $t_font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $t_family ='"Roboto Slab", serif';
                    break;
            }
        }

        if(!empty($top_logo_font))
        {
            switch ($top_logo_font) {
                case 'intro_inline':
                    $top_font = '';
                    $top_family ='"Intro Inline"';
                    break;
                case 'great_vibes':
                    $top_font = 'http://fonts.googleapis.com/css?family=Great+Vibes&subset=latin,latin-ext';
                    $top_family ='"Great Vibes"';
                    break;
                case 'roboto':
                    $top_font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $top_family ='"Roboto Slab", serif';
                    break;
                case 'cabin':
                    $top_font = 'http://fonts.googleapis.com/css?family=Cabin';
                    $top_family ='"Cabin", sans-serif';
                    break;
                case 'droid_sans':
                    $top_font = 'http://fonts.googleapis.com/css?family=Droid+Sans';
                    $top_family ="'Droid Sans', sans-serif";
                    break;
                case 'gafata':
                    $top_font = 'http://fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $top_family = '"Gafata", sans-serif';
                    break;
                case 'oxygen':
                    $top_font = 'http://fonts.googleapis.com/css?family=Oxygen';
                    $top_family ="'Oxygen', sans-serif";
                    break;
                case 'philosopher':
                    $top_font = 'http://fonts.googleapis.com/css?family=Philosopher';
                    $top_family ="'Philosopher', sans-serif";
                    break;
                case 'questrial':
                    $top_font = 'http://fonts.googleapis.com/css?family=Questrial';
                    $top_family ="'Questrial', sans-serif";
                    break;
                case 'raleway':
                    $top_font = 'http://fonts.googleapis.com/css?family=Raleway:400,600,700,800,900,500,300,200,100';
                    $top_family ="'Raleway', sans-serif";
                    break;
                case 'signika':
                    $top_font = 'http://fonts.googleapis.com/css?family=Signika';
                    $top_family ="'Signika', sans-serif";
                    break;
                case 'ubuntu':
                    $top_font = 'http://fonts.googleapis.com/css?family=Ubuntu';
                    $top_family ="'Ubuntu', sans-serif";
                    break;
                case 'georgia':
                    $top_font = '';
                    $top_family ="Georgia, serif";
                    break;
                case 'arial':
                    $top_font = '';
                    $top_family ="Arial, sans-serif";
                    break;
                case 'arbutus':
                    $top_font = 'http://fonts.googleapis.com/css?family=Arbutus+Slab';
                    $top_family ="'Arbutus Slab', serif";
                    break;
                case 'bitter':
                    $top_font = 'http://fonts.googleapis.com/css?family=Bitter';
                    $top_family ="'Bitter', serif";
                    break;
                case 'coustard':
                    $top_font = 'http://fonts.googleapis.com/css?family=Coustard';
                    $top_family ="'Coustard', serif";
                    break;
                case 'droid_serif':
                    $top_font = 'http://fonts.googleapis.com/css?family=Droid+Serif';
                    $top_family ="'Droid Serif', serif";
                    break;
                case 'eb':
                    $top_font = 'http://fonts.googleapis.com/css?family=EB+Garamond';
                    $top_family ="'EB Garamond', serif";
                    break;
                case 'goudy':
                    $top_font = 'http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911';
                    $top_family ="'Goudy Bookletter 1911', serif";
                    break;
                case 'kotta':
                    $top_font = 'http://fonts.googleapis.com/css?family=Kotta+One';
                    $top_family ="'Kotta One', serif";
                    break;
                case 'playfair':
                    $top_font = 'http://fonts.googleapis.com/css?family=Playfair+Display';
                    $top_family ="'Playfair Display', serif";
                    break;
                case 'vidaloka':
                    $top_font = 'http://fonts.googleapis.com/css?family=Vidaloka';
                    $top_family ="'Vidaloka', serif";
                    break;
                case 'pacifico':
                    $top_font = 'http://fonts.googleapis.com/css?family=Pacifico';
                    $top_family ="'Pacifico', cursive";
                    break;
                case 'dancing_script':
                    $top_font = 'http://fonts.googleapis.com/css?family=Dancing+Script';
                    $top_family ="'Dancing Script', cursive";
                    break;
                case 'gloria_hallelujah':
                    $top_font = 'http://fonts.googleapis.com/css?family=Gloria+Hallelujah';
                    $top_family ="'Gloria Hallelujah', cursive";
                    break;
                case 'satisfy':
                    $top_font = 'http://fonts.googleapis.com/css?family=Satisfy';
                    $top_family ="'Satisfy', cursive";
                    break;
                case 'bad_script':
                    $top_font = 'http://fonts.googleapis.com/css?family=Bad+Script';
                    $top_family ="'Bad Script', cursive";
                    break;
                case 'allura':
                    $top_font = 'http://fonts.googleapis.com/css?family=Allura';
                    $top_family ="'Allura', cursive";
                    break;
                default:
                    $top_font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $top_family ='"Roboto Slab", serif';
                    break;
            }
        }

        if(!empty($bottom_logo_font))
        {
            switch ($bottom_logo_font) {
                case 'intro_inline':
                    $bottom_font = '';
                    $bottom_family ='"Intro Inline"';
                    break;
                case 'great_vibes':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Great+Vibes&subset=latin,latin-ext';
                    $bottom_family ='"Great Vibes"';
                    break;
                case 'roboto':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $bottom_family ='"Roboto Slab", serif';
                    break;
                case 'cabin':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Cabin';
                    $bottom_family ='"Cabin", sans-serif';
                    break;
                case 'droid_sans':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Droid+Sans';
                    $bottom_family ="'Droid Sans', sans-serif";
                    break;
                case 'gafata':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Gafata|Lato:300,700';
                    $bottom_family = '"Gafata", sans-serif';
                    break;
                case 'oxygen':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Oxygen';
                    $bottom_family ="'Oxygen', sans-serif";
                    break;
                case 'philosopher':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Philosopher';
                    $bottom_family ="'Philosopher', sans-serif";
                    break;
                case 'questrial':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Questrial';
                    $bottom_family ="'Questrial', sans-serif";
                    break;
                case 'raleway':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Raleway:400,600,700,800,900,500,300,200,100';
                    $bottom_family ="'Raleway', sans-serif";
                    break;
                case 'signika':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Signika';
                    $bottom_family ="'Signika', sans-serif";
                    break;
                case 'ubuntu':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Ubuntu';
                    $bottom_family ="'Ubuntu', sans-serif";
                    break;
                case 'georgia':
                    $bottom_font = '';
                    $bottom_family ="Georgia, serif";
                    break;
                case 'arial':
                    $bottom_font = '';
                    $bottom_family ="Arial, sans-serif";
                    break;
                case 'arbutus':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Arbutus+Slab';
                    $bottom_family ="'Arbutus Slab', serif";
                    break;
                case 'bitter':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Bitter';
                    $bottom_family ="'Bitter', serif";
                    break;
                case 'coustard':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Coustard';
                    $bottom_family ="'Coustard', serif";
                    break;
                case 'droid_serif':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Droid+Serif';
                    $bottom_family ="'Droid Serif', serif";
                    break;
                case 'eb':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=EB+Garamond';
                    $bottom_family ="'EB Garamond', serif";
                    break;
                case 'goudy':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Goudy+Bookletter+1911';
                    $bottom_family ="'Goudy Bookletter 1911', serif";
                    break;
                case 'kotta':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Kotta+One';
                    $bottom_family ="'Kotta One', serif";
                    break;
                case 'playfair':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Playfair+Display';
                    $bottom_family ="'Playfair Display', serif";
                    break;
                case 'vidaloka':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Vidaloka';
                    $bottom_family ="'Vidaloka', serif";
                    break;
                case 'pacifico':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Pacifico';
                    $bottom_family ="'Pacifico', cursive";
                    break;
                case 'dancing_script':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Dancing+Script';
                    $bottom_family ="'Dancing Script', cursive";
                    break;
                case 'gloria_hallelujah':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Gloria+Hallelujah';
                    $bottom_family ="'Gloria Hallelujah', cursive";
                    break;
                case 'satisfy':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Satisfy';
                    $bottom_family ="'Satisfy', cursive";
                    break;
                case 'bad_script':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Bad+Script';
                    $bottom_family ="'Bad Script', cursive";
                    break;
                case 'allura':
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Allura';
                    $bottom_family ="'Allura', cursive";
                    break;
                default:
                    $bottom_font = 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700';
                    $bottom_family ='"Roboto Slab", serif';
                    break;
            }
        }

        $fonts_array = array();
        if(!empty($font)){
            if(!in_array($font, $fonts_array)){
                $fonts_array[] = $font;
                $output .= '
                    @import url('.$font.');';
            }
            $output .= '
                    @body-font:  '.$b_family.';';
        }
        else{
            $output .= '
                    @body-font:  '.$b_family.';';
        }

        if(!empty($hand_font)){
            if(!in_array($hand_font, $fonts_array)){
                $fonts_array[] = $hand_font;
                $output .= '
                    @import url('.$hand_font.');';
            }
            $output .= '
                    @hand-font:  '.$h_family.';';
        }
        else{
            $output .= '
                    @hand-font:  '.$h_family.';';
        }

        if(!empty($t_font)){
            if(!in_array($t_font, $fonts_array)){
                $fonts_array[] = $t_font;
                $output .= '
                    @import url('.$t_font.');';
            }
            $output .= '
                    @titles-font:  '.$t_family.';';
        }
        else{
            $output .= '
                    @titles-font:  '.$t_family.';';
        }

        if(!empty($top_font)){
            if(!in_array($top_font, $fonts_array)){
                $fonts_array[] = $top_font;
                $output .= '
                    @import url('.$top_font.');';
            }
            $output .= '
                    @top_family:  '.$top_family.';';
        }
        else{
            $output .= '
                    @top_family:  '.$top_family.';';
        }

        if(!empty($bottom_font)){
            if(!in_array($bottom_font, $fonts_array)){
                $fonts_array[] = $bottom_font;
                $output .= '
                    @import url('.$bottom_font.');';
            }
            $output .= '
                    @bottom_family:  '.$bottom_family.';';
        }
        else{
            $output .= '
                    @bottom_family:  '.$bottom_family.';';
        }

        if($logo_letter_spacing!=''){
            $output .= '
                    @logo_letter_spacing:  '.$logo_letter_spacing.'px;';
        }

        $primary_color = $options[TF_THEME_PREFIX . '_highlight_color'];

        if(!empty($primary_color))
            $output .= '
                    @color: '.$primary_color.';';

        $directory = get_template_directory();
        //write new values in colors.less file
        file_put_contents($directory.'/colors.less', $output);

        if(file_exists($directory.'/less-compiler.php'))
        {
            include $directory.'/less-compiler.php';
            $less = new lessc;
            $new_css = $less->compileFile($directory.'/style.less');
            //tf_print($new_css);
            //if(!empty($new_css))
            file_put_contents($directory.'/style.css', $new_css);
        }

    }
    add_action('tfuse_admin_save_options', 'tfuse_theme_styles',10,2);
}

add_theme_support( 'automatic-feed-links' );


if (!function_exists('tfuse_get_upcoming_events')) :
    function tfuse_get_upcoming_events($items)
    {
        $final_events = array();
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'event'
        );
        $query = new WP_Query( $args );
        $posts = $query -> posts;

        if(!empty($posts))
        {
            $count = 0;
            $posts_with_content = array();
            foreach($posts as $post){
                $posts_with_content[$post->ID] = $post;
                $date = tfuse_page_options('event_date','',$post->ID);
                if(!empty($date))
                {
                    // repeat event
                    $repeat = tfuse_page_options('event_repeat','',$post->ID);
                    if($repeat != 'no')
                        $repeats[$post->ID] = tfuse_page_options('event_repeat','',$post->ID);

                    if($repeat == 'year')
                    {
                        $from = tfuse_page_options('event_date','',$post->ID);
                        $date = new DateTime($from);
                        $year = (int)$date->format('Y');
                        $month = $date->format('m');
                        $day = $date->format('d');
                        for($i=0;$i<10;$i++)
                        {
                            $permalink = get_permalink($post->ID);
                            $all[$count]['event_id'] = $post->ID;
                            $all[$count]['event_date'] = $year+$i.'-'.$month.'-'.$day;
                            if(strpos($permalink, "?") === false){
                                $permalink = $permalink.'?date='.$all[$count]['event_date'];
                            }
                            else{
                                $permalink = $permalink.'&date='.$all[$count]['event_date'];
                            }
                            $all[$count]['event_permalink'] = $permalink;
                            ++$count;
                        }
                    }
                    elseif($repeat == 'month')
                    {
                        $from = tfuse_page_options('event_date','',$post->ID);
                        $day = strtotime($from);
                        for($i=0;$i<10;$i++)
                        {
                            $to = strtotime(date("Y-m-d", $day) . " +".$i." month");
                            $all[$count]['event_id'] = $post->ID;
                            $all[$count]['event_date'] = date("Y-m-d", $to);
                            $permalink = get_permalink($post->ID);
                            if(strpos($permalink, "?") === false){
                                $permalink = $permalink.'?date='.$all[$count]['event_date'];
                            }
                            else{
                                $permalink = $permalink.'&date='.$all[$count]['event_date'];
                            }
                            $all[$count]['event_permalink'] = $permalink;
                            ++$count;
                        }
                    }
                    elseif($repeat == 'week')
                    {
                        $from = tfuse_page_options('event_date','',$post->ID);
                        $day = strtotime($from);
                        for($i=0;$i<53;$i++)
                        {
                            $to = strtotime(date("Y-m-d", $day) . " +".$i." weeks");
                            $all[$count]['event_id'] = $post->ID;
                            $all[$count]['event_date'] = date("Y-m-d", $to);
                            $permalink = get_permalink($post->ID);
                            if(strpos($permalink, "?") === false){
                                $permalink = $permalink.'?date='.$all[$count]['event_date'];
                            }
                            else{
                                $permalink = $permalink.'&date='.$all[$count]['event_date'];
                            }
                            $all[$count]['event_permalink'] = $permalink;
                            ++$count;
                        }
                    }
                    elseif($repeat == 'day')
                    {
                        $from = tfuse_page_options('event_date','',$post->ID);
                        $day = strtotime($from);
                        for($i=0;$i<365;$i++)
                        {
                            $to = strtotime(date("Y-m-d", $day) . " +".$i." days");
                            $all[$count]['event_id'] = $post->ID;
                            $all[$count]['event_date'] = date("Y-m-d", $to);
                            $permalink = get_permalink($post->ID);
                            if(strpos($permalink, "?") === false){
                                $permalink = $permalink.'?date='.$all[$count]['event_date'];
                            }
                            else{
                                $permalink = $permalink.'&date='.$all[$count]['event_date'];
                            }
                            $all[$count]['event_permalink'] = $permalink;
                            ++$count;
                        }
                    }
                    else
                    {
                        $all[$count]['event_id'] = $post->ID;
                        $all[$count]['event_date'] = tfuse_page_options('event_date','',$post->ID);
                        $permalink = get_permalink($post->ID);
                        if(strpos($permalink, "?") === false){
                            $permalink = $permalink.'?date='.$all[$count]['event_date'];
                        }
                        else{
                            $permalink = $permalink.'&date='.$all[$count]['event_date'];
                        }
                        $all[$count]['event_permalink'] = $permalink;
                        ++$count;
                    }
                }
            }
        }

        if(!empty($all)){
            $current_date = date("Y-m-d");
            $upcoming_events = array();
            $count = 0;
            $sorted = tfuse_aasort($all, 'event_date');
            foreach($sorted as $event){
                if($event['event_date'] > $current_date){
                    $upcoming_events[$count]['event_id'] = $event['event_id'];
                    $upcoming_events[$count]['event_date'] = $event['event_date'];
                    $upcoming_events[$count]['event_permalink'] = $event['event_permalink'];
                    ++$count;
                }
            }

            $items = (int)$items;
            $k=0;
            for($i=0; $i<$items; $i++){
                if($upcoming_events[$i]['event_id'] == null ) continue;
                $final_events[$k]['event_id'] = $upcoming_events[$i]['event_id'];
                $final_events[$k]['event_date'] = $upcoming_events[$i]['event_date'];
                $final_events[$k]['event_permalink'] = $upcoming_events[$i]['event_permalink'];
                $final_events[$k]['event_title'] = @$posts_with_content[ $upcoming_events[$i]['event_id'] ]->post_title;
                // get event excerpt
                if($posts_with_content[ $upcoming_events[$i]['event_id'] ]->post_excerpt != ''){
                    $final_events[$k]['event_excerpt'] = @$posts_with_content[ $upcoming_events[$i]['event_id'] ]->post_excerpt;
                }
                else{
                    $final_events[$k]['event_excerpt'] = @$posts_with_content[ $upcoming_events[$i]['event_id'] ]->post_content;
                }
                $k++;
            }
        }

        return $final_events;
    }
endif;