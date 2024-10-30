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




