<?php if (function_exists('flrt_get_page_related_filters')) {
    echo do_shortcode('[fe_chips]');
} else if (is_plugin_active('facetwp/index.php')) {
    echo do_shortcode('[facetwp selections="true"] ');
} else if (is_plugin_active('premmerce-woocommerce-product-filter-premium/premmerce-filter.php')) {
    echo do_shortcode('[premmerce_active_filters]');
} else {
    the_widget('WC_Widget_Layered_Nav_Filters');
}
