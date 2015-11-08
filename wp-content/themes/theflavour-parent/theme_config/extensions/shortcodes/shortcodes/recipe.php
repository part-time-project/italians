<?php
/**
 * Recipe
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_recipe($atts, $content = null)
{
    extract( shortcode_atts(array('title' => '','description' => '','ingredients' => ''), $atts) );
    $out = '';
    $recipe_ingredients = explode("\n", $ingredients);

    if($title!='' || $description!='' || $content!=''){
        $out .= '<div class="recipe">';
        if($title!='') $out .= '<h1>'.$title.'</h1>';
        if($description!='') $out .= '<h2>'.$description.'</h2>';
        if(!empty($recipe_ingredients)) {
            $out .= '<h3>'.__('Ingredients','tfuse').'</h3>';
            $out .= '<ul>';
            foreach($recipe_ingredients as $item){
                if($item!='') $out .= '<li>'.$item.'</li>';
            }
            $out .= '</ul>';
        }
        if($content!='') $out .= '<h3>'.__('method','tfuse').'</h3>'.do_shortcode($content);
        $out .= '</div>';
    }

    return $out;
}

$atts = array(
    'name' => __('Recipe','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the recipe title','tfuse'),
            'id' => 'tf_shc_recipe_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Description','tfuse'),
            'desc' => __('Enter the recipe description','tfuse'),
            'id' => 'tf_shc_recipe_description',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Ingredients','tfuse'),
            'desc' => __('Specify the recipe ingredients, separate items with "enter"','tfuse'),
            'id' => 'tf_shc_recipe_ingredients',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Method','tfuse'),
            'desc' => __('Enter recipe method content','tfuse'),
            'id' => 'tf_shc_recipe_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('recipe', 'tfuse_recipe', $atts);