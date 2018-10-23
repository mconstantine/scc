<?php
if ( !defined( 'LIBS_PATH' ) ) {
  define( 'LIBS_PATH', WP_CONTENT_DIR . '/just-libs' );
}

define( 'USE_MODULES', true );

require_once LIBS_PATH . '/wp-remove-defaults.php';
require_once LIBS_PATH . '/wp-textdomain.php';

just_remove_unused();
just_load_theme_textdomain( 'scc' );

function scc_edit_default_scripts( $scripts ) {
  if ( !is_admin() ) {
    $scripts->remove( 'jquery' );
  }
}

function scc_enqueue_scripts() {
  wp_enqueue_script(
    'polyfill',
    'https://cdn.polyfill.io/v2/polyfill.min.js?features=default'
  );

  $tdu = get_template_directory_uri();
  $tdp = get_template_directory();
  $template = _get_current_template();

  $enqueue = function( $name, $path, $type = 'script', $deps = null ) use ( $tdu, $tdp ) {
    if ( !USE_MODULES && $type === 'script' ) {
      if ( substr( $name, 0, 2 ) === 'm_' ) {
        return;
      }

      wp_enqueue_script( $name, "$tdu/$path", $deps );
    }

    $version = filemtime( "$tdp/$path" );
    call_user_func( "wp_enqueue_$type", $name, "$tdu/$path", $deps, $version );
  };

  $enqueue( 'm_index', 'src/index.js' );
  $enqueue( 'l_index', 'legacy/legacy-index.js' );
  $enqueue( 's_index', 'css/index.css', 'style' );

  if ( function_exists( 'gutenberg_parse_blocks' ) ) {
    $content = get_post_field( 'post_content', get_the_ID() );
    $blocks = gutenberg_parse_blocks( $content );

    foreach ( $blocks as $block ) {
      if ( !is_array( $block ) ) {
        continue;
      }

      switch ( $block['blockName'] ) {
        case 'core/code':
          wp_enqueue_script(
            's_prism',
            get_template_directory_uri() . '/static/prism.js',
            null, null, true
          );
          wp_enqueue_style( 's_prism', get_template_directory_uri() . '/static/prism.css' );
          break;
        default:
          break;
      }
    }
  }
}

add_filter( 'wp_default_scripts', 'scc_edit_default_scripts' );
add_action( 'wp_enqueue_scripts', 'scc_enqueue_scripts' );

function scc_get_categories_links( $post_id = null ) {
  $categories = array();
  $terms = get_the_terms( $post_id, 'category' );

  if ( !empty( $terms ) ) {
    foreach ( $terms as $term ) {
      $link = get_term_link( $term, 'category' );

      if ( !is_wp_error( $link ) ) {
        $categories[] = "<a href=\"$link\">{$term->name}</a>";
      }
    }

    return $categories;
  }

  return false;
}

if ( USE_MODULES ) {
  function scc_script_loader_tag( $tag, $handle, $src ) {
    if ( substr( $handle, 0, 2 ) === 'm_' ) {
      $tag = "<script type=\"module\" src=\"$src\"></script>";
    } elseif ( substr( $handle, 0, 2 ) === 'l_' ) {
      $tag = "<script type=\"text/javascript\" src=\"$src\" nomodule></script>";
    }

    return $tag;
  }

  add_filter( 'script_loader_tag', 'scc_script_loader_tag', 10, 3 );
}

// function scc_add_brand_search_shortcode() {
//   return scc_read_partial( 'brand-search-form' );
// }
// add_shortcode( 'ricerca_brand', 'scc_add_brand_search_shortcode' );

function _record_template( $template ) {
  $GLOBALS['current_theme_template'] = basename( $template, '.php' );
  return $template;
}
add_filter( 'template_include', '_record_template', 1000 );

function _get_current_template() {
  if ( ! isset( $GLOBALS['current_theme_template'] ) ) return false;
  return $GLOBALS['current_theme_template'];
}
