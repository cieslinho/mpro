<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */


$latest_products_content = get_field( 'latest-products-content' );
$heading = $latest_products_content['section-heading'];
$latest_products = $latest_products_content['latest-products'];
$section_btn = $latest_products_content['section-btn'];
$section_link = $latest_products_content['section-link']

?>

<section class="latest">
    <div class="container">
        <h2 class="section-title"> <?php echo esc_html( $heading ); ?></h2>
        <?php if( $latest_products ): ?>
            <div class="latest__products">
                <?php foreach( $latest_products as $post ): ?>
                <?php 
                    // Przygotuj dane postu
                    setup_postdata($post);

                    // Uzyskaj ID produktu
                    $product_id = $post->ID;

                    // Pobierz obiekt produktu WooCommerce
                    $product = wc_get_product( $product_id );
                ?>

                <!-- Produkt promocyjny -->
                
                    <a class="latest__product" href="<?php echo get_permalink($product_id); ?>">
                        
                    <div class="latest__product-top"><?php echo $product->get_image(); // Miniatura produktu ?></div>

                        <div class="latest__product-infos">
                            <h2>
                                <?php echo get_the_title($product_id); ?>
                            </h2>
                            <span class="latest__product-price">
                                <?php echo $product->get_price_html(); ?>
                            </span>
                            <button class="latest__product-btn">Sprawdź</button>
                        
                        </div>
                    </a>

                   
                
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
                
            </div>
            <a href="<?php echo esc_html( $section_link ); ?>" class="section-btn"><?php echo esc_html( $section_btn ); ?></a>
        <?php endif; ?>
    </div>
</section>
