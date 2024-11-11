<?php
/**
 * Template Name: Moje Konto Custom
 */

if (!defined('ABSPATH')) {
    exit;
}

function custom_account_nav_link($endpoint, $label) {
    $current_endpoint = WC()->query->get_current_endpoint();
    $aria_current = ($current_endpoint === $endpoint) ? 'aria-current="page"' : '';

    echo '<li><a href="' . esc_url(wc_get_account_endpoint_url($endpoint)) . '" ' . $aria_current . '>' . esc_html($label) . '</a></li>';
}

get_header(); // Ładowanie nagłówka
?>

<section class="account">
    <div class="container">
        <?php if (is_user_logged_in()) : ?>
           <div class="account__boxes">
            <ul class="account__nav">
                <p class="account__title">
                    moje konto
                </p>
                
            <?php
                    // Tworzenie niestandardowej nawigacji z `aria-current="page"`
                    custom_account_nav_link('', 'Informacje');
                    custom_account_nav_link('orders', 'Historia i szczegóły zamówień');
                    custom_account_nav_link('edit-address', 'Moje dane adresowe');
                    custom_account_nav_link('edit-account', 'Szczegóły konta');
                    ?>
                    <li class="account__logout"><a href="<?php echo esc_url(wc_logout_url()); ?>">Wyloguj</a></li>
                </ul>
            

            <div class="account__content">
                <h2>Witaj, <span><?php echo esc_html(wp_get_current_user()->display_name); ?></span>!</h2>
                <p class="account__info">To są ustawienia <span>twojego konta.</span> Znajdziesz tutaj <span>ostatnie zamówienia, zapisane adresy wysyłki, szczegóły konta.</span></p>

                <?php do_action('woocommerce_account_content'); ?>
            </div>
        <?php else : ?>
            <p>Musisz być zalogowany, aby zobaczyć tę stronę.</p>
            <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="button">Zaloguj się</a>
            </div>
        <?php endif; ?>
    </div>
</section>