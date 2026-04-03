<?php
/**
 * =================================================
 * Hook mixxcazt_page
 * =================================================
 */
add_action('mixxcazt_page', 'mixxcazt_page_header', 10);
add_action('mixxcazt_page', 'mixxcazt_page_content', 20);

/**
 * =================================================
 * Hook mixxcazt_single_post_top
 * =================================================
 */
add_action('mixxcazt_single_post_top', 'mixxcazt_post_header', 10);

/**
 * =================================================
 * Hook mixxcazt_single_post
 * =================================================
 */
add_action('mixxcazt_single_post', 'mixxcazt_post_thumbnail', 10);
add_action('mixxcazt_single_post', 'mixxcazt_post_content', 30);

/**
 * =================================================
 * Hook mixxcazt_single_post_bottom
 * =================================================
 */
add_action('mixxcazt_single_post_bottom', 'mixxcazt_post_taxonomy', 5);
add_action('mixxcazt_single_post_bottom', 'mixxcazt_post_nav', 10);
add_action('mixxcazt_single_post_bottom', 'mixxcazt_display_comments', 20);

/**
 * =================================================
 * Hook mixxcazt_loop_post
 * =================================================
 */
add_action('mixxcazt_loop_post', 'mixxcazt_post_header', 15);
add_action('mixxcazt_loop_post', 'mixxcazt_post_content', 30);

/**
 * =================================================
 * Hook mixxcazt_footer
 * =================================================
 */
add_action('mixxcazt_footer', 'mixxcazt_footer_default', 20);

/**
 * =================================================
 * Hook mixxcazt_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'mixxcazt_template_account_dropdown', 1);
add_action('wp_footer', 'mixxcazt_mobile_nav', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */
add_action('wp_head', 'mixxcazt_pingback_header', 1);

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
add_action('mixxcazt_sidebar', 'mixxcazt_get_sidebar', 10);

/**
 * =================================================
 * Hook mixxcazt_loop_after
 * =================================================
 */
add_action('mixxcazt_loop_after', 'mixxcazt_paging_nav', 10);

/**
 * =================================================
 * Hook mixxcazt_page_after
 * =================================================
 */
add_action('mixxcazt_page_after', 'mixxcazt_display_comments', 10);

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

/**
 * =================================================
 * Hook mixxcazt_woocommerce_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_woocommerce_after_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook mixxcazt_woocommerce_after_shop_loop_item
 * =================================================
 */
