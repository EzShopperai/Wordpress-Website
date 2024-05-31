<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if( ! function_exists( 'sasby_related_team' )){
	
	function sasby_related_team(){
		$thumb_size = 'full';
		$post_id = get_the_id();	
		$number_of_avail_post = '';
		$current_post = array( $post_id );
		$title_length = SasbyTheme::$options['related_team_title_limit'] ? SasbyTheme::$options['related_team_title_limit'] : '';
		$related_post_number = SasbyTheme::$options['related_team_number'];
		
		$content = get_the_content();
		$content = apply_filters( 'the_content', $content );
		$content = wp_trim_words( get_the_excerpt(), SasbyTheme::$options['team_arexcerpt_limit'], '' );
		
		$team_related_title  = get_post_meta( get_the_ID(), 'team_related_title', true );

		# Making ready to the Query ...
		$query_type = SasbyTheme::$options['related_post_query'];

		$args = array(
			'post_type'				 => 'sasby_team',
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
			
			$terms = get_the_terms( $post_id, 'sasby_team_category' );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$port_cat_links = array();
				foreach ( $terms as $term ) {
					$port_cat_links[] = $term->term_id;
				}
			}

			if(!empty($port_cat_links)){
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'sasby_team_category',
						'field'    => 'ID',
						'terms'    => $port_cat_links,
					)
				);	
			}

		}

		# Get the posts ----------
		$related_query = new wp_query( $args );
		/*the_carousel*/
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
				'992'    =>array('slidesPerView' =>3),
				'1200'    =>array('slidesPerView' =>3),
				'1600'    =>array('slidesPerView' =>3)
			),
			'auto'   =>false
		);

		$swiper_data = json_encode( $swiper_data ); ?>
		<?php if ( $related_query->have_posts() ) { ?>
		<div class="rt-team-default rt-team-multi-layout-1 team-grid-style1 single-related-team">
			<div class="rt-swiper-slider rt-swiper-nav related-team" data-xld = '<?php echo esc_attr( $swiper_data ); ?>'>
	            <div class="rt-related-title">
					<div class="title-holder">
						<h3 class="entry-title has-animation"><?php echo wp_kses( SasbyTheme::$options['team_related_title'] , 'alltext_allow' ); ?></h3>
					</div>
					<div class="swiper-button swiper-navigation">
		                <div class="swiper-button-prev"><i class="fa-solid fa-angle-left"></i></div>
		                <div class="swiper-button-next"><i class="fa-solid fa-angle-right"></i></div>
		            </div>
	            </div>
				<div class="swiper-wrapper" >
					<?php
						while ( $related_query->have_posts() ) {
						$related_query->the_post();
						$trimmed_title = wp_trim_words( get_the_title(), $title_length, '' );
						$id = get_the_ID();
						$socials       	= get_post_meta( $id, 'sasby_team_socials', true );
						$social_fields 	= SasbyTheme_Helper::team_socials();
						$position   	= get_post_meta( $id, 'sasby_team_position', true );

					?>
						<div class="team-item swiper-slide">						
							<div class="team-content-wrap">		
								<div class="team-thums">
									<a href="<?php the_permalink();?>">
										<?php
										if ( has_post_thumbnail() ){
											the_post_thumbnail( $thumb_size );
										}
										else {
											if ( !empty( SasbyTheme::$options['no_preview_image']['id'] ) ) {
												echo wp_get_attachment_image( SasbyTheme::$options['no_preview_image']['id'], $thumb_size );
											}
											else {
												echo '<img class="wp-post-image" src="' . SasbyTheme_Helper::get_img( 'noimage_400X400.jpg' ) . '" alt="'.get_the_title().'">';
											}
										}
										?>
									</a>
								</div>
								<div class="team-content">
									<h3 class="team-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
									<?php if ( SasbyTheme::$options['team_ar_position'] ) { ?>
									<div class="team-designation"><?php echo esc_html( $position );?></div>
									<?php } ?>
									<?php if ( SasbyTheme::$options['team_ar_excerpt'] ) { ?>
									<p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p>
									<?php } ?>
								</div>
								<?php if ( SasbyTheme::$options['team_ar_social'] ) { ?>
								<ul class="team-social">
									<li class="social-item">
                                        <a href="#" class="social-hover-icon social-link">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="8.40039" y="8.40039" width="5.59991" height="5.6" rx="2.79995" fill="currentColor"></rect>
                                                <rect y="8.40027" width="5.59991" height="5.6" rx="2.79995" fill="currentColor"></rect>
                                                <rect x="8.40039" width="5.59991" height="5.6" rx="2.79995" fill="currentColor"></rect>
                                                <rect width="5.59991" height="5.6" rx="2.79995" fill="currentColor"></rect>
                                            </svg>
                                        </a>
										<ul class="team-social-dropdown">
											<?php foreach ( $socials as $key => $social ): ?>
												<?php if ( !empty( $social ) ): ?>
													<li class="social-item"><a class="social-link <?php echo esc_attr( $social_fields[$key]['icon'] );?>" target="_blank" href="<?php echo esc_url( $social );?>"><i class="fab <?php echo esc_attr( $social_fields[$key]['icon'] );?>" aria-hidden="true"></i></a></li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									</li>
								</ul>
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