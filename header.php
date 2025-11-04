<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php  bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Заголовок-->

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
     rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
   <?php wp_head(); ?>
  </head>

<body <?php body_class(); ?>>
<!--Menu Elements-->
<header class="header">
   <div class="logo-wrapper">
       <div class="menu-logo">
        <a href="<?php echo home_url(); ?>">
          <?php
             if (has_custom_logo()) {
              the_custom_logo();
             } else {
              echo  '<span class="site-title">' .get_bloginfo('name') . '</span>';
             }
          ?>
         </a>
      </div>
   </div>

   <button class="ham-menu" aria-label="Toggle menu">
       <span></span>
       <span></span>
       <span></span>
   </button>

   <div class="nav-main-container">
      <nav class="nav">
         <?php
          // Меню из админки
          wp_nav_menu([
            'theme_location' => 'primary',     // регистрируется в functions.php
            'container'      => false,
            'menu_class'     => 'nav_list',    // твой класс
            'fallback_cb'    => false,
          ]);
          ?>
      </nav>

      <!-- Кнопка поиска -->
      <button class="search-toggle" aria-label="Open search">
        <!-- SVG лупы -->
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
   </div>

   <div class="bottom_line"></div>
</header>

<!-- Mobile menu backdrop -->
<div class="backdrop"></div>

<!-- Overlay поиск (скрыт по умолчанию) -->
<div class="search-overlay" id="searchOverlay" aria-hidden="true">
  <div class="search-overlay__backdrop"></div>
  <div class="search-overlay__panel" role="dialog" aria-modal="true" aria-label="Site search">
    <form class="search-overlay__form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
      <input id="overlayInput" name="s" type="text" placeholder="Type and hit Enter" autocomplete="off" />
      <button type="submit" class="search-overlay__submit" aria-label="Search">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </button>
      <!-- Иконка крестика -->
      <button type="button" class="search-overlay__close" aria-label="Close search">
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
    </form>
  </div>
</div>
