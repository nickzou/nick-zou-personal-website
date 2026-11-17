<?php

// Cache-busting version for a theme file: its modification time.
function nick_zou_asset_version(string $file): int
{
    return filemtime(get_theme_file_path($file));
}

add_action('wp_enqueue_scripts', function () {
    foreach (['assets/css/theme-mode.css', 'assets/css/gradient.css'] as $file) {
        wp_enqueue_style(
            'nick-zou-' . basename($file, '.css'),
            get_theme_file_uri($file),
            [],
            nick_zou_asset_version($file)
        );
    }
});
