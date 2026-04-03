<?php

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('product-list', $product); ?>>
    <?php
    /**
     * Functions hooked in to mixxcazt_woocommerce_before_shop_loop_item action
     *
     */
    do_action('mixxcazt_woocommerce_before_shop_loop_item');


    ?>
    <div class="product-image">
        <?php
        /**
         * Functions hooked in to mixxcazt_woocommerce_before_shop_loop_item_title action
         *
         * @see mixxcazt_wishlist_button - 5 - woo
		 * @see woocommerce_show_product_loop_sale_flash - 10 - woo
         * @see woocommerce_template_loop_product_thumbnail - 10 - woo
         */
        do_action('mixxcazt_woocommerce_before_shop_loop_item_title');
        ?>
    </div>
    <div class="product-caption">
        <?php
        /**
         * Functions hooked in to mixxcazt_woocommerce_shop_loop_item_title action
         *
         * @see mixxcazt_woocommerce_get_product_category - 5 - woo
         * @see woocommerce_template_loop_product_title - 5 - woo
		 * @see woocommerce_template_loop_rating - 10 - woo
         */
        do_action('mixxcazt_woocommerce_shop_loop_item_title');

        /**
         * Functions hooked in to mixxcazt_woocommerce_after_shop_loop_item_title action
         *
         * @see mixxcazt_woocommerce_get_product_description - 15 - woo
         * @see woocommerce_template_loop_price - 20 - woo
         * @see woocommerce_template_loop_add_to_cart - 25 - woo
         * @see mixxcazt_quickview_button - 30 - woo
         * @see mixxcazt_compare_button - 35 - woo
         *
         */
        do_action('mixxcazt_woocommerce_after_shop_loop_item_title');
        ?>
    </div>
    <?php
    /**
     * Functions hooked in to mixxcazt_woocommerce_after_shop_loop_item action
     *
     */
    do_action('mixxcazt_woocommerce_after_shop_loop_item');
    ?>
</li>
