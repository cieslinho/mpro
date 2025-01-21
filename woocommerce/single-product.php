<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

global $product;
$product = wc_get_product( get_the_ID() ); // Uzyskuje obiekt produktu na podstawie ID

if ( ! $product || ! is_a( $product, 'WC_Product' ) ) {
	error_log( 'Product is not valid or not set.' ); // Zaloguj informację do debugowania
	return;
}

// Pobierz ID głównego zdjęcia
$main_image_id = $product->get_image_id();
// Pobierz URL i metadane głównego zdjęcia
$main_image_url = wp_get_attachment_image_url( $main_image_id, 'large' );
$main_image_alt = get_post_meta( $main_image_id, '_wp_attachment_image_alt', true );

// Placeholder dla głównego zdjęcia
$placeholder_url = 'http://mprosklep.pl/wp-content/uploads/2024/10/product-placeholder.png';

// Użyj placeholdera, jeśli brak głównego zdjęcia
if ( ! $main_image_url ) {
	$main_image_url = $placeholder_url;
	$main_image_alt = 'No image available'; // Ustaw alternatywny tekst dla placeholdera
}

$product_id = get_the_ID(); // ID aktualnego produktu
$price      = get_post_meta( $product_id, '_price', true ); // Pobierz cenę podstawową
$sale_price = get_post_meta( $product_id, '_sale_price', true ); // Pobierz cenę promocyjną (jeśli jest)
?>

<section class="product">
	<div class="container">
<?php
if ( function_exists( 'wc_print_notices' ) ) {
		wc_print_notices();
}
?>
		<div class="products__breadcrumbs">
			<?php woocommerce_breadcrumb(); ?>
		</div>

		<div class="product__content">
			<div class="product__left">
				<div class="product__img">
					<img id="main-image" src="<?php echo esc_url( $main_image_url ); ?>" alt="<?php echo esc_attr( $main_image_alt ); ?>">
				</div>

				<div class="product__thumbnails">
					
						<?php
						// Galeria miniatur
						$attachment_ids = $product->get_gallery_image_ids();

						// Dodaj główne zdjęcie jako miniaturę
						if ( $main_image_id ) {
							echo '<div class="product__thumbnail" data-large-img="' . esc_url( $main_image_url ) . '">';
							echo wp_get_attachment_image( $main_image_id, 'auto' );
							echo '</div>';
						} else {
							// Dodaj placeholder jako miniaturę, jeśli brak głównego zdjęcia
							echo '<div class="product__thumbnail" data-large-img="' . esc_url( $placeholder_url ) . '">';
							echo '<img src="' . esc_url( $placeholder_url ) . '" alt="Zdjęcie Zastępcze Produktu" />';
							echo '</div>';
						}

						// Dodaj pozostałe miniatury z galerii
						if ( $attachment_ids && count( $attachment_ids ) > 0 ) {
							foreach ( $attachment_ids as $attachment_id ) {
								$thumbnail_url = wp_get_attachment_image_url( $attachment_id, 'auto' );
								$thumbnail_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
								echo '<div class="product__thumbnail" data-large-img="' . esc_url( $thumbnail_url ) . '">';
								echo wp_get_attachment_image( $attachment_id, 'auto', false, array( 'alt' => esc_attr( $thumbnail_alt ) ) );
								echo '</div>';
							}
						} else {
							// Dodaj placeholder dla miniatur, gdy brak zdjęć
							echo '<div class="product__thumbnail" data-large-img="' . esc_url( $placeholder_url ) . '">';
							echo '<img src="' . esc_url( $placeholder_url ) . '" alt="Zdjęcie Zastępcze Produktu" />';
							echo '</div>';
						}
						?>
					
				</div>
			</div>

			<div class="product__right">
				<div class="product__details">
					<div class="product__top">
					<h1 class="product__title"><?php the_title(); ?></h1>

					<?php
					// Pobierz jednostkę miary z ACF
					$unit = get_field( 'unit_of_measure', $product->get_id() ) ?: 'szt';

					// Mapa jednostek
					$units = array(
						'szt' => 'szt.',
						'mb'  => 'mb.',
						'kg'  => 'kg',
						'm2'  => 'm2',
					);


					?>

