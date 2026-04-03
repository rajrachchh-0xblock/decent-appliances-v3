<?php
//Accordion
use Elementor\Controls_Manager;

add_action( 'elementor/element/accordion/section_title_style/before_section_end', function ($element, $args ) {
    $element->add_control(
        'title_margin',
        [
            'label' => esc_html__( 'Margin', 'mixxcazt' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'style_theme',
        [
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label' => esc_html__( 'Style Theme', 'mixxcazt' ),
            'prefix_class'	=> 'style-theme-mixxcazt-'
        ]
    );

},10,2);

add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', function ( $element, $args ) {

    $element->add_control(
        'title_background_active',
        [
            'label' => esc_html__( 'Background Active', 'mixxcazt' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}};',
            ],
        ]
    );

},10,2);
