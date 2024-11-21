<section class="cart">
    <div class="container">
        <div class="cart__boxes">
            <?php do_action('woocommerce_before_cart'); ?>
            <?php do_action('woocommerce_before_cart_table'); ?>

            <form class="cart__form woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                <?php do_action('woocommerce_before_cart_contents'); ?>

                <table class="cart__table shop_table_responsive woocommerce-cart-form__contents" cellspacing="0">
                    <thead class="cart__table-head">
                        <tr class="cart__table-row">
                            <th class="cart__table-header cart__table-header--thumbnail"><?php esc_html_e('Image', 'woocommerce'); ?></th>
                            <th class="cart__table-header cart__table-header--name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
                            <th class="cart__table-header cart__table-header--price"><?php esc_html_e('Price', 'woocommerce'); ?></th>
                            <th class="cart__table-header cart__table-header--quantity"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
                            <th class="cart__table-header cart__table-header--subtotal"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
                            <th class="cart__table-header cart__table-header--remove">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody class="cart__table-body">
                        <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                            $_product = $cart_item['data'];
                            $product_id = $cart_item['product_id'];

                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0) {
                                $product_permalink = $_product->is_visible() ? $_product->get_permalink($cart_item) : '';
                                ?>
                                <tr class="cart__item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                                    <td class="cart__item-thumbnail">
                                        <?php
                                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                                        if (!$product_permalink) {
                                            echo $thumbnail;
                                        } else {
                                            printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                                        }
                                        ?>
                                    </td>
                                    <td class="cart__item-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                        <?php
                                        if (!$product_permalink) {
                                            echo wp_kses_post($_product->get_name());
                                        } else {
                                            printf('<a href="%s">%s</a>', esc_url($product_permalink), wp_kses_post($_product->get_name()));
                                        }
                                        echo wc_get_formatted_cart_item_data($cart_item);
                                        ?>
                                    </td>
                                    <td class="cart__item-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                        <?php echo WC()->cart->get_product_price($_product); ?>
                                    </td>
                                    <td class="cart__item-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                                        <?php
                                        $product_quantity = woocommerce_quantity_input(array(
                                            'input_name' => "cart[{$cart_item_key}][qty]",
                                            'input_value' => $cart_item['quantity'],
                                            'max_value' => $_product->get_max_purchase_quantity(),
                                            'min_value' => '0',
                                            'product_name' => $_product->get_name(),
                                        ), $_product, false);
                                        echo $product_quantity;
                                        ?>
                                    </td>
                                    <td class="cart__item-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                                        <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                    </td>
                                    <td class="cart__item-remove">
                                        <?php
                                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
                                            '<a href="%s" class="cart__item-remove-link" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            esc_html__('Remove this item', 'woocommerce'),
                                            esc_attr($product_id),
                                            esc_attr($_product->get_sku())
                                        ), $cart_item_key);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <div class="cart__actions">
                    <button type="submit" class="cart__update" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">
                        <?php esc_html_e('Update cart', 'woocommerce'); ?>
                    </button>
                    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                </div>
            </form>

            <div class="cart__collaterals">
                <?php do_action('woocommerce_cart_collaterals'); ?>
            </div>
        </div>
    </div>
</section>
