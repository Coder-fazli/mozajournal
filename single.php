
<?php
/**
 * Single post template
 */
get_header(); ?>

<main class="main-content">

<?php
// single.php — только секция single post
if ( have_posts() ) :
  while ( have_posts() ) : the_post(); ?>
  
  <section class="single-post">
    <article id="post-<?php the_ID(); ?>" <?php post_class('post-article'); ?>>
      <!-- Title -->
      <h1 class="post-title entry-title"><?php the_title(); ?></h1>

      <!-- Meta -->
      <div class="post-meta entry-meta">
        <span class="post-date"><?php echo esc_html( get_the_date() ); ?></span>
        <span class="meta-sep">•</span>
        <span class="post-author"><?php the_author_posts_link(); ?></span>
        <?php if ( function_exists('the_category') ) : ?>
          <span class="meta-sep">•</span>
          <span class="post-cats"><?php the_category(', '); ?></span>
        <?php endif; ?>
        </div>

      <!-- Featured image -->
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
          <?php the_post_thumbnail( 'large', array( 'class' => 'aligncenter' ) ); ?>
        </div>
      <?php endif; ?>

      <!-- Content -->
      <div class="post-body entry-content">
        <?php
          // the_content выводит контент и пагинацию (<!--nextpage-->)
          the_content();

          // Если нужно — выводим пагинацию для поста (части поста)
          wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'your-theme-textdomain' ),
            'after'  => '</div>',
          ) );
        ?>
      </div>

      <!-- Tags -->
      <?php if ( has_tag() ) : ?>
        <div class="post-tags">
          <?php the_tags( '', ' ', '' ); ?>
        </div>
      <?php endif; ?>

      <!-- Social share (простая реализация) -->
      <div class="post-share">
        <a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_permalink() ) ); ?>" target="_blank" rel="noopener noreferrer">Share FB</a>
        <a href="<?php echo esc_url( 'https://twitter.com/intent/tweet?text=' . urlencode( get_the_title() . ' ' . get_permalink() ) ); ?>" target="_blank" rel="noopener noreferrer">Tweet</a>
      </div>
    </article>

    <!-- Author box -->
    <aside class="author-box">
      <div class="author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?>
      </div>
      <div class="author-info">
        <h4 class="author-name"><?php the_author_posts_link(); ?></h4>
        <p class="author-bio"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
      </div>
    </aside>

    <!-- Related posts (simple by category) -->
    <?php
      $related = new WP_Query( array(
        'posts_per_page' => 4,
        'post__not_in'   => array( get_the_ID() ),
        'category__in'   => wp_get_post_categories( get_the_ID() ),
      ) );

      if ( $related->have_posts() ) : ?>
        <div class="related-posts">
          <h3><?php esc_html_e( 'Related Posts', 'your-theme-textdomain' ); ?></h3>
          <div class="related-grid">
            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
              <article class="related-item">
                <a href="<?php the_permalink(); ?>">
                  <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'medium' ); ?>
                  <?php else: ?>
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/placeholder-300x200.png' ); ?>" alt="">
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

    <!-- Comments -->
    <div class="comments-wrap">
      <?php
        // Выведет шаблон комментариев, если они разрешены
        if ( comments_open() || get_comments_number() ) {
          comments_template();
        }
      ?>
    </div>
  </section>

<?php
  endwhile;
endif;

get_sidebar();
get_footer();
