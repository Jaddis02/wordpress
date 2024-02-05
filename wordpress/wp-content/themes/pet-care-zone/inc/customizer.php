<?php
/**
 * Pet Care Zone Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Pet Care Zone
 */

if ( ! defined( 'PET_CARE_ZONE_URL' ) ) {
    define( 'PET_CARE_ZONE_URL', esc_url( 'https://www.themagnifico.net/themes/pet-wordpress-theme/', 'pet-care-zone') );
}
if ( ! defined( 'PET_CARE_ZONE_TEXT' ) ) {
    define( 'PET_CARE_ZONE_TEXT', __( 'Pet Care Pro','pet-care-zone' ));
}
if ( ! defined( 'PET_CARE_ZONE_BUY_TEXT' ) ) {
    define( 'PET_CARE_ZONE_BUY_TEXT', __( 'Buy Pet Care Pro','pet-care-zone' ));
}

use WPTRT\Customize\Section\Pet_Care_Zone_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Pet_Care_Zone_Button::class );

    $manager->add_section(
        new Pet_Care_Zone_Button( $manager, 'pet_care_zone_pro', [
            'title'       => esc_html( PET_CARE_ZONE_TEXT, 'pet-care-zone' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'pet-care-zone' ),
            'button_url'  => esc_url( PET_CARE_ZONE_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'pet-care-zone-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'pet-care-zone-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pet_care_zone_customize_register($wp_customize){

    // Pro Version
    class Pet_Care_Zone_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( PET_CARE_ZONE_BUY_TEXT,'pet-care-zone' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Pet_Care_Zone_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->add_setting('pet_care_zone_logo_title_text', array(
        'default' => true,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_logo_title_text',array(
        'label'          => __( 'Enable Disable Title', 'pet-care-zone' ),
        'section'        => 'title_tagline',
        'settings'       => 'pet_care_zone_logo_title_text',
        'type'           => 'checkbox',
    )));

     //Logo
    $wp_customize->add_setting('pet_care_zone_logo_max_height',array(
        'default'   => '24',
        'sanitize_callback' => 'pet_care_zone_sanitize_number_absint'
    ));
    $wp_customize->add_control('pet_care_zone_logo_max_height',array(
        'label' => esc_html__('Logo Width','pet-care-zone'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('pet_care_zone_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'pet-care-zone' ),
        'section'        => 'title_tagline',
        'settings'       => 'pet_care_zone_theme_description',
        'type'           => 'checkbox',
    )));

    // Theme Color
    $wp_customize->add_section('pet_care_zone_color_option',array(
        'title' => esc_html__('Theme Color','pet-care-zone'),
        'priority'   => 20
    ));

    $wp_customize->add_setting( 'pet_care_zone_theme_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_care_zone_theme_color', array(
        'label' => esc_html__('First Color Option','pet-care-zone'),
        'section' => 'pet_care_zone_color_option',
        'settings' => 'pet_care_zone_theme_color'
    )));

    $wp_customize->add_setting( 'pet_care_zone_theme_color_2', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_care_zone_theme_color_2', array(
        'label' => esc_html__('Second Color Option','pet-care-zone'),
        'section' => 'pet_care_zone_color_option',
        'settings' => 'pet_care_zone_theme_color_2'
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_theme_color', array(
        'sanitize_callback' => 'Pet_Care_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Pet_Care_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_theme_color', array(
        'section'     => 'pet_care_zone_color_option',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'pet-care-zone' ),
        'description' => esc_url( PET_CARE_ZONE_URL ),
        'priority'    => 100
    )));

    // Header
    $wp_customize->add_section('pet_care_zone_header_top',array(
        'title' => esc_html__('Header','pet-care-zone'),
        'priority'   => 20
    ));

    $wp_customize->add_setting('pet_care_zone_phone_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_care_zone_phone_icon',array(
        'label' => esc_html__('Phone Icon','pet-care-zone'),
        'section' => 'pet_care_zone_header_top',
        'setting' => 'pet_care_zone_phone_icon',
        'type'  => 'text',
        'default' => 'fa fa-phone-square',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fas fa-phone-square','pet-care-zone')
    ));


    $wp_customize->add_setting('pet_care_zone_header_phone',array(
        'default' => '',
        'sanitize_callback' => 'pet_care_zone_sanitize_phone_number'
    ));
    $wp_customize->add_control('pet_care_zone_header_phone',array(
        'label' => esc_html__('Phone Number','pet-care-zone'),
        'section' => 'pet_care_zone_header_top',
        'setting' => 'pet_care_zone_header_phone',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('pet_care_zone_email_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_care_zone_email_icon',array(
        'label' => esc_html__('Email Icon','pet-care-zone'),
        'section' => 'pet_care_zone_header_top',
        'setting' => 'pet_care_zone_email_icon',
        'type'  => 'text',
        'default' => 'fas fa-envelope-square',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fas fa-envelope-square','pet-care-zone')
    ));

    $wp_customize->add_setting('pet_care_zone_topbar_email',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email'
    ));
    $wp_customize->add_control('pet_care_zone_topbar_email',array(
        'label' => esc_html__('Email Address','pet-care-zone'),
        'section' => 'pet_care_zone_header_top',
        'setting' => 'pet_care_zone_topbar_email',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('pet_care_zone_topbar_text1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_care_zone_topbar_text1',array(
        'label' => esc_html__('Text 1','pet-care-zone'),
        'section' => 'pet_care_zone_header_top',
        'setting' => 'pet_care_zone_topbar_text1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('pet_care_zone_topbar_link1',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('pet_care_zone_topbar_link1',array(
        'label' => esc_html__('Link 1','pet-care-zone'),
        'section' => 'pet_care_zone_header_top',
        'setting' => 'pet_care_zone_topbar_link1',
        'type'  => 'url'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_header_setting', array(
        'sanitize_callback' => 'Pet_Care_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Pet_Care_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_header_setting', array(
        'section'     => 'pet_care_zone_header_top',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'pet-care-zone' ),
        'description' => esc_url( PET_CARE_ZONE_URL ),
        'priority'    => 100
    )));

    // General Settings
     $wp_customize->add_section('pet_care_zone_general_settings',array(
        'title' => esc_html__('General Settings','pet-care-zone'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('pet_care_zone_preloader_hide', array(
        'default' => false,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'pet-care-zone' ),
        'section'        => 'pet_care_zone_general_settings',
        'settings'       => 'pet_care_zone_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'pet_care_zone_preloader_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_care_zone_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','pet-care-zone'),
        'section' => 'pet_care_zone_general_settings',
        'settings' => 'pet_care_zone_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'pet_care_zone_preloader_dot_1_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_care_zone_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','pet-care-zone'),
        'section' => 'pet_care_zone_general_settings',
        'settings' => 'pet_care_zone_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'pet_care_zone_preloader_dot_2_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pet_care_zone_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','pet-care-zone'),
        'section' => 'pet_care_zone_general_settings',
        'settings' => 'pet_care_zone_preloader_dot_2_color'
    )));

    $wp_customize->add_setting('pet_care_zone_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'pet-care-zone' ),
        'section'        => 'pet_care_zone_general_settings',
        'settings'       => 'pet_care_zone_sticky_header',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('pet_care_zone_scroll_hide', array(
        'default' => '',
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'pet-care-zone' ),
        'section'        => 'pet_care_zone_general_settings',
        'settings'       => 'pet_care_zone_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('pet_care_zone_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'pet_care_zone_sanitize_choices'
    ));
    $wp_customize->add_control('pet_care_zone_scroll_top_position',array(
        'type' => 'radio',
        'section' => 'pet_care_zone_general_settings',
        'choices' => array(
            'Right' => __('Right','pet-care-zone'),
            'Left' => __('Left','pet-care-zone'),
            'Center' => __('Center','pet-care-zone')
        ),
    ) );

     // Product Columns
    $wp_customize->add_setting( 'pet_care_zone_products_per_row' , array(
        'default'           => '3',
        'transport'         => 'refresh',
        'sanitize_callback' => 'pet_care_zone_sanitize_select',
    ) );

    $wp_customize->add_control('pet_care_zone_products_per_row', array(
        'label' => __( 'Product per row', 'pet-care-zone' ),
        'section'  => 'pet_care_zone_general_settings',
        'type'     => 'select',
        'choices'  => array(
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ),
    ) );

    $wp_customize->add_setting('pet_care_zone_product_per_page',array(
        'default'   => '9',
        'sanitize_callback' => 'pet_care_zone_sanitize_float'
    ));
    $wp_customize->add_control('pet_care_zone_product_per_page',array(
        'label' => __('Product per page','pet-care-zone'),
        'section'   => 'pet_care_zone_general_settings',
        'type'      => 'number'
    ));

    //Woocommerce shop page Sidebar
    $wp_customize->add_setting('pet_care_zone_woocommerce_shop_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_woocommerce_shop_page_sidebar',array(
        'label'          => __( 'Hide Shop Page Sidebar', 'pet-care-zone' ),
        'section'        => 'pet_care_zone_general_settings',
        'settings'       => 'pet_care_zone_woocommerce_shop_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('pet_care_zone_shop_page_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'pet_care_zone_sanitize_choices'
    ));
    $wp_customize->add_control('pet_care_zone_shop_page_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Shop Page Sidebar','pet-care-zone'),
        'section' => 'pet_care_zone_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','pet-care-zone'),
            'Right Sidebar' => __('Right Sidebar','pet-care-zone'),
        ),
    ) );

    //Woocommerce Single Product page Sidebar
    $wp_customize->add_setting('pet_care_zone_woocommerce_single_product_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_woocommerce_single_product_page_sidebar',array(
        'label'          => __( 'Hide Single Product Page Sidebar', 'pet-care-zone' ),
        'section'        => 'pet_care_zone_general_settings',
        'settings'       => 'pet_care_zone_woocommerce_single_product_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('pet_care_zone_single_product_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'pet_care_zone_sanitize_choices'
    ));
    $wp_customize->add_control('pet_care_zone_single_product_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Single Product Page Sidebar','pet-care-zone'),
        'section' => 'pet_care_zone_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','pet-care-zone'),
            'Right Sidebar' => __('Right Sidebar','pet-care-zone'),
        ),
    ) );

    $wp_customize->add_setting('pet_care_zone_woocommerce_product_sale',array(
        'default' => 'Left',
        'sanitize_callback' => 'pet_care_zone_sanitize_choices'
    ));
    $wp_customize->add_control('pet_care_zone_woocommerce_product_sale',array(
        'type' => 'radio',
        'section' => 'pet_care_zone_general_settings',
        'choices' => array(
            'Right' => __('Right','pet-care-zone'),
            'Left' => __('Left','pet-care-zone'),
            'Center' => __('Center','pet-care-zone')
        ),
    ) );

     // Pro Version
    $wp_customize->add_setting( 'pro_version_general_setting', array(
        'sanitize_callback' => 'Pet_Care_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Pet_Care_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_general_setting', array(
        'section'     => 'pet_care_zone_general_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'pet-care-zone' ),
        'description' => esc_url( PET_CARE_ZONE_URL ),
        'priority'    => 100
    )));

    // Post Settings
     $wp_customize->add_section('pet_care_zone_post_settings',array(
        'title' => esc_html__('Post Settings','pet-care-zone'),
        'priority'   =>40,
    ));

     $wp_customize->add_setting('pet_care_zone_post_page_title',array(
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('pet_care_zone_post_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Title', 'pet-care-zone'),
        'section'     => 'pet_care_zone_post_settings',
        'description' => esc_html__('Check this box to enable title on post page.', 'pet-care-zone'),
    ));

    $wp_customize->add_setting('pet_care_zone_post_page_thumb',array(
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('pet_care_zone_post_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Thumbnail', 'pet-care-zone'),
        'section'     => 'pet_care_zone_post_settings',
        'description' => esc_html__('Check this box to enable thumbnail on post page.', 'pet-care-zone'),
    ));

    $wp_customize->add_setting('pet_care_zone_post_page_cat',array(
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('pet_care_zone_post_page_cat',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Category and Tags', 'pet-care-zone'),
        'section'     => 'pet_care_zone_post_settings',
        'description' => esc_html__('Check this box to enable category and tags on post page.', 'pet-care-zone'),
    ));

    $wp_customize->add_setting('pet_care_zone_single_post_thumb',array(
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('pet_care_zone_single_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Thumbnail', 'pet-care-zone'),
        'section'     => 'pet_care_zone_post_settings',
        'description' => esc_html__('Check this box to enable post thumbnail on single post.', 'pet-care-zone'),
    ));

    $wp_customize->add_setting('pet_care_zone_single_post_title',array(
            'sanitize_callback' => 'pet_care_zone_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('pet_care_zone_single_post_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Title', 'pet-care-zone'),
        'section'     => 'pet_care_zone_post_settings',
        'description' => esc_html__('Check this box to enable title on single post.', 'pet-care-zone'),
    ));

    $wp_customize->add_setting('pet_care_zone_single_post_cat',array(
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('pet_care_zone_single_post_cat',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Category and Tags', 'pet-care-zone'),
        'section'     => 'pet_care_zone_post_settings',
        'description' => esc_html__('Check this box to enable post category and tags on single post.', 'pet-care-zone'),
    ));

    $wp_customize->add_setting('pet_care_zone_single_post_comment_title',array(
        'default'=> 'Leave a Reply',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('pet_care_zone_single_post_comment_title',array(
        'label' => __('Add Comment Title','pet-care-zone'),
        'input_attrs' => array(
        'placeholder' => __( 'Leave a Reply', 'pet-care-zone' ),
        ),
        'section'=> 'pet_care_zone_post_settings',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('pet_care_zone_single_post_comment_btn_text',array(
        'default'=> 'Post Comment',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('pet_care_zone_single_post_comment_btn_text',array(
        'label' => __('Add Comment Button Text','pet-care-zone'),
        'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'pet-care-zone' ),
        ),
        'section'=> 'pet_care_zone_post_settings',
        'type'=> 'text'
    ));

    // Social Link
    $wp_customize->add_section('pet_care_zone_social_link',array(
        'title' => esc_html__('Social Links','pet-care-zone'),
        'priority'   => 50,
    ));

    $wp_customize->add_setting('pet_care_zone_facebook_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_care_zone_facebook_icon',array(
        'label' => esc_html__('Social Icon','pet-care-zone'),
        'section' => 'pet_care_zone_social_link',
        'setting' => 'pet_care_zone_facebook_icon',
        'type'  => 'text',
        'default' => 'fab fa-facebook-f',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-facebook-f','pet-care-zone')
    ));

    $wp_customize->add_setting('pet_care_zone_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('pet_care_zone_facebook_url',array(
        'label' => esc_html__('Facebook Link','pet-care-zone'),
        'section' => 'pet_care_zone_social_link',
        'setting' => 'pet_care_zone_facebook_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('pet_care_zone_twitter_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_care_zone_twitter_icon',array(
        'label' => esc_html__('Social Icon','pet-care-zone'),
        'section' => 'pet_care_zone_social_link',
        'setting' => 'pet_care_zone_twitter_icon',
        'type'  => 'text',
        'default' => 'fab fa-twitter',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-twitter','pet-care-zone')
    ));

    $wp_customize->add_setting('pet_care_zone_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('pet_care_zone_twitter_url',array(
        'label' => esc_html__('Twitter Link','pet-care-zone'),
        'section' => 'pet_care_zone_social_link',
        'setting' => 'pet_care_zone_twitter_url',
        'type'  => 'url'
    ));

     $wp_customize->add_setting('pet_care_zone_instagram_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_care_zone_instagram_icon',array(
        'label' => esc_html__('Social Icon','pet-care-zone'),
        'section' => 'pet_care_zone_social_link',
        'setting' => 'pet_care_zone_instagram_icon',
        'type'  => 'text',
        'default' => 'fab fa-instagram',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-instagram','pet-care-zone')
    ));

    $wp_customize->add_setting('pet_care_zone_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('pet_care_zone_intagram_url',array(
        'label' => esc_html__('Intagram Link','pet-care-zone'),
        'section' => 'pet_care_zone_social_link',
        'setting' => 'pet_care_zone_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('pet_care_zone_linkedin_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_care_zone_linkedin_icon',array(
        'label' => esc_html__('Social Icon','pet-care-zone'),
        'section' => 'pet_care_zone_social_link',
        'setting' => 'pet_care_zone_linkedin_icon',
        'type'  => 'text',
        'default' => 'fab fa-linkedin-in',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-linkedin-in','pet-care-zone')
    ));

    $wp_customize->add_setting('pet_care_zone_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('pet_care_zone_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','pet-care-zone'),
        'section' => 'pet_care_zone_social_link',
        'setting' => 'pet_care_zone_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('pet_care_zone_pinterest_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_care_zone_pinterest_icon',array(
        'label' => esc_html__('Social Icon','pet-care-zone'),
        'section' => 'pet_care_zone_social_link',
        'setting' => 'pet_care_zone_pinterest_icon',
        'type'  => 'text',
        'default' => 'fab fa-pinterest-p',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-pinterest-p','pet-care-zone')
    ));

    $wp_customize->add_setting('pet_care_zone_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('pet_care_zone_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','pet-care-zone'),
        'section' => 'pet_care_zone_social_link',
        'setting' => 'pet_care_zone_pintrest_url',
        'type'  => 'url'
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_social_setting', array(
        'sanitize_callback' => 'Pet_Care_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Pet_Care_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_social_setting', array(
        'section'     => 'pet_care_zone_social_link',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'pet-care-zone' ),
        'description' => esc_url( PET_CARE_ZONE_URL ),
        'priority'    => 100
    )));
    

    //Slider
    $wp_customize->add_section('pet_care_zone_top_slider',array(
        'title' => esc_html__('Slider Option','pet-care-zone'),
        'description' => esc_html__('Here you have to add 3 different post categories in below dropdown. Image Dimension ( 500px x 500px )','pet-care-zone'),
        'priority'   => 60,
    ));

    $wp_customize->add_setting('pet_care_zone_top_slider_setting', array(
        'default' => 0,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_top_slider_setting',array(
        'label'          => __( 'Enable Disable Slider', 'pet-care-zone' ),
        'section'        => 'pet_care_zone_top_slider',
        'settings'       => 'pet_care_zone_top_slider_setting',
        'type'           => 'checkbox',
    )));

    for ( $count = 1; $count <= 3; $count++ ) {
        $wp_customize->add_setting( 'pet_care_zone_top_slider_page' . $count, array(
            'default'           => '',
            'sanitize_callback' => 'pet_care_zone_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'pet_care_zone_top_slider_page' . $count, array(
            'label'    => __( 'Select Slide Page', 'pet-care-zone' ),
            'section'  => 'pet_care_zone_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    $wp_customize->add_setting('pet_care_zone_slider_loop', array(
        'default' => 1,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_slider_loop',array(
        'label'          => __( 'Enable Disable Slider Loop', 'pet-care-zone' ),
        'section'        => 'pet_care_zone_top_slider',
        'settings'       => 'pet_care_zone_slider_loop',
        'type'           => 'checkbox',
    )));

    //Slider Image Opacity
    $wp_customize->add_setting('pet_care_zone_slider_opacity_color',array(
      'default' => '',
      'sanitize_callback' => 'pet_care_zone_sanitize_choices'
    ));

    $wp_customize->add_control( 'pet_care_zone_slider_opacity_color', array(
    'label'       => esc_html__( 'Slider Image Opacity','pet-care-zone' ),
    'section'     => 'pet_care_zone_top_slider',
    'type'        => 'select',
    'choices' => array(
      '0' =>  esc_attr('0','pet-care-zone'),
      '0.1' =>  esc_attr('0.1','pet-care-zone'),
      '0.2' =>  esc_attr('0.2','pet-care-zone'),
      '0.3' =>  esc_attr('0.3','pet-care-zone'),
      '0.4' =>  esc_attr('0.4','pet-care-zone'),
      '0.5' =>  esc_attr('0.5','pet-care-zone'),
      '0.6' =>  esc_attr('0.6','pet-care-zone'),
      '0.7' =>  esc_attr('0.7','pet-care-zone'),
      '0.8' =>  esc_attr('0.8','pet-care-zone'),
      '0.9' =>  esc_attr('0.9','pet-care-zone')
    ),
    ));

    //Slider height
    $wp_customize->add_setting('pet_care_zone_slider_img_height',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('pet_care_zone_slider_img_height',array(
        'label' => __('Slider Height','pet-care-zone'),
        'description'   => __('Add the slider height in px(eg. 500px).','pet-care-zone'),
        'input_attrs' => array(
            'placeholder' => __( '500px', 'pet-care-zone' ),
        ),
        'section'=> 'pet_care_zone_top_slider',
        'type'=> 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_setting', array(
        'sanitize_callback' => 'Pet_Care_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Pet_Care_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_slider_setting', array(
        'section'     => 'pet_care_zone_top_slider',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'pet-care-zone' ),
        'description' => esc_url( PET_CARE_ZONE_URL ),
        'priority'    => 100
    )));

    //Product
    $wp_customize->add_section('pet_care_zone_product_category',array(
        'title' => esc_html__('Featured Product','pet-care-zone'),
        'description' => esc_html__('Here you have to select product category which will display perticular featured product in the home page.','pet-care-zone'),
        'priority'   => 70,
    ));

    $wp_customize->add_setting('pet_care_zone_pet_product_setting', array(
        'default' => 0,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_pet_product_setting',array(
        'label'          => __( 'Enable Disable Product', 'pet-care-zone' ),
        'section'        => 'pet_care_zone_product_category',
        'settings'       => 'pet_care_zone_pet_product_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('pet_care_zone_product_loop', array(
        'default' => 1,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'pet_care_zone_product_loop',array(
        'label'          => __( 'Enable Disable Product Loop', 'pet-care-zone' ),
        'section'        => 'pet_care_zone_product_category',
        'settings'       => 'pet_care_zone_product_loop',
        'type'           => 'checkbox',
    )));

    $args = array(
       'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
    $categories = get_categories( $args );
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('pet_care_zone_pet_product',array(
        'sanitize_callback' => 'pet_care_zone_sanitize_select',
    ));
    $wp_customize->add_control('pet_care_zone_pet_product',array(
        'type'    => 'select',
        'choices' => $cats,
        'label' => __('Select Product Category','pet-care-zone'),
        'section' => 'pet_care_zone_product_category',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_product_setting', array(
        'sanitize_callback' => 'Pet_Care_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Pet_Care_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_product_setting', array(
        'section'     => 'pet_care_zone_product_category',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'pet-care-zone' ),
        'description' => esc_url( PET_CARE_ZONE_URL ),
        'priority'    => 100
    )));

    // Footer
    $wp_customize->add_section('pet_care_zone_site_footer_section', array(
        'title' => esc_html__('Footer', 'pet-care-zone'),
        'priority'   => 80,
    ));

    $wp_customize->add_setting('pet_care_zone_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'pet_care_zone_footer_bg_image',array(
        'label' => __('Footer Background Image','pet-care-zone'),
        'section' => 'pet_care_zone_site_footer_section',
        'priority' => 1,
    )));

    $wp_customize->add_setting('pet_care_zone_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('pet_care_zone_footer_text_setting', array(
        'label' => __('Replace the footer text', 'pet-care-zone'),
        'section' => 'pet_care_zone_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('pet_care_zone_show_hide_copyright',array(
        'default' => true,
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control('pet_care_zone_show_hide_copyright',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Copyright','pet-care-zone'),
        'section' => 'pet_care_zone_site_footer_section',
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Pet_Care_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Pet_Care_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'pet_care_zone_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'pet-care-zone' ),
        'description' => esc_url( PET_CARE_ZONE_URL ),
        'priority'    => 100
    )));

    // Page Settings
    $wp_customize->add_section('pet_care_zone_page_settings',array(
        'title' => esc_html__('Page Settings','pet-care-zone'),
        'priority'   =>50,
    ));

    $wp_customize->add_setting('pet_care_zone_single_page_title',array(
            'sanitize_callback' => 'pet_care_zone_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('pet_care_zone_single_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Page Title', 'pet-care-zone'),
        'section'     => 'pet_care_zone_page_settings',
        'description' => esc_html__('Check this box to enable title on single page.', 'pet-care-zone'),
    ));

    $wp_customize->add_setting('pet_care_zone_single_page_thumb',array(
        'sanitize_callback' => 'pet_care_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('pet_care_zone_single_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Page Thumbnail', 'pet-care-zone'),
        'section'     => 'pet_care_zone_page_settings',
        'description' => esc_html__('Check this box to enable page thumbnail on single page.', 'pet-care-zone'),
    ));

}
add_action('customize_register', 'pet_care_zone_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function pet_care_zone_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function pet_care_zone_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pet_care_zone_customize_preview_js(){
    wp_enqueue_script('pet-care-zone-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'pet_care_zone_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function pet_care_zone_panels_js() {
    wp_enqueue_style( 'pet-care-zone-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'pet-care-zone-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'pet_care_zone_panels_js' );

