<?php
/**
 * Theme setup and helpers
 */

if ( ! function_exists( 'mystarter_setup' ) ) {
    function mystarter_setup() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'responsive-embeds' );

        register_nav_menus( [
            'primary' => __( 'Primary Menu', 'mystarter' ),
        ] );
        }}
     
       add_action( 'after_setup_theme', 'mystarter_setup' );

function mytheme_setup() {
    add_theme_support('custom-logo', [
    'height'      => 90,   // рекомендуемая высота
    'width'       => 200,  // ширина
    'flex-height' => true,
    'flex-width'  => true,
    ]);
}
 add_action('after_setup_theme', 'mytheme_setup');


function mystarter_assets() {
    wp_enqueue_style( 'mystarter-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version') );
    wp_enqueue_script( 'mystarter-script', get_template_directory_uri() . '/assets/js/main.js', [], null, true );
}
add_action( 'wp_enqueue_scripts', 'mystarter_assets' );

require get_template_directory() . '/inc/widgets/class-mozajournal-recent-posts.php';

add_action('widgets_init', function () {
  register_sidebar([
    'name'          => 'Sidebar Magazine',
    'id'            => 'sidebar-1',
    'description'   => 'Правая колонка в геро-секции.',
    'before_widget' => '', // твой класс
    'after_widget'  => '</article>',
    'before_title'  => '<div class="text"><h5>',
    'after_title'   => '</h5></div>',
  ]);
});