<?php if ( $sale_price ) : ?>
	<p class="product__price product__pricv-sale price">
		<del><?php echo wc_price( $price ); ?></del>
		<ins><?php echo wc_price( $sale_price ); ?></ins>
		<span class="product__unit">
<?            if (isset($units[$unit])) {
		?>
		Cena za <?php echo esc_html( $units[ $unit ] ); ?>
		<?php
}
?>
		</span>
	</p>
<?php else : ?>
	<p class="product__price product__pricv-normal price">
		<?php echo wc_price( $price ); ?>
		<span class="product__unit">
<?            if (isset($units[$unit])) {
		?>
		Cena za <?php echo esc_html( $units[ $unit ] ); ?>
		<?php
}
?>
		</span>
	</p>
<?php endif; ?>
					
					
					</div>
					<?php
					$shortDescription = get_field( 'short_description' );

					if ( ! empty( $shortDescription ) ) :
						?>
	<div class="product__middle">
		<p class="product__short">
								<?php echo $shortDescription; ?>
		</p>
	</div>
					<?php endif; ?>
			
			
	
				
					

<?php
$product_id      = get_the_ID(); // Pobierz ID bieżącego produktu
$unit_of_measure = get_field( 'unit_of_measure', $product_id ); // Pobierz jednostkę miary
$price_per_unit  = get_field( 'price_per_unit', $product_id ); // Pobierz cenę za jednostkę

// Wyświetl kalkulator tylko dla jednostek kg, mb, m2
if ( in_array( $unit_of_measure, array( 'kg', 'mb', 'm2' ), true ) && $price_per_unit ) :
	?>
	
	<div class="product__calculator">
	
		<p class="product__calculator-title">
			Cena za <?php echo esc_html( $unit_of_measure ); ?>: <?php echo esc_html( $price_per_unit ); ?> PLN
		</p>
	
		<div class="product__calculator-top" id="weight-calculator">
			<div class="product__calculator-row">
				<label class="product__calculator-label" for="unit-input">
					Ilość (<?php echo esc_html( $unit_of_measure ); ?>):
				</label>
				<input class="product__calculator-input" type="number" id="unit-input" min="0.1" step="0.1" placeholder="Podaj ilość">
			</div>
		</div>

		<div class="product__calculator-middle">
			<button type="button" class="product__calculator-btn" id="calculate-price">Oblicz cenę</button>
			<p class="product__calculator-info" id="total-price"></p>
		</div>

		<div class="product__calculator-bottom">
			<label class="product__calculator-label" for="product-quantity-display">Ilość:</label>
			<input class="product__calculator-input" type="number" id="product-quantity-display" name="quantity" value="1" readonly>
			<span class="product__calculator-info"> <?php echo esc_html( $unit_of_measure ); ?></span>
		</div>
	
		<input type="hidden" id="product-total-price" name="product_total_price" value="">
		<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>">
	</div>

	<script>
document.addEventListener('DOMContentLoaded', function() {
	const unitInput = document.getElementById('unit-input');
	const quantityDisplay = document.getElementById('product-quantity-display');
	const totalPriceDisplay = document.getElementById('total-price');
	const quantityInputs = document.querySelectorAll('input[name="quantity"]'); // Pobierz wszystkie inputy quantity
	const pricePerUnit = <?php echo json_encode( $price_per_unit ); ?>; // Cena jednostkowa z PHP

	// Funkcja do obliczania ceny
	document.getElementById('calculate-price').addEventListener('click', function() {
		const quantity = parseFloat(unitInput.value) || 0; // Pobierz wartość z inputu
		const totalPrice = (quantity * pricePerUnit).toFixed(2); // Oblicz całkowitą cenę

		// Wyświetl wynik
		totalPriceDisplay.innerText = 'Cena całkowita: ' + totalPrice + ' PLN';
		quantityDisplay.value = quantity; // Ustaw ilość w quantity display
		
		// Aktualizacja wszystkich inputów 'quantity'
		quantityInputs.forEach(input => {
			input.value = quantity; // Ustaw ilość w każdym input'cie 'quantity'
		});

		// Ustaw wartość ukrytego inputa na całkowitą cenę
		document.getElementById('product-total-price').value = totalPrice;
	});
});
</script>

<?php endif; ?>







