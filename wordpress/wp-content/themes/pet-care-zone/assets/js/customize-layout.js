/*
** Scripts within the customizer controls window.
*/

(function( $ ) {
	wp.customize.bind( 'ready', function() {

	/*
	** Reusable Functions
	*/
		var optPrefix = '#customize-control-pet_care_zone_options-';
		
		// Label
		function pet_care_zone_customizer_label( id, title ) {

			// Colors

			if ( id === 'pet_care_zone_theme_color' || id === 'background_color' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Top Header

			if ( id === 'pet_care_zone_phone_icon' || id === 'pet_care_zone_email_icon' || id === 'pet_care_zone_topbar_text1' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'pet_care_zone_preloader_hide' || id === 'pet_care_zone_sticky_header' || id === 'pet_care_zone_scroll_hide' || id === 'pet_care_zone_products_per_row' || id === 'pet_care_zone_scroll_top_position' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Woocommerce product sale Setting

			if ( id === 'pet_care_zone_woocommerce_product_sale' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Social Icon

			if ( id === 'pet_care_zone_facebook_icon' || id === 'pet_care_zone_twitter_icon' || id === 'pet_care_zone_instagram_icon' || id === 'pet_care_zone_linkedin_icon' || id === 'pet_care_zone_pinterest_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Slider

			if ( id === 'pet_care_zone_top_slider_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
			// Featured Product

			if ( id === 'pet_care_zone_pet_product_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'pet_care_zone_footer_bg_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Post Setting

			if ( id === 'pet_care_zone_post_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Page Setting

			if ( id === 'pet_care_zone_single_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Setting

			if ( id === 'pet_care_zone_single_post_thumb' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Comment Setting

			if ( id === 'pet_care_zone_single_post_comment_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-pet_care_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}


	/*
	** Tabs
	*/

		// Colors
		pet_care_zone_customizer_label( 'pet_care_zone_theme_color', 'Theme Color' );
		pet_care_zone_customizer_label( 'background_color', 'Colors' );
		pet_care_zone_customizer_label( 'background_image', 'Image' );

		// Site Identity
		pet_care_zone_customizer_label( 'custom_logo', 'Logo Setup' );
		pet_care_zone_customizer_label( 'site_icon', 'Favicon' );

		// Top Header 
		pet_care_zone_customizer_label( 'pet_care_zone_phone_icon', 'Phone' );
		pet_care_zone_customizer_label( 'pet_care_zone_email_icon', 'Enail' );
		pet_care_zone_customizer_label( 'pet_care_zone_topbar_text1', 'Button' );

		// Single Post Setting
		pet_care_zone_customizer_label( 'pet_care_zone_single_post_thumb', 'Single Post Setting' );
		pet_care_zone_customizer_label( 'pet_care_zone_single_post_comment_title', 'Single Post Comment' );

		// General Setting
		pet_care_zone_customizer_label( 'pet_care_zone_preloader_hide', 'Preloader' );
		pet_care_zone_customizer_label( 'pet_care_zone_sticky_header', 'Sticky Header' );
		pet_care_zone_customizer_label( 'pet_care_zone_scroll_hide', 'Scroll To Top' );
		pet_care_zone_customizer_label( 'pet_care_zone_products_per_row', 'Woocommerce Setting' );
		pet_care_zone_customizer_label( 'pet_care_zone_scroll_top_position', 'Scroll to top Position' );
		pet_care_zone_customizer_label( 'pet_care_zone_woocommerce_product_sale', 'Woocommerce Product Sale Positions' );
		
		// Social Icon
		pet_care_zone_customizer_label( 'pet_care_zone_facebook_icon', 'Facebook' );
		pet_care_zone_customizer_label( 'pet_care_zone_twitter_icon', 'Twitter' );
		pet_care_zone_customizer_label( 'pet_care_zone_instagram_icon', 'Instagram' );
		pet_care_zone_customizer_label( 'pet_care_zone_linkedin_icon', 'Linkedin' );
		pet_care_zone_customizer_label( 'pet_care_zone_pinterest_icon', 'Pinterest' );

		//Slider
		pet_care_zone_customizer_label( 'pet_care_zone_top_slider_setting', 'Slider' );

		//Header Image
		pet_care_zone_customizer_label( 'header_image', 'Header Image' );

		//Featured Product
		pet_care_zone_customizer_label( 'pet_care_zone_pet_product_setting', 'Featured Product' );

		//Footer
		pet_care_zone_customizer_label( 'pet_care_zone_footer_bg_image', 'Footer' );

		//Post Setting
		pet_care_zone_customizer_label( 'pet_care_zone_post_page_title', 'Post Setting' );

		// Page Setting
		pet_care_zone_customizer_label( 'pet_care_zone_single_page_title', 'Page Setting' );
	

	}); // wp.customize ready

})( jQuery );
