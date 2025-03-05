<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */


$latest_products_content = get_field( 'latest-products-content' );
$heading                 = $latest_products_content['section-heading'];
$latest_products         = $latest_products_content['latest-products'];
$section_btn             = $latest_products_content['section-btn'];
$section_link            = $latest_products_content['section-link']

?>

<section class="products latest">
	<div class="container">
		<h2 class="section-title"> <?php echo esc_html( $heading ); ?></h2>
		<?php if ( $latest_products ) : ?>
			<div class="products__boxes products__latest">
				<?php foreach ( $latest_products as $post ) : ?>
					<?php
					// Przygotuj dane postu
					setup_postdata( $post );

					// Uzyskaj ID produktu
					$product_id = $post->ID;

					// Pobierz obiekt produktu WooCommerce
					$product = wc_get_product( $product_id );
					?>

				<!-- Produkt promocyjny -->
				
					<a class="products__box products__latest" href="<?php echo get_permalink( $product_id ); ?>">
						
					<div class="products__box-top products__latest-top"><?php echo $product->get_image(); // Miniatura produktu ?></div>

						<div class="products__box-infos products__latest-infos">
							<h2>
								<?php echo get_the_title( $product_id ); ?>
							</h2>
							<span class="products__price products__price-latest">
								<?php echo $product->get_price_html(); ?>
								<?php
								// Pobranie aktualnego produktu
								global $product;

								// Pobranie jednostki miary z ACF (domyślnie "szt")
								$unit = get_field( 'unit_of_measure', $product->get_id() ) ?: 'szt';

								// Mapa jednostek
								$units = array(
									'szt' => 'szt.',
									'mb'  => 'mb.',
									'kg'  => 'kg',
									'm2'  => 'm2',
									'l'   => 'litr',
								);



								// Wyświetlenie jednostki
								if ( isset( $units[ $unit ] ) ) {
									?>
		<p class="products__unit">Cena za <?php echo esc_html( $units[ $unit ] ); ?></p>
									<?php
								}


								?>
							</span>
							<button class="products__btn products__btn-latest">Sprawdź</button>
						
						</div>
					</a>

				   
				
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
				
			</div>
			<a href="<?php echo esc_html( $section_link ); ?>" class="section-btn"><?php echo esc_html( $section_btn ); ?></a>
		<?php endif; ?>
	</div>
</section>
