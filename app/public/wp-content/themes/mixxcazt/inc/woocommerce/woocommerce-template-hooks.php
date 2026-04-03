<?php
/**
 * Mixxcazt WooCommerce hooks
 *
 * @package mixxcazt
 */

/**
 * Layout
 *
 * @see  mixxcazt_before_content()
 * @see  mixxcazt_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  mixxcazt_shop_messages()
 */

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_before_main_content', 'mixxcazt_before_content', 10);
add_action('woocommerce_after_main_content', 'mixxcazt_after_content', 10);

add_action('woocommerce_before_shop_loop', 'mixxcazt_sorting_wrapper', 19);
add_action('woocommerce_before_shop_loop', 'mixxcazt_button_shop_canvas', 19);
add_action('woocommerce_before_shop_loop', 'mixxcazt_button_shop_dropdown', 19);
add_action('woocommerce_before_shop_loop', 'mixxcazt_button_grid_list_layout', 25);
add_action('woocommerce_before_shop_loop', 'mixxcazt_sorting_wrapper_close', 40);
if (mixxcazt_get_theme_option('woocommerce_archive_layout') == 'dropdown') {
    add_action('woocommerce_before_shop_loop', 'mixxcazt_render_woocommerce_shop_dropdown', 35);
}

//Position label onsale
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 30);

//Wrapper content single
add_action('woocommerce_before_single_product_summary', 'mixxcazt_woocommerce_single_content_wrapper_start', 0);
add_action('woocommerce_single_product_summary', 'mixxcazt_woocommerce_single_content_wrapper_end', 99);

// Legacy WooCommerce columns filter.
if (defined('WC_VERSION') && version_compare(WC_VERSION, '3.3', '<')) {
    add_filter('loop_shop_columns', 'mixxcazt_loop_columns');
    add_action('woocommerce_before_shop_loop', 'mixxcazt_product_columns_wrapper', 40);
    add_action('woocommerce_after_shop_loop', 'mixxcazt_product_columns_wrapper_close', 40);
}

/**
 * Products
 *
 * @see mixxcazt_upsell_display()
 * @see mixxcazt_single_product_pagination()
 */


remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);

add_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 21);
add_action('yith_quick_view_custom_style_scripts', function () {
    wp_enqueue_script('flexslider');
});

add_action('woocommerce_single_product_summary', 'mixxcazt_woocommerce_single_brand', 1);
add_action('woocommerce_single_product_summary', 'mixxcazt_woocommerce_deal_progress', 11);
add_action('woocommerce_single_product_summary', 'mixxcazt_woocommerce_time_sale', 12);
add_action('woocommerce_single_product_summary', 'mixxcazt_single_product_extra', 70);

// Wishlist
if (get_option('woosw_button_position_single') == "0") {
    add_action('woocommerce_after_add_to_cart_button', 'mixxcazt_wishlist_button', 20);
}
// Compare
if (get_option('_wooscp_button_single') == "0") {
    add_action('woocommerce_after_add_to_cart_button', 'mixxcazt_compare_button', 25);
}

add_action('woocommerce_share', 'mixxcazt_social_share', 10);

$product_single_style = mixxcazt_get_theme_option('single_product_gallery_layout', 'horizontal');

add_theme_support('wc-product-gallery-lightbox');
if ($product_single_style === 'horizontal' || $product_single_style === 'vertical') {
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-slider');
}

if ($product_single_style === 'gallery') {
    add_filter('woocommerce_single_product_image_thumbnail_html', 'mixxcazt_woocommerce_single_product_image_thumbnail_html', 10, 2);
    add_action('woocommerce_single_product_summary', 'mixxcazt_single_product_gallery_wrap_start', -1);
    add_action('woocommerce_single_product_summary', 'mixxcazt_single_product_gallery_wrap_end', 21);
    add_action('woocommerce_single_product_summary', 'mixxcazt_single_product_gallery_wrap_start', 21);
    add_action('woocommerce_single_product_summary', 'mixxcazt_single_product_gallery_wrap_end', 999);
}

if ($product_single_style === 'sticky') {
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    add_action('woocommerce_single_product_summary', 'mixxcazt_output_product_data_accordion', 70);
    add_filter('woocommerce_single_product_image_thumbnail_html', 'mixxcazt_woocommerce_single_product_image_thumbnail_html', 10, 2);
}

add_action('mixxcazt_single_product_video_360', 'mixxcazt_single_product_video_360', 10);

/**
 * Cart fragment
 *
 * @see mixxcazt_cart_link_fragment()
 */
if (defined('WC_VERSION') && version_compare(WC_VERSION, '2.3', '>=')) {
    add_filter('woocommerce_add_to_cart_fragments', 'mixxcazt_cart_link_fragment');
} else {
    add_filter('add_to_cart_fragments', 'mixxcazt_cart_link_fragment');
}

remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');

add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_start', 5);
add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_end', 15);

