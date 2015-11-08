<!doctype html>
<!--[if lt IE 8 ]><html lang="en" class="ie7"><![endif]-->
<!--[if IE 8 ]><html lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" <?php language_attributes(); ?>><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php
        if(tfuse_options('disable_tfuse_seo_tab')) {
            wp_title( '|', true, 'right' );
            bloginfo( 'name' );
            $site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
        } else wp_title(''); ?>
    </title>
    <?php tfuse_meta(); ?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php
        tfuse_head();
        wp_head();
    ?>
</head>
<body <?php body_class(); ?> >
<div id="page" class="hfeed site">
    <header>
        <div class="nav-main <?php tfuse_menu_class(); ?>" id="nav-main" >
            <div class="container">
                <div class="row">
                    <?php tfuse_get_menu('center'); ?>
                </div>
            </div>
        </div>
    </header>
    <?php
        global $is_tf_blog_page;
        if($is_tf_blog_page) tfuse_category_on_blog_page();
    ?>