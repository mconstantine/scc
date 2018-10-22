<?php get_header(); ?>
<main class="scc-single-post">
  <div class="heading">
    <?php
      $date_format = get_option( 'date_format' );
      $date = get_the_date( $date_format );
      $author_name = get_the_author_meta( 'display_name' );
      $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $author = "<a href=\"$author_url\">$author_name</a>";
    ?>
    <h6><?php printf( __( 'Published on %s by %s', 'scc' ), $date, $author ); ?></h6>

    <?php $categories = scc_get_categories_links( get_the_ID() ); ?>
    <?php if ( $categories ): ?>
      <h6><?php printf( __( 'Categories: %s', 'scc' ), implode( ', ', $categories ) ); ?></h6>
    <?php endif; ?>
  </div>
  <div class="content">
    <?php the_content(); ?>
  </div>
  <div class="footer">
    <?php if ( $next_post = get_next_post() ): ?>
      <div class="next-post">
        <h4><?php _e( 'Next Post', 'scc' ); ?></h4>
        <div>
          <?php
            $heading = get_the_date( $date_format, $next_post->ID );
            $categories = scc_get_categories_links( $next_post->ID );

            if ( $categories ) {
              $heading .= ' &ndash; ' . implode( ', ', $categories );
            }
          ?>
          <h6><?= $heading; ?></h6>
          <h5><?= get_the_title( $next_post->ID ); ?></h5>
          <p><?= get_the_excerpt( $next_post->ID ); ?></p>
          <div class="wp-block-button primary">
            <a href="<?= get_the_permalink( $next_post->ID ); ?>" class="wp-block-button__link">
              <?php _e( 'Read', 'scc' ); ?>
            </a>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php $terms = get_the_terms( get_the_ID(), 'category' ); ?>
    <?php if ( !empty( $terms ) ): ?>
      <?php
        $term_ids = array_map( function( $term ) {
          return $term->term_id;
        }, $terms );

        $exclusions = array( get_the_ID() );

        if ( $next_post ) {
          $exclusions[] = $next_post->ID;
        }

        $related_posts = new WP_Query( array(
          'post_type' => 'post',
          'orderby' => 'date',
          'posts_per_page' => 2,
          'category__in' => $term_ids,
          'post__not_in' => $exclusions
        ) );
      ?>
      <?php if ( $related_posts->have_posts() ): ?>
        <div class="related-posts">
          <h4><?php _e( 'Related Posts', 'scc' ); ?></h4>
          <?php while ( $related_posts->have_posts() ): $related_posts->the_post(); ?>
            <div>
              <?php
                $heading = get_the_date( $date_format, get_the_ID() );
                $categories = scc_get_categories_links( get_the_ID() );

                if ( $categories ) {
                  $heading .= ' &ndash; ' . implode( ', ', $categories );
                }
              ?>
              <h6><?= $heading; ?></h6>
              <h5><?= get_the_title( get_the_ID() ); ?></h5>
              <p><?= get_the_excerpt( get_the_ID() ); ?></p>
              <div class="wp-block-button primary">
                <a href="<?= get_the_permalink( get_the_ID() ); ?>" class="wp-block-button__link">
                  <?php _e( 'Read', 'scc' ); ?>
                </a>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</main>
<?php get_footer();
