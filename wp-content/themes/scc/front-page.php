<?php
  get_header();
  the_post();
?>

<main class="scc-front-page">
  <div class="content">
    <?php the_content(); ?>
  </div>
  <div class="latest-articles"></div>
</main>

<?php get_footer();
