<?php

function university_files() {
  wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  if (strstr($_SERVER['SERVER_NAME'], 'localhost')) {
    wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
  } else {
    wp_enqueue_script('vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.8c97d901916ad616a264.js'), NULL, '1.0', true);
    wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.361ae884830d52b8ba98.js'), NULL, '1.0', true);
    wp_enqueue_style('main-styles', get_theme_file_uri('/bundled-assets/styles.361ae884830d52b8ba98.css'));
  }
}

function university_features() {
  register_nav_menu('main-header-menu', 'Main Header Menu');
  register_nav_menu('footer-menu-first', 'The First Footer Menu');
  register_nav_menu('footer-menu-second', 'The Second Footer Menu');
  add_theme_support('title-tag');
}

add_action('wp_enqueue_scripts', 'university_files');
add_action('after_setup_theme', 'university_features');