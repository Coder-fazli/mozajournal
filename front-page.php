<?php
/**
 * Static front page
 */
get_header(); ?>
   
<main class="main-content"> 
   
        <div class="container">
         <section class="hero">
   <!-- Левая колонка: маленькие статьи -->
          <div class="hero-left">
          <?php
          // создаем новый запрос
             $hero_posts = new WP_Query([
              'posts_per_page' => 2,
              'post_status' => 'publish'
             ]);

             if ($hero_posts->have_posts()) : ?> 
                <?php  while ($hero_posts->have_posts()) : $hero_posts->the_post(); ?>
                  <article class="small-article">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('medium');?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                      <span class="category"><?php the_category(); ?></span>
                     <h3><?php the_title(); ?></h3>
                     <p class="author"><?php the_author(); ?></p>
                 </article>
             <?php endwhile; ?>

             <?php else : ?>
                Not Posts yet
             <?php endif; ?>
        </div> <!--hero left-->
            
          <div class="hero-main">
            <?php if (has_post_thumbnail()) : ?>
              <img src="<?php the_post_thumbnail_url('mediun'); ?>" alt="<?php the_title(); ?>">
           <?php endif; ?>

           <h2><?php the_title(); ?></h2>
           <p class="author"><?php the_author(); ?></p>
            </div>
            
              <?php get_sidebar(); ?>
</aside>
</section>
            <!--Slider Section-->
<section class="cover-stars" aria-label="November Cover Stars">
  <div class="cover-stars__header">
    <h2 class="cover-stars__title">November Cover Stars</h2>
    <div class="cover-stars__controls" aria-controls="coverTrack">
      <button class="cover-stars__btn" data-prev aria-label="Previous" disabled>‹</button>
      <span class="cover-stars__pager" data-pager aria-live="polite">1 / 1</span>
      <button class="cover-stars__btn" data-next aria-label="Next">›</button>
    </div>
  </div>  

  <div class="cover-stars__viewport container">
    <div id="coverTrack" class="cover-stars__track" role="list">

      <?php
      // WP Query для последних 6 постов
      $slider_posts = new WP_Query([
          'posts_per_page' => 10, // количество постов для слайдера
          'post_status' => 'publish'
      ]);

      if ($slider_posts->have_posts()) :
          while ($slider_posts->have_posts()) : $slider_posts->the_post(); ?>
          
          <article class="cover-card" role="listitem">
            <a class="cover-card__media" href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()) : ?>
                  <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
              <?php endif; ?>
            </a>
            <div class="cover-card__meta"><?php the_category(', '); ?></div>
            <h3 class="cover-card__title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="cover-card__by">By <?php the_author(); ?></div>
          </article>

      <?php endwhile;
      endif;
      wp_reset_postdata();
      ?>

    </div>
  </div>
</section>
    <!--End Of Slider Section-->
    </section>
    <section class="articles-grid-one">
  <h2 class="articles-grid-one-title">Last News</h2>
  <div class="articles-container">
    <div class="articles-grid-one-list">

      <?php
      $last_posts = new WP_Query([
          'posts_per_page' => 6, // количество постов на страницу
          'post_status' => 'publish'
      ]);

      if ($last_posts->have_posts()) :
          while ($last_posts->have_posts()) : $last_posts->the_post();
      ?>

      <article class="article-card">
        <div class="article-card__inner">
          <div class="article-card__image">
            <?php 
              $categories = get_the_category();
              if ($categories) :
            ?>
              <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="article-card__cat">
                <?php echo esc_html($categories[0]->name); ?>
              </a>
            <?php endif; ?>
            
            <a href="<?php the_permalink(); ?>" class="article-card__link">
              <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
              <?php endif; ?>
            </a>
          </div>

          <div class="article-card-content">
            <div class="article-card_title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
            <p class="article-card__text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
            <div class="article-card_meta">
              <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="article-card_author">
                <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', ['class'=>'article-card_author-avatar']); ?>
                <div class="article-card_author-info">
                  <span class="article-card_author-name"><?php the_author(); ?></span>
                  <span class="article-card_date"><?php echo get_the_date(); ?></span>
                </div>
              </a>
            </div>
          </div>

        </div>
      </article>

      <?php
          endwhile;
      endif;
      wp_reset_postdata();
      ?>

    </div>
  </div>

  <!-- Здесь можно подключить динамическую пагинацию WordPress -->
   <?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$last_posts = new WP_Query([
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'paged' => $paged
]);

if ($last_posts->have_posts()) :
    while ($last_posts->have_posts()) : $last_posts->the_post();
        // вывод карточек
    endwhile;

    // кастомная пагинация
    $pages = paginate_links([
        'total'   => $last_posts->max_num_pages,
        'current' => $paged,
        'prev_text' => '‹',
        'next_text' => '›',
        'type' => 'array', // возвращает массив ссылок
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 1
    ]);

    if (is_array($pages)) :
?>
<div class="artiles-grid-one_paginations">
  <nav class="articles-grid-one__pagination pagination" aria-label="Pagination">
    <a class="pagination__arrow pagination__arrow--prev" href="<?php echo $paged > 1 ? get_pagenum_link($paged-1) : '#'; ?>" aria-label="Previous page">‹</a>
    <ul class="pagination__list">
      <?php foreach ($pages as $page) : ?>
        <li>
          <?php 
            // Добавляем свои классы к ссылкам
            $page = str_replace('page-numbers', 'pagination__link', $page); 
            echo $page; 
          ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <a class="pagination__arrow pagination__arrow--next" href="<?php echo $paged < $last_posts->max_num_pages ? get_pagenum_link($paged+1) : '#'; ?>" aria-label="Next page">›</a>
  </nav>
</div>
<?php
    endif;
endif;

wp_reset_postdata();
?>
</section>

  </div>
</main>



<?php get_footer(); ?>  