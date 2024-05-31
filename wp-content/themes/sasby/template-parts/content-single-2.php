<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$sasby_has_entry_meta  = ( SasbyTheme::$options['post_date'] || SasbyTheme::$options['post_author_name'] || SasbyTheme::$options['post_cats'] || SasbyTheme::$options['post_comment_num'] || ( SasbyTheme::$options['post_length'] && function_exists( 'sasby_reading_time' ) ) || SasbyTheme::$options['post_published'] && function_exists( 'sasby_get_time' ) || ( SasbyTheme::$options['post_view'] && function_exists( 'sasby_views' ) ) ) ? true : false;

$sasby_comments_number = number_format_i18n( get_comments_number() );
$sasby_comments_html = $sasby_comments_number == 1 ? esc_html__( 'Comment' , 'sasby' ) : esc_html__( 'Comments' , 'sasby' );
$sasby_comments_html = '<span class="comment-number">'. $sasby_comments_number .'</span> '. $sasby_comments_html;
$sasby_author_bio = get_the_author_meta( 'description' );

$sasby_time_html       = sprintf( '<span>%s</span><span>%s</span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );
$sasby_time_html       = apply_filters( 'sasby_single_time', $sasby_time_html );

$author = $post->post_author;

$news_author_fb = get_user_meta( $author, 'sasby_facebook', true );
$news_author_tw = get_user_meta( $author, 'sasby_twitter', true );
$news_author_ld = get_user_meta( $author, 'sasby_linkedin', true );
$news_author_pr = get_user_meta( $author, 'sasby_pinterest', true );
$news_author_ins = get_user_meta( $author, 'sasby_instagram', true );
$news_author_tik = get_user_meta( $author, 'sasby_tiktok', true );
$sasby_author_designation = get_user_meta( $author, 'sasby_author_designation', true );

$youtube_link = get_post_meta( get_the_ID(), 'sasby_youtube_link', true );

$img_class = empty(has_post_thumbnail() ) ? 'no-image' : 'show-image';

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
							<?php echo wp_get_attachment_image( $sasby_posts_gallery, 'full', "", array( "class" => "img-responsive" ) );
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
			<?php if ( has_post_thumbnail() && ( SasbyTheme::$options['post_featured_image'] == true ) ) { ?>
				<div class="entry-thumbnail-area <?php echo esc_attr($img_class); ?>">
					<?php if ( SasbyTheme::$options['post_featured_image'] == true ) { ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail( 'sasby-size1' , ['class' => 'img-responsive'] ); ?><?php } ?><?php } ?>
					<?php if ( ( 'video' == get_post_format( $id ) && !empty( $youtube_link ) ) ) { ?>
						<div class="rt-video"><a class="rt-play play-btn-white-lg rt-video-popup" href="<?php echo esc_url( $youtube_link );?>"><i class="fas fa-play"></i></a></div>
					<?php } ?>				
				</div>
			<?php } ?>
		<?php } ?>

	<div class="main-wrap">
		<div class="entry-header">
			<?php if ( $sasby_has_entry_meta ) { ?>
			<ul class="entry-meta">				
				<?php if ( SasbyTheme::$options['post_author_name'] ) { ?>
				<li class="item-author"><i class="icon-sasby-user"></i><?php esc_html_e( 'by ', 'sasby' );?><?php the_author_posts_link(); ?>
				</li>
				<?php } if ( SasbyTheme::$options['post_date'] ) { ?>	
				<li><i class="icon-sasby-calendar"></i><?php echo get_the_date(); ?></li>
				<?php } if ( SasbyTheme::$options['post_cats'] ) { ?>
				<li><i class="icon-sasby-tags"></i><?php echo the_category( ', ' );?></li>
				<?php } if ( SasbyTheme::$options['post_comment_num'] ) { ?>
				<li><i class="icon-sasby-comment"></i><?php echo wp_kses( $sasby_comments_html , 'alltext_allow' ); ?></li>
				<?php } if ( SasbyTheme::$options['post_length'] && function_exists( 'sasby_reading_time' ) ) { ?>
				<li class="meta-reading-time meta-item"><i class="icon-sasby-time"></i><?php echo sasby_reading_time(); ?></li>
				<?php } if ( SasbyTheme::$options['post_view'] && function_exists( 'sasby_views' ) ) { ?>
				<li><span class="meta-views meta-item "><i class="fa-regular fa-eye"></i><?php echo sasby_views(); ?></span></li>
				<?php } if ( SasbyTheme::$options['post_published'] && function_exists( 'sasby_get_time' ) ) { ?>	
				<li><i class="icon-sasby-calendar-alt"></i><?php echo sasby_get_time(); ?></li>
				<?php } ?>
			</ul>
			<?php } ?>
			<h2 class="entry-title"><?php the_title();?></h2>
		</div>
		<div class="entry-content rt-single-content"><?php the_content();?>
			<?php wp_link_pages( array(
				'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'sasby' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) ); ?>
		</div>
		<?php if ( ( SasbyTheme::$options['post_tags'] && has_tag() ) || ( SasbyTheme::$options['post_share']  && ( function_exists( 'sasby_post_share' ) ) ) ) { ?>
		<div class="entry-footer">
			<div class="entry-footer-meta">
				<?php if ( SasbyTheme::$options['post_tags'] && has_tag() ) { ?>
				<div class="meta-tags">
					<h4 class="meta-title"><?php esc_html_e( 'Tags:', 'sasby' );?></h4><?php echo get_the_term_list( $post->ID, 'post_tag', '' ); ?>
				</div>	
				<?php } if ( ( SasbyTheme::$options['post_share'] ) && ( function_exists( 'sasby_post_share' ) ) ) { ?>
				<div class="post-share"><h4 class="meta-title"><?php esc_html_e( 'Share:', 'sasby' );?></h4><?php sasby_post_share(); ?></div>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
		<!-- author bio -->
		<?php if ( SasbyTheme::$options['post_author_bio'] == '1' ) { ?>
			<?php if ( !empty ( $sasby_author_bio ) ) { ?>
			<div class="media about-author">
				<div class="<?php if ( is_rtl() ) { ?>pull-right<?php } else { ?>pull-left<?php } ?>">
					<?php echo get_avatar( $author, 110 ); ?>
				</div>
				<div class="media-body">
					<div class="about-author-info">
						<h3 class="author-title"><?php the_author_posts_link();?></h3>
						<div class="author-designation"><?php if ( !empty ( $sasby_author_designation ) ) {	echo esc_html( $sasby_author_designation ); } else {	$user_info = get_userdata( $author ); echo esc_html ( implode( ', ', $user_info->roles ) );	} ?></div>
					</div>
					<?php if ( $sasby_author_bio ) { ?>
					<div class="author-bio"><?php echo esc_html( $sasby_author_bio );?></div>
					<?php } ?>
					<ul class="author-box-social">
						<?php if ( ! empty( $news_author_fb ) ){ ?><li><a href="<?php echo esc_attr( $news_author_fb ); ?>"><i class="fab fa-facebook-f"></i></a></li><?php } ?>
						<?php if ( ! empty( $news_author_tw ) ){ ?><li><a href="<?php echo esc_attr( $news_author_tw ); ?>"><i class="fab fa-x-twitter"></i></a></li><?php } ?>
						<?php if ( ! empty( $news_author_ld ) ){ ?><li><a href="<?php echo esc_attr( $news_author_ld ); ?>"><i class="fab fa-linkedin-in"></i></a></li><?php } ?>
						<?php if ( ! empty( $news_author_pr ) ){ ?><li><a href="<?php echo esc_attr( $news_author_pr ); ?>"><i class="fab fa-pinterest-p"></i></a></li><?php } ?>
						<?php if ( ! empty( $news_author_ins ) ){ ?><li><a href="<?php echo esc_url( $news_author_ins ); ?>"><i class="fab fa-instagram"></i></a></li><?php } ?>
						<?php if ( ! empty( $news_author_tik ) ){ ?><li><a href="<?php echo esc_url( $news_author_tik ); ?>"><i class="fab fa-tiktok"></i></a></li><?php } ?>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<?php } ?>
		<?php } ?>
		<!-- next/prev post -->
		<?php if ( SasbyTheme::$options['post_links'] ) { sasby_post_links_next_prev(); } ?>
		<!-- related post -->
		<?php if( SasbyTheme::$options['show_related_post'] == '1' && is_single() && !empty ( sasby_related_post() ) ) { ?>
			<div class="related-post">
				<?php sasby_related_post(); ?>
			</div>
		<?php } ?>	
		<?php
		if ( comments_open() || get_comments_number() ){
			comments_template();
		}
		?>	
	</div>
</div>