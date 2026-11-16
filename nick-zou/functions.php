<?php

// Apply a stored colour mode before first paint to avoid a flash.
add_action('wp_head', function () {
    echo "<script>try{var t=localStorage.getItem('theme');if(t==='light'||t==='dark')document.documentElement.dataset.theme=t}catch(e){}</script>\n";
}, 1);

add_action('wp_enqueue_scripts', function () {
    $version = fn ($file) => filemtime(get_theme_file_path($file));

    foreach (['assets/css/theme-mode.css', 'assets/css/gradient.css'] as $file) {
        wp_enqueue_style(
            'nick-zou-' . basename($file, '.css'),
            get_theme_file_uri($file),
            [],
            $version($file)
        );
    }

    $alpine = 'assets/js/alpine.min.js';
    wp_enqueue_script(
        'nick-zou-alpine',
        get_theme_file_uri($alpine),
        [],
        $version($alpine),
        ['strategy' => 'defer', 'in_footer' => true]
    );
});
