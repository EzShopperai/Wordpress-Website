<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'sasby-size2';

$sasby_has_entry_meta  = ( SasbyTheme::$options['blog_date'] || SasbyTheme::$options['blog_author_name'] || SasbyTheme::$options['blog_comment_num'] || SasbyTheme::$options['blog_length'] && function_exists( 'sasby_reading_time' ) || SasbyTheme::$options['blog_view'] && function_exists( 'sasby_views' ) ) ? true : false;

$sasby_time_html       = sprintf( '<span>%s</span><span>%s</span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );
$sasby_time_html       = apply_filters( 'sasby_single_time', $sasby_time_html );

$sasby_comments_number = number_format_i18n( get_comments_number() );
$sasby_comments_html = $sasby_comments_number == 1 ? esc_html__( 'Comment' , 'sasby' ) : esc_html__( 'Comments' , 'sasby' );
$sasby_comments_html = '<span class="comment-number">'. $sasby_comments_number .'</span> ' . $sasby_comments_html;

$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), SasbyTheme::$options['post_content_limit'], '.' );

$wow = SasbyTheme::$options['blog_animation'];
$effect = SasbyTheme::$options['blog_animation_effect'];

$youtube_link = get_post_meta( get_the_ID(), 'sasby_youtube_link', true );

$img_class = empty(has_post_thumbnail() ) ? 'no-image' : 'show-image';
$preview = SasbyTheme::$options['display_no_preview_image'] == '1' ? 'show-preview' : 'no-preview';

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-layout-2 ' . $wow . ' ' . $effect ); ?> data-wow-duration="1.5s">
	<div class="blog-box <?php echo esc_attr($img_class); ?> <?php echo esc_attr($preview); ?>">
		<div class="blog-img-holder">
			<div class="blog-img">
				<?php
				$swiper_data=array(
					'slidesPerView' 	=>1,
					'centeredSlides'	=>false,
					'loop'				=>true,
					'spaceBetween'		=>20,
					'slideToClickedSlide' =>true,
					'slidesPerGroup' => 1,
					'autoplay'				=>array(
						'delay'  => 1,
					),
					'speed'      =>500,
					'breakpoints' =>array(
						'0'    =>array('slidesPerView' =>1),
						'576'    =>array('slidesPerView' =>1),
						'768'    =>array('slidesPerView' =>1),
						'992'    =>array('slidesPerView' =>1),
						'1200'    =>array('slidesPerView' =>1),				
						'1600'    =>array('slidesPerView' =>1)				
					),
					'auto'   =>false
				);

				$swiper_data = json_encode( $swiper_data );
				$sasby_post_gallerys_raw = get_post_meta( get_the_ID(), 'sasby_post_gallery', true );
				$sasby_post_gallerys = explode( "," , $sasby_post_gallerys_raw );
					if ( !empty( $sasby_post_gallerys_raw ) && 'gallery' == get_post_format( $id ) ) { ?>
						<div class="rt-swiper-slider single-post-slider rt-swiper-nav" data-xld = '<?php echo esc_attr( $swiper_data ); ?>'>
							<div class="swiper-wrapper">
								<?php foreach( $sasby_post_gallerys as $sasby_posts_gallery ) { ?>
								<div class="swiper-slide">
									<?php echo wp_get_attachment_image( $sasby_posts_gallery, $thumb_size, "", array( "class" => "img-responsive" ) );
									?>
								</div>
								<?php } ?>
							</div>
							<div class="swiper-navigation">
					            <div class="swiper-button-prev"><i class="icon-sasby-left-arrow"></i><?php echo esc_html__( 'Prev' , 'sasby' ) ?></div>
					            <div class="swiper-button-next"><?php echo esc_html__( 'Next' , 'sasby' ) ?><i class="icon-sasby-right-arrow"></i></div>
					        </div>
						</div>
					<?php } else { ?>
					<?php if ( SasbyTheme::$options['blog_video'] && ( 'video' == get_post_format( $id ) && !empty( $youtube_link ) ) && ( !empty( has_post_thumbnail() ) ) ) { ?>
							<div class="rt-video"><a class="rt-play play-btn-white rt-video-popup" href="<?php echo esc_url( $youtube_link );?>"><i class="fas fa-play"></i></a></div>
						<?php } ?>
						<a href="<?php the_permalink(); ?>" class="img-opacity-hover"><?php if ( has_post_thumbnail() ) { ?>
							<?php the_post_thumbnail( $thumb_size, ['class' => 'img-responsive'] ); ?>
							<?php } else {
								if ( SasbyTheme::$options['display_no_preview_image'] == '1' ) {
									if ( !empty( SasbyTheme::$options['no_preview_image']['id'] ) ) {
										$thumbnail = wp_get_attachment_image( SasbyTheme::$options['no_preview_image']['id'], $thumb_size );						
									}
									elseif ( empty( SasbyTheme::$options['no_preview_image']['id'] ) ) {
										$thumbnail = '<img class="wp-post-image" src="'.SASBY_ASSETS_URL.'img/noimage_960X520.jpg" alt="'. the_title_attribute( array( 'echo'=> false ) ) .'">';
									}
									echo wp_kses( $thumbnail , 'alltext_allow' );
								}
							}
						?>
						</a>
				<?php } ?>
			</div>				
		</div>
		<div class="entry-content">
			<?php if ( SasbyTheme::$options['blog_video'] && ( 'video' == get_post_format( $id ) && !empty( $youtube_link ) ) && ( empty( has_post_thumbnail() ) ) ) { ?>
				<div class="rt-video"><a class="rt-play play-btn-white rt-video-popup" href="<?php echo esc_url( $youtube_link );?>"><i class="fas fa-play"></i></a></div>
			<?php } ?>
			<?php if ( $sasby_has_entry_meta ) { ?>
			<ul class="entry-meta">
				<?php if ( SasbyTheme::$options['blog_author_name'] ) { ?>
				<li class="post-author"><i class="icon-sasby-user"></i><?php esc_html_e( 'by ', 'sasby' );?><?php the_author_posts_link(); ?></li>
				<?php } if ( SasbyTheme::$options['blog_cats'] ) { ?>
				<li class="entry-categories"><i class="icon-sasby-tags"></i><?php echo the_category( ', ' );?></li>
				<?php } if ( SasbyTheme::$options['blog_date'] ) { ?>	
				<li class="post-date"><i class="icon-sasby-calendar"></i><?php echo get_the_date(); ?></li>				
				<?php } if ( SasbyTheme::$options['blog_comment_num'] ) { ?>
				<li class="post-comment"><i class="icon-sasby-comment"></i><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo wp_kses( $sasby_comments_html , 'alltext_allow' );?></a></li>
				<?php } if ( SasbyTheme::$options['blog_length'] && function_exists( 'sasby_reading_time' ) ) { ?>
				<li class="post-reading-time meta-item"><i class="icon-sasby-time"></i><?php echo sasby_reading_time(); ?></li>
				<?php } if ( SasbyTheme::$options['blog_view'] && function_exists( 'sasby_views' ) ) { ?>
				<li><i class="fa-regular fa-eye"></i><span class="post-views"><?php echo sasby_views(); ?></span></li>
				<?php } ?>
			</ul>
			<?php } ?>
			<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			<?php if ( SasbyTheme::$options['blog_content'] ) { ?>
			<div class="entry-text"><p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p></div>
			<?php } ?>	
			<?php if ( SasbyTheme::$options['blog_read_more'] ) { ?>
			<div class="post-read-more"><a class="button-style-3 btn-common" href="<?php the_permalink();?>"><?php esc_html_e( 'Continue Reading', 'sasby' );?></a>
          	</div>	
          	<?php } ?>
		</div>
	</div>
</div>