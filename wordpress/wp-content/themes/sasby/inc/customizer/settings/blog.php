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
class SasbyTheme_Blog_Post_Settings extends SasbyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_blog_post_controls' ) );
	}

    /**
     * Blog Post Controls
     */
    public function register_blog_post_controls( $wp_customize ) {

        // Blog Post Style
        $wp_customize->add_setting( 'blog_style',
            array(
                'default' => $this->defaults['blog_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );

        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'blog_style',
            array(
                'label' => __( 'Blog/Archive Layout', 'sasby' ),
                'description' => esc_html__( 'Blog Post layout variation you can selecr and use.', 'sasby' ),
                'section' => 'blog_post_settings_section',
                'choices' => array(
                    'style1' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog3.png',
                        'name' => __( 'Layout 1', 'sasby' )
                    ),
                    'style2' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog2.png',
                        'name' => __( 'Layout 2', 'sasby' )
                    ),
                    'style3' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog1.png',
                        'name' => __( 'Layout 3', 'sasby' )
                    ),
                )
            )
        ) );

        /*Loadmore*/
        $wp_customize->add_setting( 'blog_loadmore',
            array(
                'default' => $this->defaults['blog_loadmore'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'blog_loadmore',
            array(
                'label' => __( 'Blog Pagination', 'sasby' ),
                'section' => 'blog_post_settings_section',
                'type' => 'select',
                'choices' => array(
                    'pagination' => esc_html__( 'Pagination', 'sasby' ),
                    'loadmore' => esc_html__( 'Load More', 'sasby' ),
                ),
                'active_callback' => 'rttheme_is_blog_style1_enabled',
            )
        );

        $wp_customize->add_setting( 'load_more_limit',
            array(
                'default' => $this->defaults['load_more_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'load_more_limit',
            array(
                'label' => __( 'Load More Limit', 'sasby' ),
                'section' => 'blog_post_settings_section',
                'type' => 'number',
                'active_callback' => 'rttheme_is_blog_style1_enabled',
            )
        );

		$wp_customize->add_setting( 'post_content_limit',
            array(
                'default' => $this->defaults['post_content_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'post_content_limit',
            array(
                'label' => __( 'Blog Content Limit', 'sasby' ),
                'section' => 'blog_post_settings_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting( 'blog_content',
            array(
                'default' => $this->defaults['blog_content'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_content',
            array(
                'label' => __( 'Show Content', 'sasby' ),
                'section' => 'blog_post_settings_section',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_date',
            array(
                'default' => $this->defaults['blog_date'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_date',
            array(
                'label' => __( 'Show Date', 'sasby' ),
                'section' => 'blog_post_settings_section',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_author_name',
            array(
                'default' => $this->defaults['blog_author_name'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_author_name',
            array(
                'label' => __( 'Show Author', 'sasby' ),
                'section' => 'blog_post_settings_section',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_comment_num',
            array(
                'default' => $this->defaults['blog_comment_num'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_comment_num',
            array(
                'label' => __( 'Show Comment', 'sasby' ),
                'section' => 'blog_post_settings_section',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_cats',
            array(
                'default' => $this->defaults['blog_cats'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_cats',
            array(
                'label' => __( 'Show Category', 'sasby' ),
                'section' => 'blog_post_settings_section',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_view',
            array(
                'default' => $this->defaults['blog_view'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_view',
            array(
                'label' => __( 'Show Views', 'sasby' ),
                'section' => 'blog_post_settings_section',
            )
        ) );
		
		$wp_customize->add_setting( 'blog_length',
            array(
                'default' => $this->defaults['blog_length'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_length',
            array(
                'label' => __( 'Show Reading Length', 'sasby' ),
                'section' => 'blog_post_settings_section',
            )
        ) );

        $wp_customize->add_setting( 'blog_video',
            array(
                'default' => $this->defaults['blog_video'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_video',
            array(
                'label' => __( 'Show Video', 'sasby' ),
                'section' => 'blog_post_settings_section',
            )
        ) );

        $wp_customize->add_setting( 'blog_read_more',
            array(
                'default' => $this->defaults['blog_read_more'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'blog_read_more',
            array(
                'label' => __( 'Show Read More', 'sasby' ),
                'section' => 'blog_post_settings_section',
            )
        ) );

        /*Animation*/
        $wp_customize->add_setting( 'blog_animation',
            array(
                'default' => $this->defaults['blog_animation'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'blog_animation',
            array(
                'label' => __( 'Animation On/Off', 'sasby' ),
                'section' => 'blog_post_settings_section',
                'type' => 'select',
                'choices' => array(
                    'wow' => esc_html__( 'Animation On', 'sasby' ),
                    'hide' => esc_html__( 'Animation Off', 'sasby' ),
                ),
            )
        );

        $wp_customize->add_setting( 'blog_animation_effect',
            array(
                'default' => $this->defaults['blog_animation_effect'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'blog_animation_effect',
            array(
                'label' => __( 'Entrance Animation', 'sasby' ),
                'section' => 'blog_post_settings_section',
                'type' => 'select',
                'choices' => array(
                    'none' => esc_html__( 'none', 'sasby' ),
                    'bounce' => esc_html__( 'bounce', 'sasby' ),
                    'flash' => esc_html__( 'flash', 'sasby' ),
                    'pulse' => esc_html__( 'pulse', 'sasby' ),
                    'rubberBand' => esc_html__( 'rubberBand', 'sasby' ),
                    'shakeX' => esc_html__( 'shakeX', 'sasby' ),
                    'shakeY' => esc_html__( 'shakeY', 'sasby' ),
                    'headShake' => esc_html__( 'headShake', 'sasby' ),
                    'swing' => esc_html__( 'swing', 'sasby' ),                 
                    'fadeIn' => esc_html__( 'fadeIn', 'sasby' ),
                    'fadeInDown' => esc_html__( 'fadeInDown', 'sasby' ),
                    'fadeInLeft' => esc_html__( 'fadeInLeft', 'sasby' ),
                    'fadeInRight' => esc_html__( 'fadeInRight', 'sasby' ),
                    'fadeInUp' => esc_html__( 'fadeInUp', 'sasby' ),                   
                    'bounceIn' => esc_html__( 'bounceIn', 'sasby' ),
                    'bounceInDown' => esc_html__( 'bounceInDown', 'sasby' ),
                    'bounceInLeft' => esc_html__( 'bounceInLeft', 'sasby' ),
                    'bounceInRight' => esc_html__( 'bounceInRight', 'sasby' ),
                    'bounceInUp' => esc_html__( 'bounceInUp', 'sasby' ),           
                    'slideInDown' => esc_html__( 'slideInDown', 'sasby' ),
                    'slideInLeft' => esc_html__( 'slideInLeft', 'sasby' ),
                    'slideInRight' => esc_html__( 'slideInRight', 'sasby' ),
                    'slideInUp' => esc_html__( 'slideInUp', 'sasby' ), 
                ),
            )
        );

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new SasbyTheme_Blog_Post_Settings();
}
