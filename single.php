
<?php
/**
 * Single post template
 */
get_header(); ?>

<main class="main-content">

<?php
if ( have_posts() ) :
  while ( have_posts() ) : the_post(); ?>

  <section class="single-post">
    <article id="post-<?php the_ID(); ?>" <?php post_class('post-article'); ?>>
      <!-- Category -->
      <?php
        $cats = get_the_category();
        if ( $cats ) : ?>
          <div class="post-category">
            <?php echo esc_html( $cats[0]->name ); ?>
          </div>
      <?php endif; ?>

      <!-- Title -->
      <h1 class="post-title entry-title"><?php the_title(); ?></h1>

      <!-- Meta -->
      <div class="post-meta entry-meta">
        <span class="post-author">By <?php the_author_posts_link(); ?></span>
        <span class="meta-sep">&middot;</span>
        <span class="post-date"><?php echo esc_html( get_the_date() ); ?></span>
      </div>

      <!-- Social share -->
      <div class="post-share">
        <a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_permalink() ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook">
          <i class="fa fa-facebook"></i>
        </a>
        <a href="<?php echo esc_url( 'https://twitter.com/intent/tweet?text=' . urlencode( get_the_title() . ' ' . get_permalink() ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on X">
          <i class="fa fa-twitter"></i>
        </a>
        <a href="<?php echo esc_url( 'https://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&description=' . urlencode( get_the_title() ) ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Pinterest">
          <i class="fa fa-pinterest"></i>
        </a>
        <a href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&body=<?php echo rawurlencode( get_permalink() ); ?>" aria-label="Share via Email">
          <i class="fa fa-envelope"></i>
        </a>
      </div>

      <!-- Featured image -->
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
          <?php the_post_thumbnail( 'large' ); ?>
        </div>
      <?php endif; ?>

      <!-- Content -->
      <div class="post-body entry-content">
        <?php
          the_content();
          wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mystarter' ),
            'after'  => '</div>',
          ) );
        ?>
      </div>
    </article>

    <!-- Author box -->
    <aside class="author-box">
      <div class="author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
      </div>
      <div class="author-info">
        <span class="author-label">Written by</span>
        <h4 class="author-name"><?php the_author_posts_link(); ?></h4>
        <p class="author-bio"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
      </div>
    </aside>

    <!-- Related posts -->
    <?php
      $related = new WP_Query( array(
        'posts_per_page' => 4,
        'post__not_in'   => array( get_the_ID() ),
        'category__in'   => wp_get_post_categories( get_the_ID() ),
      ) );

      if ( $related->have_posts() ) : ?>
        <div class="related-posts">
          <h3><?php esc_html_e( 'Related Posts', 'mystarter' ); ?></h3>
          <div class="related-grid">
            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
              <article class="related-item">
                <a href="<?php the_permalink(); ?>">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'medium' ); ?>
                  <?php endif; ?>
                  <h4><?php the_title(); ?></h4>
                </a>
              </article>
            <?php endwhile; ?>
          </div>
        </div>
      <?php
      endif;
      wp_reset_postdata();
    ?>
  </section>

<?php
  endwhile;
endif;

get_footer();
