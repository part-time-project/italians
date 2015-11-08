<?php

if ( ! defined( 'TFUSE' )) {
    exit( 'Direct access forbidden.' );
}

if ( ! function_exists( 'tf_is_plugin_active_for_network' )) {
    function tf_is_plugin_active_for_network( $plugin )
    {
        if ( ! is_multisite()) {
            return false;
        }

        $plugins = get_site_option( 'active_sitewide_plugins' );
        if (isset( $plugins[$plugin] )) {
            return true;
        }

        return false;
    }
}

if ( ! function_exists( 'tf_is_plugin_active' )) {
    function tf_is_plugin_active( $plugin )
    {
        return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || tf_is_plugin_active_for_network(
            $plugin
        );
    }
}

if ( ! function_exists( 'tf_table_exists' )) {
    // Check if the desired table exists, in case it exists return true, in other case return false
    function tf_table_exists( $table_name, $wp_prefix = true )
    {
        global $wpdb;

        if ($wp_prefix) {
            $table_name = $wpdb->prefix.$table_name;
        }

        $tables_list = $wpdb->get_results( $wpdb->prepare( "SHOW TABLES LIKE %s", $table_name ) );

        if (( ! is_wp_error( $tables_list ) OR ( ! is_null( $tables_list ) ) ) AND count( $tables_list ) > 0) {
            return true;
        }

        return false;
    }
}

if ( ! function_exists( 'tf_table_isEmpty' )) {
    // Check if the desired table is not empty, in case it is empty return 0, in other case return number of rows
    function tf_table_isEmpty( $table_name, $wp_prefix = true )
    {
        global $wpdb;

        if ($wp_prefix) {
            $table_name = $wpdb->prefix.$table_name;
        }

        $number = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );

        return (int) $number;
    }
}

function tfwpml_save_admin_options( $value, $option )
{
    if (( $option['type'] == 'upload' ) OR ( $option['type'] == 'text' ) OR ( $option['type'] == 'textarea' )) {
        icl_register_string( 'ThemeFuse', $option['id'], $value );
    }
}

function tfwpml_save_sldier_options( $value, $option )
{
    icl_register_string( 'ThemeFuse', $option, $value );
}

function tfwpml_get_admin_options( $value, $option )
{
    $translation = false;
    if (function_exists( 'icl_t' )) {
        $translation = icl_t( 'ThemeFuse', $option, $value );
    }

    if ( ! $translation) {
        return $value;
    }

    return $translation;
}

function tfwpml_addFROM_table( $current_string = '', $tables_list = array(), $prefix = true )
{
    global $wpdb;

    if (( ! is_array( $tables_list ) ) OR ( empty( $tables_list ) )) {
        return $current_string;
    }

    $string = '';

    for ($i = 0; $i < count( $tables_list ); $i++) {
        $string .= ( $prefix ) ? $wpdb->prefix.$tables_list[$i] : $tables_list[$i];

        if ($i < count( $tables_list ) - 1) {
            $string .= ', ';
        }

    }

    if (( is_string( $current_string ) ) AND $current_string != '') {
        $string .= ', '.$current_string;
    }

    return $string;
}

function tfwpml_add_tables_for_seek( $current_string )
{
    return tfwpml_addFROM_table( $current_string, array( 'icl_translations AS ilc_trans' ) );
}

function tfwpml_add_where_for_seek( $current_string )
{
    $lang      = substr( get_locale(), 0, 2 );
    $post_type = TF_SEEK_HELPER::get_post_type();
    $where     = "AND p.ID = ilc_trans.element_id AND ilc_trans.element_type = 'post_".$post_type."' AND ilc_trans.language_code = '".$lang."' ";

    return $current_string.$where;
}

function tfwpml_addWPML_search_params( $languages )
{
    $search_link = '';

    foreach ($_GET as $key => $item) {
        if ($key != 's') {
            $search_link .= '&'.$key.'='.$item;
        }
    }

    foreach ($languages as $code => $language) {
        $languages[$code]['url'] .= $search_link;
    }

    return $languages;
}

