<?php
function tf_contactform_shortcode($atts){
    global $TFUSE;
    wp_register_script( 'contact_forms_js', get_template_directory_uri().'/js/contact_forms.js', array('jquery'), '1.1.0', true );
    wp_enqueue_script( 'contact_forms_js' );
    wp_enqueue_script('jquery-form');
    wp_enqueue_script('jquery');
    wp_register_style( 'contact_forms_css', get_template_directory_uri().'/theme_config/extensions/contactform/static/css/contact_form.css', true, '1.1.0' );
    wp_enqueue_style( 'contact_forms_css' );
    extract(shortcode_atts(array('tf_cf_formid' => '-1'), $atts));
    $out = '';
    $form_exists = false;
    $is_preview = false;
    if($tf_cf_formid!='-1'){
        $is_preview = false;
        $forms = get_option(TF_THEME_PREFIX . '_tfuse_contact_forms');
        if(isset($forms[$tf_cf_formid])){
            $form_exists = true;
            $form = $forms[$tf_cf_formid];
        }
    } elseif($TFUSE->request->COOKIE('form_array')){
        $form_exists = true;
        $is_preview = true;
        $form = unserialize($TFUSE->request->COOKIE('form_array'));
        $TFUSE->request->COOKIE('form_array',null);
    }

    if($form_exists){
        $out.='<div class="contact-form col-md-10 col-md-offset-1">';
        if($form['header_message'] != '') $out .='<h3 id="header_message" class="add-comment-title">'.urldecode($form['header_message']).'</h3>';
        $inputs = $TFUSE->get->ext_config('CONTACTFORM', 'base');
        $input_array = $inputs['input_types'];

        if($TFUSE->request->isset_POST('submit')){
            $TFUSE->ext->contactform->sendSmtp($tf_cf_formid);
        }
        $out.='<div id="form_messages" class="submit_message"></div><form id="contactForm" action="" method="post" class="ajax_form contactForm" name="contactForm">';
        $out.='<input id="this_form_id" type="hidden" value="'. $tf_cf_formid.'" />';

        $fields = '';
        $fcount = 1;
        $linewidth = 0;
        $earr = array();
        $linenr = 1;
        $countForm = count($form['input']);
        $dimension = 20;
        $lines = array();
        $lines[$linenr] = 0;

        foreach($form['input'] as $form_input_arr){
            $earr[$fcount]['width'] = $form_input_arr['width'];
            $linewidth += $form_input_arr['width'];

            if (isset($form_input_arr['newline'])) {
                $linewidth = $form_input_arr['width'];
                $earr[$fcount]['class'] = ' ';
                if ($fcount>1) {
                    $linenr++;
                    $lines[$linenr] = 0;
                }
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
            }
            elseif ($linewidth>100) {
                $linewidth = $form_input_arr['width'];
                $linenr++;
                $lines[$linenr] = 0;
                $earr[($fcount-1)]['class'] = ' omega ';
                $earr[$fcount]['class'] = ' ';
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
            }
            elseif($linewidth==100) {
                $linewidth = 0;
                $earr[$fcount]['class'] = ' omega ';
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
                $linenr++;
                $lines[$linenr] = 0;
            }
            else {
                $earr[$fcount]['class'] = ' ';
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
            }

            if ($countForm==$fcount && !isset($form_input_arr['newline'])) {
                $earr[$fcount]['class'] = ' omega ';
            }

            $fcount++;
        }

        $linewidth = 0;
        $fcount = 1;
        $margin = 20;
        foreach($form['input'] as $form_input){
            $field = $field_m = '';
            $input = $input_array[$form_input['type']];
            $floating = (isset($form_input['newline']))?'clear:left;':'';

            if (!isset($input['properties']['class']))
                $input['properties']['class'] = '';
            $input['properties']['class'] .=($input['name']=='Email')?' '.TF_THEME_PREFIX.'_email':'';
            $input['properties']['class'] .=(isset($form_input['required']) && $form_input['required'])?' tf_cf_required_input ':'';
            $label_text =(isset($form_input['required']) && $form_input['required'])?trim($form_input['label']).' '.$form['required_text']:trim($form_input['label']);
            $input['id']=str_replace('%%name%%',strtolower(str_ireplace(' ','_',$form_input['shortcode'])),$input['id']);

            $form_input['classes'] = $earr[$fcount]['class'];
            $form_input['floating'] = $floating;
            $form_input['label_text'] = $label_text;

            if($is_preview)
                $sidebar_position = 'full';
            else
                $sidebar_position = tfuse_sidebar_position();

            if (isset($form_input['newline']) ) $field_m .= '<div class="clear"></div>';

            $element_line = $earr[$fcount]['line'];

            if ($sidebar_position == 'full'){
                if($is_preview)
                    $ewidth = 560-$lines[$element_line]+$margin;
                else
                    $ewidth = 920-$lines[$element_line]+$margin;
            }
            else{
                $ewidth = 594-$lines[$element_line]+$margin;
            }

            if (isset($form_input['newline'])){
                $linewidth = $form_input['width'];
            }
            else $linewidth += $form_input['width'];


            if ($form_input['width']==100)
            {
                $form_input['ewidthpx'] = $ewidth;
                $linewidth = 0;
            }
            elseif ($linewidth>100 )
            {
                $form_input['ewidthpx'] = (int)($ewidth*$form_input['width']/100);
                $linewidth = 0;
            }
            else
            {
                $form_input['ewidthpx'] = (int)($ewidth*$form_input['width']/100);
            }


            if($lines[$element_line]==$dimension && $form_input['width']>=40 && $form_input['width']<=90){
                $form_input['ewidthpx'] = (int)(($ewidth-$dimension)*$form_input['width']/100);
            }
            elseif($lines[$element_line]==$dimension && $form_input['width']<40 && $form_input['width']>32){
                $form_input['ewidthpx'] = (int)(($ewidth-2*$dimension)*$form_input['width']/100);
            }
            elseif($lines[$element_line]==$dimension && $form_input['width']<33){
                $form_input['ewidthpx'] = (int)(($ewidth-3*$dimension)*$form_input['width']/100);
            }

            $input_field=$input['type']($input,$form_input);

            if(stripos('[input]',$form['form_template'])!==false){
            } else {
                $field_m .= $input_field;
            }

            if (trim($earr[$fcount]['class'])=='omega' ) $field_m .= '<div class="clear"></div>';

            $field .= $field_m;
            $fields .= $field;
            $fcount++;
        }

        $out .= $fields;
        $surse = get_template_directory_uri().'/images/loading.gif';
        $out .= '<div class="clear"></div><div class="submit-form clearfix" style="width:100%">';
        $out .= '<button name="submit" class="btn-submit" id="submit" type="submit">'. $form['submit_mess'].'</button>';
        $out .= '<button class="sending" id="submit" style="display: none;" type="submit">'.__('Sending ...','tfuse').'</button>';
        if($form['reset_button']!='') $out .= '<a class="link-reset" href="#" onclick="resetFields(this,event)">'.urldecode($form['reset_button']).'</a>';
        $out .= '<img id="sending_img" src="'.$surse.'" alt="Sending" style="margin-bottom:-10px; display: none; border:0;" /></div>
        </form></div><div class="clear"></div>';
    } else {
        $out="<p>".__('This Form is not defined !', 'tfuse')."</p>";
    }
    return $out;
}

