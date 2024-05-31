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
$sasby_is_post_archive = is_home() || ( is_archive() && get_post_type() == 'post' ) ? true : false;

if ( is_post_type_archive( "sasby_team" ) || is_tax( "sasby_team_category" ) ) {
		get_template_part( 'template-parts/archive', 'team' );
	return;
}
if ( is_post_type_archive( "sasby_service" ) || is_tax( "sasby_service_category" ) ) {
		get_template_part( 'template-parts/archive', 'service' );
	return;
}
if ( is_post_type_archive( "sasby_portfolio" ) || is_tax( "sasby_portfolio_category" ) ) {
		get_template_part( 'template-parts/archive', 'portfolio' );
	return;
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
			<div class="<?php echo esc_attr( $sasby_layout_class );?>">
				<main id="main" class="site-main">
					<div class="rt-sidebar-sapcer">
					<?php
					if ( have_posts() ) { ?>
						<?php
						if ( $sasby_is_post_archive && SasbyTheme::$options['blog_style'] == 'style1' ) {
							echo '<div class="loadmore-items">';
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-1', get_post_format() );
							endwhile;
							echo '</div>';
						} else if ( $sasby_is_post_archive && SasbyTheme::$options['blog_style'] == 'style2' ) {
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-2', get_post_format() );
							endwhile;
						} else if ( $sasby_is_post_archive && SasbyTheme::$options['blog_style'] == 'style3' ) {
							echo '<div class="row g-4 rt-masonry-grid">';
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-3', get_post_format() );
							endwhile;
							echo '</div>';
						} else if ( class_exists( 'Sasby_Core' ) ) {
							if ( is_tax( 'sasby_portfolio_category' ) ) {
								echo '<div class="row rt-masonry-grid">';
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content-1', get_post_format() );
								endwhile;
								echo '</div>';
							}							
						}
						else {
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content-1', get_post_format() );
							endwhile;
						}
						?>

						<?php if( SasbyTheme::$options['blog_loadmore'] == 'loadmore' && SasbyTheme::$options['blog_style'] == 'style1' ) { ?> 
							<div class="text-center blog-loadmore">
						      	<a href="#" id="loadMore" class="loadMore"><?php esc_html_e( 'Load More', 'sasby' ) ?></a>
						    </div> 
						<?php } else { ?>
							<?php SasbyTheme_Helper::pagination(); ?>
						<?php } ?>  

					<?php } else {?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php } ?>
					</div>					
				</main>
			</div>
			<?php
			if( SasbyTheme::$layout == 'right-sidebar' ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>