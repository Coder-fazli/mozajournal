
<?php
/**
 * Comments template
 */
if ( post_password_required() ) { return; }
if ( have_comments() ) : ?>
  <h2><?php comments_number(); ?></h2>
  <ol class="comment-list">
    <?php wp_list_comments(); ?>
  </ol>
  <?php the_comments_pagination(); ?>
<?php endif;

comment_form();
