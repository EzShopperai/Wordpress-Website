<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

// Layout class
if ( SasbyTheme::$layout == 'full-width' ) {
	$sasby_layout_class = 'col-sm-12 col-12';
}
else{
	$sasby_layout_class = SasbyTheme_Helper::has_active_widget();
}

$iso						= 'g-4 no-equal-gallery';

if ( SasbyTheme::$options['portfolio_archive_style'] == 'style1' ){
	$portfolio_archive_layout 	= "rt-portfolio-default rt-portfolio-multi-layout-1";
	$template 				 	= 'portfolio-1';
}elseif( SasbyTheme::$options['portfolio_archive_style'] == 'style2' ){
	$portfolio_archive_layout 	= "rt-portfolio-default rt-portfolio-multi-layout-2";
	$template 				 	= 'portfolio-2';
}elseif( SasbyTheme::$options['portfolio_archive_style'] == 'style3' ){
	$portfolio_archive_layout 	= "rt-portfolio-default rt-portfolio-multi-layout-3";
	$template 				 	= 'portfolio-3';
}else{
	$portfolio_archive_layout 	= "rt-portfolio-default rt-portfolio-multi-layout-1";
	$template 				 	= 'portfolio-1';
}

$post_classes = "";
if (  SasbyTheme::$layout == 'right-sidebar' || SasbyTheme::$layout == 'left-sidebar' ){
	$post_classes = 'col-sm-6 col-md-6';
} else {
	$post_classes = 'col-lg-4 col-md-6';
}

?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">	
		<div class="row">
			<?php
				if ( SasbyTheme::$layout == 'left-sidebar' ) {
					get_sidebar();
				}
			?>
			<div class="<?php echo esc_attr( $portfolio_archive_layout );?> <?php echo esc_attr( $sasby_layout_class );?>">
				<main id="main" class="site-main">	
					<?php if ( have_posts() ) : ?>
						<div class="row <?php echo esc_attr( $iso );?>">
							<?php while ( have_posts() ) : the_post(); ?>
								<div class="<?php echo esc_attr( $post_classes );?>">
									<?php get_template_part( 'template-parts/content', $template ); ?>
								</div>
							<?php endwhile; ?>
						</div>
					<?php SasbyTheme_Helper::pagination(); ?>	
					<?php else:?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php endif;?>
				</main>
			</div>
			<?php
				if( SasbyTheme::$layout == 'right-sidebar' ){				
					get_sidebar();
				}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>