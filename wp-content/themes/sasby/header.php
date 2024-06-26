<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if( SasbyTheme::$options['image_blend'] == 'normal' ) {
	$blend = 'normal';
}else {
	$blend = 'blend';
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php
		// Preloader	
		if ( SasbyTheme::$options['preloader'] ) {	
			if( !empty( SasbyTheme::$options['preloader_image'] ) ) {
				$pre_bg = wp_get_attachment_image_src( SasbyTheme::$options['preloader_image'], 'full', true );
				$preloader_img = $pre_bg[0];
				echo '<div id="preloader" style="background-image:url(' . esc_url($preloader_img) . ');"></div>';
			}else { ?>				
				<div id="preloader" class="loader">
			      	<div class="cssload-loader">
				        <div class="cssload-inner cssload-one"></div>
				        <div class="cssload-inner cssload-two"></div>
				        <div class="cssload-inner cssload-three"></div>
			      	</div>
			    </div>
			<?php }	            
		}
	?>

	<?php if ( is_singular() && ( SasbyTheme::$options['scroll_indicator_enable'] == '1' ) && ( SasbyTheme::$options['scroll_indicator_position'] == 'top' ) ){ ?>
	<div class="sasby-progress-container">
		<div class="sasby-progress-bar" id="sasbyBar"></div>
	</div>
	<?php } ?>

	<?php 
        if( SasbyTheme::$header_style == 1 ){
            $page_class = 'main-homeOne';
        } else {
            $page_class = 'page';
        }
    ?>
	
	<div id="page" class="site <?php echo esc_attr( $page_class ); ?>">		
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sasby' ); ?></a>		
		<header id="masthead" class="site-header">
			<div id="header-<?php echo esc_attr( SasbyTheme::$header_style ); ?>" class="header-area">
				<?php if ( SasbyTheme::$top_bar == 1 || SasbyTheme::$top_bar === "on" ){ ?>			
				<?php get_template_part( 'template-parts/header/header-top', SasbyTheme::$top_bar_style ); ?>
				<?php } ?>
				<?php if ( SasbyTheme::$header_opt == 1 || SasbyTheme::$header_opt === "on" ){ ?>
				<?php get_template_part( 'template-parts/header/header', SasbyTheme::$header_style ); ?>
				<?php } ?>			
			</div>
		</header>		
		<?php get_template_part('template-parts/header/mobile', 'menu');?>
		<div id="header-search" class="header-search">
			<div class="header-search-wrap">
            <button type="button" aria-label="close button" class="close"><i class="fa-solid fa-xmark"></i></button>
            <form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_html_e( 'Type your search........', 'sasby' ); ?>">
                <button type="submit" aria-label="submit button" class="search-btn"><i class="icon-sasby-search"></i></button>
            </form>
            </div>
        </div>
		<?php if( ( SasbyTheme::$options['body_line_animate']  === 1 || SasbyTheme::$options['body_line_animate']  === 'on' ) && ( SasbyTheme::$header_style == 1 ) ) { ?>
		<div class="rt-horizontal-line">
			<div class="rt-horizontal-line__item"></div>
			<div class="rt-horizontal-line__item"></div>
			<div class="rt-horizontal-line__item"></div>
			<div class="rt-horizontal-line__item"></div>
			<div class="rt-horizontal-line__item"></div>
			<div class="rt-horizontal-line__item"></div>
			<div class="rt-horizontal-line__item"></div>
		</div>
		<?php } ?>

		<div id="content" class="site-content <?php echo esc_attr($blend); ?>">			
			<?php
				if ( SasbyTheme::$has_banner === 1 || SasbyTheme::$has_banner === "on" ) { 
					get_template_part('template-parts/content', 'banner');
				}
			?>
			