
<?php
/**
 * Search results template
 */
get_header(); ?>

<main class="main-content">

<h1><?php printf( esc_html__( 'Search results for: %s', 'mystarter' ), '<em>' . get_search_query() . '</em>' ); ?></h1>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php the_excerpt(); ?>
  </article>
  <hr>
<?php endwhile; else: ?>
  <p><?php _e('Nothing found. Try another query.','mystarter'); ?></p>
<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer();
