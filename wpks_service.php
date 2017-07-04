<?php

/**
 * Extraer video de youtube
 * from: http://stackoverflow.com/questions/3392993/php-regex-to-get-youtube-video-id
 */
function wpks_videoFromYoutube($url) {
    parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
    return $my_array_of_vars['v']; 
}

?>
