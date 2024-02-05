<?php

    $pet_care_zone_theme_css= "";

    /*--------------------------- Scroll To Top Positions -------------------*/

    $pet_care_zone_scroll_position = get_theme_mod( 'pet_care_zone_scroll_top_position','Right');
    if($pet_care_zone_scroll_position == 'Right'){
        $pet_care_zone_theme_css .='#button{';
            $pet_care_zone_theme_css .='right: 20px;';
        $pet_care_zone_theme_css .='}';
    }else if($pet_care_zone_scroll_position == 'Left'){
        $pet_care_zone_theme_css .='#button{';
            $pet_care_zone_theme_css .='left: 20px;';
        $pet_care_zone_theme_css .='}';
    }else if($pet_care_zone_scroll_position == 'Center'){
        $pet_care_zone_theme_css .='#button{';
            $pet_care_zone_theme_css .='right: 50%;left: 50%;';
        $pet_care_zone_theme_css .='}';
    }

    /*--------------------------- Slider Image Opacity -------------------*/

    $pet_care_zone_slider_img_opacity = get_theme_mod( 'pet_care_zone_slider_opacity_color','');
    if($pet_care_zone_slider_img_opacity == '0'){
        $pet_care_zone_theme_css .='.slider-box img{';
            $pet_care_zone_theme_css .='opacity:0';
        $pet_care_zone_theme_css .='}';
        }else if($pet_care_zone_slider_img_opacity == '0.1'){
        $pet_care_zone_theme_css .='.slider-box img{';
            $pet_care_zone_theme_css .='opacity:0.1';
        $pet_care_zone_theme_css .='}';
        }else if($pet_care_zone_slider_img_opacity == '0.2'){
        $pet_care_zone_theme_css .='.slider-box img{';
            $pet_care_zone_theme_css .='opacity:0.2';
        $pet_care_zone_theme_css .='}';
        }else if($pet_care_zone_slider_img_opacity == '0.3'){
        $pet_care_zone_theme_css .='.slider-box img{';
            $pet_care_zone_theme_css .='opacity:0.3';
        $pet_care_zone_theme_css .='}';
        }else if($pet_care_zone_slider_img_opacity == '0.4'){
        $pet_care_zone_theme_css .='.slider-box img{';
            $pet_care_zone_theme_css .='opacity:0.4';
        $pet_care_zone_theme_css .='}';
        }else if($pet_care_zone_slider_img_opacity == '0.5'){
        $pet_care_zone_theme_css .='.slider-box img{';
            $pet_care_zone_theme_css .='opacity:0.5';
        $pet_care_zone_theme_css .='}';
        }else if($pet_care_zone_slider_img_opacity == '0.6'){
        $pet_care_zone_theme_css .='.slider-box img{';
            $pet_care_zone_theme_css .='opacity:0.6';
        $pet_care_zone_theme_css .='}';
        }else if($pet_care_zone_slider_img_opacity == '0.7'){
        $pet_care_zone_theme_css .='.slider-box img{';
            $pet_care_zone_theme_css .='opacity:0.7';
        $pet_care_zone_theme_css .='}';
        }else if($pet_care_zone_slider_img_opacity == '0.8'){
        $pet_care_zone_theme_css .='.slider-box img{';
            $pet_care_zone_theme_css .='opacity:0.8';
        $pet_care_zone_theme_css .='}';
        }else if($pet_care_zone_slider_img_opacity == '0.9'){
        $pet_care_zone_theme_css .='.slider-box img{';
            $pet_care_zone_theme_css .='opacity:0.9';
        $pet_care_zone_theme_css .='}';
        }

    /*--------------------------- Woocommerce Product Sale Positions -------------------*/

    $pet_care_zone_product_sale = get_theme_mod( 'pet_care_zone_woocommerce_product_sale','Right');
    if($pet_care_zone_product_sale == 'Right'){
        $pet_care_zone_theme_css .='.woocommerce ul.products li.product .onsale{';
            $pet_care_zone_theme_css .='left: auto; right: 15px;';
        $pet_care_zone_theme_css .='}';
    }else if($pet_care_zone_product_sale == 'Left'){
        $pet_care_zone_theme_css .='.woocommerce ul.products li.product .onsale{';
            $pet_care_zone_theme_css .='left: 15px; right: auto;';
        $pet_care_zone_theme_css .='}';
    }else if($pet_care_zone_product_sale == 'Center'){
        $pet_care_zone_theme_css .='.woocommerce ul.products li.product .onsale{';
            $pet_care_zone_theme_css .='right: 50%;left: 50%;';
        $pet_care_zone_theme_css .='}';
    }

    /*---------------------------Slider Height ------------*/

    $pet_care_zone_slider_img_height = get_theme_mod('pet_care_zone_slider_img_height');
    if($pet_care_zone_slider_img_height != false){
        $pet_care_zone_theme_css .='#top-slider .owl-carousel .owl-item img{';
            $pet_care_zone_theme_css .='height: '.esc_attr($pet_care_zone_slider_img_height).';';
        $pet_care_zone_theme_css .='}';
    }

    /*--------------------------- Footer background image -------------------*/

    $pet_care_zone_footer_bg_image = get_theme_mod('pet_care_zone_footer_bg_image');
    if($pet_care_zone_footer_bg_image != false){
        $pet_care_zone_theme_css .='#colophon{';
            $pet_care_zone_theme_css .='background: url('.esc_attr($pet_care_zone_footer_bg_image).')!important;';
        $pet_care_zone_theme_css .='}';
    }