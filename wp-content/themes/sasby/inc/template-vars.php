<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use Rtcl\Helpers\Functions;

add_action( 'template_redirect', 'sasby_template_vars' );
if( !function_exists( 'sasby_template_vars' ) ) {
    function sasby_template_vars() {
        // Single Pages
        if( is_single() || is_page() ) {
            $post_type = get_post_type();
            $post_id   = get_the_id();
            switch( $post_type ) {
                case 'page':
                $prefix = 'page';
                break;
                case 'product':
                $prefix = 'product';
                break;
                default:
                $prefix = 'single_post';
                break;              
                case 'sasby_team':
                $prefix = 'team';
                break;
                case 'sasby_service':
                $prefix = 'service';
                break;        
                case 'sasby_portfolio':
                $prefix = 'portfolio';
                break; 
            }
			
			$layout_settings    = get_post_meta( $post_id, 'sasby_layout_settings', true );
			$portfolio_settings    = get_post_meta( $post_id, 'sasby_portfolio_style', true );

            
            SasbyTheme::$layout = ( empty( $layout_settings['sasby_layout'] ) || $layout_settings['sasby_layout']  == 'default' ) ? SasbyTheme::$options[$prefix . '_layout'] : $layout_settings['sasby_layout'];
            SasbyTheme::$sidebar = ( empty( $layout_settings['sasby_sidebar'] ) || $layout_settings['sasby_sidebar'] == 'default' ) ? SasbyTheme::$options[$prefix . '_sidebar'] : $layout_settings['sasby_sidebar'];
            SasbyTheme::$top_bar = ( empty( $layout_settings['sasby_top_bar'] ) || $layout_settings['sasby_top_bar'] == 'default' ) ? SasbyTheme::$options['top_bar'] : $layout_settings['sasby_top_bar'];
            SasbyTheme::$top_bar_style = ( empty( $layout_settings['sasby_top_bar_style'] ) || $layout_settings['sasby_top_bar_style'] == 'default' ) ? SasbyTheme::$options['top_bar_style'] : $layout_settings['sasby_top_bar_style'];
			SasbyTheme::$header_opt = ( empty( $layout_settings['sasby_header_opt'] ) || $layout_settings['sasby_header_opt'] == 'default' ) ? SasbyTheme::$options['header_opt'] : $layout_settings['sasby_header_opt'];
            SasbyTheme::$tr_header = ( empty( $layout_settings['sasby_tr_header'] ) || $layout_settings['sasby_tr_header'] == 'default' ) ? SasbyTheme::$options['tr_header'] : $layout_settings['sasby_tr_header'];
            SasbyTheme::$header_style = ( empty( $layout_settings['sasby_header'] ) || $layout_settings['sasby_header'] == 'default' ) ? SasbyTheme::$options['header_style'] : $layout_settings['sasby_header'];
            SasbyTheme::$footer_cta = (empty($layout_settings['sasby_footer_cta']) || $layout_settings['sasby_footer_cta'] == 'default') ? SasbyTheme::$options['footer_cta_area'] : $layout_settings['sasby_footer_cta'];
            SasbyTheme::$footer_style = ( empty( $layout_settings['sasby_footer'] ) || $layout_settings['sasby_footer'] == 'default' ) ? SasbyTheme::$options['footer_style'] : $layout_settings['sasby_footer'];

			SasbyTheme::$portfolio_single_style = ( empty( $portfolio_settings ) || $portfolio_settings == 'default' ) ? SasbyTheme::$options['portfolio_single_style'] : $portfolio_settings;

			SasbyTheme::$footer_area = ( empty( $layout_settings['sasby_footer_area'] ) || $layout_settings['sasby_footer_area'] == 'default' ) ? SasbyTheme::$options['footer_area'] : $layout_settings['sasby_footer_area'];
            SasbyTheme::$copyright_area = ( empty( $layout_settings['sasby_copyright_area'] ) || $layout_settings['sasby_copyright_area'] == 'default' ) ? SasbyTheme::$options['copyright_area'] : $layout_settings['sasby_copyright_area'];
            $padding_top = ( empty( $layout_settings['sasby_top_padding'] ) || $layout_settings['sasby_top_padding'] == 'default' ) ? SasbyTheme::$options[$prefix . '_padding_top'] : $layout_settings['sasby_top_padding'];
            SasbyTheme::$padding_top = (int) $padding_top;
            $padding_bottom = ( empty( $layout_settings['sasby_bottom_padding'] ) || $layout_settings['sasby_bottom_padding'] == 'default' ) ? SasbyTheme::$options[$prefix . '_padding_bottom'] : $layout_settings['sasby_bottom_padding'];
            SasbyTheme::$padding_bottom = (int) $padding_bottom;
            SasbyTheme::$has_banner = ( empty( $layout_settings['sasby_banner'] ) || $layout_settings['sasby_banner'] == 'default' ) ? SasbyTheme::$options[$prefix . '_banner'] : $layout_settings['sasby_banner'];
            SasbyTheme::$has_breadcrumb = ( empty( $layout_settings['sasby_breadcrumb'] ) || $layout_settings['sasby_breadcrumb'] == 'default' ) ? SasbyTheme::$options[ $prefix . '_breadcrumb'] : $layout_settings['sasby_breadcrumb'];
            SasbyTheme::$bgtype = ( empty( $layout_settings['sasby_banner_type'] ) || $layout_settings['sasby_banner_type'] == 'default' ) ? SasbyTheme::$options[$prefix . '_bgtype'] : $layout_settings['sasby_banner_type'];
            SasbyTheme::$bgcolor = empty( $layout_settings['sasby_banner_bgcolor'] ) ? SasbyTheme::$options[$prefix . '_bgcolor'] : $layout_settings['sasby_banner_bgcolor'];

            SasbyTheme::$header_width = (empty($layout_settings['sasby_header_width']) || $layout_settings['sasby_header_width'] == 'default') ? SasbyTheme::$options['header_width'] : $layout_settings['sasby_header_width'];
			
			if( !empty( $layout_settings['sasby_banner_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( $layout_settings['sasby_banner_bgimg'], 'full', true );
                SasbyTheme::$bgimg = $attch_url[0];
            } elseif( !empty( SasbyTheme::$options[$prefix . '_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( SasbyTheme::$options[$prefix . '_bgimg'], 'full', true );
                SasbyTheme::$bgimg = $attch_url[0];
            } else {
                SasbyTheme::$bgimg = SASBY_ASSETS_URL . 'img/banner.jpg';
            }
			
            SasbyTheme::$pagebgcolor = empty( $layout_settings['sasby_page_bgcolor'] ) ? SasbyTheme::$options[$prefix . '_page_bgcolor'] : $layout_settings['sasby_page_bgcolor'];			
            
            if( !empty( $layout_settings['sasby_page_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( $layout_settings['sasby_page_bgimg'], 'full', true );
                SasbyTheme::$pagebgimg = $attch_url[0];
            } elseif( !empty( SasbyTheme::$options[$prefix . '_page_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( SasbyTheme::$options[$prefix . '_page_bgimg'], 'full', true );
                SasbyTheme::$pagebgimg = $attch_url[0];
            }

        }
        
        // Blog and Archive
        elseif( is_home() || is_archive() || is_search() || is_404() ) {
            if( is_search() ) {
                $prefix = 'search';
            } else if( is_404() ) {
                $prefix                                = 'error';
                SasbyTheme::$options[$prefix . '_layout'] = 'full-width';
            } elseif( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
                $prefix = 'shop';
            } elseif( is_post_type_archive( "sasby_team" ) || is_tax( "sasby_team_category" ) ) {
                $prefix = 'team_archive'; 
            } elseif( is_post_type_archive( "sasby_service" ) || is_tax( "sasby_service_category" ) ) {
                $prefix = 'service_archive';            
            } elseif( is_post_type_archive( "sasby_portfolio" ) || is_tax( "sasby_portfolio_category" ) ) {
                $prefix = 'portfolio_archive'; 
            } else {
                $prefix = 'blog';
            }
            
            SasbyTheme::$layout         		= SasbyTheme::$options[$prefix . '_layout'];
            SasbyTheme::$top_bar        		= SasbyTheme::$options['top_bar'];
            SasbyTheme::$header_opt      	    = SasbyTheme::$options['header_opt'];
            SasbyTheme::$tr_header              = SasbyTheme::$options['tr_header'];
            SasbyTheme::$footer_area     	    = SasbyTheme::$options['footer_area'];
            SasbyTheme::$copyright_area         = SasbyTheme::$options['copyright_area'];
            SasbyTheme::$top_bar_style  		= SasbyTheme::$options['top_bar_style'];
            SasbyTheme::$header_style   		= SasbyTheme::$options['header_style'];
            SasbyTheme::$footer_cta             = SasbyTheme::$options['footer_cta_area'];
            SasbyTheme::$footer_style   		= SasbyTheme::$options['footer_style'];
            SasbyTheme::$portfolio_single_style = SasbyTheme::$options['portfolio_single_style'];
            SasbyTheme::$padding_top    		= SasbyTheme::$options[$prefix . '_padding_top'];
            SasbyTheme::$padding_bottom 		= SasbyTheme::$options[$prefix . '_padding_bottom'];
            SasbyTheme::$has_banner     		= SasbyTheme::$options[$prefix . '_banner'];
            SasbyTheme::$has_breadcrumb 		= SasbyTheme::$options[$prefix . '_breadcrumb'];
            SasbyTheme::$bgtype         		= SasbyTheme::$options[$prefix . '_bgtype'];
            SasbyTheme::$bgcolor        		= SasbyTheme::$options[$prefix . '_bgcolor'];
			
            if( !empty( SasbyTheme::$options[$prefix . '_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( SasbyTheme::$options[$prefix . '_bgimg'], 'full', true );
                SasbyTheme::$bgimg = $attch_url[0];
            } else {
                SasbyTheme::$bgimg = SASBY_ASSETS_URL . 'img/banner.jpg';
            }
			
            SasbyTheme::$pagebgcolor = SasbyTheme::$options[$prefix . '_page_bgcolor'];
            if( !empty( SasbyTheme::$options[$prefix . '_page_bgimg'] ) ) {
                $attch_url      = wp_get_attachment_image_src( SasbyTheme::$options[$prefix . '_page_bgimg'], 'full', true );
                SasbyTheme::$pagebgimg = $attch_url[0];
            }
			
			
        }
    }
}

// Add body class
add_filter( 'body_class', 'sasby_body_classes' );
if( !function_exists( 'sasby_body_classes' ) ) {
    function sasby_body_classes( $classes ) {
		
		// Header
    	if ( SasbyTheme::$options['sticky_menu'] == 1 ) {
			$classes[] = 'sticky-header';
		}

        if ( SasbyTheme::$tr_header === 1 || SasbyTheme::$tr_header === "on" ){
           $classes[] = 'tr-header';
        }
		
        $classes[] = 'header-style-'. SasbyTheme::$header_style;		
        $classes[] = 'footer-style-'. SasbyTheme::$footer_style;

        if ( SasbyTheme::$top_bar == 1 || SasbyTheme::$top_bar == 'on' ){
            $classes[] = 'has-topbar topbar-style-'. SasbyTheme::$top_bar_style;
        }
        
        $classes[] = ( SasbyTheme::$layout == 'full-width' ) ? 'no-sidebar' : 'has-sidebar';
		
		$classes[] = ( SasbyTheme::$layout == 'left-sidebar' ) ? 'left-sidebar' : 'right-sidebar';
        
		if ( is_singular('post') ) {
			$classes[] =  ' post-detail-' . SasbyTheme::$options['post_style'];
        }
        return $classes;
    }
}