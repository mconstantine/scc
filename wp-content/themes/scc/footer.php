<?php
  $lang = 'it';

  if ( function_exists( 'pll_current_language' ) ) {
    $lang = pll_current_language();
  }
?>
<footer class="scc-footer">
  <div>
    <?php if (
      function_exists( 'get_field' ) &&
      ( $footer_content = get_field( "footer_content_$lang", 'options' ) )
    ): ?>
      <?= $footer_content; ?>
    <?php endif; ?>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
