<?php
defined('ABSPATH') || exit;

?>

<section class="login">
    <div class="container">
        <?php do_action('woocommerce_before_customer_login_form'); ?>
        <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

            <div class="login__boxes" id="customer_login">

                <div class="login__box login__box-login">

        <?php endif; ?>

        <h2><?php esc_html_e('Login', 'woocommerce'); ?></h2>

        <form class="login__login" method="post">
            <?php do_action('woocommerce_login_form_start'); ?>
            <div class="login__row">

                <p>
                    <label class="login__label" for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span class="required login__required">*</span></label>
                    <input type="text" class="login__input" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username']) ? esc_attr(wp_unslash($_POST['username'])) : ''); ?>" />
                </p>
                <p class="login__password-wrapper">
                    <label class="login__label" for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required login__required">*</span></label>
                    <input class="login__input login__input-show" type="password" name="password" id="password" autocomplete="current-password" />
                    <button type="button" class="login__show" aria-label="<?php esc_attr_e('Show password', 'woocommerce'); ?>">
                        <?php esc_html_e('Pokaż', 'woocommerce'); ?>
                    </button>
                </p>
            </div>

            <?php do_action('woocommerce_login_form'); ?>

            <div class="login__row login__actions">
                <label class="login__label">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
                    <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
                </label>
                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                <button type="submit" class="login__btn-login login__btn" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
            </div>
            <p class="woocommerce-LostPassword lost_password login__btn-lost">
                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
            </p>

            <?php do_action('woocommerce_login_form_end'); ?>
        </form>

        <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
                </div>

                <div class="login__box login__box-register">

                    <h2><?php esc_html_e('Register', 'woocommerce'); ?></h2>

                    <form method="post" class="login__register">
                        <?php do_action('woocommerce_register_form_start'); ?>

                        <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
                            <p>
                                <label class="login__label" for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required login__required">*</span></label>
                                <input type="text" class="login__input" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username']) ? esc_attr(wp_unslash($_POST['username'])) : ''); ?>" />
                            </p>
                        <?php endif; ?>

                        <p>
                            <label class="login__label" for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required login__required">*</span></label>
                            <input type="email" class="login__input" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email']) ? esc_attr(wp_unslash($_POST['email'])) : ''); ?>" />
                        </p>

                        <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                            <p class="login__password-wrapper">
                                <label class="login__label" for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required login__required">*</span></label>
                                <input type="password" class="login__input" name="password" id="reg_password" autocomplete="new-password" />
                                <button type="button" class="login__show-password" aria-label="<?php esc_attr_e('Show password', 'woocommerce'); ?>">
                                    <?php esc_html_e('Show', 'woocommerce'); ?>
                                </button>
                            </p>
                        <?php endif; ?>

                        <?php do_action('woocommerce_register_form'); ?>

                        <p class="woocommerce-FormRow form-row">
                            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                            <button type="submit" class="woocommerce-Button login__btn" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
                        </p>

                        <?php do_action('woocommerce_register_form_end'); ?>
                    </form>

                </div>

            </div>
        <?php endif; ?>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const toggleButtons = document.querySelectorAll('.login__show');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function () {
            const passwordField = this.previousElementSibling;

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.textContent = 'Ukryj';
            } else {
                passwordField.type = 'password';
                this.textContent = 'Pokaż';
            }
        });
    });
});
</script>

<?php do_action('woocommerce_after_customer_login_form'); ?>
