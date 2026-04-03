<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Mixxcazt_Elementor_Search extends Elementor\Widget_Base {
    public function get_name() {
        return 'mixxcazt-search';
    }

    public function get_title() {
        return esc_html__('Mixxcazt Search Form', 'mixxcazt');
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return array('mixxcazt-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'search-form-style',
            [
                'label' => esc_html__('Style', 'mixxcazt'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'   => esc_html__('Layout Style', 'mixxcazt'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'mixxcazt'),
                    'layout-2' => esc_html__('Layout 2', 'mixxcazt'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'style_search',
            [
                'label'        => esc_html__('Style', 'mixxcazt'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'style-1' => esc_html__('Style 1', 'mixxcazt'),
                    'style-2' => esc_html__('Style 2', 'mixxcazt'),
                ],
                'condition'    => [
                    'layout_style' => 'layout-1',
                ],
                'prefix_class' => 'search-form-',
                'default'      => 'style-1',
            ]
        );

        $this->add_control(
            'hide_cat',
            [
                'label'        => esc_html__('Hide filter categories', 'mixxcazt'),
                'type'         => Controls_Manager::SWITCHER,
                'condition'    => [
                    'layout_style' => 'layout-1',
                ],
                'prefix_class' => 'search-form-hide-cat-',
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label'      => esc_html__('Border width', 'mixxcazt'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} form input[type=search]' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__('Border Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color_focus',
            [
                'label'     => esc_html__('Border Color Focus', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_form',
            [
                'label'     => esc_html__('Background Form', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'background_button',
            [
                'label'     => esc_html__('Background Button', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .widget_product_search form button[type=submit]:not(:hover)' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'background_button_hover',
            [
                'label'     => esc_html__('Background Button Hover', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .widget_product_search form button[type=submit]:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color_form',
            [
                'label'     => esc_html__('Color Icon', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .widget_product_search button[type=submit]:after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius_button',
            [
                'label'      => esc_html__('Border Radius Button', 'mixxcazt'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .widget_product_search form button[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius_input',
            [
                'label'      => esc_html__('Border Radius Input', 'mixxcazt'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .widget_product_search form input[type=search]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['layout_style'] === 'layout-1' && mixxcazt_is_woocommerce_activated()):{
            mixxcazt_product_search();
        }
        endif;

        if ($settings['layout_style'] === 'layout-2'):{
            wp_enqueue_script('mixxcazt-search-popup');
            add_action('wp_footer', 'mixxcazt_header_search_popup', 1);
            ?>
            <div class="site-header-search">
                <a href="#" class="button-search-popup">
                    <i class="mixxcazt-icon-search"></i>
                    <span class="content"><?php echo esc_html__('Search', 'mixxcazt'); ?></span>
                </a>
            </div>
            <?php
        }
        endif;
    }
}

$widgets_manager->register(new Mixxcazt_Elementor_Search());
