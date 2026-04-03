<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Mixxcazt_Elementor__Menu_Canvas extends Elementor\Widget_Base{

    public function get_name()
    {
        return 'mixxcazt-menu-canvas';
    }

    public function get_title()
    {
        return esc_html__('Mixxcazt Menu Canvas', 'mixxcazt');
    }

    public function get_icon()
    {
        return 'eicon-nav-menu';
    }

    public function get_categories()
    {
        return ['opal-addons'];
    }

    protected function register_controls()
    {
        $this -> start_controls_section(
            'icon-menu_style',
            [
                'label' => esc_html__('Icon','mixxcazt'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_menu_size',
            [
                'label'     => esc_html__( 'Size Icon', 'mixxcazt' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_menu_color',
            [
                'label'     => esc_html__( 'Color', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button:not(:hover)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_menu_color_hover',
            [
                'label'     => esc_html__( 'Color Hover', 'mixxcazt' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .menu-mobile-nav-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'wrapper', 'class', 'elementor-canvas-menu-wrapper' );
        ?>
        <div <?php echo mixxcazt_elementor_get_render_attribute_string('wrapper', $this);?>>
            <?php mixxcazt_mobile_nav_button(); ?>
        </div>
        <?php
    }

}
$widgets_manager->register(new Mixxcazt_Elementor__Menu_Canvas());
