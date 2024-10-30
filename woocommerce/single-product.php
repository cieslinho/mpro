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
$placeholder_url = 'http://mpro.local/wp-content/uploads/2024/10/product-placeholder.png';

// Użyj placeholdera, jeśli brak głównego zdjęcia
if (!$main_image_url) {
    $main_image_url = $placeholder_url;
    $main_image_alt = 'No image available'; // Ustaw alternatywny tekst dla placeholdera
}
?>

<section class="product">
    <div class="container">
 <?   // Wyświetlanie komunikatów, jeśli istnieją
if ( function_exists( 'wc_print_notices' ) ) {
    wc_print_notices();
}
?>
        <div class="products__breadcrumbs">
            <?php woocommerce_breadcrumb(); ?>
        </div>

        <div class="product__content">
            <div class="product__left">
                <div class="product__main-image">
                    <img id="main-image" src="<?php echo esc_url($main_image_url); ?>" alt="<?php echo esc_attr($main_image_alt); ?>">
                </div>

                <div class="product__thumbnails">
                    
                        <?php
                        // Galeria miniatur
                        $attachment_ids = $product->get_gallery_image_ids();

                        // Dodaj główne zdjęcie jako miniaturę
                        if ($main_image_id) {
                            echo '<div class="product__thumbnail" data-large-img="' . esc_url($main_image_url) . '">';
                            echo wp_get_attachment_image($main_image_id, 'auto');
                            echo '</div>';
                        } else {
                            // Dodaj placeholder jako miniaturę, jeśli brak głównego zdjęcia
                            echo '<div class="product__thumbnail" data-large-img="' . esc_url($placeholder_url) . '">';
                            echo '<img src="' . esc_url($placeholder_url) . '" alt="No additional images" />';
                            echo '</div>';
                        }

                        // Dodaj pozostałe miniatury z galerii
                        if ($attachment_ids && count($attachment_ids) > 0) {
                            foreach ($attachment_ids as $attachment_id) {
                                $thumbnail_url = wp_get_attachment_image_url($attachment_id, 'auto');
                                $thumbnail_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                                echo '<div class="product__thumbnail" data-large-img="' . esc_url($thumbnail_url) . '">';
                                echo wp_get_attachment_image($attachment_id, 'auto', false, array('alt' => esc_attr($thumbnail_alt)));
                                echo '</div>';
                            }
                        } else {
                            // Dodaj placeholder dla miniatur, gdy brak zdjęć
                            echo '<div class="product__thumbnail" data-large-img="' . esc_url($placeholder_url) . '">';
                            echo '<img src="' . esc_url($placeholder_url) . '" alt="No additional images" />';
                            echo '</div>';
                        }
                        ?>
                    
                </div>
            </div>

            <div class="product__right">
                <?php do_action( 'woocommerce_single_product_summary' ); ?>
                
                <?php 
$categories_for_price_per_kg = ['gwoździe', 'kołki', 'nity zrywalne', 'śruby', 'nakrętki', 'podkładki', 'śruby imbusowe', 'śruby maszynowe 5.8', 'śruby maszynowe 8.8', 'śruby podsadzane', 'śruby rzymskie', 'wkręty ciesielskie', 'wkręty farmerskie', 'wkręty fosfatowane', 'wkręty hartowane', 'wkręty hartowane torx', 'wkręty samowiercące'];

if (has_term($categories_for_price_per_kg, 'product_cat', get_the_ID())) {
    $group_content = get_field('group_content');
    $price_per_kg = $group_content['price_per_kg'] ?? null;
    
    if ($price_per_kg) : ?>
        <div class="price-per-kg">
            <p>Cena za kg: <?php echo $price_per_kg; ?> PLN</p>
        </div>

        <div id="weight-calculator">
            <label for="kg-input">Ilość kg:</label>
            <input type="number" id="kg-input" min="0.1" step="0.1" placeholder="Podaj ilość kg">
            <button id="calculate-price">Oblicz cenę</button>
            <p id="total-price"></p>
        </div>

        <input type="hidden" id="product-total-price" name="product_total_price" value="">
        <input type="hidden" id="product-quantity" name="quantity" value="1">
        <label for="product-quantity-display">Ilość:</label>
        <input type="number" id="product-quantity-display" name="quantity" value="1" readonly>
        <input type="hidden" name="add-to-cart" value="<?php echo get_the_ID(); ?>">

        <span> KG</span> <!-- Jednostka KG obok ilości -->
    <?php endif; 
}


?>





<script>
document.addEventListener('DOMContentLoaded', function() {
    const kgInput = document.getElementById('kg-input');
    const quantityDisplay = document.getElementById('product-quantity-display');
    const quantityInput = document.querySelector('input[name="quantity"]'); // Input quantity

    // Funkcja do obliczania ceny
    document.getElementById('calculate-price').addEventListener('click', function() {
        const pricePerKg = <?php echo json_encode($price_per_kg); ?>; // Użyj PHP, aby pobrać cenę za kg
        const kg = parseFloat(kgInput.value) || 0; // Pobierz wartość z inputu kg
        const totalPrice = (kg * pricePerKg).toFixed(2); // Oblicz całkowitą cenę

        document.getElementById('total-price').innerText = 'Cena całkowita: ' + totalPrice + ' PLN';
        quantityDisplay.value = kg; // Ustaw ilość w quantity display
        quantityInput.value = kg; // Ustaw ilość w input 'quantity'
    });
});
</script>









            </div>
        </div>

        <!-- Nowa sekcja product__bottom -->
        <div class="product__bottom">
            <?php woocommerce_output_product_data_tabs(); ?>
        </div>
    </div>
</section>

<?php


do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' );
?>