$forms_name=array(-1=>'Choose Form');
$forms = get_option(TF_THEME_PREFIX . '_tfuse_contact_forms');
if(!empty($forms)){
    foreach($forms as $key=>$value){
        $forms_name[$key]=$value['form_name'];
    }
}
$atts = array(
    'name' => __('Contact Form', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Type', 'tfuse'),
            'desc' => __('Select the form', 'tfuse'),
            'id' => 'tf_cf_formid',
            'value' => '',
            'options' => $forms_name,
            'type' => 'select'
        )
    )
);

tf_add_shortcode('tfuse_contactform', 'tf_contactform_shortcode', $atts);
function text($input,$form_input){
    return "<div class='form-field_text pull-left ".$form_input['classes']."' style='".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'>".$form_input['label_text']."</label>
                <input type='text' style='width:".$form_input['ewidthpx']."px;' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'. trim($form_input['shortcode'])."'/>
            </div>";
}
function textarea($input,$form_input){
    return "<div class='form-field_textarea' style='".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'>".$form_input['label_text']."</label>
                <textarea style='width:".($form_input['ewidthpx'])."px;' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."' rows='10' ></textarea>
            </div>";
}
function radio($input,$form_input){
    $checked='checked="checked"';
    $output="<div class='form-field_text pull-left field_radiobox input_styled ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px;".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'>".$form_input['label_text']."</label>";

    if(is_array($form_input['options'])){
        foreach ($form_input['options'] as $key => $option) {
            $output .= '<div class="multicheckbox"><input '.$checked.' id="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '_'.$key.'"  type="radio" name="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '"  value="' .$option. '" /><label class="radiolabel" for="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '_'.$key.'">' . $option . '</label></div>';
            $checked='';
        }
    }

    $output .= "</div>";
    return $output;
}
function checkbox($input,$form_input){
    $checked = ($input['value'] == 'true') ? 'checked="checked"' : '';
    $output = "<div class='form-field_text pull-left field_checkbox input_styled ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px;".$form_input['floating']."'>
                <input class='".$input['properties']['class']."' style='width:15px;' type='checkbox' name='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' id='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' value='".$form_input['label']."'" . $checked . "/>
                <label for='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "'>".$form_input['label_text']."</label>
            </div>";
    return $output;
}
function captcha($input,$form_input){
    $input['properties']['class']="tfuse_captcha_input";
    $out="<div class='form-field_text pull-left' style='width:".$form_input['width']."%;".$form_input['floating']."'>
            <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'>".$form_input['label_text']."</label>
            <img  src='".TFUSE_EXT_URI."/contactform/library/".$input['file_name']."?form_id=".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."&ver=".rand(0, 15)."' class='tfuse_captcha_img' >
            <input type='button' class='tfuse_captcha_reload' />
            <input style='width:".$form_input['ewidthpx']."px;' id='".trim($input['id'])."' type='text' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."' />
         </div>";
    return $out;
}
function select($input,$form_input){
    $input['properties']['class'].=' tfuse_option';
    $out = "<div class='form-field_text field_select pull-left ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px; ".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "'>".$form_input['label_text']."</label>
                <span class='select_row_up'></span>
                <select style='width:".($form_input['ewidthpx'])."px;' class='inputselect ".$input['properties']['class']."' name='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' id='" .trim($input['id']). "'>";
    if(is_array($form_input['options'])){
        foreach ($form_input['options'] as $key => $option) {
            $out .= "<option value='" . str_replace(' ', '_', $option) . "'>";
            $out .= urldecode($option);
            $out .= "</option>\r\n";
        }
    }
    $out .= '</select><span class="select_row_down"></span></div>';
    return $out;
}