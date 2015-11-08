<?php
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $term_id = $term->term_id;
    $header_bg = tfuse_options('header_image',tfuse_options('header_image','',$term->parent),$term_id);
    $child_terms = tfuse_get_menu_subcategories_terms($term_id);
    $subcategories_list = '';
    if(!empty($child_terms)){
        foreach($child_terms as $item){
            $subcategories_list .= '<li class="categories-item ">
                <a href="#'.$item->slug.'" class="anchor-scroll"><img src="'.tfuse_options('category_icon','',$item->term_id).'"><br><br>'.$item->name.'</a>
            </li>';
        }
    }
?>
<section class="main-top">
    <div class="main-slider">
        <div class="wrap-main-slider" style="background-image:url(<?php echo $header_bg; ?>);">
            <div class="main-slider-content">
                <h1 class="main-slider-title"><?php echo $term->name; ?></h1>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="categories-slider menu-slider">
                                <div class="caroufredsel_wrapper">
                                    <ul id="categories-slider">
                                        <?php echo $subcategories_list; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="prev" id="categories-prev" href="#"><i class="tficon-shevron-left"></i></a>
        <a class="next" id="categories-next" href="#"><i class="tficon-shevron-right"></i></a>
    </div>
</section>