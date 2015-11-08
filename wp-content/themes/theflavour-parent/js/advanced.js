jQuery(document).ready(function() {
    var $ = jQuery;
    var options = new Array();

    options['the-flavour_page_title'] = jQuery('#the-flavour_page_title').val();
    jQuery('#the-flavour_page_title').bind('change', function() {
        options['the-flavour_page_title'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['the-flavour_homepage_category'] = jQuery('#the-flavour_homepage_category').val();
    jQuery('#the-flavour_homepage_category').bind('change', function() {
        options['the-flavour_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['the-flavour_blogpage_category'] = jQuery('#the-flavour_blogpage_category').val();
    jQuery('#the-flavour_blogpage_category').bind('change', function() {
        options['the-flavour_blogpage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['the-flavour_logo_type'] = jQuery('#the-flavour_logo_type').val();
    jQuery('#the-flavour_logo_type').bind('change', function() {
        options['the-flavour_logo_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    tfuse_toggle_options(options);

    function tfuse_toggle_options(options)
    {
        /* for custom title */
        if(options['the-flavour_page_title']=='custom_title'){
            jQuery('.the-flavour_custom_title, .the-flavour_before_title').show();
            jQuery('#the-flavour_custom_title, #the-flavour_before_title').parent().parent('.form-field').show();
        }
        else{
            jQuery('.the-flavour_custom_title, .the-flavour_before_title').hide();
            jQuery('#the-flavour_custom_title, #the-flavour_before_title').parent().parent('.form-field').hide();
        }

        /* for homepage */
        if(options['the-flavour_homepage_category']=='specific'){
            jQuery('.the-flavour_home_page, .the-flavour_use_page_options').hide();
            jQuery('.the-flavour_categories_select_categ').show();
            jQuery('#the-flavour_content_before_menu').closest('.postbox').show();
        }
        else if(options['the-flavour_homepage_category']=='page'){
            jQuery('.the-flavour_home_page, .the-flavour_use_page_options').show();
            jQuery('.the-flavour_categories_select_categ').hide();

            if(jQuery('#the-flavour_use_page_options').is(':checked')) jQuery('#the-flavour_content_before_menu').closest('.postbox').hide();
            jQuery('#the-flavour_use_page_options').live('change',function () {
                if(jQuery(this).is(':checked'))
                    jQuery('#the-flavour_content_before_menu').closest('.postbox').hide();
                else
                    jQuery('#the-flavour_content_before_menu').closest('.postbox').show();
            });
        }
        else{
            jQuery('.the-flavour_home_page, .the-flavour_use_page_options, .the-flavour_categories_select_categ').hide();
            jQuery('#the-flavour_content_before_menu').closest('.postbox').show();
        }

        /* for blog page */
        if(options['the-flavour_blogpage_category']=='specific'){
            jQuery('.the-flavour_categories_select_categ_blog').show();
        }
        else{
            jQuery('.the-flavour_categories_select_categ_blog').hide();
        }

        /* for logo type */
        if(options['the-flavour_logo_type']=='text'){
            jQuery('.the-flavour_logo_text, .the-flavour_logo_text_bottom').show();
            jQuery('.the-flavour_logo').hide();
        }
        else{
            jQuery('.the-flavour_logo_text, .the-flavour_logo_text_bottom').hide();
            jQuery('.the-flavour_logo').show();
        }

    }

});