<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size 			= 'sasby-size4';
$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), SasbyTheme::$options['portfolio_arexcerpt_limit'], '' );
?>
<article id="post-<?php the_ID(); ?>">
    <div class="portfolio-box-3">
        <div class="item-img">
            <a href="<?php the_permalink(); ?>">
				<?php
				if ( has_post_thumbnail() ){
					the_post_thumbnail( $thumb_size, ['class' => 'img-fluid'] );
				} else {
					if ( !empty( SasbyTheme::$options['no_preview_image']['id'] ) ) {
						echo wp_get_attachment_image( SasbyTheme::$options['no_preview_image']['id'], $thumb_size );
					} else {
						echo '<img class="wp-post-image" src="' . SasbyTheme_Helper::get_img( 'noimage_480X480.jpg' ) . '" alt="'.get_the_title().'" loading="lazy" >';
					}
				}
				?>
            </a>
        </div>
        <div class="content">
            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			<?php if ( SasbyTheme::$options['portfolio_ar_excerpt'] ) { ?>
                <p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p>
			<?php } ?>
            <div class="post-btn"><a href="<?php the_permalink();?>"><?php echo esc_html__('View Project', 'sasby')?></a></div>
        </div>
    </div>
</article>