<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Mixxcazt_Elementor_Map_location extends Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve testimonial widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'mixxcazt-map-location';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve testimonial widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Mixxcazt Map Location', 'mixxcazt' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve testimonial widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return array( 'mixxcazt-addons' );
	}

	public function get_script_depends() {
		return [ 'mixxcazt-elementor-map-location' ];
	}

	/**
	 * Register testimonial widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_map_location',
			[
				'label' => __( 'Map Location', 'mixxcazt' ),
			]
		);

		$this->add_control(
			'item_location_title',
			[
				'label' => esc_html__( 'Title', 'mixxcazt' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'item_location_icon',
			[
				'label'   => esc_html__( 'Icon', 'mixxcazt' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'mixxcazt-icon- mixxcazt-icon-map-marker-check',
					'library' => 'mixxcazt',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_location_country',
			[
				'label' => __( 'Location title', 'mixxcazt' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'item_location_link',
			[
				'label'       => __( 'Link to', 'mixxcazt' ),
				'placeholder' => __( 'https://your-link.com', 'mixxcazt' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'url' => '#'
				],
			]
		);

		$repeater->add_control(
			'item_phone_heading',
			[
				'label' => __( 'Phone', 'mixxcazt' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$repeater->add_control(
			'item_phone_icon',
			[
				'label'   => esc_html__( 'Icon', 'mixxcazt' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'mixxcazt-icon- mixxcazt-icon-phone-alt',
					'library' => 'mixxcazt',
				],
			]
		);

		$repeater->add_control(
			'item_phone_title',
			[
				'label' => __( 'Phone title', 'mixxcazt' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'item_phone_number',
			[
				'label' => __( 'Phone Number', 'mixxcazt' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'item_phone_link',
			[
				'label'       => __( 'Link to', 'mixxcazt' ),
				'placeholder' => __( 'https://your-link.com', 'mixxcazt' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'url' => '#'
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Items', 'mixxcazt' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ item_location_country }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'map_location_style',
			[
				'label' => esc_html__( 'Location', 'mixxcazt' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			'hidden_divider',
			[
				'label'        => esc_html__( 'Hidden Divider', 'mixxcazt' ),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'hidden-divider-map-location-',
			]
		);

		$this->add_control(
			'layout_style_location',
			[
				'label'        => esc_html__( 'Layout Style', 'mixxcazt' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => '1',
				'options'      => [
					'1' => esc_html__( 'Style 1', 'mixxcazt' ),
					'2' => esc_html__( 'Style 2', 'mixxcazt' ),
				],
				'prefix_class' => 'location-layout-style-',
			]
		);

		$this->add_responsive_control(
			'padding_map_location',
			[
				'label'      => esc_html__( 'Padding', 'mixxcazt' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .store-location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_heading_map_location',
			[
				'label' => esc_html__( 'Icon', 'mixxcazt' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'icon_size_map_location',
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
					'{{WRAPPER}} .store-location .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color_map_location',
			[
				'label'     => esc_html__( 'Color', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .store-location .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_heading_map_location',
			[
				'label' => esc_html__( 'Title', 'mixxcazt' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_map_location_typography',
				'selector' => '{{WRAPPER}} .store-location .content .title',
			]
		);

		$this->add_control(
			'title_color_map_location',
			[
				'label'     => esc_html__( 'Color', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .store-location .content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color_hover_map_location',
			[
				'label'     => esc_html__( 'Color Hover', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .store-location .content:hover .js-content-location' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_heading_map_location',
			[
				'label' => esc_html__( 'Content', 'mixxcazt' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_map_location_typography',
				'selector' => '{{WRAPPER}} .store-location .title-country',
			]
		);

		$this->add_control(
			'content_color_map_location',
			[
				'label'     => esc_html__( 'Color', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .store-location .title-country' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'phone_style',
			[
				'label' => esc_html__( 'Phone', 'mixxcazt' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			'hidden_phone',
			[
				'label'        => esc_html__( 'Hidden Phone', 'mixxcazt' ),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'hidden-phone-map-location-',
			]
		);

		$this->add_responsive_control(
			'padding_phone',
			[
				'label'      => esc_html__( 'Padding', 'mixxcazt' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .phone-location' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size_phone',
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
					'{{WRAPPER}} .phone-location .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color_phone',
			[
				'label'     => esc_html__( 'Color', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .phone-location .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_heading_phone',
			[
				'label' => esc_html__( 'Title', 'mixxcazt' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_phone_typography',
				'selector' => '{{WRAPPER}} .phone-location .content .title',
			]
		);

		$this->add_control(
			'title_color_phone',
			[
				'label'     => esc_html__( 'Color', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .phone-location .content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_heading_phone',
			[
				'label' => esc_html__( 'Content', 'mixxcazt' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_phone_typography',
				'selector' => '{{WRAPPER}} .phone-location .link',
			]
		);

		$this->add_control(
			'content_color_phone',
			[
				'label'     => esc_html__( 'Color', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .phone-location .link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color_hover_phone',
			[
				'label'     => esc_html__( 'Color Hover', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .phone-location .link:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		?>
        <div class="wrapper">
            <div class="store-location">
                <div class="location-hover">
                    <a href="#" class="location-relative js-content-location">
						<?php if ( ! empty( $settings['item_location_icon'] && [ 'aria-hidden' => 'true' ] ) ): ?>
                            <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['item_location_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
						<?php endif; ?>
                        <div class="content">
							<?php if ( ! empty( $settings['item_location_title'] ) ): ?>
                                <span class="title"><?php echo esc_html__( $settings['item_location_title'], 'mixxcazt' ); ?></span>
							<?php endif; ?>

                            <div class="country title-country">
                                <span class="location-country-title-active"></span>
                                <i aria-hidden="true" class="mixxcazt-icon-angle-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="location-sub">
						<?php
						$count = 1;
						foreach ( $settings['items'] as $index => $items ):
							$tab_title_setting_key = $this->get_repeater_setting_key( 'location_item', 'location', $index );
							$this->add_render_attribute( $tab_title_setting_key, [
								'data-setting-key' => 'location-item-' . $count . $this->get_id(),
								'class'            => 'location-item'
							] );
							?>
                            <li <?php echo mixxcazt_elementor_get_render_attribute_string( $tab_title_setting_key, $this ); ?>>
                                <a href="<?php echo esc_url( $items['item_location_link']['url'] ); ?>" class="title"><?php echo esc_html__( $items['item_location_country'], 'mixxcazt' ); ?></a>
                            </li>
							<?php $count ++; ?>
						<?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="phone-location">
				<?php
				$count = 1;
				foreach ( $settings['items'] as $index => $items ):
					$tab_content_setting_key = $this->get_repeater_setting_key( 'content', 'tabs', $index );
					$this->add_render_attribute( $tab_content_setting_key, [
						'id'    => 'location-item-' . $count . $this->get_id(),
						'class' => 'phone-content-item'
					] );
					?>
                    <div <?php echo mixxcazt_elementor_get_render_attribute_string( $tab_content_setting_key, $this ); ?>>
                        <div class="icon">
							<?php
							if ( ! empty( $items['item_phone_icon'] ) ) {
								?>
								<?php \Elementor\Icons_Manager::render_icon( $items['item_phone_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php
							}
							?>
                        </div>
                        <div class="content">
							<?php if ( $items['item_phone_title'] ): ?>
								<?php printf( '<span class="title">%s</span>', $items['item_phone_title'] ); ?>
							<?php endif; ?>
							<?php if ( $items['item_phone_number'] ): ?>
                                <a href="<?php echo esc_url( $items['item_phone_link']['url'] ); ?>" class="link"><span><?php echo esc_html( $items['item_phone_number'] ); ?></span></a>
							<?php endif; ?>
                        </div>
                    </div>
					<?php $count ++; ?>
				<?php endforeach; ?>
            </div>
        </div>
		<?php
	}

}

$widgets_manager->register( new Mixxcazt_Elementor_Map_location() );
