<?php
// Button
use Elementor\Controls_Manager;

add_action( 'elementor/element/button/section_style/after_section_end', function ($element, $args ) {

    $element->update_control(
        'background_color',
        [
            'global' => [
                'default' => '',
            ],
        ]
    );
}, 10, 2 );

add_action('elementor/element/button/section_style/before_section_end', function ($element, $args) {
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
            'condition' => [
                'selected_icon[value]!' => '',
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
            'condition' => [
                'selected_icon[value]!' => '',
            ],
        ]
    );
}, 10, 2);

add_action( 'elementor/element/button/section_style/before_section_end', function ( $element, $args ) {

    $element -> add_control(
        'style_button_hover',
        [
            'label' => esc_html__('Hover Themes','mixxcazt'),
            'type' => Controls_Manager::SWITCHER,
            'prefix_class' => 'mixxcazt-style-button-hover-',
        ]
    );
    $element -> add_control(
        'style_button_hover_background',
        [
            'condition' => [
                'style_button_hover' => 'yes',
            ],
            'label' => esc_html__('Background Hover','mixxcazt'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}.mixxcazt-style-button-hover-yes .elementor-button:before' => 'background-color: {{VALUE}};',
            ],
        ]
    );
	$element -> add_control(
		'style_button_hover_border_radius',
		[
			'condition' => [
				'style_button_hover' => 'yes',
			],
			'label' => esc_html__('Background Radius','mixxcazt'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}}.mixxcazt-style-button-hover-yes .elementor-button:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
}, 10, 2 );
