<?php
function chowordpress_wc_custom_get_price_html($price, $product)
{
    if ($product->get_price() == 0) {
        if ($product->is_on_sale() && $product->get_regular_price()) {
            $regular_price = wc_get_price_to_display($product, array('qty' => 1, 'price' => $product->get_regular_price()));

            $price = wc_format_price_range($regular_price, __('Liên hệ', 'woocommerce'));
        } else {
            $price = '<span class="amount">' . __('Liên hệ', 'woocommerce') . '</span>';
        }
    }
    return $price;
}

add_filter('woocommerce_get_price_html', 'chowordpress_wc_custom_get_price_html', 10, 2);
// Add custom Theme Functions here
function remove_category($string, $type)
{
    if ($type != 'single' && $type == 'category' && (strpos($string, 'category') !== false)) {
        $url_without_category = str_replace("/category/", "/", $string);
        return trailingslashit($url_without_category);
    }
    return $string;
}

add_filter('user_trailingslashit', 'remove_category', 100, 2);