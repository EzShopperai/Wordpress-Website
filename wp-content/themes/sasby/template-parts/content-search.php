<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), SasbyTheme::$options['search_excerpt_length'], '' );

$sasby_has_entry_meta  = ( SasbyTheme::$options['blog_author_name'] || SasbyTheme::$options['blog_date'] || SasbyTheme::$options['blog_cats'] ) ? true : false;

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-layout-1' ); ?>>
	<div class="blog-box">		
		<div class="entry-content">
			<?php if ( $sasby_has_entry_meta ) { ?>
			<ul class="entry-meta">
				<?php if ( SasbyTheme::$options['blog_author_name'] ) { ?>
				<li class="post-author"><i class="icon-sasby-user"></i><?php esc_html_e( 'by ', 'sasby' );?><?php the_author_posts_link(); ?></li>
				<?php } if ( SasbyTheme::$options['blog_date'] ) { ?>	
				<li class="post-date"><i class="icon-sasby-calendar"></i><?php echo get_the_date(); ?></li>
				<?php } if ( SasbyTheme::$options['blog_cats'] && has_category() ) { ?>
				<li class="entry-categories"><i class="icon-sasby-tags"></i><?php echo the_category( ', ' );?></li>
				<?php } ?>
			</ul>
			<?php } ?>
			<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			<?php if ( SasbyTheme::$options['blog_content'] ) { ?>
			<div class="entry-text"><p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p></div>
			<?php } ?>
		</div>
	</div>
</div>