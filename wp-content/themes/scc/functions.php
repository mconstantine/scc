<?php

function scc_edit_default_scripts( $scripts ) {
  if ( !is_admin() ) {
    $scripts->remove( 'jquery' );
  }
}

function scc_enqueue_scripts_before() {
  wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js' );
  wp_enqueue_style( 'normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css' );
}

function scc_enqueue_scripts() {
  $scripts_dir = 'js';
  $styles_dir = 'css';

  $theme_path = get_template_directory();
  $theme_url = get_template_directory_uri();

  $current_theme_template = _get_current_template();

  wp_enqueue_style( 'style', get_stylesheet_uri() );
  $script_path = "$scripts_dir/$current_theme_template.js";
  $style_path = "$styles_dir/$current_theme_template.css";

  if ( file_exists( "$theme_path/$script_path" ) ) {
    wp_enqueue_script( $current_theme_template, "$theme_url/$script_path", array() );
  } elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG && !is_dir( "$theme_path/$scripts_dir" ) ) {
    echo "Unable to find the scripts directory.<br>";
  }

  if ( file_exists( "$theme_path/$style_path" ) ) {
    wp_enqueue_style( $current_theme_template, "$theme_url/$style_path" );
  } elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG && !is_dir( "$theme_path/$styles_dir" ) ) {
    echo "Unable to find the styles directory.<br>";
  }
}

add_filter( 'wp_default_scripts', 'scc_edit_default_scripts' );
add_action( 'wp_enqueue_scripts', 'scc_enqueue_scripts_before' );
add_action( 'wp_enqueue_scripts', 'scc_enqueue_scripts' );

function _record_template( $template ) {
  $GLOBALS['current_theme_template'] = basename( $template, '.php' );
  return $template;
}
add_filter( 'template_include', '_record_template', 1000 );

function _get_current_template() {
  if ( ! isset( $GLOBALS['current_theme_template'] ) ) return false;
  return $GLOBALS['current_theme_template'];
}
