<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if( ! function_exists( 'sasby_related_portfolio' )){
	
	function sasby_related_portfolio(){
		$thumb_size 			= 'sasby-size5';
		$post_id = get_the_id();	
		$number_of_avail_post = '';
		$current_post = array( $post_id );
		$title_length = SasbyTheme::$options['related_portfolio_title_limit'] ? SasbyTheme::$options['related_portfolio_title_limit'] : '';
		$related_post_number = SasbyTheme::$options['related_portfolio_number'];
		
		$portfolio_related_title  = get_post_meta( get_the_ID(), 'portfolio_related_title', true );

		# Making ready to the Query ...
		$query_type = SasbyTheme::$options['related_post_query'];

		$args = array(
			'post_type'				 => 'sasby_portfolio',
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
			
			$terms = get_the_terms( $post_id, 'sasby_portfolio_category' );
			if ( $terms && ! is_wp_error( $terms ) ) {
			 
				$port_cat_links = array();
			 
				foreach ( $terms as $term ) {
					$port_cat_links[] = $term->term_id;
				}
			}
			
			$args['tax_query'] = array (
				array (
					'taxonomy' => 'sasby_portfolio_category',
					'field'    => 'ID',
					'terms'    => $port_cat_links,
				)
			);

		}

		# Get the posts ----------
		$related_query = new wp_query( $args );
		/*the_carousel*/
		$swiper_data=array(
			'slidesPerView' 	=>3,
			'centeredSlides'	=>false,
			'loop'				=>true,
			'spaceBetween'		=>24,
			'slideToClickedSlide' =>true,
			'slidesPerGroup' => 1,
			'autoplay'				=> true,
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

		$swiper_data = json_encode( $swiper_data );
		
		if( $related_query->have_posts() ) { ?>
		
		<div class="rt-portfolio-default rt-portfolio-multi-layout-3 related-portfolio">
			<div class="rt-swiper-slider rt-swiper-nav" data-xld = '<?php echo esc_attr( $swiper_data ); ?>'>
				<div class="rt-related-title">
					<div class="title-holder">
						<h3 class="entry-title has-animation"><?php echo wp_kses( SasbyTheme::$options['portfolio_related_title'] , 'alltext_allow' ); ?></h3>
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

					?>
						<div class="portfolio-item swiper-slide">
                            <div class="portfolio-figure">
                                <a href="<?php the_permalink(); ?>">
									<?php
									if ( has_post_thumbnail() ){
										the_post_thumbnail( $thumb_size );
									} else {
										if ( !empty( SasbyTheme::$options['no_preview_image']['id'] ) ) {
											echo wp_get_attachment_image( SasbyTheme::$options['no_preview_image']['id'], $thumb_size );
										} else {
											echo '<img class="wp-post-image" src="' . SasbyTheme_Helper::get_img( 'noimage_470X555.jpg' ) . '" alt="'.get_the_title().'" loading="lazy" >';
										}
									}
									?>
                                </a>
                            </div>
                            <div class="portfolio-content">
                                <div class="content-info">
                                    <h3 class="title"><a aria-label="Portfolio" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                </div>
                                <div class="content-action">
                                    <a aria-label="Portfolio" href="<?php the_permalink();?>"><i class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php }
		wp_reset_postdata();
	}
}
?>