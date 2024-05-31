<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size 			= 'sasby-size6';
$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), SasbyTheme::$options['portfolio_arexcerpt_limit'], '' );

?>
<article class="rt-portfolio-default rt-portfolio-multi-layout-3" id="post-<?php the_ID(); ?>">
    <div class="portfolio-item">
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
</article>