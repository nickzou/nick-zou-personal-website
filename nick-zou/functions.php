<?php

add_action('wp_enqueue_scripts', function () {
    $file = 'assets/css/gradient.css';

    wp_enqueue_style(
        'nick-zou-gradient',
        get_theme_file_uri($file),
        [],
        filemtime(get_theme_file_path($file))
    );
});
