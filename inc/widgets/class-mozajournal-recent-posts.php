<?php
// Описываем наш кастомный виджет
class Mozajournal_Recent_Posts extends WP_Widget {

  public function __construct() {
    parent::__construct(
      'mozajournal_recent_posts',
      'Recent Posts (Article)',
      ['description' => 'Выводит последние посты в виде карточек с миниатюрой.']
    );
  }

  public function widget($args, $instance) {
    echo $args['before_widget'];
    echo $args['before_title'] . 'Posts' . $args['after_title'];

    $q = new WP_Query([
      'posts_per_page' => !empty($instance['number']) ? (int)$instance['number'] : 5,
      'ignore_sticky_posts' => true,
    ]);

    while ($q->have_posts()) {
      $q->the_post(); ?>
      <article class="sidebar-item">
        <a href="<?php the_permalink(); ?>" class="thumb">
          <?php if (has_post_thumbnail()) the_post_thumbnail([120,120], ['alt'=>get_the_title()]); ?>
        </a>
        <div class="text">
          <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
          <p class="author"><?php the_author(); ?></p>
        </div>
      </article>
    <?php }

    wp_reset_postdata();
    echo $args['after_widget'];
  }

  public function form($instance) {
    $number = !empty($instance['number']) ? (int)$instance['number'] : 5; ?>
    <p>
      <label>Количество постов:</label>
      <input class="small-text"
             name="<?php echo $this->get_field_name('number'); ?>"
             type="number" value="<?php echo $number; ?>">
    </p>
  <?php }
}

// Регистрируем виджет
add_action('widgets_init', function() {
  register_widget('Mozajournal_Recent_Posts');
});
