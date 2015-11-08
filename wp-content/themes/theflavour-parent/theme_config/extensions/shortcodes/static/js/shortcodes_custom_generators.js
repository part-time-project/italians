function custom_generator_banner_slider(type,options) {
    shortcode='[banner_slider title="'+options['title']+'" before_title="'+options['before_title']+'" target="'+options['target']+'"]';
    for(i in options.array) {
        shortcode+="[bslide image='"+options.array[i]["image"]+"' url='" + options.array[i]["url"] +"'"+"][/bslide]";
    }
    shortcode+='[/banner_slider]';
    return shortcode;
}

function custom_obtainer_banner_slider(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['target']= opt_get('tf_shc_banner_slider_target',cont);
    sh_options['title']= opt_get('tf_shc_banner_slider_title',cont);
    sh_options['before_title']= opt_get('tf_shc_banner_slider_before_title',cont);

    cont.find('[name="tf_shc_banner_slider_image"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        image=opt_get(jQuery(this).attr('name'),div);

        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_banner_slider_url"]').first().parents('.option');
        url=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_banner_slider_url"]').first().attr('name'),div);

        tmp={};
        tmp['url']=url;
        tmp['image']=image;
        sh_options['array'].push(tmp);
    });
    return sh_options;
}


function custom_generator_slideshow(type,options) {
    shortcode='[slideshow type_size="'+options['type_size']+'"]';
    for(i in options.array) {
        shortcode+="[slide type='"+options.array[i]["type"]+"' content='" + options.array[i]["content"] +"'"+"][/slide]";
    }
    shortcode+='[/slideshow]';
    return shortcode;
}

function custom_obtainer_slideshow(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['type_size']= opt_get('tf_shc_slideshow_type_size',cont);

    cont.find('[name="tf_shc_slideshow_type"]').each(function(i)
    {
        div=jQuery(this).parents('.option');
        type=opt_get(jQuery(this).attr('name'),div);

        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_slideshow_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_slideshow_content"]').first().attr('name'),div);

        tmp={};

        tmp['type']=type;
        tmp['content']=content;

        sh_options['array'].push(tmp);
    });

    return sh_options;
}


function custom_generator_faq(type,options) {
    var shortcode='[faq title="'+options.title+'"]';
    for(var i in options.array) {
        shortcode+='[faq_question]'+options.array[i]['question']+'[/faq_question]';
        shortcode+='[faq_answer]'+options.array[i]['answer']+'[/faq_answer]';
    }
    shortcode+='[/faq]';
    return shortcode;
}

function custom_obtainer_faq(data) {
    var cont=jQuery('.tf_shortcode_option:visible');
    var sh_options={};
    sh_options['array']=[];
    sh_options['title']=opt_get('tf_shc_faq_title',cont);
    cont.find('[name="tf_shc_faq_question"]').each(function(i) {
        var question=jQuery(this).val();
        var answer=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_faq_answer"]:first').val();
        var tmp={};
        tmp['question']=question;
        tmp['answer']=answer;
        sh_options['array'].push(tmp);
    });
    return sh_options;
}


function custom_generator_accordion(type,options) {
    shortcode='[accordion]';
    for(i in options.array) {
        shortcode+='[ac_tab title="'+options.array[i]['title']+'" class="'+options.array[i]['class']+'"]'+options.array[i]['content']+'[/ac_tab]';
    }
    shortcode+='[/accordion]';
    return shortcode;
}

function custom_obtainer_accordion(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    cont.find('[name="tf_shc_accordion_title"]').each(function(i) {
        div=jQuery(this).parents('.option');
        title=opt_get(jQuery(this).attr('name'),div);
        div1=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_accordion_class"]').first().parents('.option');
        _class=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_accordion_class"]').first().attr('name'),div1);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_accordion_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_accordion_content"]').first().attr('name'),div);
        tmp={};
        tmp['title']=title;
        tmp['class']=_class;
        tmp['content']=content;
        sh_options['array'].push(tmp);
    });
    return sh_options;
}


function custom_generator_tabs(type,options) {
    shortcode='[tabs class="'+options['class']+'" size="'+options['size']+'"]';
    for(i in options.array) {
        shortcode+='[tab active="'+options.array[i]['active']+'" title="'+options.array[i]['title']+'"]'+options.array[i]['content']+'[/tab]';
    }
    shortcode+='[/tabs]';
    return shortcode;
}

function custom_obtainer_tabs(data) {
    cont=jQuery('.tf_shortcode_option:visible');
    sh_options={};
    sh_options['array']=[];
    sh_options['class']= opt_get('tf_shc_tabs_class',cont);
    sh_options['size']= opt_get('tf_shc_tabs_size');
    cont.find('[name="tf_shc_tabs_title"]').each(function(i) {
        div=jQuery(this).parents('.option');
        title=opt_get(jQuery(this).attr('name'),div);
        div=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_content"]').first().parents('.option');
        content=opt_get(jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_content"]').first().attr('name'),div);
        active=jQuery(this).parents('.option').nextAll('.option').find('[name="tf_shc_tabs_active"] option:selected').val();
        tmp={};
        tmp['title']=title;
        tmp['active']=active;
        tmp['content']=content;
        sh_options['array'].push(tmp);
    })
    return sh_options;
}

jQuery(document).ready(function() {
    jQuery(document).delegate('#tf_shc_prettyPhoto_type','change',function () {
        val = jQuery(this).val();
        if(val != 'image')
            jQuery('.tf_shc_prettyPhoto_thumb').hide();
        else
            jQuery('.tf_shc_prettyPhoto_thumb').show();
    });

    jQuery(document).delegate('div[rel="gallery"] img','click',function () {
        jQuery('.tf_shc_gallery_posts').hide();
    });

    jQuery(document).delegate('#tf_shc_gallery_population','change',function () {
        val = jQuery(this).val();
        if(val != 'categories'){
            jQuery('.tf_shc_gallery_categories').hide();
            jQuery('.tf_shc_gallery_posts').show();
        }
        else{
            jQuery('.tf_shc_gallery_categories').show();
            jQuery('.tf_shc_gallery_posts').hide();
        }
    });

});