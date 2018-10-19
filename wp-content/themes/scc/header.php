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
      <h1><?php the_title(); ?></h1>
      <?php if ( is_front_page() ): ?>
        <h2><?= get_bloginfo( 'description' ); ?></h2>
      <?php endif; ?>
    </div>
    <div class="scc-menu-bar">
      <button class="menu-icon open">
        <span class="icon"><span></span></span>
        <span class="label">Menu</span>
      </button>
    </div>
    <div class="scc-menu">
      <button class="menu-icon close">
        <div class="icon"><span></span></div>
        <div class="label"><?php _e( 'Close', 'scc' ); ?></div>
      </button>
      <?php
        wp_nav_menu( array(
          'menu' => 'menu_main',
          'container' => 'nav'
        ) );
      ?>
    </div>
