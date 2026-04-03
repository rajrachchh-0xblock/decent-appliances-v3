<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Mixxcazt_Customize')) {

    class Mixxcazt_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         */
        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */
            require_once get_theme_file_path('inc/customize-control/editor.php');
            $this->init_mixxcazt_blog($wp_customize);

            $this->init_mixxcazt_social($wp_customize);

            if (mixxcazt_is_woocommerce_activated()) {
                $this->init_woocommerce($wp_customize);
            }

            do_action('mixxcazt_customize_register', $wp_customize);
        }


        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_mixxcazt_blog($wp_customize) {

            $wp_customize->add_section('mixxcazt_blog_archive', array(
                'title' => esc_html__('Blog', 'mixxcazt'),
            ));

            // =========================================
            // Select Style
            // =========================================

            $wp_customize->add_setting('mixxcazt_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'standard',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('mixxcazt_options_blog_style', array(
                'section' => 'mixxcazt_blog_archive',
                'label'   => esc_html__('Blog style', 'mixxcazt'),
                'type'    => 'select',
                'choices' => array(
                    'standard' => esc_html__('Blog Standard', 'mixxcazt'),
                    'grid'     => esc_html__('Blog Grid', 'mixxcazt'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_mixxcazt_social($wp_customize) {

            $wp_customize->add_section('mixxcazt_social', array(
                'title' => esc_html__('Socials', 'mixxcazt'),
            ));
            $wp_customize->add_setting('mixxcazt_options_social_share', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('mixxcazt_options_social_share', array(
                'type'    => 'checkbox',
                'section' => 'mixxcazt_social',
                'label'   => esc_html__('Show Social Share', 'mixxcazt'),
            ));
            $wp_customize->add_setting('mixxcazt_options_social_share_facebook', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('mixxcazt_options_social_share_facebook', array(
                'type'    => 'checkbox',
                'section' => 'mixxcazt_social',
                'label'   => esc_html__('Share on Facebook', 'mixxcazt'),
            ));
            $wp_customize->add_setting('mixxcazt_options_social_share_twitter', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('mixxcazt_options_social_share_twitter', array(
                'type'    => 'checkbox',
                'section' => 'mixxcazt_social',
                'label'   => esc_html__('Share on Twitter', 'mixxcazt'),
            ));
            $wp_customize->add_setting('mixxcazt_options_social_share_linkedin', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('mixxcazt_options_social_share_linkedin', array(
                'type'    => 'checkbox',
                'section' => 'mixxcazt_social',
                'label'   => esc_html__('Share on Linkedin', 'mixxcazt'),
            ));
            $wp_customize->add_setting('mixxcazt_options_social_share_google-plus', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('mixxcazt_options_social_share_google-plus', array(
                'type'    => 'checkbox',
                'section' => 'mixxcazt_social',
                'label'   => esc_html__('Share on Google+', 'mixxcazt'),
            ));

            $wp_customize->add_setting('mixxcazt_options_social_share_pinterest', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('mixxcazt_options_social_share_pinterest', array(
                'type'    => 'checkbox',
                'section' => 'mixxcazt_social',
                'label'   => esc_html__('Share on Pinterest', 'mixxcazt'),
            ));
            $wp_customize->add_setting('mixxcazt_options_social_share_email', array(
                'type'       => 'option',
                'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('mixxcazt_options_social_share_email', array(
                'type'    => 'checkbox',
                'section' => 'mixxcazt_social',
                'label'   => esc_html__('Share on Email', 'mixxcazt'),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_woocommerce($wp_customize) {

            $wp_customize->add_panel('woocommerce', array(
                'title' => esc_html__('Woocommerce', 'mixxcazt'),
            ));

            $wp_customize->add_section('mixxcazt_woocommerce_archive', array(
                'title'      => esc_html__('Archive', 'mixxcazt'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            $wp_customize->add_setting('mixxcazt_options_woocommerce_archive_layout', array(
                'type'              => 'option',
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('mixxcazt_options_woocommerce_archive_layout', array(
                'section' => 'mixxcazt_woocommerce_archive',
                'label'   => esc_html__('Layout Style', 'mixxcazt'),
                'type'    => 'select',
                'choices' => array(
                    'default'  => esc_html__('Sidebar', 'mixxcazt'),
                    'canvas'   => esc_html__('Canvas Filter', 'mixxcazt'),
                    'dropdown' => esc_html__('Dropdown Filter', 'mixxcazt'),
                ),
            ));

            $wp_customize->add_setting('mixxcazt_options_woocommerce_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('mixxcazt_options_woocommerce_archive_sidebar', array(
                'section' => 'mixxcazt_woocommerce_archive',
                'label'   => esc_html__('Sidebar Position', 'mixxcazt'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'mixxcazt'),
                    'right' => esc_html__('Right', 'mixxcazt'),

                ),
            ));

            // =========================================
            // Single Product
            // =========================================

            $wp_customize->add_section('mixxcazt_woocommerce_single', array(
                'title'      => esc_html__('Single Product', 'mixxcazt'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('mixxcazt_options_single_product_gallery_layout', array(
                'type'              => 'option',
                'default'           => 'horizontal',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('mixxcazt_options_single_product_gallery_layout', array(
                'section' => 'mixxcazt_woocommerce_single',
                'label'   => esc_html__('Style', 'mixxcazt'),
                'type'    => 'select',
                'choices' => array(
                    'horizontal' => esc_html__('Horizontal', 'mixxcazt'),
                    'vertical'   => esc_html__('Vertical', 'mixxcazt'),
                    'gallery'    => esc_html__('Gallery', 'mixxcazt'),
                    'sticky'     => esc_html__('Sticky', 'mixxcazt'),
                ),
            ));

            $wp_customize->add_setting('mixxcazt_options_single_product_content_meta', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'mixxcazt_sanitize_editor',
            ));

            $wp_customize->add_control(new Mixxcazt_Customize_Control_Editor($wp_customize, 'mixxcazt_options_single_product_content_meta', array(
                'section' => 'mixxcazt_woocommerce_single',
                'label'   => esc_html__('Single extra description', 'mixxcazt'),
            )));
			$wp_customize->add_setting('mixxcazt_options_single_product_archive_sidebar', array(
				'type'              => 'option',
				'default'           => 'left',
				'sanitize_callback' => 'sanitize_text_field',
			));
			$wp_customize->add_control('mixxcazt_options_single_product_archive_sidebar', array(
				'section' => 'mixxcazt_woocommerce_single',
				'label'   => esc_html__('Sidebar Position', 'mixxcazt'),
				'type'    => 'select',
				'choices' => array(
					'left'  => esc_html__('Left', 'mixxcazt'),
					'right' => esc_html__('Right', 'mixxcazt'),

				),
			));


            // =========================================
            // Product
            // =========================================

            $wp_customize->add_section('mixxcazt_woocommerce_product', array(
                'title'      => esc_html__('Product Block', 'mixxcazt'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('mixxcazt_options_wocommerce_block_style', array(
                'type'              => 'option',
                'default'           => '1',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('mixxcazt_options_wocommerce_block_style', array(
                'section' => 'mixxcazt_woocommerce_product',
                'label'   => esc_html__('Style', 'mixxcazt'),
                'type'    => 'select',
                'choices' => array(
                    '1' => esc_html__('Style 1', 'mixxcazt'),
                    '2' => esc_html__('Style 2', 'mixxcazt'),
                    '3' => esc_html__('Style 3', 'mixxcazt'),
                    '4' => esc_html__('Style 4', 'mixxcazt'),
                    '5' => esc_html__('Style 5', 'mixxcazt'),
					'6' => esc_html__('Style 6', 'mixxcazt'),
                ),
            ));

            $wp_customize->add_setting('mixxcazt_options_woocommerce_product_hover', array(
                'type'              => 'option',
                'default'           => 'none',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('mixxcazt_options_woocommerce_product_hover', array(
                'section' => 'mixxcazt_woocommerce_product',
                'label'   => esc_html__('Animation Image Hover', 'mixxcazt'),
                'type'    => 'select',
                'choices' => array(
                    'none'          => esc_html__( 'None', 'mixxcazt' ),
                    'bottom-to-top' => esc_html__( 'Bottom to Top', 'mixxcazt' ),
                    'top-to-bottom' => esc_html__( 'Top to Bottom', 'mixxcazt' ),
                    'right-to-left' => esc_html__( 'Right to Left', 'mixxcazt' ),
                    'left-to-right' => esc_html__( 'Left to Right', 'mixxcazt' ),
                    'swap'          => esc_html__( 'Swap', 'mixxcazt' ),
                    'fade'          => esc_html__( 'Fade', 'mixxcazt' ),
                    'zoom-in'       => esc_html__( 'Zoom In', 'mixxcazt' ),
                    'zoom-out'      => esc_html__( 'Zoom Out', 'mixxcazt' ),
                ),
            ));
        }
    }
}
return new Mixxcazt_Customize();
