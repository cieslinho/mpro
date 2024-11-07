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
if (!$main_image_url) {
    $main_image_url = $placeholder_url;
    $main_image_alt = 'No image available'; // Ustaw alternatywny tekst dla placeholdera
}

$product_id = get_the_ID(); // ID aktualnego produktu
$price = get_post_meta($product_id, '_price', true); // Pobierz cenę podstawową
$sale_price = get_post_meta($product_id, '_sale_price', true); // Pobierz cenę promocyjną (jeśli jest)
?>

<section class="product">
    <div class="container">
 <?php   if ( function_exists( 'wc_print_notices' ) ) {
    wc_print_notices();
}
?>
        <div class="products__breadcrumbs">
            <?php woocommerce_breadcrumb(); ?>
        </div>

        <div class="product__content">
            <div class="product__left">
                <div class="product__img">
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
                            echo '<img src="' . esc_url($placeholder_url) . '" alt="Zdjęcie Zastępcze Produktu" />';
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
                            echo '<img src="' . esc_url($placeholder_url) . '" alt="Zdjęcie Zastępcze Produktu" />';
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
                    if ($sale_price) {                
                        echo '<p class="product__price product__pricv-sale price"><del>' . wc_price($price) . '</del> <ins>' . wc_price($sale_price) . '</ins></p>';
                    } else {                        
                        echo '<p class="product__price product__pricv-normal price">' . wc_price($price) . '</p>';
                    }
                    ?>
                    
                    
                    </div>
                    <?php 
$shortDescription = get_field("short_description");

if (!empty($shortDescription)) : ?>
    <div class="product__middle">
        <p class="product__short">
            <?php echo $shortDescription; ?>
        </p>
    </div>
<?php endif; ?>
            
            
    
                
                    

<?php 
// Lista ID produktów, dla których chcemy pokazać cenę za kilogram
$target_product_ids = [10010, 10015, 10016, 10018]; // Zastąp 123, 456, 789 ID produktów
// Lista kategorii, dla których chcemy pokazać cenę za kilogram
$target_categories = ['gwozdzie','wkrety-hartowane', 'wkrety-hartowane-torx', 'wkrety-fosfatowane', 'wkrety-samowiercace', 'sruby-maszynowe-5-8','sruby-maszynowe-8-8',  'nakretki', 'podkladki', 'lancuchy-gospodarcze-i-obroze']; // Nazwy kategorii

// Sprawdzenie, czy bieżący produkt ma ID na liście docelowych produktów lub należy do jednej z docelowych kategorii
if ( in_array( get_the_ID(), $target_product_ids ) || has_term( $target_categories, 'product_cat', get_the_ID() ) ) {
    $group_content = get_field( 'group_content' );
    $price_per_kg = $group_content['price_per_kg'] ?? null;
    
    if ( $price_per_kg ) : ?>
    
        <div class="product__calculator">
        
            <p class="product__calculator-title">Cena za kg: <?php echo esc_html( $price_per_kg ); ?> PLN</p>
        
            <div class="product__calculator-top" id="weight-calculator">
               <div class="product__calculator-row">
               <label class="product__calculator-label" for="kg-input">Ilość kg:</label>
               <input class="product__calculator-input" type="number" id="kg-input" min="0.1" step="0.1" placeholder="Podaj ilość kg">
               </div>
                
            </div>
<div class="product__calculator-middle">
<button type="button" class="product__calculator-btn" id="calculate-price">Oblicz cenę</button>
<p class="product__calculator-info" id="total-price"></p>
</div>

            <div class="product__calculator-bottom">
                <label class="product__calculator-label" for="product-quantity-display">Ilość:</label>
                <input class="product__calculator-input" type="number" id="product-quantity-display" name="quantity" value="1" readonly>
                <span class="product__calculator-info"> KG</span>
            </div>
        
            <input type="hidden" id="product-total-price" name="product_total_price" value="">
            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( get_the_ID() ); ?>">
        </div>

        <script>
document.addEventListener('DOMContentLoaded', function() {
    const kgInput = document.getElementById('kg-input');
    const quantityDisplay = document.getElementById('product-quantity-display');
    const quantityInputs = document.querySelectorAll('input[name="quantity"]'); // Pobierz wszystkie inputy quantity

    // Funkcja do obliczania ceny
    document.getElementById('calculate-price').addEventListener('click', function() {
        const pricePerKg = <?php echo json_encode($price_per_kg); ?>; // Użyj PHP, aby pobrać cenę za kg
        const kg = parseFloat(kgInput.value) || 0; // Pobierz wartość z inputu kg
        const totalPrice = (kg * pricePerKg).toFixed(2); // Oblicz całkowitą cenę

        // Ustawienia wyświetlania ceny i aktualizacja inputów
        document.getElementById('total-price').innerText = 'Cena całkowita: ' + totalPrice + ' PLN';
        quantityDisplay.value = kg; // Ustaw ilość w quantity display
        
        // Aktualizacja wszystkich inputów 'quantity'
        quantityInputs.forEach(input => {
            input.value = kg; // Ustaw ilość w każdym input'cie 'quantity'
        });

        // Ustawienie wartości ukrytego inputa na całkowitą cenę
        document.getElementById('product-total-price').value = totalPrice;
    });
});
</script>
       
    <?php endif; 
}
?>



<div class="product__bottom">
<div class="product__btn add-to-cart">
        <?php woocommerce_template_single_add_to_cart();?>
    
                    </div>
                    <div class="product__meta">
        <?php woocommerce_template_single_meta();?>
    </div>
    <?php get_template_part('block/product-order-benefits-block/product-order-benefits-block');?>
</div>
</div>














            </div>
        </div>

      
        
        <?php get_template_part('block/product-tabs-block/product-tabs-block');?>
        <div class="product__related">
            <h2 class="section-title section-title-margin">Podobne produkty</h2>
        <div class="products__boxes">
    <?php
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
    $related_products = wc_get_related_products(get_the_ID(), 4);

    if ($related_products):
        foreach ($related_products as $related_product_id):
          
            $product = wc_get_product($related_product_id);
            $product_title = $product->get_name();
            $product_link = get_permalink($related_product_id);
            $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($related_product_id), 'medium')[0];
            $product_price = $product->get_price_html();
    ?>
            <div class="products__box">
                <div class="products__box-top">
                    <a href="<?php echo esc_url($product_link); ?>">
                        <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($product_title); ?>">
                    </a>
                </div>
                <div class="products__box-infos">
                    <h2><a href="<?php echo esc_url($product_link); ?>"><?php echo esc_html($product_title); ?></a></h2>
                    <span class="products__price"><?php echo wp_kses_post($product_price); ?></span>
                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="products__btn">
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




