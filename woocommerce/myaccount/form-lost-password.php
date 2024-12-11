<section class="lost">
    <div class="container">
        <?php do_action('woocommerce_before_lost_password_form'); ?>

        <div class="lost__box">
            <h2><?php esc_html_e('Zapomniałeś/aś hasła?', 'woocommerce'); ?></h2>

            <form method="post" class="lost__form">
                <?php do_action('woocommerce_lostpassword_form_start'); ?>

                <p class="lost__row">
                    <label class="lost__label" for="user_login"><?php esc_html_e('Username or email', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="lost__input" name="user_login" id="user_login" autocomplete="username" />
                </p>

                <?php do_action('woocommerce_lostpassword_form'); ?>

                <p class="lost__actions">
                    <?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>
                    <button type="submit" class="lost__btn" name="lost_password" value="<?php esc_attr_e('Reset password', 'woocommerce'); ?>">
                        <?php esc_html_e('Reset password', 'woocommerce'); ?>
                    </button>
                </p>

                <?php do_action('woocommerce_lostpassword_form_end'); ?>
            </form>
        </div>

        <?php do_action('woocommerce_after_lost_password_form'); ?>
    </div>
</section>
