<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if (is_404()) {
	$sasby_title = "Error Page";
} elseif (is_search()) {
	$sasby_title = esc_html__('Search Results for : ', 'sasby') . get_search_query();
} elseif (is_home()) {
	if (get_option('page_for_posts')) {
		$sasby_title = get_the_title(get_option('page_for_posts'));
	} else {
		$sasby_title = apply_filters('theme_blog_title', esc_html__('All Posts', 'sasby'));
	}
} elseif (is_post_type_archive('sasby_team')) {
	$sasby_title  = esc_html__('Our Teams', 'sasby');
} elseif (is_post_type_archive('sasby_portfolio')) {
	$sasby_title  = esc_html__('Our Portfolios', 'sasby');
} elseif (is_post_type_archive('sasby_service')) {
	$sasby_title  = esc_html__('Our Services', 'sasby');
} elseif (is_tax('sasby_service_category')) {
	$sasby_title  = single_term_title('', false);
} elseif (is_tax('sasby_portfolio_category')) {
	$sasby_title  = single_term_title('', false);
} elseif (is_tax('sasby_team_category')) {
	$sasby_title  = single_term_title('', false);
} elseif (is_category()) {
	$sasby_title = single_term_title('', false);
} elseif (is_archive()) {
	$sasby_title = esc_html__('All Posts', 'sasby');
} elseif (is_singular('sasby_team')) {
	$sasby_title  = esc_html__('Team Details', 'sasby');
} elseif (is_singular('sasby_portfolio')) {
	$sasby_title  = esc_html__('Portfolio Details', 'sasby');
} elseif (is_singular('sasby_service')) {
	$sasby_title  = esc_html__('Service Details', 'sasby');
} elseif (is_single()) {
	$sasby_title  = esc_html__('Post Details', 'sasby');
} else {
	$sasby_title = get_the_title();
}

if (class_exists('WooCommerce')) {
	if (is_shop()) {
		$sasby_title = esc_html__('Shop Page', 'sasby');
	} elseif (is_product_category()) {
		$category = get_queried_object();
		if ($category) {
			$sasby_title = $category->name;
		}
	} elseif (is_product()) {
		$sasby_title = esc_html__('Shop Details', 'sasby');
	} else {
		$sasby_title = $sasby_title;
	}
}

$banner_opacity = '';
if (SasbyTheme::$bgtype == 'bgimg') {
	$banner_opacity = "opacity-on";
} else {
	$banner_opacity = "opacity-off";
}
if (!empty(SasbyTheme::$options['banner_shape1'])) {
	$banner_class = " banner_image_yes";
} else {
	$banner_class = " banner_image_no";
}

if (!empty(SasbyTheme::$options['banner_shape1'])) {
	$banner_shape1 = wp_get_attachment_image_src(SasbyTheme::$options['banner_shape1'], 'full', true);
	$banner_bg_img1 = $banner_shape1[0];
}
?>
<?php if (SasbyTheme::$has_banner == 1 || SasbyTheme::$has_banner == 'on') { ?>
	<div class="entry-banner <?php echo esc_attr($banner_opacity);
								echo esc_attr($banner_class); ?>">
		<div class="container position-relative">
			<div class="entry-banner-content">
				<div class="rt-banner-content">
					<?php if (is_single()) { ?>
						<h1 class="entry-title">
							<?php echo wp_kses($sasby_title, 'alltext_allow');?>
						</h1>
					<?php } else if (is_page()) { ?>
						<h1 class="entry-title"><?php echo wp_kses($sasby_title, 'alltext_allow'); ?></h1>
					<?php } else { ?>
						<h1 class="entry-title"><?php echo wp_kses($sasby_title, 'alltext_allow'); ?></h1>
					<?php } ?>
					<?php if (SasbyTheme::$has_breadcrumb == 1) { ?>
						<?php get_template_part('template-parts/content', 'breadcrumb'); ?>
					<?php } ?>
				</div>
				<?php if (SasbyTheme::$options['banner_shape'] && !empty(SasbyTheme::$options['banner_shape1'])) { ?>
					<div class="banner-shape1 wow fadeInDown" data-wow-delay="0.1s" data-wow-duration="1.2s">
						<img src="<?php echo esc_url($banner_bg_img1); ?>" alt="banner">
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>