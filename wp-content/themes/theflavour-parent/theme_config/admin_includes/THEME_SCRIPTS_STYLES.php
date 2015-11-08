<?php
/**
 * Include javascript and css files for dashboard
 *
 */

if ( ! function_exists( 'tfuse_add_admin_css' ) ) {
    /**
     * This function include files of css.
     */
    function tfuse_add_admin_css()
    {
        wp_register_style( 'custom_admin', tfuse_get_file_uri('/css/custom_admin.css') );
        wp_enqueue_style( 'custom_admin' );
    }
    add_action( 'admin_enqueue_scripts', 'tfuse_add_admin_css' );
}


if ( ! function_exists( 'tfuse_add_admin_js' ) ) {
    /**
     * This function include files of javascript.
     */
    function tfuse_add_admin_js()
    {
        wp_register_script( 'advanced', tfuse_get_file_uri('/js/advanced.js'), array('jquery'), '1.0', true );
        wp_enqueue_script( 'advanced' );
    }
    add_action( 'admin_enqueue_scripts', 'tfuse_add_admin_js' );
}