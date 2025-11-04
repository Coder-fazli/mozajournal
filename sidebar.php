<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
  <aside class="hero-sidebar" role="complementary">
   
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
  </aside>
<?php else : ?>
  <aside class="hero-sidebar" role="complementary">
    
    <p>Добавьте виджеты в раздел <strong>Внешний вид → Виджеты → Sidebar Magazine</strong>.</p>
  </aside>
<?php endif; ?>