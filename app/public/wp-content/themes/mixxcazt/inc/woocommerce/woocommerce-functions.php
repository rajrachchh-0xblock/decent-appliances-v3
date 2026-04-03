<?php
/**
 * Checks if the current page is a product archive
 *
 * @return boolean
 */
function mixxcazt_is_product_archive() {
    if (is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag()) {
        return true;
    } else {
        return false;
    }
}

/**
 * @param $product WC_Product
 */
function mixxcazt_product_get_image($product) {
    return $product->get_image();
}

/**
 * @param $product WC_Product
 */
function mixxcazt_product_get_price_html($product) {
    return $product->get_price_html();
}

/**
 * Retrieves the previous product.
 *
 * @param bool $in_same_term Optional. Whether post should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param string $taxonomy Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 * @since 2.4.3
 *
 */
function mixxcazt_get_previous_product($in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat') {
    $product = new Mixxcazt_WooCommerce_Adjacent_Products($in_same_term, $excluded_terms, $taxonomy, true);
    return $product->get_product();
}

/**
 * Retrieves the next product.
 *
 * @param bool $in_same_term Optional. Whether post should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param string $taxonomy Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 * @since 2.4.3
 *
 */
function mixxcazt_get_next_product($in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat') {
    $product = new Mixxcazt_WooCommerce_Adjacent_Products($in_same_term, $excluded_terms, $taxonomy);
    return $product->get_product();
}


function mixxcazt_is_woocommerce_extension_activated($extension = 'WC_Bookings') {
    if ($extension == 'YITH_WCQV') {
        return class_exists($extension) && class_exists('YITH_WCQV_Frontend') ? true : false;
    }

    return class_exists($extension) ? true : false;
}

function mixxcazt_woocommerce_pagination_args($args) {
    $args['prev_text'] = '<i class="mixxcazt-icon mixxcazt-icon-chevron-left"></i>' . esc_html__('PREVIOUS', 'mixxcazt');
    $args['next_text'] = esc_html__('NEXT', 'mixxcazt') . '<i class="mixxcazt-icon mixxcazt-icon-chevron-right"></i>';
    return $args;
}

add_filter('woocommerce_pagination_args', 'mixxcazt_woocommerce_pagination_args', 10, 1);


/**
 * Check if a product is a deal
 *
 * @param int|object $product
 *
 * @return bool
 */
function mixxcazt_woocommerce_is_deal_product($product) {
    $product = is_numeric($product) ? wc_get_product($product) : $product;

    // It must be a sale product first
    if (!$product->is_on_sale()) {
        return false;
    }

    if (!$product->is_in_stock()) {
        return false;
    }

    // Only support product type "simple" and "external"
    if (!$product->is_type('simple') && !$product->is_type('external')) {
        return false;
    }

    $deal_quantity = get_post_meta($product->get_id(), '_deal_quantity', true);

    if ($deal_quantity > 0) {
        return true;
    }

    return false;
}

if (!function_exists('mixxcazt_ajax_search_products')) {
    function mixxcazt_ajax_search_products() {
        global $woocommerce;
        $search_keyword = $_REQUEST['query'];

        $ordering_args = $woocommerce->query->get_catalog_ordering_args('date', 'desc');
        $suggestions   = array();

        $args = array(
            's'                   => apply_filters('mixxcazt_ajax_search_products_search_query', $search_keyword),
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'orderby'             => $ordering_args['orderby'],
            'order'               => $ordering_args['order'],
            'posts_per_page'      => apply_filters('mixxcazt_ajax_search_products_posts_per_page', 8),

        );

        $args['tax_query']['relation'] = 'AND';

        if (!empty($_REQUEST['product_cat'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => strip_tags($_REQUEST['product_cat']),
                'operator' => 'IN'
            );
        }

        $products = get_posts($args);

        if (!empty($products)) {
            foreach ($products as $post) {
                $product       = wc_get_product($post);
                $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()));

                $suggestions[] = apply_filters('mixxcazt_suggestion', array(
                    'id'    => $product->get_id(),
                    'value' => strip_tags($product->get_title()),
                    'url'   => $product->get_permalink(),
                    'img'   => esc_url($product_image[0]),
                    'price' => $product->get_price_html(),
                ), $product);
            }
        } else {
            $suggestions[] = array(
                'id'    => -1,
                'value' => esc_html__('No results', 'mixxcazt'),
                'url'   => '',
            );
        }
        wp_reset_postdata();

        echo json_encode($suggestions);
        die();
    }
}

add_action('wp_ajax_mixxcazt_ajax_search_products', 'mixxcazt_ajax_search_products');
add_action('wp_ajax_nopriv_mixxcazt_ajax_search_products', 'mixxcazt_ajax_search_products');

