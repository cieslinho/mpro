<?php
// $logo = get_theme_mod('custom_logo');
// $phone_number = get_theme_mod('phone_number');
// $email_address = get_theme_mod('email_address');
// $address = get_theme_mod('address');
// $bank_account_number = get_theme_mod('bank_account_number');
// $facebook_url = get_theme_mod('facebook_url');
// $instagram_url = get_theme_mod('instagram_url');
?>
<footer class="footer">
   <div class="container">
    <div class="footer__top">
        <div class="footer__box">
            <p class="footer__title">Kontakt</p>
            <?php wp_nav_menu(array('theme_location' => 'footer-contact', 'container_class' => 'footer__nav footer__nav-contact')); ?>
        </div>
        <div class="footer__box">
            <p class="footer__title">O firmie</p>
            <?php wp_nav_menu(array('theme_location' => 'footer-company', 'container_class' => 'footer__nav')); ?>
        </div>
        <div class="footer__box">
            <p class="footer__title">Na skróty</p>
            <?php wp_nav_menu(array('theme_location' => 'footer-categories', 'container_class' => 'footer__nav')); ?>
        </div>
        <div class="footer__box">
            <p class="footer__title">Informacje</p>
            <?php wp_nav_menu(array('theme_location' => 'footer-info', 'container_class' => 'footer__nav')); ?>
        </div>
        <div class="footer__box">
            <p class="footer__title">Obserwuj nas</p>
            <?php wp_nav_menu(array('theme_location' => 'footer-socials', 'container_class' => 'footer__nav footer__nav-socials')); ?>
        </div>
    </div>
    <div class="footer__middle"></div>
    <div class="footer__bottom"></div>
   </div>
</footer>