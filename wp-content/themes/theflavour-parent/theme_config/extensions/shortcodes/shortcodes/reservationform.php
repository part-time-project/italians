<?php
function tf_reservationform_shortcode($atts){
    global $TFUSE;
    $template_directory = get_template_directory_uri();
    wp_enqueue_script('jquery');
    wp_register_script( 'reservation_forms_js', $template_directory.'/js/reservation_frontend.js', array('jquery'), '1.1.0', true );
    wp_enqueue_script( 'reservation_forms_js' );
    wp_enqueue_script('jquery-form');
	wp_register_style( 'jquery_css',TFUSE_ADMIN_CSS.'/jquery-ui-1.8.14.custom.css');
	wp_enqueue_style( 'jquery_css' );
    wp_register_style( 'reservation_forms_css', $template_directory.'/theme_config/extensions/reservationform/static/css/reservation_form.css', true, '1.1.0' );
    wp_enqueue_style( 'reservation_forms_css' );
    extract(shortcode_atts(array('tf_rf_formid' => '-1'), $atts));
    $out='';
    $form_exists=false;
	$is_preview=false;
    if($tf_rf_formid!='-1'){
        $is_preview=false;
        $form = get_term_by('id',$tf_rf_formid,'reservations');
        $form_exists = (is_object($form) && count($form) > 0)?true :false;
        $form = unserialize($form->description);

    } elseif($TFUSE->request->COOKIE('res_form_array')){
        $is_preview=true;
        $form_exists=true;
        $form = unserialize($TFUSE->request->COOKIE('res_form_array'));
        $TFUSE->request->COOKIE('form_array',null);
    }
    if($form_exists){
        $out .='<div class="container reservation-container">';
        if($form['header_message']!='') $out .='<h3 id="header_message">'.__(urldecode($form['header_message']),'tfuse').'</h3>';
        $inputs = $TFUSE->get->ext_config('RESERVATIONFORM', 'base');
        $input_array = $inputs['input_types'];
        $out.='<form id="reservationForm" action="#" method="post" class="reservationForm" name="reservationForm"><div class="row">';
        $out.='<input id="this_form_id" type="hidden" value="'. $tf_rf_formid.'" />';

        $fcount = 1;
        $linewidth = 0;
        $earr=array();
        $linenr = 1;
        $lines=array();
        $countForm = count($form['input']);
        $dimension=25;
        $lines[$linenr] = 0;

        $line1=array();
        $line2=array();
        foreach($form['input'] as $form_input_arr1){
            if( isset($form_input_arr1['column']) && $form_input_arr1['column']==1) $line2[]=$form_input_arr1;
            else $line1[]=$form_input_arr1;
        }
        if(isset($line2[0])) $line2[0]['newline']=1;
        $colmuns=array_merge($line1,$line2);

        foreach($colmuns as $form_input_arr){
            $earr[$fcount]['width'] = $form_input_arr['width'];
            $linewidth += $form_input_arr['width'];

            if (isset($form_input_arr['newline']) && $form_input_arr['newline']==1) {
                $linewidth = $form_input_arr['width'];
                $earr[$fcount]['class'] = ' ';
                if ($fcount>1) {$linenr++;
                    $lines[$linenr] = 0;}
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
                $lines[$linenr]=0;
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

        $text_type=array();
        $email_type = array();
        foreach($input_array as $input){
            if($input['name'] == 'Text line'){
                $text_type = $input;
            }
            if($input['name'] == 'Email'){
                $email_type = $input;
            }
            if(!empty($text_type) && !empty($email_type)) break;
        }
        $input_array['date_in'] = $text_type;
        $input_array['date_out'] = $text_type;
        $input_array['res_email'] = $email_type;

        $linewidth = 0;
        $fcount = 1;
        $margin=25;
        $out_left = '<div class="col-lg-3 col-lg-offset-1 col-md-4 col-sm-7 col-xs-10 left-colum">';
        $out_right = '<div class="col-md-7 col-xs-12 right-colum">';
        foreach($colmuns as $form_input){
            $input = array();
            if(isset($input_array[$form_input['type']]))
            $input=$input_array[$form_input['type']];
            if(isset($input['properties'])){
                $proprstr='';
                foreach($input['properties'] as $key=>$value){
                    $proprstr .=$key."=".$value." ";
                }
            }
            $floating=(isset($form_input['newline']) )?'clear:left;':' ';
            if (!isset($input['properties']['class']))
                $input['properties']['class'] = '';
            $input['properties']['class'] .=(isset($input['name']) && $input['name']=='Email')?' '.TF_THEME_PREFIX.'_email':'';
            $input['properties']['class'] .=(isset($form_input['required']))?' tf_rf_required_input ':'';
            $label_text =(isset($form_input['required']))?trim(urldecode($form_input['label'])).' '.urldecode($form['required_text']):trim(urldecode($form_input['label']));
            $input['id']=(isset($input['id']))?str_replace('%%name%%',urldecode($form_input['shortcode']),$input['id']):TF_THEME_PREFIX.'_'.urldecode($form_input['shortcode']);

            $form_input['classes'] = $earr[$fcount]['class'];
            $form_input['floating'] = $floating;
            $form_input['label_text'] = $label_text;
            $label='<label for="' .TF_THEME_PREFIX."_".trim(urldecode($form_input['shortcode'])). '">'.urldecode($label_text).'</label><br/>';

            if($is_preview)
                $sidebar_position = 'full';
            else
                $sidebar_position = tfuse_sidebar_position();

            $element_line = $earr[$fcount]['line'];

            if ($sidebar_position == 'full' || $form['position']=='before_content')
            {
                if($is_preview){
                    $ewidth=590-$lines[$element_line]+$margin;
                }
                else{
                    if(isset($form_input["column"]) && $form_input["column"]=='0'){
                        // special for left column
                        $margin_leftc=12;
                        $line_left=($lines[$element_line] / 25)*$margin_leftc;
                        $ewidth=216-$line_left+$margin_leftc;
                    }
                    else{
                        $ewidth=616-$lines[$element_line]+$margin;
                    }
                }
            }
            else {
                if(isset($form_input["column"]) && $form_input["column"]=='0'){
                    // special for left column
                    $margin_leftc=12;
                    $line_left=($lines[$element_line] / 25)*$margin_leftc;
                    $ewidth=144-$line_left+$margin_leftc;
                }
                else{
                    $ewidth=380-$lines[$element_line]+$margin;
                }
            }

            if (isset($form_input['newline']) && $form_input['newline'] == 1){
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

            // for single element in next line
            if($lines[$element_line]==$dimension && $form_input['width']>=40 && $form_input['width']<=90){
                $form_input['ewidthpx'] = (int)(($ewidth-$dimension)*$form_input['width']/100);
            }
            elseif($lines[$element_line]==$dimension && $form_input['width']<40 && $form_input['width']>32){
                $form_input['ewidthpx'] = (int)(($ewidth-2*$dimension)*$form_input['width']/100);
            }
            elseif($lines[$element_line]==$dimension && $form_input['width']<33){
                $form_input['ewidthpx'] = (int)(($ewidth-3*$dimension)*$form_input['width']/100);
            }

            $fcount++;
            if(in_array($form_input['type'],array('date_in','date_out')))
                $input['type'] = 'res_datepicker';
            elseif($form_input['type'] == 9)
                $input['type'] = 'res_text';
            else $input['type'] = 'res_'.$input['type'];

            if(!function_exists($input['type']))
                continue;

            $input_field=$input['type']($input,$form_input);
            if($input['type']=='checkbox'){
                $tmp=$label;
                $label=$input_field;
                $input_field=$tmp;
            }

            if(isset($form_input["column"]) && $form_input["column"]=='1') $out_right .=$input_field;
            else $out_left .= $input_field;
        }

        $out_left .= '</div>';
        $out_right .= '<div class="clear"></div><div class="reservation_submit">
            <span id="send_form">
                <input class="btn-submit" type="submit" id="submit" name="submit" value="'. __(urldecode($form['submit_mess']),'tfuse').'">
            </span>';
            if($form['reset_button']!='') $out_right .= '<a onclick="resetFields(this,event)" href="#" class="link-reset">'.__(urldecode($form['reset_button']),'tfuse').'</a>';
            $out_right .= '<span id="sending" style="display: none;">
                <input class="btn-submit" type="submit" id="submit" name="submit" value="'.__('Sending ...','tfuse').'">
            </span>
        </div>
        </div>';

        $out .= $out_left.$out_right;
        $out .='</div></form> <div id="form_messages" class="submit_message" ></div> </div>';
    } else {
        $out=__("<p>This Form is not defined !</p>","tfuse");
    }
    return $out;
}
$forms_name=array(-1=>'Choose Form');
$forms_term = get_terms('reservations', array('hide_empty' => 0));
$forms=array();
foreach ($forms_term as $key => $form) {
    $forms[$form->term_id] = unserialize($form->description);
}
if(!empty($forms)){
    foreach($forms as $key=>$value){
        $forms_name[$key]=urldecode($value['form_name']);
    }
}
$atts = array(
    'name' => __('Reservation Form','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Select the form','tfuse'),
            'id' => 'tf_rf_formid',
            'value' => '',
            'options' => $forms_name,
            'type' => 'select'
        )
    )
);

tf_add_shortcode('tfuse_reservationform', 'tf_reservationform_shortcode', $atts);
function res_text($input,$form_input){
    if($form_input['label_text']=='') $form_input['label_text'] = '&nbsp';
    return "<div class='row field_text pull-left ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px; ".$form_input['floating']."'>
            <label class='label_title'>".__($form_input['label_text'],'tfuse')."</label><br>
            <input type='text' style='width:".$form_input['ewidthpx']."px;' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'. trim($form_input['shortcode'])."' value='' />
        </div>";
}
function res_textarea($input,$form_input){
    return "<div class='row field_textarea pull-left' style='width:".($form_input['ewidthpx'])."px; ".$form_input['floating']."'>
        <label class='label_title'>".__($form_input['label_text'],'tfuse')."</label><br>
        <textarea style='width:".$form_input['ewidthpx']."px;' class='textareaField ".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."' rows='10' value=''></textarea>
    </div>";
}
function res_radio($input,$form_input){
    $checked='checked="checked"';
    $output="<div class='row alignleft input_styled inlinelist ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px;".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'>".__($form_input['label_text'],'tfuse')."</label><br>";

    if(is_array($form_input['options'])){
        foreach ($form_input['options'] as $key => $option) {
            $output .= '<div class="rowRadio"><input '.$checked.' id="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '_'.$key.'"  type="radio" name="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '"  value="' .$option. '" /><label class="radiolabel" for="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '_'.$key.'">' . __(urldecode($option),'tfuse') . '</label></div>';
            $checked='';
        }
    }
    $output .= "</div>";
    return $output;
}
function res_datepicker($input,$form_input){
    $datepickers_classes = array('date_in' => ' tfuse_rf_post_datepicker_in', 'date_out' => ' tfuse_rf_post_datepicker_out');
    $input['properties']['class'] .= $datepickers_classes[$form_input['type']];
    $input['properties']['class'] .=  ' tf_rf_required_input ';
    $output="<div class='row field_text pull-left ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px; ".$form_input['floating']."'>
        <label class='label_title'>".__($form_input['label_text'],'tfuse')."</label><br>
        <input style='width:".($form_input['ewidthpx'])."px;' type='text' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'. trim($form_input['shortcode'])."' /></div>";
    return $output;
}
function res_checkbox($input,$form_input){
    $checked = ($input['value'] == 'true') ? 'checked="checked"' : '';
    $output = "<div class='row input_styled alignleft checklist ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px;".$form_input['floating']."'>
                <div class='rowCheckbox'><input class='".$input['properties']['class']."' style='width:15px; float:left;' type='checkbox' name='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' id='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' value='".__($form_input['label'],'tfuse')."'" . $checked . "/></div>
                <label class='labelchecked label_title' for='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "'>".__($form_input['label_text'],'tfuse')."</label><br>
            </div>";
    return $output;
}
function res_captcha($input,$form_input){
    $input['properties']['class']="tfuse_captcha_input";
    $out="<div class='row field_text pull-left captcha ' style='".$form_input['floating']."'>
            <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'>".__($form_input['label_text'],'tfuse')."</label><br>
            <img  src='".TFUSE_EXT_URI."/contactform/library/".$input['file_name']."?form_id=".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."&ver=".rand(0, 15)."' class='tfuse_captcha_img' >
            <input type='button' class='tfuse_captcha_reload' /><br>
            <input style='width:".$form_input['ewidthpx']."px;' id='".trim($input['id'])."' type='text' class='inputtext ".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."' />
         </div>";
    return $out;
}
function res_select($input,$form_input){
    if($form_input['label_text']=='') $form_input['label_text'] = '&nbsp';
    $input['properties']['class'].=' tfuse_option';
    $out = "<div class='row field_select pull-left ".$form_input['classes']."' style='width:".($form_input['ewidthpx'])."px; ".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "'>".__($form_input['label_text'],'tfuse')."</label><br>
                <select style='width:".($form_input['ewidthpx'])."px !important;' class='inputselect ".$input['properties']['class']."' name='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' id='" .trim($input['id']). "'>";
    if(is_array($form_input['options'])){
        foreach ($form_input['options'] as $key => $option) {
            $option_val = str_replace(' ', '_', urldecode($option));
            $option_val = str_replace(':', '_', urldecode($option));
            $out .= "<option value='" . $option_val . "'>";
            $out .= __(urldecode($option),'tfuse');
            $out .= "</option>\r\n";
        }
    }
    $out .= '</select></div>';
    return $out;
}