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
<div class="rt-footer-top-banner banner-wrap rt-footer-cta">
    <div class="container">
        <div class="banner-layout">
            <div class="row align-items-center">
                <div class="col-md-7 banner-text mb-0">
                    <div class="item-img position-relative text-box">
                        <?php if (!empty(SasbyTheme::$options['footer_cta_subtitle'])) { ?>
                            <p class="mb-0"><?php echo esc_html(SasbyTheme::$options['footer_cta_subtitle']); ?></p>
                        <?php } ?>
                        <?php if (!empty(SasbyTheme::$options['footer_cta_title'])) { ?>
                            <h2 class="heading-title mb-0"><?php echo esc_html(SasbyTheme::$options['footer_cta_title']); ?></h2>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="button-list mt-3 mt-lg-0">
                        <?php if (!empty(SasbyTheme::$options['footer_btn_text'])) { ?>
                            <a href="<?php echo esc_html(SasbyTheme::$options['footer_btn_link']); ?>" class="banner-btn">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.05436 10.9446C5.88351 11.6675 5.87847 12.4198 6.03962 13.1449C6.20077 13.8701 6.52393 14.5494 6.9849 15.1319C7.44586 15.7144 8.03268 16.1851 8.70137 16.5086C9.37007 16.8321 10.1033 17.0001 10.8462 17V13.0615M6.05436 10.9446C4.48728 9.8031 3.21246 8.30707 2.33402 6.57873C1.45559 4.85039 0.998474 2.93877 1 1C2.93863 0.998603 4.85009 1.45579 6.57828 2.33421C8.30647 3.21264 9.80236 4.48739 10.9438 6.05436M6.05436 10.9446C7.48049 11.9877 9.11462 12.7099 10.8462 13.0615M10.8462 13.0615C10.931 13.0788 11.0161 13.0952 11.1013 13.1108C11.8457 12.5205 12.5197 11.8465 13.1099 11.1022C13.0944 11.0166 13.0789 10.9313 13.0615 10.8462M10.9438 6.05436C11.6668 5.88336 12.4191 5.87821 13.1444 6.0393C13.8696 6.20038 14.549 6.52352 15.1316 6.9845C15.7143 7.44548 16.185 8.03235 16.5086 8.70112C16.8321 9.36989 17.0001 10.1032 17 10.8462H13.0615M10.9438 6.05436C11.9868 7.48026 12.7097 9.11491 13.0615 10.8462M14.8987 12.8072C15.4384 13.2085 15.8581 13.7499 16.1122 14.3727C16.3663 14.9955 16.4452 15.6759 16.3403 16.3403C15.6758 16.4451 14.9954 16.3661 14.3726 16.1118C13.7498 15.8576 13.2084 15.4377 12.8072 14.8978M5.30769 6.53846C5.30769 6.86488 5.43737 7.17793 5.66818 7.40875C5.89899 7.63956 6.21204 7.76923 6.53846 7.76923C6.86488 7.76923 7.17793 7.63956 7.40875 7.40875C7.63956 7.17793 7.76923 6.86488 7.76923 6.53846C7.76923 6.21204 7.63956 5.89899 7.40875 5.66818C7.17793 5.43736 6.86488 5.30769 6.53846 5.30769C6.21204 5.30769 5.89899 5.43736 5.66818 5.66818C5.43737 5.89899 5.30769 6.21204 5.30769 6.53846Z" stroke="#1CB779" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg> <?php echo esc_html(SasbyTheme::$options['footer_btn_text']); ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>