add_filter('woocommerce_get_script_data', function ($params, $handle) {
    if ($handle == "wc-add-to-cart") {
        $params['i18n_view_cart'] = '';
    }
    return $params;
}, 10, 2);

/*
 *
 * Layout Product
 *
 * */
function mixxcazt_include_hooks_product_blocks() {

    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

    add_action('woocommerce_before_shop_loop_item', 'mixxcazt_woocommerce_product_loop_start', -1);
    add_action('woocommerce_shop_loop_item_title', 'mixxcazt_woocommerce_product_caption_start', -1);
    /**
     * Integrations
     *
     * @see mixxcazt_template_loop_product_thumbnail()
     *
     */
    add_action('woocommerce_shop_loop_item_title', 'mixxcazt_woocommerce_product_caption_end', 998);
    add_action('woocommerce_after_shop_loop_item', 'mixxcazt_woocommerce_product_loop_end', 999);

    // product-transition
    add_action('woocommerce_before_shop_loop_item_title', 'mixxcazt_woocommerce_product_loop_image', 10);
    add_action('mixxcazt_woocommerce_product_loop_image', 'mixxcazt_woocommerce_get_product_label_stock', 9);
    add_action('mixxcazt_woocommerce_product_loop_image', 'mixxcazt_template_loop_product_thumbnail', 10);
    add_action('mixxcazt_woocommerce_product_loop_image', 'mixxcazt_quick_shop_wrapper', 15);
    add_action('mixxcazt_woocommerce_product_loop_image', 'woocommerce_template_loop_product_link_open', 99);
    add_action('mixxcazt_woocommerce_product_loop_image', 'woocommerce_template_loop_product_link_close', 99);


    // Compare
    if (get_option('_wooscp_button_archive') == "0") {
        add_action('mixxcazt_woocommerce_product_loop_action', 'mixxcazt_compare_button', 30);
    }

    // QuickView
    if (get_option('woosq_button_position') == "0") {
        add_action('mixxcazt_woocommerce_product_loop_action', 'mixxcazt_quickview_button', 15);
    }

    $product_style = mixxcazt_get_theme_option('wocommerce_block_style', 1);

    switch ($product_style) {
        case 1:

            // product-caption
            add_action('woocommerce_shop_loop_item_title', 'mixxcazt_woocommerce_product_loop_action', 45);
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 40);
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 35);
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 30);
            add_action('woocommerce_shop_loop_item_title', 'mixxcazt_woocommerce_get_product_category', 5);

            // Wishlist
            if (get_option('woosw_button_position_archive') == "0") {
                add_action('mixxcazt_woocommerce_product_loop_image', 'mixxcazt_wishlist_button', 5);
            }
            break;

        case 2:
		case 6:
            // product-caption
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 35);
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 30);

            //content-product-imagin
			add_action('woocommerce_before_shop_loop_item', 'mixxcazt_woocommerce_product_content_product_imagin', 10);

            // product-caption-bottom
            add_action('woocommerce_after_shop_loop_item_title', 'mixxcazt_woocommerce_product_loop_bottom_start', -1);
            add_action('woocommerce_after_shop_loop_item_title', 'mixxcazt_woocommerce_product_loop_bottom_end', 999);
            add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 40);
            add_action('woocommerce_after_shop_loop_item_title', 'mixxcazt_woocommerce_product_loop_action', 45);

            // Wishlist
            if (get_option('woosw_button_position_archive') == "0") {
                add_action('mixxcazt_woocommerce_product_loop_action', 'mixxcazt_wishlist_button', 20);
            }
            break;

        case 3:
        case 4:

            add_action('mixxcazt_woocommerce_product_loop_image', 'mixxcazt_woocommerce_product_loop_action', 45);

            // product-caption
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 35);
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 30);
            add_action('mixxcazt_woocommerce_product_loop_action', 'woocommerce_template_loop_add_to_cart', 5);
            // Wishlist
            if (get_option('woosw_button_position_archive') == "0") {
                add_action('mixxcazt_woocommerce_product_loop_action', 'mixxcazt_wishlist_button', 10);
            }
            add_filter('woocommerce_loop_add_to_cart_link', function ($quantity, $product) {
                return '<div class="opal-add-to-cart-button">' . $quantity . '</div>';
            }, 10, 2);
            break;

        case 5:

            add_action('mixxcazt_woocommerce_product_loop_image', 'mixxcazt_woocommerce_product_loop_action', 45);
            // Wishlist
            if (get_option('woosw_button_position_archive') == "0") {
                add_action('mixxcazt_woocommerce_product_loop_action', 'mixxcazt_wishlist_button', 10);
            }
            // product-caption
            add_action('woocommerce_shop_loop_item_title', 'mixxcazt_woocommerce_get_product_category', 5);
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 35);
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 30);
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 40);
            break;

    }

}

add_action('init', 'mixxcazt_include_hooks_product_blocks');

