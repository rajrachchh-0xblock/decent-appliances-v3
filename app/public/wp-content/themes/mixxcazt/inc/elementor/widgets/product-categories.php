<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!mixxcazt_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

/**
 * Elementor Mixxcazt_Elementor_Products_Categories
 * @since 1.0.0
 */
class Mixxcazt_Elementor_Products_Categories extends Elementor\Widget_Base {

    public function get_categories() {
        return array('mixxcazt-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'mixxcazt-product-categories';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Product Categories', 'mixxcazt');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Settings', 'mixxcazt'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_cate_layout',
            [
                'label'   => esc_html__('Layout', 'mixxcazt'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1' => esc_html__('Style 1', 'mixxcazt'),
                    'style-2' => esc_html__('Style 2', 'mixxcazt'),
                    'style-3' => esc_html__('Style 3', 'mixxcazt'),
                    'style-4' => esc_html__('Style 4', 'mixxcazt'),
                    'style-5' => esc_html__('Style 5', 'mixxcazt'),
                    'style-6' => esc_html__('Style 6', 'mixxcazt'),
                    'style-7' => esc_html__('Style 7', 'mixxcazt'),
                    'style-8' => esc_html__('Style 8', 'mixxcazt'),
                    'style-9' => esc_html__('Style 9', 'mixxcazt'),
                ]
            ]
        );

        $this->add_control(
            'categories_type',
            [
                'label'   => esc_html__('Type', 'mixxcazt'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'cate_image',
                'options' => [
                    'cate_image' => esc_html__('Image', 'mixxcazt'),
                    'cate_icon'  => esc_html__('Icon', 'mixxcazt'),
                ]
            ]
        );

        $this->add_control(
            'categories_name',
            [
                'label' => esc_html__('Alternate Name', 'mixxcazt'),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'       => esc_html__('Categories', 'mixxcazt'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'options'     => $this->get_product_categories(),
                'multiple'    => false,
            ]
        );

        $this->add_control(
            'category_icon',
            [
                'label'     => esc_html__('Icon', 'mixxcazt'),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'categories_type' => 'cate_icon'
                ]
            ]
        );