function tfwpml_tf_group_duplicate( $id, $language, $post_array, $new_post )
{
    global $wpdb;

    $query = "SELECT ID FROM $wpdb->posts ".
             "WHERE post_type = 'tfuse_gallery_group' AND post_name LIKE '%_$id%'";

    $ids = wp_list_pluck( $wpdb->get_results( $query ), 'ID' );

    if (empty( $ids )) {
        return;
    }

    foreach ($ids as $id) {
        $post        = get_post( $id );
        $attachments = get_posts(
            array(
                'post_type'      => 'attachment',
                'post_parent'    => $post->ID,
                'posts_per_page' => -1,
                'post_status'    => 'any'
            )
        );

        if (empty( $attachments )) {
            continue;
        }

        $post = (array) $post;
        unset( $post['ID'] );
        unset( $post['guid'] );
        unset( $post['post_date'] );
        unset( $post['post_date_gmt'] );
        unset( $post['post_modified'] );
        unset( $post['post_modified_gmt'] );
        $post['post_name'] = preg_replace( '/(.*)_[0-9]*$/', '$1_'.$new_post, $post['post_name'] );

        $new_id = wp_insert_post( $post );

        if ( ! $new_id) {
            continue;
        }

        foreach ($attachments as $attachment) {
            $new_attachment                = (array) $attachment;
            $new_attachment['post_parent'] = $new_id;
            unset( $new_attachment['ID'] );
            unset( $new_attachment['post_date'] );
            unset( $new_attachment['post_date_gmt'] );
            unset( $new_attachment['post_modified'] );
            unset( $new_attachment['post_modified_gmt'] );
            $new_att_id = wp_insert_post( $new_attachment );

            if ( ! $new_att_id) {
                continue;
            }

            add_post_meta( $new_att_id, 'tfwpml_real_attachment', $attachment->ID );

            $post_meta_infos = $wpdb->get_results(
                "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$attachment->ID"
            );

            if (count( $post_meta_infos ) != 0) {
                $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
                foreach ($post_meta_infos as $meta_info) {
                    $meta_key        = $meta_info->meta_key;
                    $meta_value      = addslashes( $meta_info->meta_value );
                    $sql_query_sel[] = "SELECT $new_att_id, '$meta_key', '$meta_value'";
                }
                $sql_query .= implode( " UNION ALL ", $sql_query_sel );
                $wpdb->query( $sql_query );
            }
        }

    }
}

function tfwpml_get_fake_attachments( $post_id )
{
    /**
     * @var wpdb $wpdb
     */
    global $wpdb;

    $ids   = array();
    $posts = wp_list_pluck(
        $wpdb->get_results(
            "SELECT post_id ID FROM $wpdb->postmeta WHERE meta_key='tfwpml_real_attachment' AND meta_value=$post_id",
            ARRAY_A
        ),
        'ID',
        'ID'
    );

    foreach ($posts as $post) {
        $ids[(int) $post] = (int) $post;
        foreach (tfwpml_get_fake_attachments( $post ) as $children) {
            $ids[(int) $children] = (int) $children;
        }
    }

    return $ids;
}

function tfwpml_remove_attachments( $post_id, $exclude = -1 )
{
    $posts = tfwpml_get_fake_attachments( $post_id );
    $posts[$post_id] = $post_id;

    if (isset( $posts[(int) $exclude] )) {
        unset( $posts[(int) $exclude] );
    }

    foreach ($posts as $post) {
        wp_delete_attachment( $post, true );
    }

}


function tfwpml_get_real_attachment( $post_id )
{
    $parent = (int) get_post_meta( $post_id, 'tfwpml_real_attachment', true );

    if ( ! $parent) {
        return $post_id;
    }

    return tfwpml_get_real_attachment( $parent );
}

function tfwpml_delete_attachment( $post_id )
{
    remove_action( 'delete_attachment', 'tfwpml_delete_attachment', 10 );
    tfwpml_remove_attachments( tfwpml_get_real_attachment( $post_id ), $post_id );
    add_action( 'delete_attachment', 'tfwpml_delete_attachment' );
}

add_action( 'icl_make_duplicate', 'tfwpml_tf_group_duplicate', 1, 4 );
add_action( 'delete_attachment', 'tfwpml_delete_attachment', 10, 1 );

if (( tf_is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) )
    AND ( ( tf_table_exists( 'icl_translations' ) OR ( tf_table_isEmpty( 'icl_translations' ) > 0 ) ) )
) {
    add_filter( 'get_search_sql_from', 'tfwpml_add_tables_for_seek' );
    add_filter( 'get_search_sql_where', 'tfwpml_add_where_for_seek' );
    add_filter( 'icl_ls_languages', 'tfwpml_addWPML_search_params' );
}

if (( tf_is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) AND ( tf_is_plugin_active(
        'wpml-string-translation/plugin.php'
    ) )
) {
    add_filter( 'admin_text_value', 'tfwpml_save_admin_options', 10, 2 );
    add_filter( 'tfuse_options_value', 'tfwpml_get_admin_options', 10, 2 );

    add_filter( 'tfuse_slider_value', 'tfwpml_save_sldier_options', 10, 2 );
    add_filter( 'tfuse_sldier_value', 'tfwpml_get_admin_options', 10, 2 );
}
