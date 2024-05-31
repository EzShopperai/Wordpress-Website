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
	$sasby_layout_class = 'col-xl-8';
}
$sasby_is_post_archive = is_home() || ( is_archive() && get_post_type() == 'post' ) ? true : false;

$sasby_author_bio      = get_the_author_meta( 'description' );
$subtitle = get_post_meta( get_the_ID(), 'sasby_subtitle', true );
$author = $post->post_author;

$news_author_fb = get_user_meta( $author, 'sasby_facebook', true );
$news_author_tw = get_user_meta( $author, 'sasby_twitter', true );
$news_author_ld = get_user_meta( $author, 'sasby_linkedin', true );
$news_author_pr = get_user_meta( $author, 'sasby_pinterest', true );
$news_author_ins = get_user_meta( $author, 'sasby_instagram', true );
$news_author_tik = get_user_meta( $author, 'sasby_tiktok', true );
$sasby_author_designation = get_user_meta( $author, 'sasby_author_designation', true );


?>
<?php get_header(); ?>
<div id="primary" class="content-area">
	<!-- author bio -->
	<?php if ( SasbyTheme::$options['post_author_bio'] == '1' ) { ?>
	<div class="author-banner">
		<div class="container">			
			<?php if ( !empty ( $sasby_author_bio ) ) { ?>
			<div class="admin-author">
				<div class="author-img">
					<?php echo get_avatar( $author, 100 ); ?>
				</div>
				<div class="author-content">
					<div class="about-author-info">
						<h2 class="author-title"><?php the_author_posts_link();?></h2>
						<div class="author-designation"><?php if ( !empty ( $sasby_author_designation ) ) {	echo esc_html( $sasby_author_designation ); } else {	$user_info = get_userdata( $author ); echo esc_html ( implode( ', ', $user_info->roles ) );	} ?></div>
					</div>
					<?php if ( $sasby_author_bio ) { ?>
						<div class="author-bio"><?php echo esc_html( $sasby_author_bio );?></div>
					<?php } ?>
					<ul class="author-box-social">
						<?php if ( ! empty( $news_author_fb ) ){ ?><li><a href="<?php echo esc_url( $news_author_fb ); ?>"><i class="fab fa-facebook-f"></i></a></li><?php } ?>
						<?php if ( ! empty( $news_author_tw ) ){ ?><li><a href="<?php echo esc_url( $news_author_tw ); ?>"><i class="fab fa-x-twitter"></i></a></li><?php } ?>
						<?php if ( ! empty( $news_author_ld ) ){ ?><li><a href="<?php echo esc_url( $news_author_ld ); ?>"><i class="fab fa-linkedin-in"></i></a></li><?php } ?>
						<?php if ( ! empty( $news_author_pr ) ){ ?><li><a href="<?php echo esc_url( $news_author_pr ); ?>"><i class="fab fa-pinterest-p"></i></a></li><?php } ?>
						<?php if ( ! empty( $news_author_ins ) ){ ?><li><a href="<?php echo esc_url( $news_author_ins ); ?>"><i class="fab fa-instagram"></i></a></li><?php } ?>
						<?php if ( ! empty( $news_author_tik ) ){ ?><li><a href="<?php echo esc_url( $news_author_tik ); ?>"><i class="fab fa-tiktok"></i></a></li><?php } ?>
					</ul>
				</div>				
			</div>
			<?php } ?>
		</div>	
	</div>		
	<?php } ?>

	<div class="container">
		<div class="row">
			<?php if ( SasbyTheme::$layout == 'left-sidebar' ) { get_sidebar(); } ?>
			<div class="<?php echo esc_attr( $sasby_layout_class );?>">
				<main id="main" class="site-main">	
					<div class="rt-sidebar-sapcer">				
					<?php if ( have_posts() ) : ?>
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
						<div class="mt50"><?php SasbyTheme_Helper::pagination();?></div>
					<?php else: ?>
						<?php get_template_part( 'template-parts/content', 'none' );?>
					<?php endif;?>
					</div>
				</main>					
			</div>
			<?php
			if ( SasbyTheme::$layout == 'right-sidebar' ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>