<?php
/**
 * =================================================
 * Hook mixxcazt_page
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_single_post_top
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_single_post
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_single_post_bottom
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_loop_post
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_footer
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_after_footer
 * =================================================
 */
add_action('mixxcazt_after_footer', 'mixxcazt_sticky_single_add_to_cart', 999);

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'mixxcazt_render_woocommerce_shop_canvas', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_content_top
 * =================================================
 */
add_action('mixxcazt_content_top', 'mixxcazt_shop_messages', 10);

/**
 * =================================================
 * Hook mixxcazt_post_header_before
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_sidebar
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_loop_after
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_page_after
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_woocommerce_before_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_woocommerce_before_shop_loop_item_title
 * =================================================
 */
add_action('mixxcazt_woocommerce_before_shop_loop_item_title', 'mixxcazt_wishlist_button', 5);
add_action('mixxcazt_woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('mixxcazt_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * =================================================
 * Hook mixxcazt_woocommerce_shop_loop_item_title
 * =================================================
 */
add_action('mixxcazt_woocommerce_shop_loop_item_title', 'mixxcazt_woocommerce_get_product_category', 5);
add_action('mixxcazt_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 5);
add_action('mixxcazt_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 10);

/**
 * =================================================
 * Hook mixxcazt_woocommerce_after_shop_loop_item_title
 * =================================================
 */
add_action('mixxcazt_woocommerce_after_shop_loop_item_title', 'mixxcazt_woocommerce_get_product_description', 15);
add_action('mixxcazt_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 20);
add_action('mixxcazt_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 25);
add_action('mixxcazt_woocommerce_after_shop_loop_item_title', 'mixxcazt_quickview_button', 30);
add_action('mixxcazt_woocommerce_after_shop_loop_item_title', 'mixxcazt_compare_button', 35);

/**
 * =================================================
 * Hook mixxcazt_woocommerce_after_shop_loop_item
 * =================================================
 */
