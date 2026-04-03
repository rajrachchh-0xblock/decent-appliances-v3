<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! mixxcazt_is_woocommerce_activated() ) {
	return;
}

use Elementor\Controls_Manager;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Mixxcazt_Elementor_Widget_Products extends \Elementor\Widget_Base {


	public function get_categories() {
		return array( 'mixxcazt-addons' );
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
		return 'mixxcazt-products';
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
		return esc_html__( 'Products', 'mixxcazt' );
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


	public function get_script_depends() {
		return [
			'mixxcazt-elementor-products',
			'slick',
			'tooltipster'
		];
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
				'label' => esc_html__( 'Settings', 'mixxcazt' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Posts Per Page', 'mixxcazt' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_responsive_control(
			'column',
			[
				'label'          => esc_html__( 'columns', 'mixxcazt' ),
				'type'           => \Elementor\Controls_Manager::SELECT,
				'default'        => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'options'        => [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6 ],
			]
		);

        $this->add_control(
            'column_laptop',
            [
                'label'          => esc_html__( 'columns Laptop', 'mixxcazt' ),
                'type'           => \Elementor\Controls_Manager::SELECT,
                'default'        => 3,
                'options'        => [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6 ],
            ]
        );


		$this->add_control(
			'advanced',
			[
				'label' => esc_html__( 'Advanced', 'mixxcazt' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'mixxcazt' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'       => esc_html__( 'Date', 'mixxcazt' ),
					'id'         => esc_html__( 'Post ID', 'mixxcazt' ),
					'menu_order' => esc_html__( 'Menu Order', 'mixxcazt' ),
					'popularity' => esc_html__( 'Number of purchases', 'mixxcazt' ),
					'rating'     => esc_html__( 'Average Product Rating', 'mixxcazt' ),
					'title'      => esc_html__( 'Product Title', 'mixxcazt' ),
					'rand'       => esc_html__( 'Random', 'mixxcazt' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'mixxcazt' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => esc_html__( 'ASC', 'mixxcazt' ),
					'desc' => esc_html__( 'DESC', 'mixxcazt' ),
				],
			]
		);

		$this->add_control(
			'categories',
			[
				'label'    => esc_html__( 'Categories', 'mixxcazt' ),
				'type'     => Controls_Manager::SELECT2,
				'options'  => $this->get_product_categories(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'cat_operator',
			[
				'label'     => esc_html__( 'Category Operator', 'mixxcazt' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'IN',
				'options'   => [
					'AND'    => esc_html__( 'AND', 'mixxcazt' ),
					'IN'     => esc_html__( 'IN', 'mixxcazt' ),
					'NOT IN' => esc_html__( 'NOT IN', 'mixxcazt' ),
				],
				'condition' => [
					'categories!' => ''
				],
			]
		);

		$this->add_control(
			'tag',
			[
				'label'    => esc_html__( 'Tags', 'mixxcazt' ),
				'type'     => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'  => $this->get_product_tags(),
				'multiple' => true,
			]
		);

		$this->add_control(
			'tag_operator',
			[
				'label'     => esc_html__( 'Tag Operator', 'mixxcazt' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'IN',
				'options'   => [
					'AND'    => esc_html__( 'AND', 'mixxcazt' ),
					'IN'     => esc_html__( 'IN', 'mixxcazt' ),
					'NOT IN' => esc_html__( 'NOT IN', 'mixxcazt' ),
				],
				'condition' => [
					'tag!' => ''
				],
			]
		);

		$this->add_control(
			'product_type',
			[
				'label'   => esc_html__( 'Product Type', 'mixxcazt' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'newest',
				'options' => [
					'newest'       => esc_html__( 'Newest Products', 'mixxcazt' ),
					'on_sale'      => esc_html__( 'On Sale Products', 'mixxcazt' ),
					'best_selling' => esc_html__( 'Best Selling', 'mixxcazt' ),
					'top_rated'    => esc_html__( 'Top Rated', 'mixxcazt' ),
					'featured'     => esc_html__( 'Featured Product', 'mixxcazt' ),
				],
			]
		);

		$this->add_control(
			'paginate',
			[
				'label'   => esc_html__( 'Paginate', 'mixxcazt' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'       => esc_html__( 'None', 'mixxcazt' ),
					'pagination' => esc_html__( 'Pagination', 'mixxcazt' ),
				],
			]
		);

		$this->add_control(
			'product_layout',
			[
				'label'   => esc_html__( 'Product Layout', 'mixxcazt' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid' => esc_html__( 'Grid', 'mixxcazt' ),
					'list' => esc_html__( 'List', 'mixxcazt' ),
				],
			]
		);

        $this->add_control(
            'grid_layout_special',
            [
                'label'     => esc_html__( 'Grid Layout Special', 'mixxcazt' ),
                'type'      => Controls_Manager::SWITCHER,
                'default' => '',
                'condition' => [
                    'product_layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'grid_layout_border',
            [
                'label'     => esc_html__( 'Grid Border', 'mixxcazt' ),
                'type'      => Controls_Manager::SWITCHER,
                'default' => '',
                'condition' => [
                    'product_layout' => 'grid'
                ],
                'prefix_class' => 'grid-layout-border-',
            ]
        );

        $this->add_control(
            'grid_layout_border_all',
            [
                'label'     => esc_html__( 'Grid Border All', 'mixxcazt' ),
                'type'      => Controls_Manager::SWITCHER,
                'default' => '',
                'condition' => [
                    'product_layout' => 'grid'
                ],
                'prefix_class' => 'grid-layout-border-all-',
            ]
        );

		$this->add_control(
			'list_layout',
			[
				'label'     => esc_html__( 'List Layout', 'mixxcazt' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [
					'1' => esc_html__( 'Style 1', 'mixxcazt' ),
					'2' => esc_html__( 'Style 2', 'mixxcazt' ),
                    '3' => esc_html__( 'Style 3', 'mixxcazt' ),
                    '4' => esc_html__( 'Style 4', 'mixxcazt' ),
                    '5' => esc_html__( 'Style 5', 'mixxcazt' ),
                    '6' => esc_html__( 'Style 6', 'mixxcazt' ),
                    '7' => esc_html__( 'Style 7', 'mixxcazt' ),
                    '8' => esc_html__( 'Style 8', 'mixxcazt' ),
                    '9' => esc_html__( 'Style 9', 'mixxcazt' ),
                    '10' => esc_html__( 'Style 10', 'mixxcazt' ),
                    '11' => esc_html__( 'Style 11', 'mixxcazt' ),
                    '12' => esc_html__( 'Style 12', 'mixxcazt' ),
				],
				'condition' => [
					'product_layout' => 'list'
				]
			]
		);

		$this->add_responsive_control(
			'product_gutter',
			[
				'label'      => esc_html__( 'Gutter', 'mixxcazt' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} ul.products li.product'      => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ul.products li.product-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ul.products'                 => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
				],
			]
		);

		$this->end_controls_section();
		// End Section Query

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('List Style', 'mixxcazt'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style_1',
            [
                'label'     => esc_html__( 'List Style 1', 'mixxcazt' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'list_layout' => '1',
                    'product_layout' => 'list',
                ],
            ]
        );

        $this->add_control(
            'border_style_1',
            [
                'label' => esc_html__( 'Border', 'mixxcazt' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'border-products-list-1-',
                'default'   => 'yes',
                'condition' => [
                    'list_layout' => '1',
                    'product_layout' => 'list',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_width_style_1',
            [
                'label' => esc_html__( 'Border Width', 'mixxcazt' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition' => [
                    'border_style_1' => 'yes',
                    'list_layout' => '1',
                    'product_layout' => 'list',
                ],
                'selectors' => [
                    '{{WRAPPER}}.border-products-list-1-yes .woocommerce-product-list.products-list-1 ul.products .product-list-inner ' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'style_2',
            [
                'label'     => esc_html__( 'List Style 2', 'mixxcazt' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'list_layout' => '2',
                    'product_layout' => 'list',
                ],
            ]
        );

        $this->add_control(
            'border_style_2',
            [
                'label' => esc_html__( 'Border', 'mixxcazt' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'border-products-list-2-',
                'condition' => [
                    'list_layout' => '2',
                    'product_layout' => 'list',
                ],
            ]
        );

        $this->add_control(
            'style_3',
            [
                'label'     => esc_html__( 'List Style 3', 'mixxcazt' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'list_layout' => '3',
                    'product_layout' => 'list',
                ],
            ]
        );

        $this->add_control(
            'border_style_3',
            [
                'label' => esc_html__( 'Border', 'mixxcazt' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'border-products-list-3-',
                'default'   => 'yes',
                'condition' => [
                    'list_layout' => '3',
                    'product_layout' => 'list',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_width_style_3',
            [
                'label' => esc_html__( 'Border Width', 'mixxcazt' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition' => [
                    'border_style_3' => 'yes',
                    'list_layout' => '3',
                    'product_layout' => 'list',
                ],
                'selectors' => [
                    '{{WRAPPER}}.border-products-list-3-yes .woocommerce-product-list.products-list-3 ul.products .product-list-inner ' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_product_list',
            [
                'label' => esc_html__('Padding', 'mixxcazt'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'condition' => [
                    'product_layout' => 'list',
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.products .product-list-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__('Image', 'mixxcazt'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'mixxcazt'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} ul.products li.product .product-block img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} ul.products li.product .product-block .product-img-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();
		// Carousel Option
		$this->add_control_carousel();
	}


	protected function get_product_categories() {
		$categories = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
			)
		);
		$results    = array();
		if ( ! is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$results[ $category->slug ] = $category->name;
			}
		}

		return $results;
	}

	protected function get_product_tags() {
		$tags    = get_terms( array(
				'taxonomy'   => 'product_tag',
				'hide_empty' => false,
			)
		);
		$results = array();
		if ( ! is_wp_error( $tags ) ) {
			foreach ( $tags as $tag ) {
				$results[ $tag->slug ] = $tag->name;
			}
		}

		return $results;
	}

	protected function get_product_type( $atts, $product_type ) {
		switch ( $product_type ) {
			case 'featured':
				$atts['visibility'] = "featured";
				break;

			case 'on_sale':
				$atts['on_sale'] = true;
				break;

			case 'best_selling':
				$atts['best_selling'] = true;
				break;

			case 'top_rated':
				$atts['top_rated'] = true;
				break;

			default:
				break;
		}

		return $atts;
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
		$this->woocommerce_default( $settings );
	}

	private function woocommerce_default( $settings ) {
		$type = 'products';
		$atts = [
			'limit'          => $settings['limit'],
			'columns'        => $settings['enable_carousel'] === 'yes' ? 1 : $settings['column'],
			'orderby'        => $settings['orderby'],
			'order'          => $settings['order'],
			'product_layout' => $settings['product_layout'],
		];

		$class = '';


		if ( $settings['product_layout'] == 'list' ) {


			$class .= ' products-list';
			$class .= ' products-list-' . $settings['list_layout'];
			$class .= ' woocommerce-product-list';

            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '1') {
                $atts['show_rating']    = true;
            }

            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '2' ) {
                $atts['show_category'] = true;
                $atts['show_rating']    = true;
            }

            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '3' ) {
                $atts['show_category'] = true;
            }

            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '4' ) {
                $atts['show_rating']    = true;
            }

            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '5' ) {
                $atts['show_rating']    = true;
            }

            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '6') {
                $atts['show_rating']    = true;
                $atts['show_except']   = true;
                $atts['show_time_sale'] = true;
            }
            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '7' ) {
                $atts['show_rating']    = true;
                $atts['show_deal_progress'] = true;
                $atts['show_button_caption'] = true;
            }
            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '8') {
                $atts['show_category'] = true;
                $atts['show_rating']    = true;
                $atts['show_deal_progress'] = true;
                $atts['show_time_sale'] = true;
            }
            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '9') {
                $atts['show_category'] = true;
                $atts['show_rating']    = true;
                $atts['show_deal_progress'] = true;
                $atts['show_time_sale'] = true;
            }
            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '10') {
                $atts['show_rating']    = true;
                $atts['show_time_sale'] = true;
            }
            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '11') {
                $atts['show_rating']    = true;
                $atts['show_except']   = true;
                $atts['show_time_sale'] = true;
            }
            if ( ! empty( $settings['list_layout'] ) && $settings['list_layout'] == '12' ) {
                $atts['show_rating']    = true;
            }

		}


		$atts = $this->get_product_type( $atts, $settings['product_type'] );
		if ( isset( $atts['on_sale'] ) && wc_string_to_bool( $atts['on_sale'] ) ) {
			$type = 'sale_products';
		} elseif ( isset( $atts['best_selling'] ) && wc_string_to_bool( $atts['best_selling'] ) ) {
			$type = 'best_selling_products';
		} elseif ( isset( $atts['top_rated'] ) && wc_string_to_bool( $atts['top_rated'] ) ) {
			$type = 'top_rated_products';
		}

		if ( ! empty( $settings['categories'] ) ) {
			$atts['category']     = implode( ',', $settings['categories'] );
			$atts['cat_operator'] = $settings['cat_operator'];
		}

		if ( ! empty( $settings['tag'] ) ) {
			$atts['tag']          = implode( ',', $settings['tag'] );
			$atts['tag_operator'] = $settings['tag_operator'];
		}

		// Carousel
		if ( $settings['enable_carousel'] === 'yes' ) {
			$atts['carousel_settings'] = json_encode( wp_slash( $this->get_carousel_settings() ) );
			$atts['product_layout']    = 'carousel';
			if ( $settings['product_layout'] == 'list' ) {
				$atts['product_layout'] = 'list-carousel';
			}
		} else {

            if ( ! empty( $settings['column_laptop'] ) ) {
                $class .= ' columns-laptop-' . $settings['column_laptop'];
            }

			if ( ! empty( $settings['column_tablet'] ) ) {
				$class .= ' columns-tablet-' . $settings['column_tablet'];
			}

			if ( ! empty( $settings['column_mobile'] ) ) {
				$class .= ' columns-mobile-' . $settings['column_mobile'];
			}
		}

        if ( $settings['paginate'] === 'pagination' ) {
            $atts['paginate'] = 'true';
        }
        if($settings['product_layout'] == 'grid' && $settings['grid_layout_special']=='yes' && $settings['enable_carousel'] !== 'yes') {
            add_action('woocommerce_shop_loop_item_title','mixxcazt_woocommerce_product_gallery_image',1);
            remove_action('mixxcazt_woocommerce_product_loop_image', 'mixxcazt_template_loop_product_thumbnail', 10);
            add_action('mixxcazt_woocommerce_product_loop_image', 'mixxcazt_template_loop_product_thumbnail_special', 10);
            $class .= ' grid-layout-special';
        }

        $atts['class'] = $class;


        echo ( new WC_Shortcode_Products( $atts, $type ) )->get_content(); // WPCS: XSS ok

        if($settings['product_layout'] == 'grid' && $settings['grid_layout_special']=='yes' && $settings['enable_carousel'] !== 'yes') {
            remove_action('woocommerce_shop_loop_item_title','mixxcazt_woocommerce_product_gallery_image',1);
            remove_action('mixxcazt_woocommerce_product_loop_image', 'mixxcazt_template_loop_product_thumbnail_special', 10);
            add_action('mixxcazt_woocommerce_product_loop_image', 'mixxcazt_template_loop_product_thumbnail', 10);
        }
	}

	protected function add_control_carousel( $condition = array() ) {
		$this->start_controls_section(
			'section_carousel_options',
			[
				'label'     => esc_html__( 'Carousel Options', 'mixxcazt' ),
				'type'      => Controls_Manager::SECTION,
				'condition' => $condition,
			]
		);

		$this->add_control(
			'enable_carousel',
			[
				'label' => esc_html__( 'Enable', 'mixxcazt' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);


		$this->add_control(
			'navigation',
			[
				'label'     => esc_html__( 'Navigation', 'mixxcazt' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dots',
				'options'   => [
					'both'   => esc_html__( 'Arrows and Dots', 'mixxcazt' ),
					'arrows' => esc_html__( 'Arrows', 'mixxcazt' ),
					'dots'   => esc_html__( 'Dots', 'mixxcazt' ),
					'none'   => esc_html__( 'None', 'mixxcazt' ),
				],
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'     => esc_html__( 'Pause on Hover', 'mixxcazt' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'mixxcazt' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'mixxcazt' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay'        => 'yes',
					'enable_carousel' => 'yes'
				],
                'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'     => esc_html__( 'Infinite Loop', 'mixxcazt' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'enable_carousel' => 'yes'
				],
			]
		);

        $this->add_control(
            'hidden_style_2',
            [
                'label'     => esc_html__( 'Infinite Hidden', 'mixxcazt' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
                'prefix_class' => 'products-block-style-2-hidden-',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'carousel_arrows',
			[
				'label'      => esc_html__( 'Carousel Arrows', 'mixxcazt' ),
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'     => 'enable_carousel',
							'operator' => '==',
							'value'    => 'yes',
						],
						[
							'name'     => 'navigation',
							'operator' => '!==',
							'value'    => 'none',
						],
						[
							'name'     => 'navigation',
							'operator' => '!==',
							'value'    => 'dots',
						],
					],
				],
			]
		);

		//Style arrow
		$this->add_control(
			'style_arrow',
			[
				'label' => esc_html__( 'Style Arrow', 'mixxcazt' ),
				'type'  => Controls_Manager::SELECT,
                'options'   => [
                        'style-1'   => esc_html__('Style 1', 'mixxcazt'),
                        'style-2'   => esc_html__('Style 2', 'mixxcazt'),
                        'style-3'   => esc_html__('Style 3', 'mixxcazt'),
                ],
                'default'   => 'style-1',
                'prefix_class'  => 'arrow-'
			]
		);


		//add icon next size
		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Size', 'mixxcazt' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .slick-arrow:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//add icon next color
        $this->add_control(
            'color_button',
            [
                'label' => esc_html__('Color', 'mixxcazt'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->start_controls_tabs('tabs_carousel_arrow_style');

        $this->start_controls_tab(
            'tab_carousel_arrow_normal',
            [
                'label' => esc_html__('Normal', 'mixxcazt'),
            ]
        );

        $this->add_control(
            'carousel_arrow_color_icon',
            [
                'label'     => esc_html__('Color icon', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_border',
            [
                'label'     => esc_html__('Color Border', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_background',
            [
                'label'     => esc_html__('Color background', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_arrow_hover',
            [
                'label' => esc_html__('Hover', 'mixxcazt'),
            ]
        );

        $this->add_control(
            'carousel_arrow_color_icon_hover',
            [
                'label'     => esc_html__('Color icon', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_border_hover',
            [
                'label'     => esc_html__('Color Border', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_background_hover',
            [
                'label'     => esc_html__('Color background', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->add_control(
			'next_heading',
			[
				'label' => esc_html__( 'Next button', 'mixxcazt' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'next_vertical',
			[
				'label'       => esc_html__( 'Next Vertical', 'mixxcazt' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'top'    => [
						'title' => esc_html__( 'Top', 'mixxcazt' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'mixxcazt' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				]
			]
		);

		$this->add_responsive_control(
			'next_vertical_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-next' => 'top: unset; bottom: unset; {{next_vertical.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'next_horizontal',
			[
				'label'       => esc_html__( 'Next Horizontal', 'mixxcazt' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'  => [
						'title' => esc_html__( 'Left', 'mixxcazt' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'mixxcazt' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'defautl'     => 'right'
			]
		);
		$this->add_responsive_control(
			'next_horizontal_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 45,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-next' => 'left: unset; right: unset;{{next_horizontal.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->add_control(
			'prev_heading',
			[
				'label'     => esc_html__( 'Prev button', 'mixxcazt' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'prev_vertical',
			[
				'label'       => esc_html__( 'Prev Vertical', 'mixxcazt' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'top'    => [
						'title' => esc_html__( 'Top', 'mixxcazt' ),
						'icon'  => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'mixxcazt' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				]
			]
		);

		$this->add_responsive_control(
			'prev_vertical_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-prev' => 'top: unset; bottom: unset; {{prev_vertical.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'prev_horizontal',
			[
				'label'       => esc_html__( 'Prev Horizontal', 'mixxcazt' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'  => [
						'title' => esc_html__( 'Left', 'mixxcazt' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'mixxcazt' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'defautl'     => 'left'
			]
		);
		$this->add_responsive_control(
			'prev_horizontal_value',
			[
				'type'       => Controls_Manager::SLIDER,
				'show_label' => false,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 45,
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-prev' => 'left: unset; right: unset; {{prev_horizontal.value}}: {{SIZE}}{{UNIT}};',
				]
			]
		);


		$this->end_controls_section();

        $this->start_controls_section(
            'carousel_dots',
            [
                'label'      => esc_html__('Carousel Dots', 'mixxcazt'),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'enable_carousel',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'none',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'both',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'arrows',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'style_dots',
            [
                'label' => esc_html__( 'Style Dots', 'mixxcazt' ),
                'type'  => Controls_Manager::SELECT,
                'options'   => [
                    'style-1'   => esc_html__('Style 1', 'mixxcazt'),
                    'style-2'   => esc_html__('Style 2', 'mixxcazt'),
                ],
                'default'   => 'style-1',
                'prefix_class'  => 'dots-'
            ]
        );

        $this->start_controls_tabs('tabs_carousel_dots_style');

        $this->start_controls_tab(
            'tab_carousel_dots_normal',
            [
                'label' => esc_html__('Normal', 'mixxcazt'),
            ]
        );

        $this->add_control(
            'carousel_dots_color',
            [
                'label'     => esc_html__('Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity',
            [
                'label'     => esc_html__('Opacity', 'mixxcazt'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_dots_hover',
            [
                'label' => esc_html__('Hover', 'mixxcazt'),
            ]
        );

        $this->add_control(
            'carousel_dots_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-dots li button:focus:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_hover',
            [
                'label'     => esc_html__('Opacity', 'mixxcazt'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover:before' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .slick-dots li button:focus:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_dots_activate',
            [
                'label' => esc_html__('Activate', 'mixxcazt'),
            ]
        );

        $this->add_control(
            'carousel_dots_color_activate',
            [
                'label'     => esc_html__('Color', 'mixxcazt'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_activate',
            [
                'label'     => esc_html__('Opacity', 'mixxcazt'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'dots_vertical_value',
            [
                'label'      => esc_html__('Spacing', 'mixxcazt'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'Alignment_text',
            [
                'label' => esc_html__('Alignment text', 'mixxcazt'),
                'type' => Controls_Manager::CHOOSE,
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
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
	}

	protected function get_carousel_settings() {
		$settings = $this->get_settings_for_display();

		return array(
			'navigation'         => $settings['navigation'],
			'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? true : false,
			'autoplay'           => $settings['autoplay'] === 'yes' ? true : false,
			'autoplayTimeout'    => $settings['autoplay_speed'],
			'items'              => $settings['column'],
            'items_laptop'       => $settings['column_laptop'],
			'items_tablet'       => isset($settings['column_tablet']) ? $settings['column_tablet'] : $settings['column'],
			'items_mobile'       => isset($settings['column_mobile']) ? $settings['column_mobile'] : 1,
			'loop'               => $settings['infinite'] === 'yes' ? true : false,
		);
	}

	protected function render_carousel_template() {
		?>
        var carousel_settings = {
        navigation: settings.navigation,
        autoplayHoverPause: settings.pause_on_hover === 'yes' ? true : false,
        autoplay: settings.autoplay === 'yes' ? true : false,
        autoplayTimeout: settings.autoplay_speed,
        items: settings.column,
        items_laptop: settings.column_laptop,
        items_tablet: settings.column_tablet ? settings.column_tablet : settings.column,
        items_mobile: settings.column_mobile ? settings.column_mobile : 1,
        loop: settings.infinite === 'yes' ? true : false,
        };
		<?php
	}
}

$widgets_manager->register( new Mixxcazt_Elementor_Widget_Products() );
