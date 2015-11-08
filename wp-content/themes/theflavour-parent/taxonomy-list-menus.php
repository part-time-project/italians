<?php
    get_header();
    $sidebar_position = tfuse_sidebar_position();
    tfuse_shortcode_content('top');
    get_template_part('menus','header');
    $currency_symbol = tfuse_options('currency_symbol','$');
    $symbol_position = tfuse_options('symbol_position','left');
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $term_id = $term->term_id;
    $child_terms = tfuse_get_menu_subcategories_terms($term_id);
    if( empty($child_terms) ){
        $child_terms[] = $term;
    }
    wp_register_script( 'scrollto', tfuse_get_file_uri('/js/scrollto.js'), array('jquery'), '1.0', true );
    wp_enqueue_script( 'scrollto' );
?>
<div id="main" class="site-main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <?php foreach($child_terms as $item){
                    $menu_type = tfuse_options('menu_type','1',$item->term_id);
                    $args = array(
                        'post_type'      => 'menu',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => $item->taxonomy,
                                'field' => 'slug',
                                'terms' => $item->slug
                            )
                        )
                    );
                    $postslist = get_posts( $args ); ?>
                    <section class="dishes <?php echo $item->slug; ?>" id="<?php echo $item->slug; ?>">
                        <h1 class="title">
                            <div class="ribbon">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns: xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 261.98 57.981" enable-background="new 0 0 261.98 57.981" xml:space="preserve" preserveAspectRatio="none">
                                    <g>
                                        <g>
                                            <path d="M36.638,7.173l8.318,50.808h172.071l8.318-50.808H36.638z M45.59,0H0.369l15.234,25.403L0,50.808h39.688
                                            L32.451,4.784L45.59,0z M246.377,25.403L261.611,0h-45.22l13.137,4.784l-7.235,46.023h39.686L246.377,25.403z"/>
                                        </g>
                                    </g>
                                    <span><?php echo $item->name; ?></span>
                                </svg>
                            </div>
                        </h1>
                        <ul>
                            <?php /* for show category with specific menu type */
                                if($menu_type=='1'){
                                    foreach($postslist as $post_item){
                                        tfuse_get_menus_listing($post_item->ID, $currency_symbol, $symbol_position);
                                    }
                                }
                                else{
                                    foreach($postslist as $post_item){
                                        tfuse_get_menus_listing2($post_item->ID, $currency_symbol, $symbol_position);
                                    }
                                }
                            ?>
                        </ul>
                    </section>
                <?php } ?>
            </div><!-- /.col-sm-8-->
        </div><!-- /.row-->
    </div><!-- /.container-->
</div><!-- /#main-->

<?php tfuse_shortcode_content('bottom'); ?>
<?php get_footer(); ?>