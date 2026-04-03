<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Mixxcazt_Elementor_Account extends Elementor\Widget_Base {

	public function get_name() {
		return 'mixxcazt-account';
	}

	public function get_title() {
		return esc_html__( 'Mixxcazt Account', 'mixxcazt' );
	}

	public function get_icon() {
		return 'eicon-lock-user';
	}

	public function get_categories() {
		return array( 'mixxcazt-addons' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'header_group_config',
			[
				'label' => esc_html__( 'Config', 'mixxcazt' ),
			]
		);

		$this->add_control(
			'account_icon',
			[
				'label'   => esc_html__( 'Icon', 'mixxcazt' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'mixxcazt-icon- mixxcazt-icon-account',
					'library' => 'mixxcazt',
				],
			]
		);

		$this->add_control(
			'account_text',
			[
				'label'   => 'Content Login',
				'type'    => Controls_Manager::WYSIWYG,
				'default' => 'Sign In or Register',
			]
		);

		$this->add_control(
			'content_welcome',
			[
				'label'   => esc_html__( 'Content admin', 'mixxcazt' ),
				'default' => 'Welcome to <br>',
				'type'    => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'header-group-style',
			[
				'label' => esc_html__( 'Icon', 'mixxcazt' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-header-account .header-group-action > div a:not(:hover) i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-header-account .header-group-action > div a:not(:hover):before'   => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-header-account .header-group-action > div a:hover i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-header-account .header-group-action > div a:hover:before'   => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Font Size', 'mixxcazt' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-header-account .header-group-action > div a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'          => esc_html__( 'Width', 'mixxcazt' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units'     => [ '%', 'px', 'vw' ],
				'range'          => [
					'%'  => [
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
				'selectors'      => [
					'{{WRAPPER}} .elementor-header-account .header-group-action > div a .avatar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'account-content',
			[
				'label' => esc_html__( 'Content', 'mixxcazt' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Elementor\Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Content', 'mixxcazt' ),
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .site-header-account a .account-content',
			]
		);

		$this->add_group_control(
			Elementor\Group_Control_Typography::get_type(),
			[
				'label'    => esc_html__( 'Content Name', 'mixxcazt' ),
				'name'     => 'typography_content_admin',
				'selector' => '{{WRAPPER}} .site-header-account a .account-content .content-name',
			]
		);

		$this->start_controls_tabs( 'account_style_color' );

		$this->start_controls_tab( 'account_normal',
			[
				'label' => esc_html__( 'Normal', 'mixxcazt' ),
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Color', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .site-header-account a:not(:hover) .account-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'name_text_color',
			[
				'label'     => esc_html__( 'Color Name', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .site-header-account a:not(:hover) .account-content .content-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'account_hover',
			[
				'label' => esc_html__( 'Hover', 'mixxcazt' ),
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label'     => esc_html__( 'Color Hover', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .site-header-account a:hover .account-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'name_text_color_hover',
			[
				'label'     => esc_html__( 'Color Name Hover', 'mixxcazt' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .site-header-account a:hover .account-content .content-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-header-account' );
		?>
        <div <?php echo mixxcazt_elementor_get_render_attribute_string( 'wrapper', $this ); ?>>
            <div class="header-group-action">
				<?php
				if ( mixxcazt_is_woocommerce_activated() ) {
					$account_link = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
				} else {
					$account_link = wp_login_url();
				}
				?>
                <div class="site-header-account">
                    <a href="<?php echo esc_html( $account_link ); ?>">
						<?php
						if ( ! is_user_logged_in() ) {
							if ( ! empty( $settings['account_icon'] ) ) {
								?>
								<?php \Elementor\Icons_Manager::render_icon( $settings['account_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php
							}
						} else {
							$user_id = get_current_user_id();
							echo get_avatar( $user_id, 24 );
						}

						?>
                        <div class="account-content">
							<?php
							if ( ! is_user_logged_in() ) {
								?>
                                <div class="account-content"><?php printf( '%s', $settings['account_text'] ); ?></div>
								<?php
							} else {

								$user = wp_get_current_user(); ?>
								<?php if ( ! empty( $settings['content_welcome'] ) ): ?>
                                    <div class="content-admin"><?php printf('%s', $settings['content_welcome']); ?></div>
								<?php endif; ?>
                                <span class="content-name"><?php echo esc_html( $user->display_name ); ?></span>
							<?php } ?>
                        </div>
                    </a>
                    <div class="account-dropdown">

                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

$widgets_manager->register( new Mixxcazt_Elementor_Account() );
