<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!mixxcazt_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Mixxcazt_Elementor_Breadcrumb extends Elementor\Widget_Base {

    public function get_name() {
        return 'woocommerce-breadcrumb';
    }

    public function get_title() {
        return __('Mixxcazt WooCommerce Breadcrumbs', 'mixxcazt');
    }

    public function get_icon() {
        return 'eicon-product-breadcrumbs';
    }

    public function get_categories() {
        return ['woocommerce-elements', 'woocommerce-elements-single'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_product_rating_style',
            [
                'label' => __('Style Breadcrumb', 'mixxcazt'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wc_style_warning',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __('The style of this widget is often affected by your theme and plugins. If you experience any such issue, try to switch to a basic theme and deactivate related plugins.', 'mixxcazt'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => __('Text Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-breadcrumb' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'     => __('Link Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-breadcrumb > a:not(:hover)' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography Link', 'mixxcazt' ),
                'name' => 'text_link_typography',
                'selector' => '{{WRAPPER}} .woocommerce-breadcrumb a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Typography Text', 'mixxcazt' ),
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .woocommerce-breadcrumb',
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'     => __('Alignment', 'mixxcazt'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'mixxcazt'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'mixxcazt'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'mixxcazt'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-breadcrumb' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_product_rating_style_title',
            [
                'label' => __( 'Style Title', 'mixxcazt' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color_title',
            [
                'label' => __( 'Title Color', 'mixxcazt' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mixxcazt-woocommerce-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .mixxcazt-woocommerce-title',
            ]
        );

        $this->add_control(
            'display_title',
            [
                'label' => __( 'Hidden Title', 'mixxcazt' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class'	=> 'hidden-mixxcazt-title-'
            ]
        );

        $this->add_control(
            'display_title_single',
            [
                'label' => __( 'Hidden Title Single', 'mixxcazt' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class'	=> 'hidden-mixxcazt-title-single-'
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Margin', 'mixxcazt' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .mixxcazt-woocommerce-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $args = apply_filters(
            'woocommerce_breadcrumb_defaults',
            array(
                'delimiter'   => '&nbsp;'.'<i class="mixxcazt-icon-long-arrow-right"></i>'.'&nbsp;',
                'wrap_before' => '<nav class="woocommerce-breadcrumb">',
                'wrap_after'  => '</nav>',
                'before'      => '',
                'after'       => '',
                'home'        => _x( 'Home Page', 'breadcrumb', 'mixxcazt' ),
            )
        );
        $breadcrumbs = new WC_Breadcrumb();
        if ( ! empty( $args['home'] ) ) {
            $breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
        }
        $args['breadcrumb'] = $breadcrumbs->generate();
        /**
         * WooCommerce Breadcrumb hook
         *
         * @see WC_Structured_Data::generate_breadcrumblist_data() - 10
         */
        do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

        printf('<div class="mixxcazt-woocommerce-title">%s</div>',$args['breadcrumb'][count($args['breadcrumb']) - 1][0]);
        wc_get_template( 'global/breadcrumb.php', $args );
    }
    public function render_plain_content() {}
}

$widgets_manager->register(new Mixxcazt_Elementor_Breadcrumb());
