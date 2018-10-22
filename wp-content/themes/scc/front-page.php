<?php get_header(); ?>

<main class="scc-front-page">
  <div class="content">
    <?php the_content(); ?>
  </div>

  <div class="latest-articles">
    <h4><span><?php _e( 'Latest Posts', 'scc' ); ?></span></h4>
    <?php
      $latest_posts = new WP_Query( array(
        'post_type' => 'post',
        'order_by' => 'date',
        'posts_per_page' => 3
      ) );
    ?>
    <?php if ( $latest_posts->have_posts() ): ?>
      <?php $date_format = get_option( 'date_format' ); ?>
      <?php while ( $latest_posts->have_posts() ): $latest_posts->the_post(); ?>
        <div>
          <?php
            $categories = array();
            $terms = get_the_terms( get_the_ID(), 'category' );

            if ( !empty( $terms ) ) {
              foreach ( $terms as $term ) {
                $link = get_term_link( $term, 'category' );

                if ( !is_wp_error( $link ) ) {
                  $categories[] = "<a href=\"$link\">{$term->name}</a>";
                }
              }

              $categories = ' &ndash; ' . implode( ', ', $categories );
            } else {
              $categories = '';
            }
          ?>
          <h6><?= get_the_date( $date_format ) ?><?= $categories; ?></h6>
          <h5><?php the_title(); ?></h5>
          <?= the_excerpt(); ?>
          <div class="wp-block-button primary">
            <a href="<?php the_permalink(); ?>" class="wp-block-button__link">
              <?php _e( 'Read', 'scc' ); ?>
            </a>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</main>

<?php get_footer();
