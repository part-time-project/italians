<?php
/**
 * Functions to select homepage category
 *
 * @since The Flavour 1.0
 */

if (!function_exists('tfuse_list_page_options')) :
    function tfuse_list_page_options() {
        $pages = get_pages();
        $result = array();
        $result[0] = 'Select a page';
        foreach ( $pages as $page ) {
            $result[ $page->ID ] = $page->post_title;
        }
        return $result;
    }
endif;


if (!function_exists('tfuse_list_portfolio_categories')) :
    function tfuse_list_portfolio_categories() {
        $args = array(
            'hide_empty'    => false,
        );

        $terms = get_terms('group', $args);
        $result = array();
        $result[0] = __('Select Gallery Category','tfuse');

        if(!empty($terms))
            foreach ( $terms as $term ) {
                if($term->parent == 0)
                    $result[$term->term_id] = $term->name;
            }
        return $result;
    }
endif;