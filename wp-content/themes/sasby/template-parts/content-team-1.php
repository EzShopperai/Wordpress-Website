<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'sasby-size6';
$id = get_the_ID();

$position   	= get_post_meta( $id, 'sasby_team_position', true );
$socials       	= get_post_meta( $id, 'sasby_team_socials', true );
$social_fields 	= SasbyTheme_Helper::team_socials();

$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), SasbyTheme::$options['team_arexcerpt_limit'], '' );

?>
<article id="post-<?php the_ID(); ?>">
    <div class="team-item">
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
</article>