<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\sasby\Customizer\Settings;

use radiustheme\sasby\Customizer\SasbyTheme_Customizer;
use radiustheme\sasby\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\sasby\Customizer\Controls\Customizer_Image_Radio_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class SasbyTheme_Footer_Settings extends SasbyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_footer_controls' ) );
	}

    public function register_footer_controls( $wp_customize ) {

        // Footer Fun Fact Off & On
        $wp_customize->add_setting(
            'footer_cta_area',
            array(
                'default' => $this->defaults['footer_cta_area'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control(new Customizer_Switch_Control(
            $wp_customize,
            'footer_cta_area',
            array(
                'label' => __('Footer CTA', 'sasby'),
                'section' => 'footer_cta_section',
            )
        ));
       
        // Footer Title One
        $wp_customize->add_setting(
            'footer_cta_subtitle',
            array(
                'default' => $this->defaults['footer_cta_subtitle'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control(
            'footer_cta_subtitle',
            array(
                'label' => __('CTA Subtitle', 'sasby'),
                'section' => 'footer_cta_section',
                'type' => 'text',
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        );
        // Footer CTA Title
        $wp_customize->add_setting(
            'footer_cta_title',
            array(
                'default' => $this->defaults['footer_cta_title'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );

        $wp_customize->add_control(
            'footer_cta_title',
            array(
                'label' => __('CTA Title', 'sasby'),
                'section' => 'footer_cta_section',
                'type' => 'textarea',
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        );
        // Footer Go It On
        $wp_customize->add_setting(
            'footer_go_it_on',
            array(
                'default' => $this->defaults['footer_go_it_on'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );

        $wp_customize->add_control(
            'footer_go_it_on',
            array(
                'label' => __('Go it on', 'sasby'),
                'section' => 'footer_cta_section',
                'type' => 'text',
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        );
        // Footer App Store Text 
        $wp_customize->add_setting(
            'footer_appstore_text',
            array(
                'default' => $this->defaults['footer_appstore_text'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );

        $wp_customize->add_control(
            'footer_appstore_text',
            array(
                'label' => __('App Store Text', 'sasby'),
                'section' => 'footer_cta_section',
                'type' => 'text',
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        );
        // Footer App Store Link 
        $wp_customize->add_setting(
            'footer_appstore_link',
            array(
                'default' => $this->defaults['footer_appstore_link'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );

        $wp_customize->add_control(
            'footer_appstore_link',
            array(
                'label' => __('App Store Link', 'sasby'),
                'section' => 'footer_cta_section',
                'type' => 'text',
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        );
        // Footer Google Play Text 
        $wp_customize->add_setting(
            'footer_googleplay_text',
            array(
                'default' => $this->defaults['footer_googleplay_text'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );

        $wp_customize->add_control(
            'footer_googleplay_text',
            array(
                'label' => __('Google Play Text', 'sasby'),
                'section' => 'footer_cta_section',
                'type' => 'text',
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        );
        // Footer Google Play Link 
        $wp_customize->add_setting(
            'footer_googleplay_link',
            array(
                'default' => $this->defaults['footer_googleplay_link'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );

        $wp_customize->add_control(
            'footer_googleplay_link',
            array(
                'label' => __('Google Play Link', 'sasby'),
                'section' => 'footer_cta_section',
                'type' => 'text',
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        );
        // Footer Button Text 
        $wp_customize->add_setting(
            'footer_btn_text',
            array(
                'default' => $this->defaults['footer_btn_text'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );

        $wp_customize->add_control(
            'footer_btn_text',
            array(
                'label' => __('Button Text', 'sasby'),
                'section' => 'footer_cta_section',
                'type' => 'text',
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        );
        // Footer Button Link 
        $wp_customize->add_setting(
            'footer_btn_link',
            array(
                'default' => $this->defaults['footer_btn_link'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );

        $wp_customize->add_control(
            'footer_btn_link',
            array(
                'label' => __('Button Link', 'sasby'),
                'section' => 'footer_cta_section',
                'type' => 'text',
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        );

        // Footer image One
        $wp_customize->add_setting(
            'footer_app_image1',
            array(
                'default' => $this->defaults['footer_app_image1'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize,
            'footer_app_image1',
            array(
                'label' => __('App Image One', 'sasby'),
                'description' => esc_html__(
                    'This is the description for the Media Control',
                    'sasby'
                ),
                'section' => 'footer_cta_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __('Select File', 'sasby'),
                    'change' => __('Change File', 'sasby'),
                    'default' => __('Default', 'sasby'),
                    'remove' => __(
                        'Remove',
                        'sasby'
                    ),
                    'placeholder' => __('No file selected', 'sasby'),
                    'frame_title' => __('Select File', 'sasby'),
                    'frame_button' => __('Choose File', 'sasby'),
                ),
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        ));
        // Footer image One
        $wp_customize->add_setting(
            'footer_app_image2',
            array(
                'default' => $this->defaults['footer_app_image2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize,
            'footer_app_image2',
            array(
                'label' => __('App Image Two', 'sasby'),
                'description' => esc_html__(
                    'This is the description for the Media Control',
                    'sasby'
                ),
                'section' => 'footer_cta_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __('Select File', 'sasby'),
                    'change' => __('Change File', 'sasby'),
                    'default' => __('Default', 'sasby'),
                    'remove' => __(
                        'Remove',
                        'sasby'
                    ),
                    'placeholder' => __('No file selected', 'sasby'),
                    'frame_title' => __('Select File', 'sasby'),
                    'frame_button' => __('Choose File', 'sasby'),
                ),
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        ));

        // Footer Shape image One
        $wp_customize->add_setting(
            'footer_shapeimage_image1',
            array(
                'default' => $this->defaults['footer_shapeimage_image1'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize,
            'footer_shapeimage_image1',
            array(
                'label' => __('Shape Image One', 'sasby'),
                'description' => esc_html__(
                    'This is the description for the Media Control',
                    'sasby'
                ),
                'section' => 'footer_cta_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __('Select File', 'sasby'),
                    'change' => __('Change File', 'sasby'),
                    'default' => __('Default', 'sasby'),
                    'remove' => __(
                        'Remove',
                        'sasby'
                    ),
                    'placeholder' => __('No file selected', 'sasby'),
                    'frame_title' => __('Select File', 'sasby'),
                    'frame_button' => __('Choose File', 'sasby'),
                ),
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        ));
        // Footer image One
        $wp_customize->add_setting(
            'footer_shapeimage_image2',
            array(
                'default' => $this->defaults['footer_shapeimage_image2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize,
            'footer_shapeimage_image2',
            array(
                'label' => __('Shape Image Two', 'sasby'),
                'description' => esc_html__(
                    'This is the description for the Media Control',
                    'sasby'
                ),
                'section' => 'footer_cta_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __('Select File', 'sasby'),
                    'change' => __('Change File', 'sasby'),
                    'default' => __('Default', 'sasby'),
                    'remove' => __(
                        'Remove',
                        'sasby'
                    ),
                    'placeholder' => __('No file selected', 'sasby'),
                    'frame_title' => __('Select File', 'sasby'),
                    'frame_button' => __('Choose File', 'sasby'),
                ),
                'active_callback'   => 'rttheme_is_footer_cta_enabled',
            )
        ));
		
		// Footer off & on
		$wp_customize->add_setting( 'footer_area',
            array(
                'default' => $this->defaults['footer_area'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'footer_area',
            array(
                'label' => __( 'Footer Top', 'sasby' ),
                'section' => 'footer_layout_settings',
            )
        ) );

		
        // Footer Style
        $wp_customize->add_setting( 'footer_style',
            array(
                'default' => $this->defaults['footer_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );

        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'footer_style',
            array(
                'label' => __( 'Footer Layout', 'sasby' ),
                'description' => esc_html__( 'You can set default footer form here.', 'sasby' ),
                'section' => 'footer_layout_settings',
                'choices' => array(
                    '1' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/footer-1.jpg',
                        'name' => __( 'Layout 1', 'sasby' )
                    ),                  
                    '2' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/footer-2.jpg',
                        'name' => __( 'Layout 2', 'sasby' )
                    ),
                    '3' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/footer-3.jpg',
                        'name' => __( 'Layout 3', 'sasby' )
                    ),
                    '4' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/footer-4.jpg',
                        'name' => __( 'Layout 4', 'sasby' )
                    ),
                )
            )
        ) );
		// Footer 1 column
		$wp_customize->add_setting( 'footer_column_1',
            array(
                'default' => $this->defaults['footer_column_1'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
                'active_callback' => 'rttheme_is_footer1_enabled',
            )
        );
        $wp_customize->add_control( 'footer_column_1',
            array(
                'label' => __( 'Number of Columns for Footer', 'sasby' ),
                'section' => 'footer_layout_settings',
                'type' => 'select',
                'choices' => array(
                    '1' => esc_html__( '1 Column', 'sasby' ),
                    '2' => esc_html__( '2 Columns', 'sasby' ),
                    '3' => esc_html__( '3 Columns', 'sasby' ),
                    '4' => esc_html__( '4 Columns', 'sasby' ),
                ),
                'active_callback' => 'rttheme_is_footer1_enabled',
            )
        );

        // Footer 2 column
        $wp_customize->add_setting( 'footer_column_2',
            array(
                'default' => $this->defaults['footer_column_2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
                'active_callback' => 'rttheme_is_footer2_enabled',
            )
        );
        $wp_customize->add_control( 'footer_column_2',
            array(
                'label' => __( 'Number of Columns for Footer', 'sasby' ),
                'section' => 'footer_layout_settings',
                'type' => 'select',
                'choices' => array(
                    '1' => esc_html__( '1 Column', 'sasby' ),
                    '2' => esc_html__( '2 Columns', 'sasby' ),
                    '3' => esc_html__( '3 Columns', 'sasby' ),
                    '4' => esc_html__( '4 Columns', 'sasby' ),
                ),
                'active_callback' => 'rttheme_is_footer2_enabled',
            )
        );

        // Footer 3 column
        $wp_customize->add_setting( 'footer_column_3',
            array(
                'default' => $this->defaults['footer_column_3'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'footer_column_3',
            array(
                'label' => __( 'Number of Columns for Footer', 'sasby' ),
                'section' => 'footer_layout_settings',
                'type' => 'select',
                'choices' => array(
                    '1' => esc_html__( '1 Column', 'sasby' ),
                    '2' => esc_html__( '2 Columns', 'sasby' ),
                    '3' => esc_html__( '3 Columns', 'sasby' ),
                    '4' => esc_html__( '4 Columns', 'sasby' ),
                ),
                'active_callback' => 'rttheme_is_footer3_enabled',
            )
        );

        // Footer 4 column
        $wp_customize->add_setting( 'footer_column_4',
            array(
                'default' => $this->defaults['footer_column_4'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'footer_column_4',
            array(
                'label' => __( 'Number of Columns for Footer', 'sasby' ),
                'section' => 'footer_layout_settings',
                'type' => 'select',
                'choices' => array(
                    '1' => esc_html__( '1 Column', 'sasby' ),
                    '2' => esc_html__( '2 Columns', 'sasby' ),
                    '3' => esc_html__( '3 Columns', 'sasby' ),
                    '4' => esc_html__( '4 Columns', 'sasby' ),
                ),
                'active_callback' => 'rttheme_is_footer4_enabled',
            )
        );
		
		// Footer 1 bgtype
		$wp_customize->add_setting( 'footer_bgtype',
            array(
                'default' => $this->defaults['footer_bgtype'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );

        $wp_customize->add_control( 'footer_bgtype',
            array(
                'label' => __( 'Background Type', 'sasby' ),
                'section' => 'footer_color_settings',
                'description' => esc_html__( 'This is banner background type.', 'sasby' ),
                'type' => 'select',
                'choices' => array(
					'fbgcolor' => esc_html__( 'BG Color', 'sasby' ),
                    'fbgimg' => esc_html__( 'BG Image', 'sasby' ),
                ),
                'active_callback' => 'rttheme_is_footer1_enabled',
            )
        );

        // Footer 1 background color
        $wp_customize->add_setting('fbgcolor', 
            array(
                'default' => $this->defaults['fbgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fbgcolor',
            array(
                'label' => esc_html__('Background Color', 'sasby'),
                'settings' => 'fbgcolor', 
                'section' => 'footer_color_settings',
                'active_callback' => 'rttheme_footer1_bgcolor_type_condition',
            )
        ));
        // Footer 1 background image
        $wp_customize->add_setting( 'fbgimg',
            array(
                'default' => $this->defaults['fbgimg'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbgimg',
            array(
                'label' => __( 'Background Image', 'sasby' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'sasby' ),
                'section' => 'footer_color_settings',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'sasby' ),
                    'change' => __( 'Change File', 'sasby' ),
                    'default' => __( 'Default', 'sasby' ),
                    'remove' => __( 'Remove', 'sasby' ),
                    'placeholder' => __( 'No file selected', 'sasby' ),
                    'frame_title' => __( 'Select File', 'sasby' ),
                    'frame_button' => __( 'Choose File', 'sasby' ),
                ),
                'active_callback' => 'rttheme_footer1_bgimg_type_condition',
            )
        ) );

        // Footer 2 bgtype
        $wp_customize->add_setting( 'footer_bgtype2',
            array(
                'default' => $this->defaults['footer_bgtype2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'footer_bgtype2',
            array(
                'label' => __( 'Background Type', 'sasby' ),
                'section' => 'footer_color_settings',
                'description' => esc_html__( 'This is banner background type.', 'sasby' ),
                'type' => 'select',
                'choices' => array(
                    'fbgcolor2' => esc_html__( 'BG Color', 'sasby' ),
                    'fbgimg2' => esc_html__( 'BG Image', 'sasby' ),
                ),
                'active_callback' => 'rttheme_is_footer2_enabled',
            )
        );		
        // Footer 2 background color
        $wp_customize->add_setting('fbgcolor2', 
            array(
                'default' => $this->defaults['fbgcolor2'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fbgcolor2',
            array(
                'label' => esc_html__('Background Color', 'sasby'),
                'settings' => 'fbgcolor2', 
                'section' => 'footer_color_settings',
                'active_callback' => 'rttheme_footer2_bgcolor_type_condition',
            )
        ));		

        // Footer 2 background image
        $wp_customize->add_setting( 'fbgimg2',
            array(
                'default' => $this->defaults['fbgimg2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbgimg2',
            array(
                'label' => __( 'Background Image', 'sasby' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'sasby' ),
                'section' => 'footer_color_settings',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'sasby' ),
                    'change' => __( 'Change File', 'sasby' ),
                    'default' => __( 'Default', 'sasby' ),
                    'remove' => __( 'Remove', 'sasby' ),
                    'placeholder' => __( 'No file selected', 'sasby' ),
                    'frame_title' => __( 'Select File', 'sasby' ),
                    'frame_button' => __( 'Choose File', 'sasby' ),
                ),
                'active_callback' => 'rttheme_footer2_bgimg_type_condition',
            )
        ) );

        // Footer 3 bgtype
        $wp_customize->add_setting( 'footer_bgtype3',
            array(
                'default' => $this->defaults['footer_bgtype3'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'footer_bgtype3',
            array(
                'label' => __( 'Background Type', 'sasby' ),
                'section' => 'footer_color_settings',
                'description' => esc_html__( 'This is banner background type.', 'sasby' ),
                'type' => 'select',
                'choices' => array(
                    'fbgcolor3' => esc_html__( 'BG Color', 'sasby' ),
                    'fbgimg3' => esc_html__( 'BG Image', 'sasby' ),
                ),
                'active_callback' => 'rttheme_is_footer3_enabled',
            )
        );      
        // Footer 2 background color
        $wp_customize->add_setting('fbgcolor3', 
            array(
                'default' => $this->defaults['fbgcolor3'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fbgcolor3',
            array(
                'label' => esc_html__('Background Color', 'sasby'),
                'settings' => 'fbgcolor3', 
                'section' => 'footer_color_settings',
                'active_callback' => 'rttheme_footer3_bgcolor_type_condition',
            )
        ));     

        // Footer 2 background image
        $wp_customize->add_setting( 'fbgimg3',
            array(
                'default' => $this->defaults['fbgimg3'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fbgimg3',
            array(
                'label' => __( 'Background Image', 'sasby' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'sasby' ),
                'section' => 'footer_color_settings',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'sasby' ),
                    'change' => __( 'Change File', 'sasby' ),
                    'default' => __( 'Default', 'sasby' ),
                    'remove' => __( 'Remove', 'sasby' ),
                    'placeholder' => __( 'No file selected', 'sasby' ),
                    'frame_title' => __( 'Select File', 'sasby' ),
                    'frame_button' => __( 'Choose File', 'sasby' ),
                ),
                'active_callback' => 'rttheme_footer3_bgimg_type_condition',
            )
        ) );

        /*Footer 1, 2 and 3 Color*/ 
		$wp_customize->add_setting('footer_title_color', 
            array(
                'default' => $this->defaults['footer_title_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_title_color',
            array(
                'label' => esc_html__('Footer Title Color', 'sasby'),
                'section' => 'footer_color_settings',
            )
        ));
		
		$wp_customize->add_setting('footer_color', 
            array(
                'default' => $this->defaults['footer_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_color',
            array(
                'label' => esc_html__('Footer Text Color', 'sasby'),
                'section' => 'footer_color_settings',
            )
        ));
		
		$wp_customize->add_setting('footer_link_color', 
            array(
                'default' => $this->defaults['footer_link_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_color',
            array(
                'label' => esc_html__('Footer Link Color', 'sasby'),
                'section' => 'footer_color_settings',
            )
        ));
		
		$wp_customize->add_setting('footer_link_hover_color', 
            array(
                'default' => $this->defaults['footer_link_hover_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_hover_color',
            array(
                'label' => esc_html__('Footer Link Hover Color', 'sasby'),
                'section' => 'footer_color_settings',
            )
        ));
        // Footer 2 copyright bg color
        $wp_customize->add_setting('copyright_text_color', 
            array(
                'default' => $this->defaults['copyright_text_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_text_color',
            array(
                'label' => esc_html__('Copyright Text Color', 'sasby'),
                'section' => 'footer_color_settings',
            )
        ));

        $wp_customize->add_setting('copyright_link_color', 
            array(
                'default' => $this->defaults['copyright_link_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_link_color',
            array(
                'label' => esc_html__('Copyright Link Color', 'sasby'),
                'section' => 'footer_color_settings',
            )
        )); 

        $wp_customize->add_setting('copyright_hover_color', 
            array(
                'default' => $this->defaults['copyright_hover_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_hover_color',
            array(
                'label' => esc_html__('Copyright Hover Color', 'sasby'),
                'section' => 'footer_color_settings',
            )
        ));

        /* = Footer Copyright
        ======================================================*/
        $wp_customize->add_setting('copyright_bg_color', 
            array(
                'default' => $this->defaults['copyright_bg_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_bg_color',
            array(
                'label' => esc_html__('Copyright Background Color', 'sasby'),
                'section' => 'footer_color_settings',
                'active_callback' => 'rttheme_is_copyright_bg_color_enabled',
            )
        ));
		
		// Copyright Text
        $wp_customize->add_setting( 'copyright_text',
            array(
                'default' => $this->defaults['copyright_text'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_textarea_sanitization',
            )
        );
        $wp_customize->add_control( 'copyright_text',
            array(
                'label' => __( 'Copyright Text', 'sasby' ),
                'section' => 'footer_section',
                'type' => 'textarea',
            )
        );

        $wp_customize->add_setting( 'copyright_menu',
            array(
                'default' => $this->defaults['copyright_menu'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'copyright_menu',
            array(
                'label' => __( 'Copyright Menu Display', 'sasby' ),
                'section' => 'footer_section',
            )
        ) );

	    $wp_customize->add_setting( 'copyright_area',
		    array(
			    'default' => $this->defaults['copyright_area'],
			    'transport' => 'refresh',
			    'sanitize_callback' => 'rttheme_switch_sanitization',
		    )
	    );
	    $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'copyright_area',
		    array(
			    'label' => __( 'Footer Copyright', 'sasby' ),
			    'section' => 'footer_section',
		    )
	    ) );

        $wp_customize->add_setting( 'logo_display',
            array(
                'default' => $this->defaults['logo_display'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'logo_display',
            array(
                'label' => __( 'Footer Logo Display', 'sasby' ),
                'section' => 'footer_address_section',
                'active_callback' => 'rttheme_is_footer3_enabled',
            )
        ) );
        
        /*footer 2 logo*/
        $wp_customize->add_setting('footer_logo3',
            array(
              'default'           => $this->defaults['footer_logo3'],
              'transport'         => 'refresh',
              'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'footer_logo3',
            array(
                'label'         => esc_html__('Footer Logo', 'sasby'),
                'description'   => esc_html__('This is the description for the Media Control', 'sasby'),
                'section'       => 'footer_address_section',
                'mime_type'     => 'image',
                'button_labels' => array(
                    'select'       => esc_html__('Select File', 'sasby'),
                    'change'       => esc_html__('Change File', 'sasby'),
                    'default'      => esc_html__('Default', 'sasby'),
                    'remove'       => esc_html__('Remove', 'sasby'),
                    'placeholder'  => esc_html__('No file selected', 'sasby'),
                    'frame_title'  => esc_html__('Select File', 'sasby'),
                    'frame_button' => esc_html__('Choose File', 'sasby'),
                ),
                'active_callback' => 'rttheme_is_footer3_enabled',
            )
        ));

	    $wp_customize->add_setting( 'footer_number_label',
		    array(
			    'default' => $this->defaults['footer_number_label'],
			    'transport' => 'refresh',
			    'sanitize_callback' => 'rttheme_textarea_sanitization',
		    )
	    );
	    $wp_customize->add_control( 'footer_number_label',
		    array(
			    'label' => __( 'Number Label', 'sasby' ),
			    'section' => 'footer_address_section',
			    'type' => 'text',
			    'active_callback' => 'rttheme_is_footer3_enabled',
		    )
	    );


	    $wp_customize->add_setting( 'footer_number',
		    array(
			    'default' => $this->defaults['footer_number'],
			    'transport' => 'refresh',
			    'sanitize_callback' => 'rttheme_textarea_sanitization',
		    )
	    );
	    $wp_customize->add_control( 'footer_number',
		    array(
			    'label' => __( 'Number', 'sasby' ),
			    'section' => 'footer_address_section',
			    'type' => 'text',
			    'active_callback' => 'rttheme_is_footer3_enabled',
		    )
	    );

	    $wp_customize->add_setting( 'footer_address',
		    array(
			    'default' => $this->defaults['footer_address'],
			    'transport' => 'refresh',
			    'sanitize_callback' => 'rttheme_textarea_sanitization',
		    )
	    );
	    $wp_customize->add_control( 'footer_address',
		    array(
			    'label' => __( 'Address Label', 'sasby' ),
			    'section' => 'footer_address_section',
			    'type' => 'text',
			    'active_callback' => 'rttheme_is_footer3_enabled',
		    )
	    );

	    $wp_customize->add_setting( 'footer_email_label',
		    array(
			    'default' => $this->defaults['footer_email_label'],
			    'transport' => 'refresh',
			    'sanitize_callback' => 'rttheme_textarea_sanitization',
		    )
	    );
	    $wp_customize->add_control( 'footer_email_label',
		    array(
			    'label' => __( 'Email Label', 'sasby' ),
			    'section' => 'footer_address_section',
			    'type' => 'text',
			    'active_callback' => 'rttheme_is_footer3_enabled',
		    )
	    );

	    $wp_customize->add_setting( 'footer_email',
		    array(
			    'default' => $this->defaults['footer_email'],
			    'transport' => 'refresh',
			    'sanitize_callback' => 'rttheme_textarea_sanitization',
		    )
	    );
	    $wp_customize->add_control( 'footer_email',
		    array(
			    'label' => __( 'Email Label', 'sasby' ),
			    'section' => 'footer_address_section',
			    'type' => 'text',
			    'active_callback' => 'rttheme_is_footer3_enabled',
		    )
	    );

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new SasbyTheme_Footer_Settings();
}
