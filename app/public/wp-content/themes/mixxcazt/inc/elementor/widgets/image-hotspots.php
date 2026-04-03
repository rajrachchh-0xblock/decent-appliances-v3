<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


class Mixxcazt_Image_Hotspots extends Elementor\Widget_Base {
    public function get_name() {
        return 'mixxcazt-image-hotspots';
    }

    public function is_reload_preview_required() {
        return true;
    }

    public function get_title() {
        return esc_html__('Mixxcazt Image Hotspots', 'mixxcazt');
    }

    public function get_script_depends() {
        return ['mixxcazt-elementor-image-hotspots', 'tooltipster'];
    }

    public function get_style_depends() {
        return ['tooltipster'];
    }

    public function get_categories() {
        return array('mixxcazt-addons');
    }

    public function get_icon() {
        return 'eicon-image-hotspot';
    }

    protected function register_controls() {


        /**START Background Image Section  **/
        $this->start_controls_section('image_hotspots_image_section',
            [
                'label' => esc_html__('Wrapper', 'mixxcazt'),
            ]
        );

        $this->add_control(
            'image_hotspots_layout',
            [
                'label'   => esc_html__('Layout', 'mixxcazt'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'tooltips' => esc_html__('Tooltips', 'mixxcazt'),
                ],
                'default' => 'tooltips'
            ]
        );

        $this->add_control('image_hotspots_image',
            [
                'label'       => esc_html__('Choose Image', 'mixxcazt'),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'label_block' => true
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'background_image', // Actually its `image_size`.
                'default' => 'full'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_icons_settings',
            [
                'label' => esc_html__('Hotspots', 'mixxcazt'),
            ]
        );

        $repeater = new Elementor\Repeater();

        $repeater->add_responsive_control('mixxcazt_image_hotspots_main_icons_horizontal_position',
            [
                'label'      => esc_html__('Horizontal Position', 'mixxcazt'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default'    => [
                    'size' => 50,
                    'unit' => '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.mixxcazt-image-hotspots-main-icons' => 'left: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_responsive_control('mixxcazt_image_hotspots_main_icons_vertical_position',
            [
                'label'      => esc_html__('Vertical Position', 'mixxcazt'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default'    => [
                    'size' => 50,
                    'unit' => '%'
                ],
                'selectors'  => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.mixxcazt-image-hotspots-main-icons' => 'top: {{SIZE}}{{UNIT}}'
                ]
            ]
        );

        $repeater->add_control('image_hotspots_tooltips_icon',
            [
                'label'   => esc_html__('Icon', 'mixxcazt'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]);


        $repeater->add_control('image_hotspots_tooltips_texts',
            [
                'label'   => esc_html__('Heading', 'mixxcazt'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Lorem ipsum',
                'dynamic'     => ['active' => true],
                'label_block' => true,

            ]);

        $repeater->add_control('image_hotspots_tooltips_price',
            [
                'label'   => esc_html__('Price', 'mixxcazt'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'label_block' => true,
            ]);

        $repeater->add_control(
            'image_hotspots_tooltips_image',
            [
                'label'      => esc_html__('Choose Image', 'mixxcazt'),
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'image_hotspots_tooltips_link',
            [
                'label'       => esc_html__('Link to', 'mixxcazt'),
                'placeholder' => esc_html__('https://your-link.com', 'mixxcazt'),
                'type'        => Controls_Manager::URL,
            ]
        );

        $this->add_control('image_hotspots_icons',
            [
                'label'  => esc_html__('Hotspots', 'mixxcazt'),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_hotspots_tooltips_image',
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('image_hotspots_tooltips_section',
            [
                'label'     => esc_html__('Tooltips', 'mixxcazt'),
                'condition' =>
                    [
                        'image_hotspots_layout' => ['tooltips'],
                    ]
            ]
        );

        $this->add_control(
            'image_hotspots_trigger_type',
            [
                'label'   => esc_html__('Trigger', 'mixxcazt'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'click' => esc_html__('Click', 'mixxcazt'),
                    'hover' => esc_html__('Hover', 'mixxcazt'),
                ],
                'default' => 'hover'
            ]
        );

        $this->add_control(
            'image_hotspots_arrow',
            [
                'label'     => esc_html__('Show Line', 'mixxcazt'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__('Show', 'mixxcazt'),
                'label_off' => esc_html__('Hide', 'mixxcazt'),
                'default' => 'label_on'
            ]
        );

        $this->add_control(
            'image_hotspots_tooltips_position',
            [
                'label'       => esc_html__('Positon', 'mixxcazt'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => [
                    'top'    => esc_html__('Top', 'mixxcazt'),
                    'bottom' => esc_html__('Bottom', 'mixxcazt'),
                    'left'   => esc_html__('Left', 'mixxcazt'),
                    'right'  => esc_html__('Right', 'mixxcazt'),
                ],
                'description' => esc_html__('Sets the side of the tooltip. The value may one of the following: \'top\', \'bottom\', \'left\', \'right\'. It may also be an array containing one or more of these values. When using an array, the order of values is taken into account as order of fallbacks and the absence of a side disables it', 'mixxcazt'),
                'default'     => ['top', 'bottom'],
                'label_block' => true,
                'multiple'    => true
            ]
        );

        $this->add_control('image_hotspots_tooltips_distance_position',
            [
                'label'   => esc_html__('Spacing', 'mixxcazt'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('The distance between the origin and the tooltip in pixels, default is 6', 'mixxcazt'),
                'default' => 6,
            ]
        );

        $this->add_control('image_hotspots_min_width',
            [
                'label'       => esc_html__('Min Width', 'mixxcazt'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'description' => esc_html__('Set a minimum width for the tooltip in pixels, default: 0 (auto width)', 'mixxcazt'),
            ]
        );

        $this->add_control('image_hotspots_max_width',
            [
                'label'       => esc_html__('Max Width', 'mixxcazt'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'description' => esc_html__('Set a maximum width for the tooltip in pixels, default: null (no max width)', 'mixxcazt'),
            ]
        );

        $this->add_responsive_control('image_hotspots_tooltips_wrapper_height',
            [
                'label'       => esc_html__('Height', 'mixxcazt'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px', 'em', '%'],
                'range'       => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 20,
                    ]
                ],
                'label_block' => true,
                'selectors'   => [
                    '.tooltipster-box.tooltipster-box-{{ID}}' => 'height: {{SIZE}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->add_control('image_hotspots_anim',
            [
                'label'       => esc_html__('Animation', 'mixxcazt'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'fade'  => esc_html__('Fade', 'mixxcazt'),
                    'grow'  => esc_html__('Grow', 'mixxcazt'),
                    'swing' => esc_html__('Swing', 'mixxcazt'),
                    'slide' => esc_html__('Slide', 'mixxcazt'),
                    'fall'  => esc_html__('Fall', 'mixxcazt'),
                ],
                'default'     => 'fade',
                'label_block' => true,
            ]
        );

        $this->add_control('image_hotspots_anim_dur',
            [
                'label'   => esc_html__('Animation Duration', 'mixxcazt'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('Set the animation duration in milliseconds, default is 350', 'mixxcazt'),
                'default' => 350,
            ]
        );

        $this->add_control('image_hotspots_delay',
            [
                'label'   => esc_html__('Delay', 'mixxcazt'),
                'type'    => Controls_Manager::NUMBER,
                'title'   => esc_html__('Set the animation delay in milliseconds, default is 10', 'mixxcazt'),
                'default' => 10,
            ]
        );

        $this->add_control('image_hotspots_hide',
            [
                'label'        => esc_html__('Hide on Mobiles', 'mixxcazt'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => 'Show',
                'label_off'    => 'Hide',
                'description'  => esc_html__('Hide tooltips on mobile phones', 'mixxcazt'),
                'return_value' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_hotspots_wrapper',
            [
                'label' => esc_html__('Wrapper', 'mixxcazt'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Width', 'mixxcazt' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px', 'vw' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mixxcazt-image-hotspots-container .mixxcazt-addons-image-hotspots-ib-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Height', 'mixxcazt' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units' => [ 'px', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mixxcazt-image-hotspots-container .mixxcazt-addons-image-hotspots-ib-img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function render($instance = []) {
        // get our input from the widget settings.
        $settings = $this->get_settings_for_display();

        $image_src = $settings['image_hotspots_image'];

        $image_src_size = Group_Control_Image_Size::get_attachment_image_src($image_src['id'], 'background_image', $settings);
        if (empty($image_src_size)) : $image_src_size = $image_src['url'];
        else: $image_src_size = $image_src_size; endif;

        $image_hotspots_settings = [
            'anim'        => $settings['image_hotspots_anim'],
            'animDur'     => !empty($settings['image_hotspots_anim_dur']) ? $settings['image_hotspots_anim_dur'] : 350,
            'delay'       => !empty($settings['image_hotspots_anim_delay']) ? $settings['image_hotspots_anim_delay'] : 10,
            'arrow'       => ($settings['image_hotspots_arrow'] == 'yes') ? true : false,
            'distance'    => !empty($settings['image_hotspots_tooltips_distance_position']) ? $settings['image_hotspots_tooltips_distance_position'] : 6,
            'minWidth'    => !empty($settings['image_hotspots_min_width']['size']) ? $settings['image_hotspots_min_width']['size'] : 0,
            'maxWidth'    => !empty($settings['image_hotspots_max_width']['size']) ? $settings['image_hotspots_max_width']['size'] : 'null',
            'side'        => !empty($settings['image_hotspots_tooltips_position']) ? $settings['image_hotspots_tooltips_position'] : array(
                'right',
                'left'
            ),
            'hideMobiles' => ($settings['image_hotspots_hide'] == true) ? true : false,
            'trigger'     => $settings['image_hotspots_trigger_type'],
            'id'          => $this->get_id(),
            'layout'      => $settings['image_hotspots_layout'],
        ];

        $migrated = isset($settings['__fa4_migrated']['selected_icon']);
        $is_new   = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

        if (empty($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
            $settings['icon'] = 'fa fa-star';
        }

        if (!empty($settings['icon'])) {
            $this->add_render_attribute('icon', 'class', $settings['icon']);
            $this->add_render_attribute('icon', 'aria-hidden', 'true');
        }
        ?>

        <div id="mixxcazt-image-hotspots-<?php echo esc_attr($this->get_id()); ?>" class="mixxcazt-image-hotspots-container <?php echo esc_attr($settings['image_hotspots_layout']); ?>" data-settings='<?php echo wp_json_encode($image_hotspots_settings); ?>'>
            <img class="mixxcazt-addons-image-hotspots-ib-img" alt="<?php esc_attr_e('Background', 'mixxcazt'); ?>" src="<?php echo esc_url($image_src_size); ?>">
            <?php foreach ($settings['image_hotspots_icons'] as $index => $item) {
                $list_item_key = 'img_hotspot_' . $index;

                $main_icon_class = [
                    'mixxcazt-image-hotspots-main-icons',
                    'elementor-repeater-item-' . $item['_id'],
                    'tooltip-wrapper',
                    'mixxcazt-image-hotspots-main-icons-' . $item['_id']
                ];
                $this->add_render_attribute($list_item_key, 'class', $main_icon_class);
                $this->add_render_attribute($list_item_key, 'data-tab', '#elementor-hotspots-tab-content-' . $item['_id']);

                $migrated = isset($settings['__fa4_migrated']['image_hotspots_tooltips_icon']);
                ?>
                <div <?php echo mixxcazt_elementor_get_render_attribute_string($list_item_key, $this); ?> data-tooltip-content="#tooltip_content-<?php echo esc_attr($item['_id']); ?>">
                    <div class="mixxcazt-image-hotspots-icon">
                        <?php
                            if ($is_new || $migrated) {
                                Icons_Manager::render_icon($item['image_hotspots_tooltips_icon'], ['aria-hidden' => 'true']);
                            } else { ?>
                                <i <?php echo mixxcazt_elementor_get_render_attribute_string('icon', $this); // WPCS: XSS ok. ?>></i>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="mixxcazt-image-hotspots-tooltips-wrapper">
                        <div id="tooltip_content-<?php echo esc_attr($item['_id']); ?>" class="mixxcazt-image-hotspots-tooltips-text mixxcazt-image-hotspots-tooltips-text-<?php echo esc_attr($this->get_id()); ?>">
                            <?php if ($settings['image_hotspots_layout'] == 'tooltips'): ?>
                                <div class="image-hotspots-hover">
                                    <div class="image">
                                        <?php if (!empty($item['image_hotspots_tooltips_image']['url'])) :
                                            echo Group_Control_Image_Size::get_attachment_image_html($item, 'image_hotspots_tooltips_image', 'image_hotspots_tooltips_image');
                                        endif; ?>
                                    </div>
                                    <div class="content">
                                    <?php if (!empty($item['image_hotspots_tooltips_texts'])) : ?>
                                        <h2 class="heading-title">
                                            <?php if (!empty($item['image_hotspots_tooltips_link']['url'])){ ?>
                                                <a href="<?php echo esc_url($item['image_hotspots_tooltips_link']['url']); ?>"> <?php echo esc_html__($item['image_hotspots_tooltips_texts'], 'mixxcazt'); ?></a>
                                            <?php } else{ ?>
                                                <?php echo esc_html__($item['image_hotspots_tooltips_texts'], 'mixxcazt'); ?>
                                            <?php } ?>
                                        </h2>
                                    <?php endif; ?>
                                    <?php if (!empty($item['image_hotspots_tooltips_price'])) : ?>
                                        <div class="price"><?php echo esc_html__($item['image_hotspots_tooltips_price'], 'mixxcazt'); ?></div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
    }
}

$widgets_manager->register(new Mixxcazt_Image_Hotspots());
