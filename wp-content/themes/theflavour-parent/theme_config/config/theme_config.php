<?php
/**
 * Generate theme details
 */

$theme_info = wp_get_theme(null, WP_CONTENT_DIR . '/themes/');
if ( is_child_theme() )
    $cfg['theme_version'] = $theme_info->parent()->display('Version');
else
    $cfg['theme_version'] = $theme_info->display('Version');

$cfg['mods_version'] = '1.0.8';
$cfg['theme_name'] = 'The Flavour';
$cfg['prefix'] = sanitize_title($cfg['theme_name']);
$cfg['author_name'] = 'ThemeFuse';
$cfg['theme_author'] = '<a target="_blank" href="http://themefuse.com">ThemeFuse</a> - ';
$cfg['forum_url'] = 'http://support.themefuse.com/hc/en-us/requests/new';
$cfg['manual_url'] = 'http://docs.themefuse.com/?article=the-flavour';

$cfg['disabled_extensions'] = array();

$cfg['screen_options']['nav-menus'] = array('add-post','add-post_tag');

$cfg['install_options']['tax'] = array($cfg['prefix'] . '_homepage_category', 'categories_select');
$cfg['install_options']['pos'] = array('posts_select');