        $this->add_control(
            'category_image',
            [
                'label'      => esc_html__('Choose Image', 'mixxcazt'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
                'condition'  => [
                    'categories_type' => 'cate_image'
                ]
            ]

        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
                'condition' => [
                    'categories_type' => 'cate_image'
                ]
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'     => esc_html__('Alignment', 'mixxcazt'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'mixxcazt'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'mixxcazt'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'mixxcazt'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .cat-title'                  => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .link_category_product'      => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'layout_bg_style',
            [
                'label' => esc_html__('Wrapper', 'mixxcazt'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'wrap_background',
                'selectors' => [
                    '{{WRAPPER}} .product-cat'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'selector' => '{{WRAPPER}} .product-cat',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'mixxcazt'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'layout_bg_padding',
            [
                'label'      => esc_html__('Padding', 'mixxcazt'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'mixxcazt'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tilte_typography',
                'selector' => '{{WRAPPER}} .cat-title .title',
            ]
        );

        $this->start_controls_tabs('tab_title');
        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => esc_html__('Normal', 'mixxcazt'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_background',
            [
                'label'     => esc_html__('Background', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title ' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => esc_html__('Hover', 'mixxcazt'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-title .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_background_hover',
            [
                'label'     => esc_html__('Background Hover', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-title ' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'mixxcazt'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .cat-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'total_style',
            [
                'label' => esc_html__('Total', 'mixxcazt'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'total_typography',
                'selector' => '{{WRAPPER}} .cat-total',
            ]
        );

        $this->start_controls_tabs('tab_total');
        $this->start_controls_tab(
            'tab_total_normal',
            [
                'label' => esc_html__('Normal', 'mixxcazt'),
            ]
        );
        $this->add_control(
            'total_color',
            [
                'label'     => esc_html__('Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-total' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_total_hover',
            [
                'label' => esc_html__('Hover', 'mixxcazt'),
            ]
        );
        $this->add_control(
            'total_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-total' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_responsive_control(
            'total_padding',
            [
                'label'      => esc_html__('Padding', 'mixxcazt'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .product-cat .cat-total' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label'           => esc_html__('Image', 'mixxcazt'),
                'tab'             => Controls_Manager::TAB_STYLE,
                'categories_type' => 'cate_image'
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'mixxcazt'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat .link_category_product img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'mixxcazt'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat .link_category_product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'icon_style',
            [
                'label'     => esc_html__('Icon', 'mixxcazt'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'categories_type' => 'cate_icon'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => esc_html__('Spacing', 'mixxcazt'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 15,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .link_category_product' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Size', 'mixxcazt'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 200,
                    ],
                ],
                'default'   => [
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .link_category_product' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .link_category_product svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tab_icon');
        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => esc_html__('Normal', 'mixxcazt'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .link_category_product' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => esc_html__('Hover', 'mixxcazt'),
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .link_category_product' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results    = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['categories'])) {
            echo esc_html__('Choose Category', 'mixxcazt');
            return;
        }
        $has_icon = !empty($settings['icon']);

        if ($has_icon) {
            $this->add_render_attribute('i', 'class', $settings['icon']);
            $this->add_render_attribute('i', 'aria-hidden', 'true');
        }

        $category = get_term_by('slug', $settings['categories'], 'product_cat');

        $this->add_render_attribute('wrapp', 'class', 'product-cat');
        $this->add_render_attribute('wrapp', 'class', esc_attr($settings['product_cate_layout']));
        if (!is_wp_error($category)) {

            if (!empty($settings['category_image']['id'])) {
                $image = Group_Control_Image_Size::get_attachment_image_src($settings['category_image']['id'], 'image', $settings);
            } else {
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                if (!empty($thumbnail_id)) {
                    $image = wp_get_attachment_url($thumbnail_id);
                }elseif (!empty($settings['category_image']['url'])){
                    $image = $settings['category_image']['url'];
                } else {
                    $image = wc_placeholder_img_src();
                }
            }
            ?>
            <div <?php echo mixxcazt_elementor_get_render_attribute_string('wrapp', $this); ?>>
                <div class="cat-image">
                    <a class="link_category_product" href="<?php echo esc_url(get_term_link($category)); ?>" title="<?php echo esc_attr($category->name); ?>">
                        <?php if ($settings['categories_type'] == 'cate_image'): ?>
                            <img src="<?php echo esc_url_raw($image); ?>" alt="<?php echo esc_html($category->name); ?>">
                        <?php else:
                            $migrated = isset($settings['__fa4_migrated']['selected_icon']);
                            $is_new = !isset($settings['icon']) && Icons_Manager::is_migration_allowed();

                            if ($is_new || $migrated) {
                                Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                            } elseif (!empty($settings['icon'])) {
                                ?>
                            <i <?php echo mixxcazt_elementor_get_render_attribute_string('i', $this); ?>></i><?php
                            }
                        endif; ?>
                    </a>
                    <div class="product-cat-caption">
                        <div class="cat-title">
                            <a class="title" href="<?php echo esc_url(get_term_link($category)); ?>" title="<?php echo esc_attr($category->name); ?>">
                                <span class="cats-title-text"><?php echo empty($settings['categories_name']) ? esc_html($category->name) : sprintf('%s', $settings['categories_name']); ?></span>
                            </a>
                            <div class="cat-total"><?php echo esc_html($category->count) . ' ' . esc_html__('products', 'mixxcazt'); ?></div>
                            <a class="cat-button" href="<?php echo esc_url(get_term_link($category)); ?>" title="<?php echo esc_attr($category->name); ?>"><?php echo esc_html__('Shop Now', 'mixxcazt'); ?></a>
                        </div>

                    </div>
                </div>
            </div>
            <?php

        }

    }
}

$widgets_manager->register(new Mixxcazt_Elementor_Products_Categories());

