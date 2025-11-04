
# MyStarter — минимальная тема WordPress

## Установка
1. Зайдите в `Внешний вид → Темы → Добавить новую → Загрузить тему`.
2. Загрузите архив `mystarter.zip` из этого чата и активируйте тему.
3. Создайте меню в `Внешний вид → Меню` и привяжите его к области *Primary Menu*.
4. Добавьте виджеты в `Внешний вид → Виджеты` (область *Sidebar*).

## Структура
- `style.css` — метаданные темы + базовые стили.
- `functions.php` — подключение стилей/скриптов, поддержка фич, меню, сайдбар.
- `header.php`, `footer.php` — шапка и подвал.
- `index.php` — запасной шаблон (The Loop).
- `front-page.php` — главная, если выбрана статическая страница.
- `home.php` — блог, если главная статическая.
- `single.php`, `page.php`, `archive.php`, `search.php`, `404.php`
- `sidebar.php`, `comments.php`
- `template-parts/content-none.php`
- `assets/js/main.js`

## Дальше
- Изучите [Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/).
- Используйте хуки `wp_head`, `wp_footer`, `wp_enqueue_scripts`, `after_setup_theme`.
- Пишите стили в `style.css` или подключайте дополнительные файлы через `wp_enqueue_style`.
