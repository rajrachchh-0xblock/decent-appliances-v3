<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Mixxcazt_Elementor_Language_Switcher extends Elementor\Widget_Base {

    public function get_categories() {
        return array('mixxcazt-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'mixxcazt-language-switcher';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Language Switcher', 'mixxcazt');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-global-settings';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'section_language_switcher',
            [
                'label' => esc_html__('Layout', 'mixxcazt'),
            ]
        );

        $this->add_control('layout',
            [
                'label'        => esc_html__('Style', 'mixxcazt'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'style-1',
                'options'      => [
                    'style-1' => esc_html__('Style 1', 'mixxcazt'),
                    'style-2' => esc_html__('Style 2', 'mixxcazt'),
                    'style-3' => esc_html__('Style 3', 'mixxcazt'),
                    'style-mobile' => esc_html__('Style Mobile', 'mixxcazt'),
                ],
                'prefix_class' => 'language-switcher-'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .mixxcazt-language-switcher span',
            ]
        );

        $this->start_controls_tabs('style_color');

        $this->start_controls_tab('typo_normal',
            [
                'label' => esc_html__('Normal', 'mixxcazt'),
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => esc_html__('Label Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item > div span.label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item > div span.title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('typo_hover',
            [
                'label' => esc_html__('Hover', 'mixxcazt'),
            ]
        );

        $this->add_control(
            'label_color_hover',
            [
                'label'     => esc_html__('Label Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item > div:hover span.label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Title Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item > div:hover span.title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'hover_right',
            [
                'label' => esc_html__( 'Hover Right', 'mixxcazt' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'language-switcher-style-hover-right-',
            ]
        );

        $this->end_controls_section();


    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $languages = apply_filters('wpml_active_languages', []);
        if (!mixxcazt_is_wpml_activated() || count($languages) <= 0) {
            ?>
            <div class="mixxcazt-language-switcher">
                <ul class="menu">
                    <li class="item">
                        <div class="language-switcher-head">
                            <img src="<?php echo esc_attr(get_template_directory_uri() . '/assets/images/language-switcher/en.png'); ?>" alt="WPML">
                            <span>
                                <span class="label">
                                    <?php echo esc_html__('Language:', 'mixxcazt'); ?>
                                </span>
                                <span class="title"><?php echo esc_html__('English', 'mixxcazt'); ?></span>
                            </span>
                        </div>
                        <ul class="sub-item">
                            <li>
                                <a href="#">
                                    <img width="18" height="12" src="<?php echo esc_attr(get_template_directory_uri() . '/assets/images/language-switcher/de.png'); ?>" alt="WPML">
                                    <span><?php echo esc_html__('German', 'mixxcazt'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img width="18" height="12" src="<?php echo esc_attr(get_template_directory_uri() . '/assets/images/language-switcher/it.png'); ?>" alt="WPML">
                                    <span><?php echo esc_html__('Italian', 'mixxcazt'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img width="18" height="12" src="<?php echo esc_attr(get_template_directory_uri() . '/assets/images/language-switcher/hi.png'); ?>" alt="WPML">
                                    <span><?php echo esc_html__('Hindi', 'mixxcazt'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span><?php echo esc_html__('Requires WPML', 'mixxcazt'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
        } else {
            ?>
            <div class="mixxcazt-language-switcher">
                <ul class="menu">
                    <li class="item">
                        <div class="language-switcher-head">
                            <img src="<?php echo esc_url($languages[ICL_LANGUAGE_CODE]['country_flag_url']) ?>" alt="<?php esc_attr($languages[ICL_LANGUAGE_CODE]['default_locale']) ?>">
                            <span class="label">
                                    <?php echo esc_html__('Language:', 'mixxcazt'); ?>
                                </span>
                            <span class="title">
                                    <?php echo esc_html($languages[ICL_LANGUAGE_CODE]['translated_name']); ?>
                                </span>
                        </div>
                        <ul class="sub-item">
                            <?php
                            foreach ($languages as $key => $language) {
                                if (ICL_LANGUAGE_CODE === $key) {
                                    continue;
                                }
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($language['url']) ?>">
                                        <img width="18" height="12" src="<?php echo esc_url($language['country_flag_url']) ?>" alt="<?php esc_attr($language['default_locale']) ?>">
                                        <span><?php echo esc_html($language['translated_name']); ?></span>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
        }
    }
}

$widgets_manager->register(new Mixxcazt_Elementor_Language_Switcher());
