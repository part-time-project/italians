<?php
/**
 * Generate theme menu
 *
 * @since The Flavour 1.0
 */

global $menus;

// -----------------------------------------------
register_nav_menus(array(
    'primary' => __('Primary Navigation', 'tfuse'),
    'secondary' => __('Secondary Navigation', 'tfuse'),
    'footer' => __('Footer Navigation', 'tfuse'),
));

if (!function_exists('tfuse_load_megamenu_walker'))
{
    function tfuse_load_megamenu_walker()
    {
        global $TFUSE;
        $TFUSE->load->ext_helper('MEGAMENU', 'TF_MENU_WALKER');
        $TFUSE->load->ext_helper('MEGAMENU', 'TF_MEGAMENU_OPTHELP');

    }
}
tfuse_load_megamenu_walker();

$menus = array(
    'primary' => array(
        'depth' => 4,
        'container'       => 'nav',
        'container_id' => 'site-navigation',
        'container_class' => 'site-navigation left',
        'menu_class' => 'nav-menu clearfix',
        'theme_location' => 'primary',
        'fallback_cb' => 'tfuse_select_menu_msg',
        'link_before'     => '',
        'link_after'      => ''
    ),
    'secondary' => array(
        'depth' => 4,
        'container'       => 'nav',
        'container_id' => 'site-navigation2',
        'container_class' => 'site-navigation right',
        'menu_class' => 'nav-menu clearfix',
        'theme_location' => 'secondary',
        'fallback_cb' => 'tfuse_select_menu_msg',
        'link_before'     => '',
        'link_after'      => ''
    ),
    'footer' => array(
        'depth' => 1,
        'container'       => 'nav',
        'container_id' => 'site-navigation3',
        'container_class' => 'site-navigation',
        'menu_class' => '',
        'theme_location' => 'footer',
        'fallback_cb' => '',
        'link_before'     => '',
        'link_after'      => ''
    )
);

$disabled_extensions = apply_filters('tfuse_get_disabled_extensions', null);
if (!in_array('megamenu', $disabled_extensions)) {
    $menus['primary']['walker'] = new TF_FRONT_END_MENU_WALKER();
    $menus['secondary']['walker'] = new TF_FRONT_END_MENU_WALKER();
}

// -----------------------------------------------
function tfuse_menu($menu_type) {
    global $menus;
    if (isset($menus[$menu_type])) {
        wp_nav_menu($menus[$menu_type]);
    }
}

function tfuse_select_menu_msg()
{
    echo '<div class="topmenu"><p style="color:#ffffff;">Please go to the <a href="' . admin_url('nav-menus.php') . '" target="_blanck">Menu</a> section, create a  menu and then select the newly created menu from the Theme Locations box from the left.</p></div>';    
}
