
<?php
/**
 * Static page template
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <?php comments_template(); ?>
  </article>
<?php endwhile; endif;

get_sidebar();
get_footer();
