<?php

use Elementor\Controls_Manager;

add_action('elementor/element/tabs/section_tabs_style/before_section_end', function ($element, $args) {
	$element->add_responsive_control(
		'content_padding',
		[
			'type'      => \Elementor\Controls_Manager::DIMENSIONS,
			'label'     => esc_html__('Padding Content', 'mixxcazt'),
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_responsive_control(
		'title_padding',
		[
			'type'      => \Elementor\Controls_Manager::DIMENSIONS,
			'label'     => esc_html__('Padding Title', 'mixxcazt'),
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_responsive_control(
		'title_icon_padding',
		[
			'type'      => \Elementor\Controls_Manager::DIMENSIONS,
			'label'     => esc_html__('Padding Icon', 'mixxcazt'),
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
	$element->add_control(
		'icon_tab_size',
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
				'{{WRAPPER}} .elementor-tab-title a i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$element->add_control(
		'title_icon_tab_color',
		[
			'label'     =>esc_html__('Icon Color', 'mixxcazt'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title a i' => 'color: {{VALUE}};',
			],
		]
	);
	$element->add_control(
		'title_icon_tab_active_color',
		[
			'label'     =>esc_html__('Icon Active', 'mixxcazt'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-tab-title.elementor-active a i' => 'color: {{VALUE}};',
			],
		]
	);
}, 10, 2);
