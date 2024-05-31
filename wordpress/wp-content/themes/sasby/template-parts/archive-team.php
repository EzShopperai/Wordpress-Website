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
$iso = 'g-4 no-equal-team';

if ( SasbyTheme::$options['team_archive_style'] == 'style1' ){
	$team_archive_layout 		= "rt-team-default rt-team-multi-layout-1";
	$template 				 	= 'team-1';
}elseif( SasbyTheme::$options['team_archive_style'] == 'style2' ){
	$team_archive_layout 		= "rt-team-default rt-team-multi-layout-1";
	$template 				 	= 'team-2';
}else{
	$team_archive_layout 		= "rt-team-default rt-team-multi-layout-1";
	$template 				 	= 'team-1';
}

$post_classes = "";
if (  SasbyTheme::$layout == 'right-sidebar' || SasbyTheme::$layout == 'left-sidebar' ){
	$post_classes = 'col-sm-6 col-lg-4';
} else {
	$post_classes = 'col-sm-6 col-xl-4 col-lg-4';
} ?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">	
		<div class="row">
			<?php
				if ( SasbyTheme::$layout == 'left-sidebar' ) {
					get_sidebar();
				}
			?>
			<div class="rt-team-default rt-team-multi-layout-1 <?php echo esc_attr( $sasby_layout_class );?>">
				<main id="main" class="site-main">	
					<?php if ( have_posts() ) : ?>
						<div class="row <?php echo esc_attr( $iso );?>">
							<?php while ( have_posts() ) : the_post(); ?>
								<div class="<?php echo esc_attr( $post_classes );?>">
									<?php get_template_part( 'template-parts/content', 'team-1' ); ?>
								</div>
							<?php endwhile; ?>
						</div>
					<?php else:?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php endif;?>
					<?php SasbyTheme_Helper::pagination(); ?>	
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
