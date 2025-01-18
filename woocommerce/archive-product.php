<?php
/**
 * The template for displaying product archives, including the main shop page which is a post type archive.
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 */



defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

// Pobierz maksymalną cenę z produktów
global $wpdb;
$max_price = $wpdb->get_var(
	"
    SELECT MAX(CAST(meta_value AS DECIMAL(10,2))) 
    FROM {$wpdb->postmeta} 
    WHERE meta_key = '_price'
    AND post_id IN (SELECT ID FROM {$wpdb->posts} WHERE post_type = 'product' AND post_status = 'publish')
"
);

// Ustaw wartość domyślną na 10000, jeśli nie ma produktów
$max_price = $max_price ? $max_price : 10000;

// Usuń domyślny wrapper ul i li WooCommerce
remove_action( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
remove_action( 'woocommerce_product_loop_start', 'woocommerce_product_loop_start', 10 );
remove_action( 'woocommerce_product_loop_end', 'woocommerce_product_loop_end', 10 );
?>

<section class="products">
	<div class="container">
		<div class="products__breadcrumbs">
			<?php
			/**
			 * Wyświetl breadcrumbs WooCommerce.
			 */
			woocommerce_breadcrumb();
			?>
		</div>
		
		<!-- Breadcrumbs -->

		<div class="products__content">
			<div class="products__left">
				<aside class="products__sidebar">
					<?php
					// Wyświetl widgety sidebaru
					if ( is_active_sidebar( 'shop-sidebar' ) ) {
						dynamic_sidebar( 'shop-sidebar' );
					}
					?>

<div class="price-filter">
	<h3>Filtruj wg ceny</h3>
	<div class="price-range">
		<div class="slider-container">
			<input type="range" id="priceSlider" min="0" max="<?php echo esc_attr( $max_price ); ?>" value="0">
		</div>
	</div>
	<div class="price-values">
		
			<button class="change-price" id="priceDecrease">-</button>
			<input type="number" id="priceInput" value="0" min="0" max="<?php echo esc_attr( $max_price ); ?>">
			<button class="change-price" id="priceIncrease">+</button>
		
	</div>
	<div class="displayed-values">
		<span id="priceValue">0</span>
	</div>
	<button id="filterButton">Filtruj</button>
</div>

				</aside>
			</div>

			<div class="products__right">
			<?php get_template_part( 'block/top-banner-block/top-banner-block' ); ?>
			<div class="products__sorting">
	<form method="GET">
		<label for="orderby" class="products__sorting-label">Sortuj:</label>
		<select name="orderby" id="orderby" class="products__sorting-select" onchange="this.form.submit()">
			<option value="">Wybierz sortowanie</option>
			<option value="date_asc" <?php selected( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'date_asc' ); ?>>Data rosnąco</option>
			<option value="date_desc" <?php selected( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'date_desc' ); ?>>Data malejąco</option>
			<option value="price_asc" <?php selected( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'price_asc' ); ?>>Cena rosnąco</option>
			<option value="price_desc" <?php selected( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'price_desc' ); ?>>Cena malejąco</option>
		</select>
	</form>
	<div class="products__count">
	<?php woocommerce_result_count(); ?>
	
	</div>
</div>


				<div class="products__boxes">
					<?php if ( woocommerce_product_loop() ) : ?>
						<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
							<?php
							while ( have_posts() ) :
								the_post();
								?>
					<div class="products__box">
						<div class="products__box-top">
							<a href="<?php the_permalink(); ?>">
								<?php
										/**
										 * Hook: woocommerce_before_shop_loop_item_title.
										 *
										 * @hooked woocommerce_show_product_loop_sale_flash - 10
										 * @hooked woocommerce_template_loop_product_thumbnail - 10
										 */
										do_action( 'woocommerce_before_shop_loop_item_title' );
								?>
							</a>
						</div>
						<div class="products__box-infos">
							<h2>
								<?php the_title(); ?>
							</h2>
							<span class="products__price">
								<?php
										/**
										 * Hook: woocommerce_after_shop_loop_item_title.
										 *
										 * @hooked woocommerce_template_loop_price - 10
										 */
										do_action( 'woocommerce_after_shop_loop_item_title' );
								?>
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
							<div class="products__btn products__btn-loop">
								<?php
										/**
										 * Hook: woocommerce_after_shop_loop_item.
										 *
										 * @hooked woocommerce_template_loop_add_to_cart - 10
										 */
										do_action( 'woocommerce_after_shop_loop_item' );
								?>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
					<?php else : ?>
						<?php do_action( 'woocommerce_no_products_found' ); ?>
					<?php endif; ?>
				</div>
				<?php get_template_part( 'block/bottom-banner-block/bottom-banner-block' ); ?>
			</div>
		</div>

		<!-- Paginacja dolna -->
		<div class="products__pagination">
			<?php
			/**
			 * Wyświetl paginację WooCommerce na dole.
			 */
			woocommerce_pagination();
			?>
		</div>
	</div>
</section>

<script>
	var maxPrice = <?php echo esc_js( $max_price ); ?>; // Przekazanie maksymalnej ceny do JavaScript
</script>

<?php
get_footer( 'shop' );
?>
