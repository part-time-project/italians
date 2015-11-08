<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for admin area. */
/* ----------------------------------------------------------------------------------- */

$directory = get_template_directory_uri();

$options = array(
    'tabs' => array(
        array(
            'name' => __('General','tfuse'),
            'type' => 'tab',
            'id' => TF_THEME_PREFIX . '_general',
            'headings' => array(
                array(
                    'name' => __('General Settings','tfuse'),
                    'options' => array(/* 1 */
                        // Select logo type
                        array('name' => __('Select Logo Type','tfuse'),
                            'desc' => __('Select the type of logo','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_type',
                            'value' => 'text',
                            'options' => array(
                                'text' => __('Text','tfuse'),
                                'image' => __('Image','tfuse'),
                            ),
                            'type' => 'select',
                        ),
                        // Top Text Logo
                        array(
                            'name' => __('Top Logo Text','tfuse'),
                            'desc' => __('Enter top logo text. Is posible to use "i" and "span" tags','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_text',
                            'value' => 'The',
                            'type' => 'text'
                        ),
                        // Bottom Text Logo
                        array(
                            'name' => __('Bottom Logo Text','tfuse'),
                            'desc' => __('Enter top logo text. Is posible to use "i" and "span" tags','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_text_bottom',
                            'value' => 'Flavour',
                            'type' => 'text'
                        ),
                        // Custom Logo Option
                        array(
                            'name' => __('Custom Logo','tfuse'),
                            'desc' => __('Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo',
                            'value' => '',
                            'type' => 'upload',
                        ),
                        // Select logo position
                        array('name' => __('Select Logo Position','tfuse'),
                            'desc' => __('Select the position of logo. Atention if you set center position you must set primary and secondary menu, else only primary','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_position',
                            'value' => 'center',
                            'options' => array(
                                'left' => __('Left','tfuse'),
                                'center' => __('Center','tfuse'),
                                'right' => __('Right','tfuse'),
                            ),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Custom Favicon Option
                        array(
                            'name' => __('Custom Favicon <br /> (16px x 16px)','tfuse'),
                            'desc' => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_favicon',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        // Select Navigation Type
                        array('name' => __('Select Navigation Type','tfuse'),
                            'desc' => __('Select the type of navigation','tfuse'),
                            'id' => TF_THEME_PREFIX . '_site_menu_type',
                            'value' => 'simple',
                            'options' => array(
                                'simple' => __('Simple Menu','tfuse'),
                                'sticky' => __('Sticky Menu','tfuse'),
                            ),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Search Box Text
                        array(
                            'name' => __('Search Box text','tfuse'),
                            'desc' => __('Enter your Search Box text','tfuse'),
                            'id' => TF_THEME_PREFIX . '_search_box_text',
                            'value' => 'enter keywords',
                            'type' => 'text',
                            'divider' => true
                        ),
                         // Change default avatar
                        array(
                            'name' => __('Default Avatar','tfuse'),
                            'desc' => __('For users without a custom avatar of their own, you can either display a generic logo or a generated one based on their e-mail address.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_default_avatar',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        // Tracking Code Option
                        array(
                            'name' => __('Tracking Code','tfuse'),
                            'desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_google_analytics',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Custom CSS Option
                        array(
                            'name' => __('Custom CSS','tfuse'),
                            'desc' => __('Quickly add some CSS to your theme by adding it to this block.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_css',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    ) /* E1 */
                ),
                array(
                    'name' => __('RSS Settings','tfuse'),
                    'options' => array(
                        // RSS URL Options
                        array('name' => __('RSS URL','tfuse'),
                            'desc' => __('Enter your preferred RSS URL. (Feedburner or other','tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_url',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // E-Mail URL Option
                        array('name' => __('E-Mail URL','tfuse'),
                            'desc' => __('Enter your preferred E-mail subscription URL. (Feedburner or other)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_id',
                            'value' => '',
                            'type' => 'text'
                        ),
                    )
                ),
                array(
                    'name' => __('Twitter','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Consumer Key','tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/yb44HiF2NZ">consumer key</a>.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_key',
                            'value' => 'XW7t8bECoR6ogYtUDNdjiQ',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Consumer Secret','tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/eaKJHG1omN">consumer secret key</a>.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_secret',
                            'value' => 'Z7UzuWU8a4obyOOlIguuI4a5JV4ryTIPKZ3POIAcJ9M',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Token','tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a> application <a href="http://screencast.com/t/QEEG2O4H">access token key</a>.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_user_token',
                            'value' => '1510587853-ugw6uUuNdNMdGGDn7DR4ZY4IcarhstIbq8wdDud',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Secret','tfuse'),
                            'desc' => __('Set your <a href="http://screencast.com/t/zHu17C7nXy1">twitter</a>  application <a href="http://screencast.com/t/Yv7nwRGsz">access token secret key</a>.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_twitter_user_secret',
                            'value' => '7aNcpOUGtdKKeT1L72i3tfdHJWeKsBVODv26l9C0Cc',
                            'type' => 'text'
                        )
                    )
                ),
                array(
                    'name' => __('Enable Theme settings','tfuse'),
                    'options' => array(
                        // Enable Blog Filter
                        array('name' => __('Blog Filter','tfuse'),
                            'desc' => __('Enable Blog Filter?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_blog_filter',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Portfolio Filter
                        array('name' => __('Portfolio Filter','tfuse'),
                            'desc' => __('Enable Portfolio Filter?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_portfolio_filter',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Author Info
                        array('name' => __('Author Info','tfuse'),
                            'desc' => __('Enable Author Info?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_author_info',
                            'value' => false,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Post Meta
                        array('name' => __('Post Meta','tfuse'),
                            'desc' => __('Enable Post Meta?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_post_meta',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Portfolio Meta
                        array('name' => __('Portfolio Meta','tfuse'),
                            'desc' => __('Enable Portfolio Meta?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_porfolio_meta',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Events Meta
                        array('name' => __('Events Meta','tfuse'),
                            'desc' => __('Enable Events Meta?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_events_meta',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable Menus Meta
                        array('name' => __('Menus Meta','tfuse'),
                            'desc' => __('Enable Menus Meta?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_menus_meta',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Go to single menu
                        array('name' => __('Go to Single Menu?','tfuse'),
                            'desc' => __('Go to single menu?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_single_menu',
                            'value' => false,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Enable posts lightbox (prettyPhoto) Option
                        array('name' => __('prettyPhoto on Portfolios','tfuse'),
                            'desc' => __('Enable opening image and attachemnts in prettyPhoto on Categories listings? If No, image link go to post.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_portfolio_prettyphoto',
                            'value' => true,
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Dynamic Image Resizer Option
                        array('name' => __('Dynamic Image Resizer','tfuse'),
                            'desc' => __('This will Disable the thumb.php script that dynamicaly resizes images on your site. We recommend you keep this enabled, however note that for this to work you need to have "GD Library" installed on your server. This should be done by your hosting server administrator.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_resize',
                            'value' => false,
                            'type' => 'checkbox',
                            'divider'   => true
                        ),
                        // Disable SEO
                        array('name' => __('Disable SEO Tab','tfuse'),
                            'desc' => __('Disable SEO option?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_tfuse_seo_tab',
                            'value' => false,
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
                        // Remove wordpress versions for security reasons
                        array(
                            'name' => __('Remove Wordpress Versions','tfuse'),
                            'desc' => __('Remove Wordpress versions from the source code, for security reasons.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_remove_wp_versions',
                            'value' => true,
                            'type' => 'checkbox'
                        ),
                    )
                ),
            )
        ),
        array(
            'name' => __('Styles','tfuse'),
            'id' => TF_THEME_PREFIX . '_styles',
            'headings' => array(
                array(
                    'name' => __('Theme Fonts','tfuse'),
                    'options' => array(
                        array('name' => __('Hand Written','tfuse'),
                            'desc' => __('Select the hand writtent font. You can preview it on ','tfuse').'<a href="https://www.google.com/fonts" target="_blank">'.__(' Google Fonts','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_hand_font',
                            'value' => 'great_vibes',
                            'options' => array(
                                'regular' => '---Regular---',
                                'intro_inline' => 'Intro Inline',
                                'hand_writting' => '---Handwriting---',
                                'great_vibes' => 'Great Vibes',
                                'pacifico' => 'Pacifico',
                                'dancing_script' => 'Dancing Script',
                                'gloria_hallelujah' => 'Gloria Hallelujah',
                                'satisfy' => 'Satisfy',
                                'bad_script' => 'Bad Script',
                                'allura' => 'Allura',
                                'serif' => '---Serif---',
                                'roboto' => 'Roboto Slab',
                                'georgia' => 'Georgia',
                                'arbutus' => 'Arbutus Slab',
                                'bitter' => 'Bitter',
                                'coustard' => 'Coustard',
                                'droid_serif' => 'Droid Serif',
                                'eb' => 'EB Garamond',
                                'goudy' => 'Goudy Bookletter 1911',
                                'kotta' => 'Kotta One',
                                'playfair' => 'Playfair Display',
                                'vidaloka' => 'Vidaloka',
                                'sans_serif' => '---Sans Serif---',
                                'cabin' => 'Cabin',
                                'droid_sans' => 'Droid Sans',
                                'gafata' => 'Gafata',
                                'oxygen' => 'Oxygen',
                                'philosopher' => 'Philosopher',
                                'questrial' => 'Questrial',
                                'raleway' => 'Raleway',
                                'signika' => 'Signika',
                                'ubuntu' => 'Ubuntu',
                                'arial' => 'Arial',
                            ),
                            'type' => 'select',
                            'divider' => true

                        ),
                        array('name' => __('Titles','tfuse'),
                            'desc' => __('Select the titles font. You can preview it on ','tfuse').'<a href="https://www.google.com/fonts" target="_blank">'.__(' Google Fonts','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_titles_font',
                            'value' => 'raleway',
                            'options' => array(
                                'regular' => '---Regular---',
                                'intro_inline' => 'Intro Inline',
                                'hand_writting' => '---Handwriting---',
                                'great_vibes' => 'Great Vibes',
                                'pacifico' => 'Pacifico',
                                'dancing_script' => 'Dancing Script',
                                'gloria_hallelujah' => 'Gloria Hallelujah',
                                'satisfy' => 'Satisfy',
                                'bad_script' => 'Bad Script',
                                'allura' => 'Allura',
                                'serif' => '---Serif---',
                                'roboto' => 'Roboto Slab',
                                'georgia' => 'Georgia',
                                'arbutus' => 'Arbutus Slab',
                                'bitter' => 'Bitter',
                                'coustard' => 'Coustard',
                                'droid_serif' => 'Droid Serif',
                                'eb' => 'EB Garamond',
                                'goudy' => 'Goudy Bookletter 1911',
                                'kotta' => 'Kotta One',
                                'playfair' => 'Playfair Display',
                                'vidaloka' => 'Vidaloka',
                                'sans_serif' => '---Sans Serif---',
                                'cabin' => 'Cabin',
                                'droid_sans' => 'Droid Sans',
                                'gafata' => 'Gafata',
                                'oxygen' => 'Oxygen',
                                'philosopher' => 'Philosopher',
                                'questrial' => 'Questrial',
                                'raleway' => 'Raleway',
                                'signika' => 'Signika',
                                'ubuntu' => 'Ubuntu',
                                'arial' => 'Arial',
                            ),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => __('Body Text','tfuse'),
                            'desc' => __('Select the body text font. You can preview it on ','tfuse').'<a href="https://www.google.com/fonts" target="_blank">'.__(' Google Fonts','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_body_font',
                            'value' => 'raleway',
                            'options' => array(
                                'regular' => '---Regular---',
                                'intro_inline' => 'Intro Inline',
                                'hand_writting' => '---Handwriting---',
                                'great_vibes' => 'Great Vibes',
                                'pacifico' => 'Pacifico',
                                'dancing_script' => 'Dancing Script',
                                'gloria_hallelujah' => 'Gloria Hallelujah',
                                'satisfy' => 'Satisfy',
                                'bad_script' => 'Bad Script',
                                'allura' => 'Allura',
                                'serif' => '---Serif---',
                                'roboto' => 'Roboto Slab',
                                'georgia' => 'Georgia',
                                'arbutus' => 'Arbutus Slab',
                                'bitter' => 'Bitter',
                                'coustard' => 'Coustard',
                                'droid_serif' => 'Droid Serif',
                                'eb' => 'EB Garamond',
                                'goudy' => 'Goudy Bookletter 1911',
                                'kotta' => 'Kotta One',
                                'playfair' => 'Playfair Display',
                                'vidaloka' => 'Vidaloka',
                                'sans_serif' => '---Sans Serif---',
                                'cabin' => 'Cabin',
                                'droid_sans' => 'Droid Sans',
                                'gafata' => 'Gafata',
                                'oxygen' => 'Oxygen',
                                'philosopher' => 'Philosopher',
                                'questrial' => 'Questrial',
                                'raleway' => 'Raleway',
                                'signika' => 'Signika',
                                'ubuntu' => 'Ubuntu',
                                'arial' => 'Arial',
                            ),
                            'type' => 'select'
                        )
                    )
                ),
                array(
                    'name' => __('Logo Fonts','tfuse'),
                    'options' => array(
                        array('name' => __('Top Logo','tfuse'),
                            'desc' => __('Select the font for top logo. You can preview it on ','tfuse').'<a href="https://www.google.com/fonts" target="_blank">'.__(' Google Fonts','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_top_logo_font',
                            'value' => 'great_vibes',
                            'options' => array(
                                'regular' => '---Regular---',
                                'intro_inline' => 'Intro Inline',
                                'hand_writting' => '---Handwriting---',
                                'great_vibes' => 'Great Vibes',
                                'pacifico' => 'Pacifico',
                                'dancing_script' => 'Dancing Script',
                                'gloria_hallelujah' => 'Gloria Hallelujah',
                                'satisfy' => 'Satisfy',
                                'bad_script' => 'Bad Script',
                                'allura' => 'Allura',
                                'serif' => '---Serif---',
                                'roboto' => 'Roboto Slab',
                                'georgia' => 'Georgia',
                                'arbutus' => 'Arbutus Slab',
                                'bitter' => 'Bitter',
                                'coustard' => 'Coustard',
                                'droid_serif' => 'Droid Serif',
                                'eb' => 'EB Garamond',
                                'goudy' => 'Goudy Bookletter 1911',
                                'kotta' => 'Kotta One',
                                'playfair' => 'Playfair Display',
                                'vidaloka' => 'Vidaloka',
                                'sans_serif' => '---Sans Serif---',
                                'cabin' => 'Cabin',
                                'droid_sans' => 'Droid Sans',
                                'gafata' => 'Gafata',
                                'oxygen' => 'Oxygen',
                                'philosopher' => 'Philosopher',
                                'questrial' => 'Questrial',
                                'raleway' => 'Raleway',
                                'signika' => 'Signika',
                                'ubuntu' => 'Ubuntu',
                                'arial' => 'Arial',
                            ),
                            'type' => 'select',
                            'divider' => true

                        ),
                        array('name' => __('Bottom Logo','tfuse'),
                            'desc' => __('Select the font for bottom logo. You can preview it on ','tfuse').'<a href="https://www.google.com/fonts" target="_blank">'.__(' Google Fonts','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_bottom_logo_font',
                            'value' => 'intro_inline',
                            'options' => array(
                                'regular' => '---Regular---',
                                'intro_inline' => 'Intro Inline',
                                'hand_writting' => '---Handwriting---',
                                'great_vibes' => 'Great Vibes',
                                'pacifico' => 'Pacifico',
                                'dancing_script' => 'Dancing Script',
                                'gloria_hallelujah' => 'Gloria Hallelujah',
                                'satisfy' => 'Satisfy',
                                'bad_script' => 'Bad Script',
                                'allura' => 'Allura',
                                'serif' => '---Serif---',
                                'roboto' => 'Roboto Slab',
                                'georgia' => 'Georgia',
                                'arbutus' => 'Arbutus Slab',
                                'bitter' => 'Bitter',
                                'coustard' => 'Coustard',
                                'droid_serif' => 'Droid Serif',
                                'eb' => 'EB Garamond',
                                'goudy' => 'Goudy Bookletter 1911',
                                'kotta' => 'Kotta One',
                                'playfair' => 'Playfair Display',
                                'vidaloka' => 'Vidaloka',
                                'sans_serif' => '---Sans Serif---',
                                'cabin' => 'Cabin',
                                'droid_sans' => 'Droid Sans',
                                'gafata' => 'Gafata',
                                'oxygen' => 'Oxygen',
                                'philosopher' => 'Philosopher',
                                'questrial' => 'Questrial',
                                'raleway' => 'Raleway',
                                'signika' => 'Signika',
                                'ubuntu' => 'Ubuntu',
                                'arial' => 'Arial',
                            ),
                            'type' => 'select',
                        ),
                        array('name' => __('Letter Spacing','tfuse'),
                            'desc' => __('Enter the letter spacing. Ex: -10','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo_letter_spacing',
                            'value' => '-10',
                            'type' => 'text',
                        ),
                    )
                ),
                array(
                    'name' => __('Theme Styles','tfuse'),
                    'options' => array(
                        array('name' => __('Highlight Color','tfuse'),
                            'desc' => __('Select Highlight Color','tfuse'),
                            'id' => TF_THEME_PREFIX . '_highlight_color',
                            'value' => '#FFA42E',
                            'type' => 'colorpicker',
                        ),
                    )
                ),
            )
        ),
        array(
            'name' => __('Homepage','tfuse'),
            'id' => TF_THEME_PREFIX . '_homepage',
            'headings' => array(
                array(
                    'name' => __('Homepage Population','tfuse'),
                    'options' => array(
                        array('name' => __('Homepage Population','tfuse'),
                            'desc' => __('Select which categories to display on homepage. More over you can choose to load a specific page or change the number of posts on the homepage from <a target="_blank" href="' . network_admin_url('options-reading.php') . '">here</a>','tfuse'),
                            'id' => TF_THEME_PREFIX . '_homepage_category',
                            'value' => '',
                            'options' => array('all' => __('From All Categories','tfuse'), 'specific' => __('From Specific Categories','tfuse'), 'page' => __('From Specific Page','tfuse')),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on homepage','tfuse'),
                            'desc' => __('Pick one or more categories by starting to type the category name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ',
                            'type' => 'multi',
                            'subtype' => 'category',
                        ),
                        // page on homepage
                        array('name' => __('Select Page','tfuse'),
                            'desc' => __('Select the page','tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_page',
                            'value' => 'image',
                            'options' => tfuse_list_page_options(),
                            'type' => 'select',
                        ),
                        array('name' => __('Use page options','tfuse'),
                            'desc' => __('Use page options','tfuse'),
                            'id' => TF_THEME_PREFIX . '_use_page_options',
                            'value' => false,
                            'type' => 'checkbox'
                        )
                    ),

                ),
                array(
                    'name' => __('Homepage Shortcodes','tfuse'),
                    'options' => array(
                        // Before Menu
                        array('name' => __('Shortcodes Before Menu','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_before_menu',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes Before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                    ),
                ),
            )
        ),
        array(
            'name' => __('Blog','tfuse'),
            'id' => TF_THEME_PREFIX . '_blogpage',
            'headings' => array(
                array(
                    'name' => __('Blog Page Population','tfuse'),
                    'options' => array(
                        array('name' => __('Select Page','tfuse'),
                            'desc' => __('Select the page','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_page',
                            'value' => 'image',
                            'options' => tfuse_list_page_options(),
                            'type' => 'select',
                        ),
                        array('name' => __('Blog Page Population','tfuse'),
                            'desc' => __('Select which categories to display on blog page. More over you can choose to load a specific page or change the number of posts on the blog page from <a target="_blank" href="' . network_admin_url('options-reading.php') . '">here</a>','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blogpage_category',
                            'value' => '',
                            'options' => array('all' => __('From All Categories','tfuse'), 'specific' => __('From Specific Categories','tfuse')),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on blog page','tfuse'),
                            'desc' => __('Pick one or more categories by starting to type the category name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ_blog',
                            'type' => 'multi',
                            'subtype' => 'category',
                        )
                    )
                ),
                array(
                    'name' => __('Blog Page Shortcodes','tfuse'),
                    'options' => array(
                        // Before Menu
                        array('name' => __('Shortcodes Before Menu','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_before_menu_blog',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes Before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_blog',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_blog',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                    ),
                ),
            )
        ),
        array(
            'name' => __('Posts','tfuse'),
            'id' => TF_THEME_PREFIX . '_posts',
            'headings' => array(
                array(
                    'name' => __('Default Post Options','tfuse'),
                    'options' => array(
                        // Post Content
                        array('name' => __('Post Content','tfuse'),
                            'desc' => __('Select if you want to show the full content (use <em>more</em> tag) or the excerpt on posts listings (categories).','tfuse'),
                            'id' => TF_THEME_PREFIX . '_post_content',
                            'value' => 'excerpt',
                            'options' => array('excerpt' => __('The Excerpt','tfuse'), 'content' => __('Full Content','tfuse')),
                            'type' => 'select',
                        ),
                        array('name' => __('Post Type','tfuse'),
                            'desc' => __('Select your preferred post type','tfuse'),
                            'id' => TF_THEME_PREFIX . '_single_post_type',
                            'value' => 'post-style-1',
                            'options' => array(
                                'post-style-1' => array($directory . '/images/post-type/post-style-1.png', __('Image with left align and rounded', 'tfuse')),
                                'post-style-2' => array($directory . '/images/post-type/post-style-2.png', __('Image with right align and rounded', 'tfuse')),
                                'post-style-3' => array($directory . '/images/post-type/post-style-3.png', __('Image with left align', 'tfuse')),
                                'post-style-4' => array($directory . '/images/post-type/post-style-4.png', __('Image with right align', 'tfuse')),
                                'post-style-6' => array($directory . '/images/post-type/post-style-6.png', __('Big image and centered, title after image', 'tfuse')),
                                'post-style-7' => array($directory . '/images/post-type/post-style-7.png', __('Big image and centered', 'tfuse')),
                            ),
                            'type' => 'images',
                        ),

                    )
                )
            )
        ),
        array(
            'name' => __('Menus','tfuse'),
            'id' => TF_THEME_PREFIX . '_menus',
            'headings' => array(
                array(
                    'name' => __('Default Post Menus','tfuse'),
                    'options' => array(
                        array('name' => __('Money Currency, symbol','tfuse'),
                            'desc' => __('The symbol of the currency being used. (i.e. $, €, £) in singular form.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_currency_symbol',
                            'value' => '$',
                            'type' => 'text',
                        ),
                        array('name' => __('Money Symbol position','tfuse'),
                            'desc' => __('The symbol the position from against price: Left / Right','tfuse'),
                            'id' => TF_THEME_PREFIX . '_symbol_position',
                            'value' => 'left',
                            'options' => array(
                                'left' => __('Left','tfuse'),
                                'right' => __('Right','tfuse')
                            ),
                            'type' => 'select',
                        ),
                    )
                )
            )
        ),
        array(
            'name' => __('Footer','tfuse'),
            'id' => TF_THEME_PREFIX . '_footer',
            'headings' => array(
                array(
                    'name' => __('Footer Content','tfuse'),
                    'options' => array(
                        //copyright
                        array('name' => __('Custom Copyright','tfuse'),
                            'desc' => __('Create your custom copyright','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_copyright',
                            'value' => 'Restaurant Wordpress theme © 2014 Made by <a rel="nofollow" href="http://themefuse.com" target="_blank">ThemeFuse</a>',
                            'type' =>'textarea'
                        ),
                    )
                ),
                array(
                    'name' => __('Footer Social','tfuse'),
                    'options' => array(
                        array('name' => __('Facebook','tfuse'),
                            'desc' => __('Enter facebook link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_facebook',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Twitter','tfuse'),
                            'desc' => __('Enter twitter link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_twitter',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Pinterest','tfuse'),
                            'desc' => __('Enter pinterest link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_pinterest',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Trip Advisor','tfuse'),
                            'desc' => __('Enter Trip Advisor link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_trip_advisor',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Instagram','tfuse'),
                            'desc' => __('Enter instagram link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_social_instagram',
                            'value' => '',
                            'type' => 'text'
                        ),
                    )
                )
            )
        ),
        array(
            'name' => __('Page elements','tfuse'),
            'id' => TF_THEME_PREFIX . '_page_elements',
            'headings' => array(
                array(
                    'name' => __('Search','tfuse'),
                    'options' => array(
                        // Before Menu
                        array('name' => __('Shortcodes Before Menu','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_before_menu_search',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes Before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_search',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_search',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                    )
                ),
                array(
                    'name' => __('404','tfuse'),
                    'options' => array(
                        // 404 text
                        array('name' => __('404 text','tfuse'),
                            'desc' => __('Enter text for 404 page.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_text_404',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Before Menu
                        array('name' => __('Shortcodes Before Menu','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_before_menu_404',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes Before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_404',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_404',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                    )
                ),
                array(
                    'name' => __('Tag','tfuse'),
                    'options' => array(
                        // Before Menu
                        array('name' => __('Shortcodes Before Menu','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_before_menu_tag',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes Before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_tag',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_tag',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                    )
                ),
                array(
                    'name' => __('Archive','tfuse'),
                    'options' => array(
                        // Before Menu
                        array('name' => __('Shortcodes Before Menu','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_before_menu_archive',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Top Shortcodes
                        array('name' => __('Shortcodes Before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_top_archive',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes After Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_bottom_archive',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                    )
                ),
            )
        )

    )
);

?>