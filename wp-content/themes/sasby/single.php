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
$sasby_has_entry_meta  = ( SasbyTheme::$options['post_date'] || SasbyTheme::$options['post_author_name'] || SasbyTheme::$options['post_comment_num'] || ( SasbyTheme::$options['post_length'] && function_exists( 'sasby_reading_time' ) ) || SasbyTheme::$options['post_published'] && function_exists( 'sasby_get_time' ) || ( SasbyTheme::$options['post_view'] && function_exists( 'sasby_views' ) ) ) ? true : false;

$sasby_comments_number = number_format_i18n( get_comments_number() );
$sasby_comments_html = $sasby_comments_number == 1 ? esc_html__( 'Comment' , 'sasby' ) : esc_html__( 'Comments' , 'sasby' );
$sasby_comments_html = '<span class="comment-number">'. $sasby_comments_number .'</span> '. $sasby_comments_html;
$sasby_author_bio = get_the_author_meta( 'description' );

$sasby_time_html       = sprintf( '<span>%s</span><span>%s</span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );
$sasby_time_html       = apply_filters( 'sasby_single_time', $sasby_time_html );
$youtube_link = get_post_meta( get_the_ID(), 'sasby_youtube_link', true );

if ( empty(has_post_thumbnail() ) ) {
	$img_class ='no-image';
}else {
	$img_class ='show-image';
}

?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<input type="hidden" id="sasby-cat-ids" value="<?php echo implode(',', wp_get_post_categories( get_the_ID(), array( 'fields' => 'ids' ) ) ); ?>">
	<?php if ( SasbyTheme::$options['post_style'] == 'style1' ) { ?>
		<div id="contentHolder">
			<div class="container">
				<div class="row">				
					<?php if ( SasbyTheme::$layout == 'left-sidebar' ) { get_sidebar(); } ?>
						<div class="<?php echo esc_attr( $sasby_layout_class );?>">
							<main id="main" class="site-main"> 
								<div class="rt-sidebar-sapcer <?php echo ( SasbyTheme::$options['scroll_post_enable'] == 1 ) ? esc_attr( 'ajax-scroll-post' ) : ''; ?>">
								<?php while ( have_posts() ) : the_post(); ?>
									<?php get_template_part( 'template-parts/content-single', get_post_format() );?>						
								<?php endwhile; ?> 
								</div> 
							</main>
						</div>
					<?php if ( SasbyTheme::$layout == 'right-sidebar' ) { get_sidebar(); }	?>
				</div>
			</div>
		</div>
	<?php } else if ( SasbyTheme::$options['post_style'] == 'style2' ) { ?>
	<div id="contentHolder">
		<div class="container">
			<div class="row">
				<?php if ( SasbyTheme::$layout == 'left-sidebar' ) { get_sidebar(); } ?>
					<div class="<?php echo esc_attr( $sasby_layout_class );?>">
						<main id="main" class="site-main">
							<div class="rt-sidebar-sapcer <?php echo ( SasbyTheme::$options['scroll_post_enable'] == 1 ) ? esc_attr( 'ajax-scroll-post' ) : ''; ?>">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'template-parts/content-single-2', get_post_format() );?>						
							<?php endwhile; ?>
							</div>
						</main>					
					</div>
				<?php if ( SasbyTheme::$layout == 'right-sidebar' ) { get_sidebar(); }	?>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<?php get_footer(); ?>