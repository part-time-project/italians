<?php

add_theme_support( 'post-thumbnails');


add_action( 'init', 'tfuse_remove_thumbnail_support' );
function tfuse_remove_thumbnail_support() {
	remove_post_type_support( 'page', 'thumbnail' );
}

add_image_size( 'post-thumb1', 260, 390, true );
add_image_size( 'post-thumb2', 254, 224, true );


if (!function_exists('tfuse_aasort')) :
    /**
     * To override tfuse_aasort() in a child theme, add your own tfuse_aasort()
     * to your child theme's file.
    */
    function tfuse_aasort ($array, $key) {
        $sorter=array();
        $ret=array();
        if (!$array){$array = array();}
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        return $ret;
    }
endif;


if (!function_exists('tfuse_rewrite_worpress_reading_options')):

    /**
     * To override tfuse_rewrite_worpress_reading_options() in a child theme, add your own tfuse_rewrite_worpress_reading_options()
     * to your child theme's file.
    */

    function tfuse_rewrite_worpress_reading_options ($options)
    {
        if($options[TF_THEME_PREFIX . '_homepage_category'] == 'page')
        {
            update_option('show_on_front', 'page');

            if(get_post_type(intval($options[TF_THEME_PREFIX . '_home_page'])) == 'page')
            {
                update_option('page_on_front', intval($options[TF_THEME_PREFIX . '_home_page']));
            }

            if(get_post_type(intval($options[TF_THEME_PREFIX . '_blog_page'])) == 'page')
            {
                update_option('page_for_posts', intval($options[TF_THEME_PREFIX . '_blog_page']));
            }
            else
            {
                update_option('page_for_posts', 0);
            }
        }
        else
        {
            update_option('show_on_front', 'posts');
            update_option('page_on_front', 0);
            update_option('page_for_posts', 0);
        }
    }
    add_action('tfuse_admin_save_options','tfuse_rewrite_worpress_reading_options', 10, 1);
endif;


if (!function_exists('tfuse_get_instagram_photos')):
    function tfuse_get_instagram_photos($username, $items = 9) {
        if ( false === ( $instagram = get_transient( 'instagram-photos-' . sanitize_title_with_dashes( $username ) . '-'.$items ) ) ) {
            $connect = wp_remote_get( 'http://instagram.com/' . trim( $username ) );

            if ( is_wp_error( $connect ) ) {
                return new WP_Error( 'site_down', __( 'Unable to communicate with Instagram.', 'tf' ) );
            }

            if ( 200 != wp_remote_retrieve_response_code( $connect ) ) {
                return new WP_Error( 'invalid_response', __( 'Instagram did not return a 200.', 'tf' ) );
            }

            $shared_data     = explode( 'window._sharedData = ', $connect['body'] );
            $instagram_json  = explode( ';</script>', $shared_data[1] );
            $instagram_array = json_decode( $instagram_json[0], true );

            if ( ! $instagram_array ) {
                return new WP_Error( 'bad_json', __( 'Instagram has returned invalid data.', 'tf' ) );
            }

            // attention on this array !
            if(isset($instagram_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'])) {
                $images = $instagram_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
            }
            else{
                return;
            }

            $instagram = array();
            $count     = 0;
            foreach ( $images as $image ) {
                if ( !$image['is_video']) {
                    $instagram[] = array(
                        'code'        => $image['code'],
                        'link'        => $image['display_src'],
                        'likes'       => $image['likes']['count'],
                    );
                    $count ++;
                }
                if ( $count == $items ) {
                    break;
                }
            }

            $instagram = base64_encode( serialize( $instagram ) );
            set_transient( 'instagram-photos-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
        }
        $instagram = unserialize( base64_decode( $instagram ) );

        return array_slice( $instagram, 0, $items );
    }
endif;


if (!function_exists('tfuse_archive_events')) :
    function tfuse_archive_events()
    {
        global $q_config;

        if( isset( $_POST['lang'] ) && !empty( $_POST['lang'] ) ) {
            $q_config['language'] = $_POST['lang'];
        }

        $cat_ID = (intval($_POST['id']));
        $hour = $end_hour = $repeat = $date = '';
        $args = array(
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'events',
                    'field' => 'id',
                    'terms' => $cat_ID
                )
            )
        );
        $query = new WP_Query( $args );
        $posts = $query -> posts;

        if(!empty($posts))
        {
            $all = $dates = $hours = $repeats = $titles = $links = array();
            $count = 0;
            foreach($posts as $post){
                $date = tfuse_page_options('event_date','',$post->ID);
                if(!empty($date))
                {
                    $event_hour = tfuse_page_options('event_hour_min', false, $post->ID);
                    $end_event_hour = tfuse_page_options('end_hour_min', false, $post->ID);
                    if(!empty($event_hour))
                        $hour .= $event_hour['hour'].':'.$event_hour['minute'].' '.$event_hour['time'];

                    if(!empty($end_event_hour))
                        $end_hour .= ' - '.$end_event_hour['hour'].':'.$end_event_hour['minute'].' '.$end_event_hour['time'];
                    else $end_hour = '';

                    //repeat event
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
                            $dates[$year+$i.'-'.$month.'-'.$day][][$hour.$end_hour] = $permalink.','.get_the_title($post->ID);
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
                            $dates[date("Y-m-d", $to)][][$hour.$end_hour] = $permalink.','.get_the_title($post->ID);
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
                            $dates[date("Y-m-d", $to)][][$hour.$end_hour] = $permalink.','.get_the_title($post->ID);
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
                            $dates[date("Y-m-d", $to)][][$hour.$end_hour] = $permalink.','.get_the_title($post->ID);
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
                        $dates[tfuse_page_options('event_date','',$post->ID)][][$hour.$end_hour] = $permalink.','.get_the_title($post->ID);
                        ++$count;
                    }
                    $hour = $end_hour = "";
                }
            }
            $response = array('date'=>$dates,'repeat'=>$repeats);
            $response = json_encode( $response);
            echo $response;
            die();
        }
        else
        {
            echo '';
            die();
        }
    }
    add_action('wp_ajax_tfuse_archive_events','tfuse_archive_events');
    add_action('wp_ajax_nopriv_tfuse_archive_events','tfuse_archive_events');
