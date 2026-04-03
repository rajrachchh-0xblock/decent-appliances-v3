<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if (!mixxcazt_is_mailchimp_activated()) {
    return;
}

use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;


class Mixxcazt_Elementor_Mailchimp extends Elementor\Widget_Base {

    public function get_name() {
        return 'mixxcazt-mailchmip';
    }

    public function get_title() {
        return esc_html__( 'MailChimp Sign-Up Form', 'mixxcazt' );
    }

    public function get_categories() {
        return array( 'mixxcazt-addons' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_script_depends() {
        return [ 'magnific-popup' ];
    }

    public function get_style_depends() {
        return [ 'magnific-popup' ];
    }


    protected function register_controls()
    {

        $this->start_controls_section(
            'mailchip_style',
            [
                'label' => esc_html__('Mailchimp', 'mixxcazt'),
            ]
        );

        $this->add_control(
            'mailchimp_style',
            [
                'label' => esc_html__('Style', 'mixxcazt'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => esc_html__('Style 1', 'mixxcazt'),
                    'style-2' => esc_html__('Style 2', 'mixxcazt'),
                    'style-3' => esc_html__('Style 3', 'mixxcazt'),
                    'style-4' => esc_html__('Style 4', 'mixxcazt'),
                ],
                'default' => 'style-1',
                'prefix_class' => 'mailchimp-'
            ]
        );
        $this->end_controls_section();
        //INPUT
        $this->start_controls_section(
            'mailchip_style_input',
            [
                'label' => esc_html__( 'Input', 'mixxcazt' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_input_style' );

        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label' => esc_html__( 'Normal', 'mixxcazt' ),
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label'     => esc_html__( 'Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-style .mc4wp-form .mc4wp-form-fields .form-input input[type="email"]' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_color_placeholder',
            [
                'label'     => esc_html__( 'Color Placeholder', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-style .mc4wp-form .mc4wp-form-fields .form-input input[type="email"]::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_background',
            [
                'label'     => esc_html__( 'Background Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-style .mc4wp-form .mc4wp-form-fields .form-input input[type="email"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_color_border',
            [
                'label'     => esc_html__( 'Color Border', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-style .mc4wp-form .mc4wp-form-fields .form-input input[type="email"]' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_input_focus',
            [
                'label' => esc_html__( 'Focus', 'mixxcazt' ),
            ]
        );

        $this->add_control(
            'input_background_focus',
            [
                'label'     => esc_html__( 'Background Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-style .mc4wp-form .mc4wp-form-fields .form-input input[type="email"]:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_border_color_focus',
            [
                'label'     => esc_html__( 'Border Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-style .mc4wp-form .mc4wp-form-fields .form-input input[type="email"]:focus' => 'border-color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'align_input',
            [
                'label'     => esc_html__( 'Alignment', 'mixxcazt' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'mixxcazt' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'mixxcazt' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'mixxcazt' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(

            Group_Control_Border::get_type(),
            [
                'name'        => 'border_input',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .mc4wp-form-fields input[type="email"]',
                'separator'   => 'before',
            ]
        );


        $this->add_responsive_control(
            'input_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'mixxcazt' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .mc4wp-form-fields input[type="email"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'input_margin',
            [
                'label'     => esc_html__( 'Margin', 'mixxcazt' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields .form-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]

        );

        $this->add_control(
            'input_padding',
            [
                'label'     => esc_html__( 'Padding', 'mixxcazt' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields .form-input input[type="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]

        );

        $this->end_controls_section();

        //Button
        $this->start_controls_section(
            'mailchip_style_button',
            [
                'label' => esc_html__( 'Button', 'mixxcazt' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'mixxcazt' ),
            ]
        );

        $this->add_control(
            'button_bacground',
            [
                'label'     => esc_html__( 'Background Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Text Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields .form-button i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border',
            [
                'label'     => esc_html__( 'Border Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'mixxcazt' ),
            ]
        );

        $this->add_control(
            'button_bacground_hover',
            [
                'label'     => esc_html__( 'Background Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__( 'Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_hover',
            [
                'label'     => esc_html__( 'Border Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_hover',
            [
                'label'     => esc_html__( 'Icon Color hover', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_button',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'mixxcazt' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .mc4wp-form-fields button[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __( 'Padding', 'mixxcazt' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .form-style .mc4wp-form .mc4wp-form-fields button[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        echo '<div class="form-style">';
        mc4wp_show_form();

        echo '</div>';
    }
}
$widgets_manager->register(new Mixxcazt_Elementor_Mailchimp());
