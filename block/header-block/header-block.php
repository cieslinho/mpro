<?php
/**
 * Testimonial Block template.
 *
 * @param array $block The block settings and attributes.
 */


$category_content = get_field( 'category-content' );
$btnText      = $category_content['btn-text'];
$btnLink      = $category_content['btn-link'];
$heading      = $category_content['heading'];
$slider_content = get_field( 'slider-content' );
$sliderProducts      = $slider_content['slider-products'];
$promo_content = get_field( 'promo-content' );
$promoHeading      = $promo_content['promo-heading'];
$promoProducts      = $promo_content['promo-products'];
$promoText      = $promo_content['promo-text'];
$promoLink      = $promo_content['promo-link'];


?>

<header class="header">
    <div class="container">
        <div class="header__boxes">
            <div class="header__categories">
                <p class="header__heading">
                    <?php echo esc_html( $heading ); ?>
                </p>
                <?php wp_nav_menu(array('theme_location' => 'categories-header', 'container_class' => 'header__menu')); ?>
                <a class="header__btn" href="<?php echo esc_html( $btnLink ); ?>">
                    <?php echo esc_html( $btnText ); ?>
                </a>
            </div>

            <div class="header__slider">
                <?php if( $sliderProducts ): ?>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach( $sliderProducts as $post ): ?>
                        <?php 
                                // Przygotuj dane postu
                                setup_postdata($post);

                                // Uzyskaj ID produktu
                                $product_id = $post->ID;

                                // Pobierz obiekt produktu WooCommerce
                                $product = wc_get_product( $product_id );
                                ?>

                        <!-- Każdy produkt w karuzeli -->
                        <div class="swiper-slide header__product header__product-normal">

                            <a href="<?php echo get_permalink($product_id); ?>">
                                <?php echo $product->get_image(); // Miniatura produktu ?>
                                <div class="header__product-infos">
                                    <h2>
                                        <?php echo get_the_title($product_id); ?>
                                    </h2>

                                    <span class="header__product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </span>
                                    <button class="header__btn header__btn-cart">Dodaj do koszyka</button>
                                </div>
                            </a>
                        </div>


                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                    <div class="swiper-pagination"></div>



                    <!-- Paginacja Swiper -->

                    <!-- Przyciski nawigacji Swiper -->
                </div>
                <?php endif; ?>
            </div>

            <div class="header__promo">
                <p class="header__heading">
                    <?php echo esc_html( $promoHeading ); ?>
                </p>
                <?php if( $promoProducts ): ?>
                <div class="header__discounts">
                    <?php foreach( $promoProducts as $post ): ?>
                    <?php 
                            // Przygotuj dane postu
                            setup_postdata($post);

                            // Uzyskaj ID produktu
                            $product_id = $post->ID;

                            // Pobierz obiekt produktu WooCommerce
                            $product = wc_get_product( $product_id );
                            ?>

                    <!-- Produkt promocyjny -->
                    <div class="header__product header__product-promo">
                        <a href="<?php echo get_permalink($product_id); ?>">
                            <?php echo $product->get_image(); // Miniatura produktu ?>


                            <div class="header__product-infos">
                                <h2>
                                    <?php echo get_the_title($product_id); ?>
                                </h2>
                                <span class="header__product-price">
                                    <?php echo $product->get_price_html(); ?>
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
    </div>
</header>