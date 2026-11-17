<?php

// The colour mode toggle is a preview feature: it exists everywhere except production.
function nick_zou_has_theme_toggle(): bool
{
    return wp_get_environment_type() !== 'production';
}

// [theme_toggle] renders the button, or nothing in production.
add_shortcode('theme_toggle', function () {
    if (!nick_zou_has_theme_toggle()) {
        return '';
    }

    return file_get_contents(get_theme_file_path('assets/html/theme-toggle.html'));
});

// Apply a stored colour mode before first paint to avoid a flash.
add_action('wp_head', function () {
    if (!nick_zou_has_theme_toggle()) {
        return;
    }

    echo "<script>try{var t=localStorage.getItem('theme');if(t==='light'||t==='dark')document.documentElement.dataset.theme=t}catch(e){}</script>\n";
}, 1);

// The button is driven by Alpine, which loads only where the button does.
add_action('wp_enqueue_scripts', function () {
    if (!nick_zou_has_theme_toggle()) {
        return;
    }

    $alpine = 'assets/js/alpine.min.js';
    wp_enqueue_script(
        'nick-zou-alpine',
        get_theme_file_uri($alpine),
        [],
        nick_zou_asset_version($alpine),
        ['strategy' => 'defer', 'in_footer' => true]
    );
});
