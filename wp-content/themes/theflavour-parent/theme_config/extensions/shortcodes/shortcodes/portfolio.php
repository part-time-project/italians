<?php

function tfuse_portfolio($atts)
{
    extract(shortcode_atts(array('category' => '', 'columns' => 'three-column'), $atts));
    wp_register_script( 'isotope', tfuse_get_file_uri('/js/isotope.pkgd.min.js'), array('jquery'), '1.0', true );
    wp_enqueue_script( 'isotope' );
    $output = '';

    if($category != 0)
    {
        $tax = 'group';
        $term = get_term_by('id', $category , $tax);
        $term_children = get_term_children( $category, $tax );
        $args = array(
            'posts_per_page' => -1,
	        'post_type' => 'portfolio',
	        'tax_query' => array(
		        array(
			        'taxonomy' => $tax,
			        'field' => 'id',
			        'terms' => $category
                )
            )
        );
        $query = new WP_Query( $args );
        $posts = $query->get_posts();

        if(!empty($term))
        {
            $output .= '<div class="shortcode-portfolio">';
            if(tfuse_options('enable_portfolio_filter', true)){
                $output .= '<div class="wrapp-categories-gallery">
                    <ul id="categories" class="gallery-categories">';
                    if(!empty($term_children)){
                        $output .= '<li class="categories-item active" data-category="'.$term->slug.'"><div class="check-category"><span></span></div>'.$term->name.'</li>';
                        foreach ($term_children as $id) {
                            $term_child = get_term_by('id', $id , $tax);
                            $output .= '<li class="categories-item" data-category="'.$term_child->slug.'"><div class="check-category"><span></span></div>'.$term_child->name.'</li>';
                        }
                    }
                    $output .= '</ul>
                    <a class="prev" id="categories-prev" href="#"><i class="tficon-shevron-left"></i></a>
                    <a class="next" id="categories-next" href="#"><i class="tficon-shevron-right"></i></a>
                </div>';
            }

            $output .= '<section class="gallery">'.''.'
                <ul id="gallery-list" class="gallery-list '.$columns.'">';
                    if(!empty($posts)){
                        foreach ($posts as $post) {
                            $output .= '<li class="gallery-item" data-category="'.tfuse_get_portfolio_categories_list($post->ID).'">
                                <div class="gallery-img">'.tfuse_get_portfolio_thumbnail($post->ID, $columns).'</div>
                                '.tfuse_get_portfolio_gallery($post->ID).'
                            </li>';
                        }
                    }
                $output .= '</ul>';
            $output .= '</section></div>';
		}
    }
    
    return $output;
}

$atts = array(
    'name' => __('Portfolio', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Category', 'tfuse'),
            'desc' => __('Select Parent portfolio Category','tfuse'),
            'id' => 'tf_shc_portfolio_category',
            'value' => '',
            'options' => tfuse_list_portfolio_categories(),
            'type' => 'select',
        ),
        array(
            'name' => __('Columns', 'tfuse'),
            'desc' => __('Select the number of columns','tfuse'),
            'id' => 'tf_shc_portfolio_columns',
            'value' => 'three-column',
            'options' => array(
                'two-column' => __('Two Columns','tfuse'),
                'three-column' => __('Three Columns','tfuse'),
                'four-column' => __('Four Columns','tfuse')
            ),
            'type' => 'select',
        ),

    )
);

tf_add_shortcode('portfolio', 'tfuse_portfolio', $atts);