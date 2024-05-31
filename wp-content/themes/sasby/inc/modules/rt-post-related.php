<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if( ! function_exists( 'sasby_related_post' )){
	
	function sasby_related_post(){
		$thumb_size = 'sasby-size3';
		$post_id = get_the_id();	
		$number_of_avail_post = '';
		$current_post = array( $post_id );	
		$title_length = SasbyTheme::$options['show_related_post_title_limit'] ? SasbyTheme::$options['show_related_post_title_limit'] : '';
		$related_post_number = SasbyTheme::$options['show_related_post_number'];

		$sasby_has_entry_meta  = ( SasbyTheme::$options['blog_date'] || SasbyTheme::$options['blog_cats'] || SasbyTheme::$options['blog_author_name'] || SasbyTheme::$options['blog_comment_num'] || SasbyTheme::$options['blog_length'] && function_exists( 'sasby_reading_time' ) || SasbyTheme::$options['blog_view'] && function_exists( 'sasby_views' ) ) ? true : false;

		# Making ready to the Query ...
		$query_type = SasbyTheme::$options['related_post_query'];

		$args = array(
			'post__not_in'           => $current_post,
			'posts_per_page'         => $related_post_number,
			'no_found_rows'          => true,
			'post_status'            => 'publish',
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
		);

		# Checking Related Posts Order ----------
		if( SasbyTheme::$options['related_post_sort'] ){

			$post_order = SasbyTheme::$options['related_post_sort'];

			if( $post_order == 'rand' ){

				$args['orderby'] = 'rand';
			}
			elseif( $post_order == 'views' ){

				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'sasby_views';
			}
			elseif( $post_order == 'popular' ){

				$args['orderby'] = 'comment_count';
			}
			elseif( $post_order == 'modified' ){

				$args['orderby'] = 'modified';
				$args['order']   = 'ASC';
			}
			elseif( $post_order == 'recent' ){

				$args['orderby'] = '';
				$args['order']   = '';
			}
		}


		# Get related posts by author ----------
		if( $query_type == 'author' ){
			$args['author'] = get_the_author_meta( 'ID' );
		}

		# Get related posts by tags ----------
		elseif( $query_type == 'tag' ){
			$tags_ids  = array();
			$post_tags = get_the_terms( $post_id, 'post_tag' );

			if( ! empty( $post_tags ) ){
				foreach( $post_tags as $individual_tag ){
					$tags_ids[] = $individual_tag->term_id;
				}

				$args['tag__in'] = $tags_ids;
			}
		}

		# Get related posts by categories ----------
		else{
			$category_ids = array();
			$categories   = get_the_category( $post_id );

			foreach( $categories as $individual_category ){
				$category_ids[] = $individual_category->term_id;
			}

			$args['category__in'] = $category_ids;
		}

		# Get the posts ----------
		$related_query = new wp_query( $args );
		
		$count_post = $related_query->post_count;
		if ( $count_post < 4 ) {
			$number_of_avail_post = false;
		} else {
			$number_of_avail_post = true;
		}

	
		$swiper_data=array(
			'slidesPerView' 	=>2,
			'centeredSlides'	=>false,
			'loop'				=>true,
			'spaceBetween'		=>24,
			'slideToClickedSlide' =>true,
			'slidesPerGroup' => 1,
			'autoplay'				=>array(
				'delay'  => 1,
			),
			'speed'      =>500,
			'breakpoints' =>array(
				'0'    =>array('slidesPerView' =>1),
				'576'    =>array('slidesPerView' =>2),
				'768'    =>array('slidesPerView' =>2),
				'992'    =>array('slidesPerView' =>2),
				'1200'    =>array('slidesPerView' =>2),				
				'1600'    =>array('slidesPerView' =>2)				
			),
			'auto'   =>false
		);

		$swiper_data = json_encode( $swiper_data );

		?>
		<?php if ( $related_query->have_posts() ) { ?>
		<div class="rt-related-post blog-layout-3">			
			<div class="rt-swiper-slider related-post" data-xld = '<?php echo esc_attr( $swiper_data ); ?>'>
				<div class="rt-related-title">
					<h3 class="related-title"><?php echo wp_kses( SasbyTheme::$options['related_title'] , 'alltext_allow' ); ?></h3>
					<div class="swiper-button">
		                <div class="swiper-button-prev"><i class="icon-sasby-left-arrow"></i><?php echo esc_html__( 'Prev' , 'sasby' ) ?></div>
		                <div class="swiper-button-next"><?php echo esc_html__( 'Next' , 'sasby' ) ?><i class="icon-sasby-right-arrow"></i></div>
		            </div>
	            </div>
				<div class="swiper-wrapper">
				<?php
					while ( $related_query->have_posts() ) {
					$related_query->the_post();
					$trimmed_title = wp_trim_words( get_the_title(), $title_length, '' );

					$id = get_the_ID();
					$content = get_the_content();
					$content = apply_filters( 'the_content', $content );
					$content = wp_trim_words( get_the_excerpt(), SasbyTheme::$options['post_content_limit'], '' );
					$sasby_comments_number = number_format_i18n( get_comments_number() );
					$sasby_comments_html = $sasby_comments_number == 1 ? esc_html__( 'Comment' , 'sasby' ) : esc_html__( 'Comments' , 'sasby' );
					$sasby_comments_html = '<span class="comment-number">'. $sasby_comments_number .'</span> '. $sasby_comments_html;

					$sasby_time_html = sprintf( '<span>%s</span> <span>%s</span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );
					$sasby_time_html = apply_filters( 'sasby_single_time', $sasby_time_html );

				?>
					<div class="blog-box swiper-slide">
						<?php if ( has_post_thumbnail() || SasbyTheme::$options['display_no_preview_image'] == '1'  ) { ?>
						<div class="blog-img-holder">
							<div class="blog-img">
								<a href="<?php the_permalink(); ?>" class="img-opacity-hover"><?php if ( has_post_thumbnail() ) { ?>
									<?php the_post_thumbnail( $thumb_size, ['class' => 'img-responsive'] ); ?>
										<?php } else {
										if ( SasbyTheme::$options['display_no_preview_image'] == '1' ) {
											if ( !empty( SasbyTheme::$options['no_preview_image']['id'] ) ) {
												$thumbnail = wp_get_attachment_image( SasbyTheme::$options['no_preview_image']['id'], $thumb_size );						
											}
											elseif ( empty( SasbyTheme::$options['no_preview_image']['id'] ) ) {
												$thumbnail = '<img class="wp-post-image" src="'.SASBY_ASSETS_URL.'img/noimage_520X330.jpg" alt="'. the_title_attribute( array( 'echo'=> false ) ) .'">';
											}
											echo wp_kses( $thumbnail , 'alltext_allow' );
										}
									}
									?>
								</a>
							</div>
						</div>
						<?php } ?>
						<div class="entry-content">	
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
								<li><i class="fa-regular fa-eye"></i><span class="post-views meta-item "><?php echo sasby_views(); ?></span></li>
								<?php } ?>
							</ul>
							<?php } ?>
							<h4 class="entry-title"><a href="<?php the_permalink();?>"><?php echo esc_html( $trimmed_title ); ?></a></h4>
							<?php if ( SasbyTheme::$options['blog_read_more'] ) { ?>
							<div class="post-read-more"><a class="button-style-3 btn-common" href="<?php the_permalink();?>"><?php esc_html_e( 'Continue Reading', 'sasby' );?><i class="icon-sasby-right-arrow"></i></a>
				          	</div>	
				          	<?php } ?>	

						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php
		wp_reset_postdata();
	}
}
?>