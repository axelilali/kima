<?php

add_action('wp_enqueue_scripts', function () {
 $manifestPath = get_theme_file_path('public/dist/manifest.json');

 if (is_array(wp_remote_get('http://localhost:5173/'))) {

  wp_enqueue_script('vite', 'http://localhost:5173/@vite/client', [], null);
  wp_enqueue_script('main-js', 'http://localhost:5173/assets/js/main.js', ['jquery'], null, true);
  wp_enqueue_style('style-css', 'http://localhost:5173/assets/scss/styles.scss', [], 'null');

 } elseif (file_exists($manifestPath)) {

  $manifest = json_decode(file_get_contents($manifestPath), true);
  wp_enqueue_script('main-js', get_theme_file_uri('public/dist/' . $manifest['assets/js/main.js']['file']), ['jquery'], null, true);
  wp_enqueue_style('style-css', get_theme_file_uri('public/dist/' . $manifest['assets/scss/styles.scss']['file']), [], null);

 }
});

// Load scripts as modules.
add_filter('script_loader_tag', function (string $tag, string $handle, string $src) {
 if (in_array($handle, ['vite', 'main-js'])) {
  return '<script type="module" src="' . esc_url($src) . '" defer></script>';
 }

 return $tag;
}, 10, 3);
