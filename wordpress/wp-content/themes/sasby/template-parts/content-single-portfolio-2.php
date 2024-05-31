<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'sasby-size2';

global $post;
$sasby_project_title 		= get_post_meta( $post->ID, 'sasby_project_title', true );
$sasby_project_text 			= get_post_meta( $post->ID, 'sasby_project_text', true );
$sasby_project_client 		= get_post_meta( $post->ID, 'sasby_project_client', true );
$sasby_project_start 		= get_post_meta( $post->ID, 'sasby_project_start', true );
$sasby_project_end 			= get_post_meta( $post->ID, 'sasby_project_end', true );
$sasby_project_web 			= get_post_meta( $post->ID, 'sasby_project_web', true );
$sasby_portfolio_gallerys 			= get_post_meta( $post->ID, 'sasby_portfolio_gallery', true );
$ratting	 	= get_post_meta( $id, 'sasby_project_rating', true );
$portfolio_rating = 5- intval( $ratting ) ;

?>
<div id="post-<?php the_ID();?>" <?php post_class( 'portfolio-single' );?>>	
	<div class="portfolio-single-content porfolio-style2">
		<div class="row">
			<div class="col-12">
				<div class="portfolio-info ">
					<?php if ( !empty( $sasby_project_title ) ) { ?>
						<div class="rt-section-title style3 has-animation">
							<h3 class="entry-title"><?php echo esc_html( $sasby_project_title );?></h3>
						</div>
					<?php } if ( !empty( $sasby_project_text ) ) { ?>
					<p><?php echo esc_html( $sasby_project_text );?></p>
					<?php } ?>
					<ul class="info-list info-list2">
						<?php if( SasbyTheme::$options['single_portfolio_cat'] ) { ?>
						<li><label><?php esc_html_e( 'Category', 'sasby' );?>: </label>
							<span class="portfolio-cat"><?php
								$i = 1;
								$term_lists = get_the_terms( get_the_ID(), 'sasby_portfolio_category' );
								if( $term_lists ) {
								foreach ( $term_lists as $term_list ){ 
								$link = get_term_link( $term_list->term_id, 'sasby_portfolio_category' ); ?><?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; } } ?>
							</span>
						</li>
						<?php } ?>
						<?php if ( !empty( $sasby_project_client ) && SasbyTheme::$options['single_portfolio_client'] ) { ?>
						<li><label><?php esc_html_e( 'Client', 'sasby' );?>: </label><?php echo esc_html( $sasby_project_client );?></li>
						<?php } if ( !empty( $sasby_project_start ) && SasbyTheme::$options['single_portfolio_startdate'] ) { ?>
						<li><label><?php esc_html_e( 'Starts On', 'sasby' );?>: </label><?php echo esc_html( $sasby_project_start );?></li>
						<?php } if ( !empty( $sasby_project_end ) && SasbyTheme::$options['single_portfolio_enddate'] ) { ?>
						<li><label><?php esc_html_e( 'Ends On', 'sasby' );?>: </label><?php echo esc_html( $sasby_project_end );?></li>
						<?php } if ( !empty( $sasby_project_web ) && SasbyTheme::$options['single_portfolio_weblink'] ) { ?>
						<li class="website"><label><?php esc_html_e( 'Web Link', 'sasby' );?>: </label><?php echo esc_html( $sasby_project_web );?></li>
						<?php } ?>
						<?php if( SasbyTheme::$options['single_portfolio_rating'] ) { ?>
						<?php if( $ratting != -1) { ?>
						<li class="rating"><label><?php esc_html_e( 'Rating', 'sasby' );?>: </label>
							<ul class="rating">
								<?php for ($i=0; $i < $ratting; $i++) { ?>
									<li class="star-rate"><i class="fa fa-star" aria-hidden="true"></i></li>
								<?php } ?>			
								<?php for ($i=0; $i < $portfolio_rating; $i++) { ?>
									<li><i class="fa fa-star" aria-hidden="true"></i></li>
								<?php } ?>
							</ul>
						</li>
					<?php } } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="portfolio-content">
			<?php the_content();?>
		</div>
	</div>	
</div>