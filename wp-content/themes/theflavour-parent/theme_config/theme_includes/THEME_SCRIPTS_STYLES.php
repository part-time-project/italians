<?php

add_action( 'wp_enqueue_scripts', 'tfuse_add_css' );
add_action( 'wp_enqueue_scripts', 'tfuse_add_js' );

if ( ! function_exists( 'tfuse_add_css' ) ) :
/**
 * This function include files of css.
*/
    function tfuse_add_css()
    {
        wp_register_style( 'bootstrap', tfuse_get_file_uri('/css/bootstrap.css'), array(), false );
        wp_enqueue_style( 'bootstrap' );

        wp_register_style( 'font-awesome', tfuse_get_file_uri('/css/font-awesome.css') );
        wp_enqueue_style( 'font-awesome' );

        wp_register_style( 'style.css', tfuse_get_file_uri('/style.css'), array(), false );
        wp_enqueue_style( 'style.css' );

        wp_register_style( 'fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,800,700italic,800italic,300italic');
        wp_enqueue_style( 'fonts' );

        wp_register_style( 'prettyPhoto', tfuse_get_file_uri('/css/prettyPhoto.css'), false, '' );
        wp_enqueue_style( 'prettyPhoto' );

        wp_register_style( 'animate', tfuse_get_file_uri('/css/animate.css'), array(), false );
        wp_enqueue_style( 'animate' );

        wp_register_style( 'cusel.css', tfuse_get_file_uri('/css/cusel.css'), array(), false );
        wp_enqueue_style( 'cusel.css' );

        wp_register_style( 'custom', tfuse_get_file_uri('/custom.css'), array(), false );
        wp_enqueue_style( 'custom' );
	}
endif;


if ( ! function_exists( 'tfuse_add_js' ) ) :
/**
 * This function include files of javascript.
*/
    function tfuse_add_js()
    {
        wp_enqueue_script( 'jquery' );

        wp_register_script( 'jquery-ui', tfuse_get_file_uri('/js/lib/jquery-ui.min.js'), array('jquery'), '1.10.4', false );
        wp_enqueue_script( 'jquery-ui' );

        wp_register_script( 'bootstrap', tfuse_get_file_uri('/js/lib/bootstrap.min.js'), array('jquery'), '3.1.0', false );
        wp_enqueue_script( 'bootstrap' );

        wp_register_script( 'prettyPhoto', TFUSE_ADMIN_JS . '/jquery.prettyPhoto.js', array('jquery'), '3.1.4', false );
        wp_enqueue_script( 'prettyPhoto' );

        // general.js can be overridden in a child theme by copying it in child theme's js folder
        wp_register_script( 'general', tfuse_get_file_uri('/js/general.js'), array('jquery'), '2.0', false );
        wp_enqueue_script( 'general' );
		wp_localize_script( 'general', 'TfPhpVars', array(
			'home' => __('Home', 'tfuse'),
		) );

        wp_register_script( 'events',  tfuse_get_file_uri('/js/events.js'), array('jquery'), '', true );
        wp_enqueue_script( 'events' );
        if( function_exists('qtrans_getLanguage') ){
            wp_localize_script('events', 'tf_qtrans_lang', array(
                'lang' => qtrans_getLanguage()
            ));
        }

        wp_register_script( 'slicknav', tfuse_get_file_uri('/js/jquery.slicknav.min.js'), array('jquery'), '1.0', true );
        wp_enqueue_script( 'slicknav' );

        wp_register_script( 'modernizr', tfuse_get_file_uri('/js/lib/modernizr.min.js'));
        wp_enqueue_script( 'modernizr' );

        wp_register_script( 'html5shiv', tfuse_get_file_uri('/js/lib/html5shiv.js'));
        wp_enqueue_script( 'html5shiv' );

        wp_register_script( 'respond', tfuse_get_file_uri('/js/lib/respond.min.js'));
        wp_enqueue_script( 'respond' );

        wp_register_script( 'carouFredSel', tfuse_get_file_uri('/js/jquery.carouFredSel-6.2.1.js'), array('jquery'), '6.2.1', true );
        wp_enqueue_script( 'carouFredSel' );

        wp_register_script( 'cusel-min', tfuse_get_file_uri('/js/cusel.min.js'), array('jquery'), '3.0', true );
        wp_enqueue_script( 'cusel-min' );

        wp_register_script( 'parallax', tfuse_get_file_uri('/js/parallax.js'), array('jquery'), '1.1.3', true );
        wp_enqueue_script( 'parallax' );

        wp_register_script( 'scrollto', tfuse_get_file_uri('/js/scrollto.js'), array('jquery'), '1.0', true );
        wp_enqueue_script( 'scrollto' );

        if(!is_admin()){
            do_action('tf_scripts_added');
        }
    }
endif;