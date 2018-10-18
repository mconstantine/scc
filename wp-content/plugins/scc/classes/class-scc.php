<?php
if ( !defined( 'LIBS_PATH' ) ) {
  define( 'LIBS_PATH', WP_CONTENT_DIR . '/just-libs' );
}

require_once LIBS_PATH . '/wp-remove-defaults.php';
require_once LIBS_PATH . '/wp-menus.php';

class Scc {
  function __construct() {
    just_register_menu( 'menu_main', 'Menu principale' );
    add_action( 'upload_mimes', array( $this, 'upload_mimes' ) );
  }

  function upload_mimes( $mimes ) {
    return array_merge( $mimes, array( 'svg' => 'image/svg+xml' ) );
  }
}
