<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <title><?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
  </head>
  <body>
    <?php the_post(); ?>
    <div class="scc-cover">
      <?php if ( is_front_page() ): ?>
        <h1><?= get_bloginfo( 'title' ); ?></h1>
        <h2><?= get_bloginfo( 'description' ); ?></h2>
      <?php else: ?>
        <h1><?php the_title(); ?></h1>
      <?php endif; ?>
    </div>
    <div class="scc-menu-bar">
      <button id="scc-menu-icon-open" class="menu-icon open">
        <span class="icon"><span></span></span>
        <span class="label">Menu</span>
      </button>
    </div>
    <div id="scc-menu-dim" class="scc-menu-dim"></div>
    <div id="scc-menu" class="scc-menu">
      <button class="menu-icon close">
        <div id="scc-menu-icon-close" class="icon"><span></span></div>
        <div class="label"><?php _e( 'Close', 'scc' ); ?></div>
      </button>
      <?php
        wp_nav_menu( array(
          'menu' => 'menu_main',
          'container' => 'nav',
          'container_class' => 'menu-container'
        ) );
      ?>
    </div>
