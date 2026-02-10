
<?php
/**
 * Footer template
 */
?>
</main>
<footer class="site-footer">
  <div class="footer-inner">

    <!-- Left column: brand + socials -->
    <div class="footer-brand">
      <div class="footer-logo">
        <?php
          if ( has_custom_logo() ) {
            the_custom_logo();
          } else {
            echo '<span class="footer-site-name">' . get_bloginfo('name') . '</span>';
          }
        ?>
      </div>
      <p class="footer-desc"><?php echo esc_html( get_bloginfo('description') ); ?></p>
      <div class="footer-socials">
        <a href="#" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" aria-label="X / Twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" aria-label="Pinterest"><i class="fa fa-pinterest"></i></a>
        <a href="#" aria-label="Instagram"><i class="fa fa-instagram"></i></a>
        <a href="#" aria-label="TikTok"><i class="fa fa-music"></i></a>
      </div>
    </div>

    <!-- Middle column: site links -->
    <div class="footer-links">
      <h4>MORE FROM <?php echo strtoupper( get_bloginfo('name') ); ?></h4>
      <ul>
        <li><a href="<?php echo esc_url( home_url('/') ); ?>">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Privacy Policy</a></li>
      </ul>
    </div>

    <!-- Right column: categories -->
    <div class="footer-categories">
      <h4>SEE MORE STORIES</h4>
      <ul>
        <?php
          $cats = get_categories( array( 'number' => 8, 'orderby' => 'count', 'order' => 'DESC' ) );
          if ( $cats ) :
            foreach ( $cats as $cat ) : ?>
              <li><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                <?php echo esc_html( $cat->name ); ?>
              </a></li>
            <?php endforeach;
          endif;
        ?>
      </ul>
    </div>

  </div>

  <div class="footer-bottom">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
