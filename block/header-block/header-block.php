<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */


$category_content = get_field( 'category-content' );
$btnText          = $category_content['btn-text'];
$btnLink          = $category_content['btn-link'];
$heading          = $category_content['heading'];

$hero_content  = get_field( 'hero-content' );
$contentOption = $hero_content['content-option'];
$img           = $hero_content['img'];
$title         = $hero_content['title'];
$description   = $hero_content['description'];
$imageHero     = $hero_content['image_hero'];

$search_content = get_field( 'search-content' );
$shortcode      = $search_content['shortcode'];

$promo_content = get_field( 'promo-content' );
$promoHeading  = $promo_content['promo-heading'];
$promoProducts = $promo_content['promo-products'];
$promoText     = $promo_content['promo-text'];
$promoLink     = $promo_content['promo-link'];


?>

<header class="header">
	<div class="container">
		<div class="header__boxes">
			<div class="header__categories">
				<p class="header__heading">
					<?php echo esc_html( $heading ); ?>
				</p>
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'categories-header',
						'container_class' => 'header__menu',
					)
				);
				?>
				<a class="header__btn" href="<?php echo esc_html( $btnLink ); ?>">
					<?php echo esc_html( $btnText ); ?>
				</a>
			</div>
			<div class="header__search">
			<?php echo do_shortcode( $shortcode ); ?>
			</div>

			<div class="header__content">
	<?php if ( $contentOption === 'grafika' && $img ) : ?>
		
			<img class="header__image" src="<?php echo esc_url( wp_get_attachment_image_url( $img, 'full' ) ); ?>" 
				alt="<?php echo esc_attr( get_post_meta( $img, '_wp_attachment_image_alt', true ) ?: 'Obrazek Dekoracyjny lub Promocyjny' ); ?>">
		
	<?php elseif ( $contentOption === 'brakGrafiki' ) : ?>
		<div class="header__texts">
			<?php if ( $title ) : ?>
				<h1 class="header__title"><?php echo esc_html( $title ); ?></h1>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<div class="header__description"><?php echo wp_kses_post( $description ); ?></div>
			<?php endif; ?>

			
		</div>
		<?php if ( $imageHero ) : ?>
				<div class="header__wrapper">
					<img class="header__image" src="<?php echo esc_url( wp_get_attachment_image_url( $imageHero, 'full' ) ); ?>" 
						alt="<?php echo esc_attr( get_post_meta( $imageHero, '_wp_attachment_image_alt', true ) ?: 'Obrazek Dekoracyjny lub Promocyjny' ); ?>">
						</div>
			<?php endif; ?>
	<?php endif; ?>
</div>
			

			<div class="header__promo">
				<p class="header__heading">
					<?php echo esc_html( $promoHeading ); ?>
				</p>
				<?php if ( $promoProducts ) : ?>
				<div class="header__discounts">
					<?php foreach ( $promoProducts as $post ) : ?>
						<?php
							// Przygotuj dane postu
							setup_postdata( $post );

							// Uzyskaj ID produktu
							$product_id = $post->ID;

							// Pobierz obiekt produktu WooCommerce
							$product = wc_get_product( $product_id );
						?>

					<!-- Produkt promocyjny -->
					<div class="header__product header__product-promo">
						<a href="<?php echo get_permalink( $product_id ); ?>">
							<?php echo $product->get_image(); // Miniatura produktu ?>


							<div class="header__product-infos">
								<h2>
									<?php echo get_the_title( $product_id ); ?>
								</h2>
								<span class="header__product-price">
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
									);



									// Wyświetlenie jednostki
									if ( isset( $units[ $unit ] ) ) {
										?>
		<p class="header__product-unit">Cena za <?php echo esc_html( $units[ $unit ] ); ?></p>
										<?php
									}


									?>
								</span>
							</div>
						</a>
					</div>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				</div>
				<?php endif; ?>
				<a class="header__btn" href="<?php echo esc_html( $promoLink ); ?>">
					<?php echo esc_html( $promoText ); ?>
				</a>
			</div>
		</div>
	</>
</header>
