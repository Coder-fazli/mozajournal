
<?php
/**
 * Archive template
 */
get_header(); ?>

<main class="main-content">

<h1><?php the_archive_title(); ?></h1>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php the_excerpt(); ?>
  </article>
  <hr>
<?php endwhile; endif; ?>

<?php get_sidebar(); ?>
<?php get_footer();
