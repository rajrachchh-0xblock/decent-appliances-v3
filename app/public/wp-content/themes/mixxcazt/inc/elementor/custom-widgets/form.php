<?php
//Form

use Elementor\Controls_Manager;

add_action( 'elementor/element/form/section_field_style/before_section_end', function ($element, $args ) {
    $element->add_control(
        'field_border_color_focus',
        [
            'label' => esc_html__( 'Border Color Focus', 'mixxcazt' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-field-group:not(.elementor-field-type-upload) .elementor-field:not(.elementor-select-wrapper):focus' => 'border-color: {{VALUE}};',
                '{{WRAPPER}} .elementor-field-group .elementor-select-wrapper select:focus' => 'border-color: {{VALUE}};',
            ],
        ]
    );

    $element->add_control(
        'field_text_padding',
        [
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'label' => esc_html__( 'Padding', 'mixxcazt' ),
            'selectors' => [
                '{{WRAPPER}} .elementor-field-group:not(.elementor-field-type-upload):not(.elementor-field-type-recaptcha_v3):not(.elementor-field-type-recaptcha) .elementor-field:not(.elementor-select-wrapper)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .elementor-field-group .elementor-select-wrapper select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_control(
        'field_text_margin',
        [
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'label' => esc_html__( 'Margin', 'mixxcazt' ),
            'selectors' => [
                '{{WRAPPER}} .elementor-field-group .elementor-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_control(
        'textarea_heading',
        [
            'type' => \Elementor\Controls_Manager::HEADING,
            'label' => esc_html__( 'Textarea', 'mixxcazt' ),
            'separator'	=> 'before'
        ]
    );

    $element->add_control(
        'textarea_color',
        [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => esc_html__( 'Color', 'mixxcazt' ),
            'selectors' => [
                '{{WRAPPER}} textarea.elementor-field' => 'color: {{VALUE}} !important',
            ],
        ]
    );

    $element->add_control(
        'textarea_background',
        [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => esc_html__( 'Background', 'mixxcazt' ),
            'selectors' => [
                '{{WRAPPER}} textarea.elementor-field' => 'background: {{VALUE}} !important',
            ],
        ]
    );

    $element->add_control(
        'textarea_border_color',
        [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => esc_html__( 'Border Color', 'mixxcazt' ),
            'selectors' => [
                '{{WRAPPER}} textarea.elementor-field ' => 'border-color: {{VALUE}} !important',
            ],
        ]
    );

    $element->add_control(
        'textarea_border_color_active',
        [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => esc_html__( 'Border Color Active', 'mixxcazt' ),
            'selectors' => [
                '{{WRAPPER}} textarea.elementor-field:focus ' => 'border-color: {{VALUE}} !important',
            ],
        ]
    );

    $element->add_control(
        'textarea_border',
        [
            'label' => esc_html__( 'Border Width', 'mixxcazt' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 20,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} textarea.elementor-field' => 'border-width: {{SIZE}}{{UNIT}} !important;',
            ],
        ]
    );

    $element->add_control(
        'textarea_padding',
        [
            'label' => esc_html__( 'Padding', 'mixxcazt' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-field-group-message textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
        ]
    );


},10,2);

add_action('elementor/element/form/section_steps_style/after_section_end', function($element, $args){
    $element->update_control(
        'button_background_color',
        [
            'global' => [
                'default'	=> ''
            ]
        ]
    );
    $element->update_control(
        'button_text_padding',
        [
            'type' => Controls_Manager::HIDDEN,
        ]
    );
}, 10, 2);

add_action( 'elementor/element/form/section_field_style/before_section_end', function ( $element, $args ) {
    $element->add_control(
        'fields_alignment',
        [
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'label' => esc_html__( 'Alignment', 'mixxcazt' ),
            'options'   => [
                'left'   => [
                    'title' => esc_html__('Left', 'mixxcazt'),
                    'icon'  => 'fa fa-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'mixxcazt'),
                    'icon'  => 'fa fa-align-center',
                ],
                'right'  => [
                    'title' => esc_html__('Right', 'mixxcazt'),
                    'icon'  => 'fa fa-align-right',
                ],
            ],
            'prefix_class'	=> 'fields-align-'
        ]
    );
},10,2);

add_action('elementor/element/form/section_button_style/before_section_end', function($element, $args){

    $element -> add_responsive_control(
        'button_background_color_style_2',
        [
            'label' => esc_html__('Text Padding','mixxcazt'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'icon_button_size',
        [
            'label' => esc_html__('Icon Size', 'mixxcazt'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'button_icon_color',
        [
            'label'     => esc_html__('Icon Color', 'mixxcazt'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-button .elementor-button-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
            ],
        ]
    );

}, 10, 2);
