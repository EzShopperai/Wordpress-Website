<?php
if (SasbyTheme::$options['footer_bgtype'] == 'fbgcolor') {
    $sasby_bg = SasbyTheme::$options['fbgcolor'];
} else {
    $sasby_bg = 'url(' . $footer_bg_img . ') no-repeat center bottom / cover';
}
$bgc = $menu_on = $copyright_on = '';
if (SasbyTheme::$options['footer_bgtype'] == 'fbgimg') {
    $bgc = 'footer-bg-opacity';
} ?>
<div class="rt-footer-top-banner banner-wrap">
    <div class="container">
        <div class="banner-layout">
            <?php if (!empty(SasbyTheme::$options['footer_shapeimage_image1']) || !empty(SasbyTheme::$options['footer_shapeimage_image2'])) { ?>
                <ul class="element-shape">
                    <?php if (!empty(SasbyTheme::$options['footer_shapeimage_image1'])) {
                        $img_one = wp_get_attachment_image(SasbyTheme::$options['footer_shapeimage_image1'], 'full', true);  ?>
                        <li>
                            <?php echo wp_kses_post($img_one); ?>
                        </li>
                    <?php } ?>

                    <?php if (!empty(SasbyTheme::$options['footer_shapeimage_image2'])) {
                        $img_two = wp_get_attachment_image(SasbyTheme::$options['footer_shapeimage_image2'], 'full', true);  ?>
                        <li>
                            <?php echo wp_kses_post($img_two); ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="item-img position-relative">

                        <?php if (!empty(SasbyTheme::$options['footer_app_image1'])) {
                            $img_three = wp_get_attachment_image_url(SasbyTheme::$options['footer_app_image1'], 'full', true);  ?>
                            <img class="wow fadeInUp animated" data-wow-delay=".1s" data-wow-duration="1s" src="<?php echo wp_kses_post($img_three); ?>" alt="iphone">
                        <?php } else { ?>
                            <img class="wow fadeInUp animated" data-wow-delay=".1s" data-wow-duration="1s" src="<?php echo get_template_directory_uri(); ?>/assets/img/iPhone-1.png" alt="iphone">
                        <?php } ?>

                        <?php if (!empty(SasbyTheme::$options['footer_app_image2'])) {
                            $img_four = wp_get_attachment_image_url(SasbyTheme::$options['footer_app_image2'], 'full', true);  ?>
                            <div class="small-img">
                                <img class="wow fadeInUp animated" data-wow-delay=".4s" data-wow-duration="1s" src="<?php echo wp_kses_post($img_four); ?>" alt="iphone">
                            </div>
                        <?php } else { ?>
                            <div class="small-img">
                                <img class="wow fadeInUp animated" data-wow-delay=".4s" data-wow-duration="1s" src="<?php echo get_template_directory_uri(); ?>/assets/img/iPhone-2.png" alt="iphone">
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="banner-text">
                        <div class="text-box">

                            <?php if (!empty(SasbyTheme::$options['footer_cta_subtitle'])) { ?>
                                <p class="mb-0"><?php echo esc_html(SasbyTheme::$options['footer_cta_subtitle']); ?></p>
                            <?php } ?>
                            <?php if (!empty(SasbyTheme::$options['footer_cta_title'])) { ?>
                                <h2 class="heading-title"><?php echo esc_html(SasbyTheme::$options['footer_cta_title']); ?></h2>
                            <?php } ?>

                            <div class="button-list mt-3 mt-lg-0">
                                <ul>
                                    <?php if (!empty(SasbyTheme::$options['footer_appstore_text'])) { ?>
                                        <li>
                                            <a href="<?php echo esc_html(SasbyTheme::$options['footer_appstore_link']); ?>" class="brand-btn">
                                                <div class="brand-app"><i class="fa-brands fa-apple"></i></div>
                                                <div class="content">
                                                    <div class="label"><?php echo esc_html(SasbyTheme::$options['footer_go_it_on']); ?></div>
                                                    <div class="text"><?php echo esc_html(SasbyTheme::$options['footer_appstore_text']); ?></div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if (!empty(SasbyTheme::$options['footer_googleplay_text'])) { ?>
                                        <li>
                                            <a href="<?php echo esc_html(SasbyTheme::$options['footer_googleplay_link']); ?>" class="brand-btn">
                                                <div class="brand-app"><i class="fa-brands fa-google-play"></i></div>
                                                <div class="content">
                                                    <div class="label"><?php echo esc_html(SasbyTheme::$options['footer_go_it_on']); ?></div>
                                                    <div class="text"><?php echo esc_html(SasbyTheme::$options['footer_googleplay_text']); ?></div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>