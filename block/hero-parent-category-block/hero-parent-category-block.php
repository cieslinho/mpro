<?php
/**
 * Wyświetla obrazek w kategorii z pola ACF `hero-img` oraz przypisanym tekstem alt z biblioteki mediów.
 * Obrazek jest pobierany z kategorii nadrzędnej, jeśli bieżąca kategoria nie ma przypisanego obrazka.
 *
 * @return void
 */

$current_category = get_queried_object();

/**
 * Funkcja do pobierania obrazka z bieżącej kategorii lub jej nadrzędnych.
 *
 * @param int $category_id ID kategorii.
 * @return int|null ID obrazka lub null, jeśli nie znaleziono.
 */
function get_hero_image_recursive( $category_id ) {
	// Pobierz dane z ACF dla bieżącej kategorii
	$hero_content = get_field( 'hero-content', 'product_cat_' . $category_id );
	$hero_img     = isset( $hero_content['hero-img'] ) ? $hero_content['hero-img'] : null;

	// Jeśli obrazek istnieje, zwróć jego ID
	if ( $hero_img ) {
		return $hero_img;
	}

	// Jeśli kategoria ma rodzica, spróbuj pobrać obrazek z nadrzędnej kategorii
	$parent_id = get_term( $category_id )->parent;
	if ( $parent_id != 0 ) {
		return get_hero_image_recursive( $parent_id );
	}

	// Jeśli nie znaleziono obrazka i nie ma już nadrzędnych kategorii, zwróć null
	return null;
}

// Pobierz obrazek dla bieżącej kategorii (lub nadrzędnej)
$hero_img = get_hero_image_recursive( $current_category->term_id );

// Jeśli obrazek istnieje, renderuj HTML
if ( $hero_img ) {
	// Pobierz URL obrazka
	$hero_img_url = wp_get_attachment_image_url( $hero_img, 'full' );
	// Pobierz alt z biblioteki mediów
	$hero_img_alt = get_post_meta( $hero_img, '_wp_attachment_image_alt', true );

	// Pobierz nazwę kategorii głównej (najwyższego poziomu w hierarchii)
	$top_category = $current_category;
	while ( $top_category->parent != 0 ) {
		$top_category = get_term( $top_category->parent, 'product_cat' );
	}

	// Renderowanie kontenera z obrazkiem
	?>
	<div class="category__hero">
		<p class="category__hero-title">
			<?php echo esc_html( $top_category->name ); ?> <!-- Wyświetl nazwę kategorii ogólnej -->
		</p>
		<img class="category__hero-img" src="<?php echo esc_url( $hero_img_url ); ?>" alt="<?php echo esc_attr( $hero_img_alt ); ?>">
	</div>
	<?php
}
?>
