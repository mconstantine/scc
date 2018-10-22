<?php
if ( !defined( 'LIBS_PATH' ) ) {
  define( 'LIBS_PATH', WP_CONTENT_DIR . '/just-libs' );
}

require_once LIBS_PATH . '/wp-remove-defaults.php';
require_once LIBS_PATH . '/wp-menus.php';
require_once LIBS_PATH . '/wp-textdomain.php';

class Scc {
  function __construct() {
    just_register_menu( 'menu_main', 'Menu principale' );
    just_load_plugin_textdomain( 'scc' );
    add_action( 'init', array( $this, 'init' ) );
    add_action( 'upload_mimes', array( $this, 'upload_mimes' ) );
  }

  function init() {
    if ( function_exists( 'acf_add_options_page' ) ) {
      acf_add_options_page( array(
        'page_title' => __( 'Options', 'scc' ),
        'icon_url' => 'dashicons-admin-tools',
        'position' => 30
      ) );
    }
  }

  function upload_mimes( $mimes ) {
    return array_merge( $mimes, array( 'svg' => 'image/svg+xml' ) );
  }
}
