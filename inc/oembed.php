<?php

function ground_handle_oembed_cookiebot($return, $data, $url)
{

    // Check if cookiebot is active
    if (!isset($_COOKIE["CookieConsent"])) {
        return $return;
    }

    // Intercept youtube oembed
    if ('YouTube' === $data->provider_name) {

        // Change src to data-cookieblock-
        $pattern = '~<iframe[^>]*\K(?=src)~i';
        $replacement = 'data-cookieblock-';
        $return = preg_replace($pattern, $replacement, $return);

        // Add attribute data-cookieconsent
        $return = str_replace(
            '<iframe',
            '<iframe data-cookieconsent="marketing"',
            $return
        );

        $class_list = 'cookieconsent-optout-marketing | absolute top-0 left-0 w-full h-full border -gray-500 p-6 rounded-theme';
        // Add div to accept cookie
        $message = __('Please <a href="javascript:Cookiebot.renew()">accept marketing-cookies</a> to watch this video.', 'ground');
        $return .= '<div class="' . $class_list . '">' . $message . '</div>';
    }

    return $return;
}
add_filter('oembed_dataparse', 'ground_handle_oembed_cookiebot', 99, 3);

// To use ‘oembed_dataparse’ for the first time, you might have to clear oEmbed post-meta cache:

add_filter('oembed_ttl', function ($ttl) {
    $GLOBALS['wp_embed']->usecache = 0;
    $ttl = 0;
    // House-cleanoing
    do_action('wpse_do_cleanup');
    return $ttl;
});

add_filter('embed_oembed_discover', function ($discover) {
    if (1 === did_action('wpse_do_cleanup'))
        $GLOBALS['wp_embed']->usecache = 1;
    return $discover;
});
