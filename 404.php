
<?php
/**
 * 404 template
 */
get_header(); ?>

<main class="main-content">

<h1><?php _e('Page not found','mystarter'); ?></h1>
<p><?php _e('The page you are looking for does not exist.','mystarter'); ?></p>
<?php get_search_form(); ?>

<?php get_footer();
