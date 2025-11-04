
<?php
/**
 * Single post template
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1 class="entry-title"><?php the_title(); ?></h1>
    <div class="entry-meta">
      <span><?php echo get_the_date(); ?></span> • <span><?php the_author_posts_link(); ?></span>
    </div>
    <?php if ( has_post_thumbnail() ) : the_post_thumbnail('large'); endif; ?>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <?php comments_template(); ?>
  </article>
<?php endwhile; endif;

get_sidebar();
get_footer();