<div class="product__bottom">
<?php
$product_id      = get_the_ID();
$unit_of_measure = get_field( 'unit_of_measure', $product_id ); // Pobierz jednostkę miary
$price_per_unit  = get_field( 'price_per_unit', $product_id ); // Pobierz cenę jednostkową (np. za kg, mb, m2)

// Pobierz stan magazynowy produktu
$product        = wc_get_product( $product_id );
$stock_status   = $product->get_stock_status();
$stock_quantity = $product->get_stock_quantity();
?>

<?php if ( in_array( $unit_of_measure, array( 'kg', 'mb', 'm2' ), true ) && $price_per_unit ) : ?>
	<!-- Formularz z customową ilością, widoczny tylko jeśli jednostka miary to 'kg', 'mb', lub 'm2' -->
	<div class="product__btn add-to-cart">
	<div class="stock-status">
		<?php if ( $stock_status === 'instock' ) : ?>
			<p class="stock in-stock"><?php echo esc_html( $stock_quantity ); ?> <?php echo esc_html( $unit_of_measure ); ?> w magazynie</p>
		<?php elseif ( $stock_status === 'outofstock' ) : ?>
			<p class="stock out-of-stock">Brak w magazynie</p>
		<?php elseif ( $stock_status === 'onbackorder' ) : ?>
			<p>Stan magazynowy: Dostępny na zamówienie</p>
		<?php endif; ?>
	</div>
	<form class="cart" method="post" enctype="multipart/form-data">
		<div class="quantity">
		<label for="custom-quantity"></label>
		<input class="input-text qty text" type="number" id="custom-quantity" name="custom_quantity" min="0" step="0.01" required>
		</div>
		
		<!-- Ukryte pole przekazujące ID produktu -->
		<input type="hidden" name="product_id" value="<?php echo esc_attr( $product_id ); ?>">

		<!-- Standardowe pole ilości w WooCommerce -->
		<input type="hidden" name="quantity" value="1">

		<button class="single_add_to_cart_button button alt" type="submit" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>">Dodaj do koszyka</button>
	</form>
	</div>
	<div class="product__meta">
		<?php woocommerce_template_single_meta(); ?>
	</div>
<?php else : ?>
	<!-- Standardowy przycisk WooCommerce jeśli brak jednostki miary lub ceny -->
	<div class="product__btn add-to-cart">
		<?php woocommerce_template_single_add_to_cart(); ?>
	</div>
	<div class="product__meta">
		<?php woocommerce_template_single_meta(); ?>
	</div>
<?php endif; ?>

<?php get_template_part( 'block/product-order-benefits-block/product-order-benefits-block' ); ?>
</div>

</div>














			</div>
		</div>

	  
		
		<?php get_template_part( 'block/product-tabs-block/product-tabs-block' ); ?>
		<div class="product__related">
			<h2 class="section-title section-title-margin">Podobne produkty</h2>
		<div class="products__boxes">
	<?php
	ini_set( 'display_errors', 'Off' );
	ini_set( 'error_reporting', E_ALL );
	$related_products = wc_get_related_products( get_the_ID(), 4 );

	if ( $related_products ) :
		foreach ( $related_products as $related_product_id ) :

			$product       = wc_get_product( $related_product_id );
			$product_title = $product->get_name();
			$product_link  = get_permalink( $related_product_id );
			$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $related_product_id ), 'medium' )[0];
			$product_price = $product->get_price_html();
			?>
			<div class="products__box">
				<div class="products__box-top">
					<a href="<?php echo esc_url( $product_link ); ?>">
						<img src="<?php echo esc_url( $product_image ); ?>" alt="<?php echo esc_attr( $product_title ); ?>">
					</a>
				</div>
				<div class="products__box-infos">
					<h2><a href="<?php echo esc_url( $product_link ); ?>"><?php echo esc_html( $product_title ); ?></a></h2>
					<span class="products__price"><?php echo wp_kses_post( $product_price ); ?>
					
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
		<p class="products__unit">Cena za <?php echo esc_html( $units[ $unit ] ); ?></p>
											<?php
										}


										?>
				
				
				</span>
					<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="products__btn">
						Dodaj do koszyka
					</a>
				</div>
			</div>
			<?php
		endforeach;
	endif;
	?>
</div>
</div>

		</div>
	   
	</div>
</section>

<?php


do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' );
?>
