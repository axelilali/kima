<?php
ini_set('display_errors', 1);

require_once __DIR__ . '/config/twig.config.php';
require_once __DIR__ . '/config/vite.config.php';

class Theme
{

 public function __construct()
 {

  self::add_twig_function();
  self::theme_support();
 }

 private function theme_support()
 {
  add_theme_support('automatic-feed-links');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support(
   'html5',
   array(
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
   )
  );
  add_theme_support(
   'post-formats',
   array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
    'gallery',
    'audio',
   )
  );

  add_theme_support('menus');
 }

 private function add_twig_function()
 {
  global $twig;

  $twig->addFunction(new \Twig\TwigFunction('wp_head', function () {
   do_action('wp_head');
  }));

  $twig->addFunction(new \Twig\TwigFunction('wp_footer', function () {
   do_action('wp_footer');
  }));

  $twig->addFunction(new \Twig\TwigFunction('body_class', function ($css_class = '') {
   echo 'class="' . esc_attr(implode(' ', get_body_class($css_class))) . '"';
  }));
 }
}

new Theme();