endif;


if(!function_exists('tf_is_real_post_save')){
    /**
     * This function is used in 'post_updated' action
     *
     * @param $post_id
     * @return bool
     */
    function tf_is_real_post_save($post_id)
    {
        return !(
            wp_is_post_revision($post_id)
            || wp_is_post_autosave($post_id)
            || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            || (defined('DOING_AJAX') && DOING_AJAX)
        );
    }
}


if (!function_exists('tfuse_find_hour')) :
    function tfuse_find_hour($post_id)
    {
        global $TFUSE;

        if (!tf_is_real_post_save($post_id)) {
            return;
        }

        $time = array(
            'hour'   => $TFUSE->request->post(TF_THEME_PREFIX.'_event_hour'),
            'minute' => $TFUSE->request->post(TF_THEME_PREFIX.'_event_minute'),
            'time'   => $TFUSE->request->post(TF_THEME_PREFIX.'_event_time'),
        );
        tfuse_set_page_option('event_hour_min', $time, $post_id);

        $endtime = array(
            'hour'   => $TFUSE->request->post(TF_THEME_PREFIX.'_event_hour_end'),
            'minute' => $TFUSE->request->post(TF_THEME_PREFIX.'_event_minute_end'),
            'time'   => $TFUSE->request->post(TF_THEME_PREFIX.'_event_time_end'),
        );
        tfuse_set_page_option('end_hour_min', $endtime, $post_id);
    }
    add_action( 'save_post_event', 'tfuse_find_hour' );
endif;


if (!function_exists('tfuse_save_special_events')) :
    function tfuse_save_special_events($post_id)
    {
        global $TFUSE;
        if (!tf_is_real_post_save($post_id)) {
            return;
        }

        $meta_value = $TFUSE->request->post(TF_THEME_PREFIX.'_event_special');
        update_post_meta($post_id, 'special_event', $meta_value, false);
    }
    add_action( 'save_post_event', 'tfuse_save_special_events' );
endif;