<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Mixxcazt_Elementor')) :

    /**
     * The Mixxcazt Elementor Integration class
     */
    class Mixxcazt_Elementor {
        private $suffix = '';

        public function __construct() {
            $this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'register_auto_scripts_frontend']);
            add_action('elementor/init', array($this, 'add_category'));
            add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
            add_action('elementor/widgets/register', array($this, 'customs_widgets'));
            add_action('elementor/widgets/register', array($this, 'include_widgets'));
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);

            // Custom Animation Scroll
            add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);

            // Elementor Fix Noitice WooCommerce
            add_action('elementor/editor/before_enqueue_scripts', array($this, 'woocommerce_fix_notice'));

            // Backend
            add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);

            // Add Icon Custom
            add_action('elementor/icons_manager/native', [$this, 'add_icons_native']);
            add_action('elementor/controls/register', [$this, 'add_icons']);

            if (!mixxcazt_is_elementor_pro_activated()) {
                require trailingslashit(get_template_directory()) . 'inc/elementor/custom-css.php';
                if (is_admin()) {
                    add_action('manage_elementor_library_posts_columns', [$this, 'admin_columns_headers']);
                    add_action('manage_elementor_library_posts_custom_column', [$this, 'admin_columns_content'], 10, 2);
                }
            }

            add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);
            add_action('wp_enqueue_scripts', [$this, 'elementor_kit']);
        }

        public function elementor_kit() {
            $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
            Elementor\Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
            $myvals = get_post_meta($active_kit_id, '_elementor_page_settings', true);
            if (!empty($myvals)) {
                $css = '';
                foreach ($myvals['system_colors'] as $key => $value) {
                    $css .= $value['color'] !== '' ? '--' . $value['_id'] . ':' . $value['color'] . ';' : '';
                }

                $var = "body{{$css}}";
                wp_add_inline_style('mixxcazt-style', $var);
            }
        }

        public function additional_fonts($fonts) {
            $fonts["Red Rose"] = 'googlefonts';
            $fonts["Neurial Grotesk"] = 'system';
            return $fonts;
        }

        public function admin_columns_headers($defaults) {
            $defaults['shortcode'] = __('Shortcode', 'mixxcazt');

            return $defaults;
        }

        public function admin_columns_content($column_name, $post_id) {
            if ('shortcode' === $column_name) {
                ob_start();
                ?>
                <input class="elementor-shortcode-input" type="text" readonly onfocus="this.select()" value="[hfe_template id='<?php echo esc_attr($post_id); ?>']"/>
                <?php
                ob_get_contents();
            }
        }

        public function add_js() {
            global $mixxcazt_version;
            wp_enqueue_script('mixxcazt-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend.js'), [], $mixxcazt_version);
        }

        public function add_style_editor() {
            global $mixxcazt_version;
            wp_enqueue_style('mixxcazt-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], $mixxcazt_version);
        }

        public function add_scripts() {
            global $mixxcazt_version;
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('mixxcazt-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $mixxcazt_version);
            wp_style_add_data('mixxcazt-elementor', 'rtl', 'replace');

            // Add Scripts
            wp_register_script('tweenmax', get_theme_file_uri('/assets/js/vendor/TweenMax.min.js'), array('jquery'), '1.11.1');
            wp_register_script('parallaxmouse', get_theme_file_uri('/assets/js/vendor/jquery-parallax.js'), array('jquery'), $mixxcazt_version);

            if (mixxcazt_elementor_check_type('animated-bg-parallax')) {
                wp_enqueue_script('tweenmax');
                wp_enqueue_script('jquery-panr', get_theme_file_uri('/assets/js/vendor/jquery-panr' . $suffix . '.js'), array('jquery'), '0.0.1');
            }
        }


        public function register_auto_scripts_frontend() {
            global $mixxcazt_version;
            wp_register_script('mixxcazt-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
            wp_register_script('mixxcazt-elementor-countdown', get_theme_file_uri('/assets/js/elementor/countdown.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
            wp_register_script('mixxcazt-elementor-image-gallery', get_theme_file_uri('/assets/js/elementor/image-gallery.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
            wp_register_script('mixxcazt-elementor-image-hotspots', get_theme_file_uri('/assets/js/elementor/image-hotspots.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
            wp_register_script('mixxcazt-elementor-map-location', get_theme_file_uri('/assets/js/elementor/map-location.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
            wp_register_script('mixxcazt-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
            wp_register_script('mixxcazt-elementor-product-tab', get_theme_file_uri('/assets/js/elementor/product-tab.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
            wp_register_script('mixxcazt-elementor-products', get_theme_file_uri('/assets/js/elementor/products.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
            wp_register_script('mixxcazt-elementor-tabs', get_theme_file_uri('/assets/js/elementor/tabs.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
            wp_register_script('mixxcazt-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
            wp_register_script('mixxcazt-elementor-video', get_theme_file_uri('/assets/js/elementor/video.js'), array('jquery','elementor-frontend'), $mixxcazt_version, true);
           
        }

        public function add_category() {
            Elementor\Plugin::instance()->elements_manager->add_category(
                'mixxcazt-addons',
                array(
                    'title' => esc_html__('Mixxcazt Addons', 'mixxcazt'),
                    'icon'  => 'fa fa-plug',
                ),
                1);
        }

        public function add_animations_scroll($animations) {
            $animations['Mixxcazt Animation'] = [
                'opal-move-up'    => 'Move Up',
                'opal-move-down'  => 'Move Down',
                'opal-move-left'  => 'Move Left',
                'opal-move-right' => 'Move Right',
                'opal-flip'       => 'Flip',
                'opal-helix'      => 'Helix',
                'opal-scale-up'   => 'Scale',
                'opal-am-popup'   => 'Popup',
            ];

            return $animations;
        }

        public function customs_widgets() {
            $files = glob(get_theme_file_path('/inc/elementor/custom-widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        /**
         * @param $widgets_manager Elementor\Widgets_Manager
         */
        public function include_widgets($widgets_manager) {
            $files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        public function woocommerce_fix_notice() {
            if (mixxcazt_is_woocommerce_activated()) {
                remove_action('woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5);
                remove_action('woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_account_content', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
            }
        }

        public function add_icons( $manager ) {
            $new_icons = json_decode( '{"mixxcazt-icon-accessories":"accessories","mixxcazt-icon-account":"account","mixxcazt-icon-aimchair":"aimchair","mixxcazt-icon-arrow-down":"arrow-down","mixxcazt-icon-arrow-left":"arrow-left","mixxcazt-icon-arrow-right":"arrow-right","mixxcazt-icon-arrow-up":"arrow-up","mixxcazt-icon-baby-carriage":"baby-carriage","mixxcazt-icon-badge-percent":"badge-percent","mixxcazt-icon-bathroom":"bathroom","mixxcazt-icon-bathtub":"bathtub","mixxcazt-icon-bed":"bed","mixxcazt-icon-beside_table":"beside_table","mixxcazt-icon-birth":"birth","mixxcazt-icon-cabinet":"cabinet","mixxcazt-icon-caret-bold-left":"caret-bold-left","mixxcazt-icon-caret-bold-right":"caret-bold-right","mixxcazt-icon-cart-2":"cart-2","mixxcazt-icon-cart":"cart","mixxcazt-icon-clock-2":"clock-2","mixxcazt-icon-clone-compare":"clone-compare","mixxcazt-icon-credit-card-front":"credit-card-front","mixxcazt-icon-crown":"crown","mixxcazt-icon-customer":"customer","mixxcazt-icon-delivery_2":"delivery_2","mixxcazt-icon-delivery_3":"delivery_3","mixxcazt-icon-delivery_4":"delivery_4","mixxcazt-icon-delivery":"delivery","mixxcazt-icon-drawer":"drawer","mixxcazt-icon-faucet":"faucet","mixxcazt-icon-financing":"financing","mixxcazt-icon-fresh":"fresh","mixxcazt-icon-gem":"gem","mixxcazt-icon-gifts_2":"gifts_2","mixxcazt-icon-gifts":"gifts","mixxcazt-icon-globe":"globe","mixxcazt-icon-ice-skate":"ice-skate","mixxcazt-icon-location-circle":"location-circle","mixxcazt-icon-lock-alt":"lock-alt","mixxcazt-icon-long-arrow-down":"long-arrow-down","mixxcazt-icon-long-arrow-left":"long-arrow-left","mixxcazt-icon-long-arrow-right":"long-arrow-right","mixxcazt-icon-long-arrow-up":"long-arrow-up","mixxcazt-icon-mailbox":"mailbox","mixxcazt-icon-medal":"medal","mixxcazt-icon-menu":"menu","mixxcazt-icon-mission":"mission","mixxcazt-icon-mitten":"mitten","mixxcazt-icon-money":"money","mixxcazt-icon-months":"months","mixxcazt-icon-months1":"months1","mixxcazt-icon-natural":"natural","mixxcazt-icon-paper-plane":"paper-plane","mixxcazt-icon-paw-alt":"paw-alt","mixxcazt-icon-phone-alt":"phone-alt","mixxcazt-icon-phone-rotary":"phone-rotary","mixxcazt-icon-phone":"phone","mixxcazt-icon-quality":"quality","mixxcazt-icon-quote_2":"quote_2","mixxcazt-icon-return_1":"return_1","mixxcazt-icon-return_2":"return_2","mixxcazt-icon-return_3":"return_3","mixxcazt-icon-return_4":"return_4","mixxcazt-icon-reward_2":"reward_2","mixxcazt-icon-reward":"reward","mixxcazt-icon-rings-wedding":"rings-wedding","mixxcazt-icon-search":"search","mixxcazt-icon-secure":"secure","mixxcazt-icon-shapes":"shapes","mixxcazt-icon-shipping_1":"shipping_1","mixxcazt-icon-shipping-fast":"shipping-fast","mixxcazt-icon-step_stool":"step_stool","mixxcazt-icon-store-alt":"store-alt","mixxcazt-icon-support_1":"support_1","mixxcazt-icon-support_2":"support_2","mixxcazt-icon-tags":"tags","mixxcazt-icon-tire":"tire","mixxcazt-icon-toilet":"toilet","mixxcazt-icon-trusted":"trusted","mixxcazt-icon-tshirt":"tshirt","mixxcazt-icon-undo":"undo","mixxcazt-icon-user-headset-1":"user-headset-1","mixxcazt-icon-vision":"vision","mixxcazt-icon-volleyball-ball":"volleyball-ball","mixxcazt-icon-wallet":"wallet","mixxcazt-icon-wardrope":"wardrope","mixxcazt-icon-warranty":"warranty","mixxcazt-icon-wash_basin":"wash_basin","mixxcazt-icon-wash":"wash","mixxcazt-icon-what":"what","mixxcazt-icon-wishlist":"wishlist","mixxcazt-icon-360":"360","mixxcazt-icon-angle-down":"angle-down","mixxcazt-icon-angle-left":"angle-left","mixxcazt-icon-angle-right":"angle-right","mixxcazt-icon-angle-up":"angle-up","mixxcazt-icon-arrow-circle-down":"arrow-circle-down","mixxcazt-icon-arrow-circle-left":"arrow-circle-left","mixxcazt-icon-arrow-circle-right":"arrow-circle-right","mixxcazt-icon-arrow-circle-up":"arrow-circle-up","mixxcazt-icon-bars":"bars","mixxcazt-icon-caret-down":"caret-down","mixxcazt-icon-caret-left":"caret-left","mixxcazt-icon-caret-right":"caret-right","mixxcazt-icon-caret-square-left":"caret-square-left","mixxcazt-icon-caret-square-right":"caret-square-right","mixxcazt-icon-caret-up":"caret-up","mixxcazt-icon-cart-empty":"cart-empty","mixxcazt-icon-check-square":"check-square","mixxcazt-icon-chevron-circle-left":"chevron-circle-left","mixxcazt-icon-chevron-circle-right":"chevron-circle-right","mixxcazt-icon-chevron-down":"chevron-down","mixxcazt-icon-chevron-left":"chevron-left","mixxcazt-icon-chevron-right":"chevron-right","mixxcazt-icon-chevron-up":"chevron-up","mixxcazt-icon-circle":"circle","mixxcazt-icon-clock":"clock","mixxcazt-icon-cloud-download-alt":"cloud-download-alt","mixxcazt-icon-comment":"comment","mixxcazt-icon-comments":"comments","mixxcazt-icon-contact":"contact","mixxcazt-icon-credit-card":"credit-card","mixxcazt-icon-dot-circle":"dot-circle","mixxcazt-icon-edit":"edit","mixxcazt-icon-envelope":"envelope","mixxcazt-icon-expand-alt":"expand-alt","mixxcazt-icon-external-link-alt":"external-link-alt","mixxcazt-icon-eye":"eye","mixxcazt-icon-file-alt":"file-alt","mixxcazt-icon-file-archive":"file-archive","mixxcazt-icon-filter":"filter","mixxcazt-icon-folder-open":"folder-open","mixxcazt-icon-folder":"folder","mixxcazt-icon-free_ship":"free_ship","mixxcazt-icon-frown":"frown","mixxcazt-icon-gift":"gift","mixxcazt-icon-grid":"grid","mixxcazt-icon-grip-horizontal":"grip-horizontal","mixxcazt-icon-heart-fill":"heart-fill","mixxcazt-icon-heart":"heart","mixxcazt-icon-history":"history","mixxcazt-icon-home":"home","mixxcazt-icon-info-circle":"info-circle","mixxcazt-icon-instagram":"instagram","mixxcazt-icon-level-up-alt":"level-up-alt","mixxcazt-icon-list":"list","mixxcazt-icon-long-arrow-alt-down":"long-arrow-alt-down","mixxcazt-icon-long-arrow-alt-left":"long-arrow-alt-left","mixxcazt-icon-long-arrow-alt-right":"long-arrow-alt-right","mixxcazt-icon-long-arrow-alt-up":"long-arrow-alt-up","mixxcazt-icon-map-marker-check":"map-marker-check","mixxcazt-icon-meh":"meh","mixxcazt-icon-minus-circle":"minus-circle","mixxcazt-icon-minus":"minus","mixxcazt-icon-mobile-android-alt":"mobile-android-alt","mixxcazt-icon-money-bill":"money-bill","mixxcazt-icon-pencil-alt":"pencil-alt","mixxcazt-icon-play-circle":"play-circle","mixxcazt-icon-plus-circle":"plus-circle","mixxcazt-icon-plus":"plus","mixxcazt-icon-quote":"quote","mixxcazt-icon-random":"random","mixxcazt-icon-reply-all":"reply-all","mixxcazt-icon-reply":"reply","mixxcazt-icon-search-plus":"search-plus","mixxcazt-icon-shield-check":"shield-check","mixxcazt-icon-shopping-basket":"shopping-basket","mixxcazt-icon-shopping-cart":"shopping-cart","mixxcazt-icon-sign-out-alt":"sign-out-alt","mixxcazt-icon-smile":"smile","mixxcazt-icon-spinner":"spinner","mixxcazt-icon-square":"square","mixxcazt-icon-star-fill":"star-fill","mixxcazt-icon-star":"star","mixxcazt-icon-store":"store","mixxcazt-icon-sync":"sync","mixxcazt-icon-tachometer-alt":"tachometer-alt","mixxcazt-icon-th-large":"th-large","mixxcazt-icon-th-list":"th-list","mixxcazt-icon-thumbtack":"thumbtack","mixxcazt-icon-times-circle":"times-circle","mixxcazt-icon-times":"times","mixxcazt-icon-trophy-alt":"trophy-alt","mixxcazt-icon-truck":"truck","mixxcazt-icon-user-headset":"user-headset","mixxcazt-icon-user-shield":"user-shield","mixxcazt-icon-user":"user","mixxcazt-icon-video":"video","mixxcazt-icon-adobe":"adobe","mixxcazt-icon-amazon":"amazon","mixxcazt-icon-android":"android","mixxcazt-icon-angular":"angular","mixxcazt-icon-apper":"apper","mixxcazt-icon-apple":"apple","mixxcazt-icon-atlassian":"atlassian","mixxcazt-icon-behance":"behance","mixxcazt-icon-bitbucket":"bitbucket","mixxcazt-icon-bitcoin":"bitcoin","mixxcazt-icon-bity":"bity","mixxcazt-icon-bluetooth":"bluetooth","mixxcazt-icon-btc":"btc","mixxcazt-icon-centos":"centos","mixxcazt-icon-chrome":"chrome","mixxcazt-icon-codepen":"codepen","mixxcazt-icon-cpanel":"cpanel","mixxcazt-icon-discord":"discord","mixxcazt-icon-dochub":"dochub","mixxcazt-icon-docker":"docker","mixxcazt-icon-dribbble":"dribbble","mixxcazt-icon-dropbox":"dropbox","mixxcazt-icon-drupal":"drupal","mixxcazt-icon-ebay":"ebay","mixxcazt-icon-facebook":"facebook","mixxcazt-icon-figma":"figma","mixxcazt-icon-firefox":"firefox","mixxcazt-icon-google-plus":"google-plus","mixxcazt-icon-google":"google","mixxcazt-icon-grunt":"grunt","mixxcazt-icon-gulp":"gulp","mixxcazt-icon-html5":"html5","mixxcazt-icon-jenkins":"jenkins","mixxcazt-icon-joomla":"joomla","mixxcazt-icon-link-brand":"link-brand","mixxcazt-icon-linkedin":"linkedin","mixxcazt-icon-mailchimp":"mailchimp","mixxcazt-icon-opencart":"opencart","mixxcazt-icon-paypal":"paypal","mixxcazt-icon-pinterest-p":"pinterest-p","mixxcazt-icon-reddit":"reddit","mixxcazt-icon-skype":"skype","mixxcazt-icon-slack":"slack","mixxcazt-icon-snapchat":"snapchat","mixxcazt-icon-spotify":"spotify","mixxcazt-icon-trello":"trello","mixxcazt-icon-twitter":"twitter","mixxcazt-icon-vimeo":"vimeo","mixxcazt-icon-whatsapp":"whatsapp","mixxcazt-icon-wordpress":"wordpress","mixxcazt-icon-yoast":"yoast","mixxcazt-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

        public function add_icons_native($tabs) {
            global $mixxcazt_version;
            $tabs['opal-custom'] = [
                'name'          => 'mixxcazt-icon',
                'label'         => esc_html__('Mixxcazt Icon', 'mixxcazt'),
                'prefix'        => 'mixxcazt-icon-',
                'displayPrefix' => 'mixxcazt-icon-',
                'labelIcon'     => 'fab fa-font-awesome-alt',
                'ver'           => $mixxcazt_version,
                'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
                'native'        => true,
            ];

            return $tabs;
        }
    }

endif;

return new Mixxcazt_Elementor();
