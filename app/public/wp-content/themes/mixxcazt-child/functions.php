<?php
/**
 * Theme functions and definitions.
 */

		 
function dynamic_page_title() {
    if (is_shop()) {
        return get_the_title(wc_get_page_id('shop'));
    } elseif (is_product_category() || is_product_tag()) {
        return single_term_title('', false);
    } elseif (is_product()) {
        return get_the_title();
    } else {
        return get_the_title();
    }
}
add_shortcode('dynamic_title', 'dynamic_page_title');

