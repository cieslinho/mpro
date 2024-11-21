<?php
defined('ABSPATH') || exit;


if (wc_get_page_id('shop') > 0) : ?>
    <section class="cart">
        <div class="container">
            <? do_action('woocommerce_cart_is_empty'); ?>
            <!-- <div class="cart__emptyContent">
                <h1><?php esc_html_e('Your cart is currently empty.', 'woocommerce'); ?></h1>
                
                <a class="button" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
                    <?php esc_html_e('Return to shop', 'woocommerce'); ?>
                </a>
            </div> -->
        </div>
    </section>
<?php endif; ?>
