<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */

$menu_content = get_field('menu-content');
$categoryImage = $menu_content['category-image'];

/**
 * Dodaj obrazek obok elementów <li> w menu
 */
function add_image_next_to_li($item_output, $item, $depth, $args) {
    // Pobierz niestandardowe pole z ACF dla bieżącego elementu menu
    $menu_content = get_field('menu-content', $item); 
    $categoryImageID = $menu_content['category-image'];  // Zmienna dla identyfikatora obrazka z ACF

    if ($categoryImageID) {
        // Użyj wp_get_attachment_image, aby wygenerować HTML obrazka
        $image_html = wp_get_attachment_image($categoryImageID, 'thumbnail', false, array(
            'class' => 'category__image',
        ));

        // Stwórz nowy tag <a> z obrazkiem i tytułem linku
        $link_url = esc_url($item->url);
        $link_title = esc_html($item->title);
        
        // Połącz obrazek z linkiem
        $item_output = '<a href="' . $link_url . '" class="category__link">' . $image_html . $link_title . '</a>';
    }

    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'add_image_next_to_li', 10, 4);

/**
 * Dodaj klasę swiper-slide do każdego elementu <li>
 */
function add_swiper_slide_class($classes, $item, $args) {
    $classes[] = 'swiper-slide category__slide'; // Dodaj klasę swiper-slide
    return $classes;
}
add_filter('nav_menu_css_class', 'add_swiper_slide_class', 10, 3);
?>
<section class="category">
    <div class="container">
   <div class="swiper category__swiper">
  
    <?php
      wp_nav_menu(array(
        'theme_location' => 'category-slider',
        'items_wrap'     => '<ul class="swiper-wrapper category__wrapper">%3$s</ul>',
      ));
    ?>
  

  <!-- Dodaj strzałki nawigacyjne Swiper -->
  <!-- <div class="swiper-button-next category__next"></div>
  <div class="swiper-button-prev category__prev"></div> -->
  <div class="swiper-pagination category__pagination"></div>
  </div>
  
  <!-- Dodaj paginację (opcjonalnie) -->


    </div>
</section>