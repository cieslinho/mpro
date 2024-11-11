<?php
$footerBoxContent = get_field('footer_box_content', 'option');
$contactHeading = $footerBoxContent['footer-contact'];
$companyHeading = $footerBoxContent['footer-company'];
$categoriesHeading = $footerBoxContent['footer-categories'];
$infoHeading = $footerBoxContent['footer-info'];
$logoMobile = get_theme_mod('custom_logo-mobile');

$companyStreet = get_field('company-street', 'option');
$companyPostalCode = get_field('company-postal-code', 'option');
$companyTax = get_field('company-tax', 'option');
$companyKrs = get_field('company-krs', 'option');
$companyRegon = get_field('company-regon', 'option');


$shippingText = get_field('footer-shipping', 'option');
$shippingImg = get_field('footer-shipping-img', 'option');
$paymentsText = get_field('footer-payments', 'option');
$paymentsImg = get_field('footer-payments-img', 'option');


if ($footerBoxContent) :
    
    $footerSocialsHeading = $footerBoxContent['footer-socials-content']['footer-socials-heading'];

    
    $socialsItems = $footerBoxContent['footer-socials-content']['socials-item'];


    endif;  
?>
<footer class="footer">
    <div class="container">
        <div class="footer__top">
            <div class="footer__box">
                <?php if ($contactHeading) : ?>
                <p class="footer__box-title">
                    <?php echo $contactHeading; ?>
                </p>
                <?php endif; ?>
                <?php if ($contactHeading) : ?>
                <button class="footer__btn active">
                <?php echo $contactHeading; ?>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="arrow-icon"
            xmlns="http://www.w3.org/2000/svg">
          <g id="type=ep:arrow-up">
              <path id="Vector"
                d="M11.4568 15.9299L3.49181 7.57045C3.35884 7.43096 3.28467 7.24565 3.28467 7.05295C3.28467 6.86024 3.35884 6.67493 3.49181 6.53545L3.50081 6.52645C3.56527 6.45859 3.64286 6.40456 3.72886 6.36764C3.81486 6.33072 3.90747 6.31168 4.00106 6.31168C4.09465 6.31168 4.18726 6.33072 4.27326 6.36764C4.35926 6.40456 4.43685 6.45859 4.50131 6.52645L12.0013 14.3984L19.4983 6.52645C19.5628 6.45859 19.6404 6.40456 19.7264 6.36764C19.8124 6.33072 19.905 6.31168 19.9986 6.31168C20.0921 6.31168 20.1848 6.33072 20.2708 6.36764C20.3568 6.40456 20.4343 6.45859 20.4988 6.52645L20.5078 6.53545C20.6408 6.67493 20.715 6.86024 20.715 7.05295C20.715 7.24565 20.6408 7.43096 20.5078 7.57045L12.5428 15.9299C12.4728 16.0035 12.3885 16.062 12.2952 16.102C12.2018 16.142 12.1014 16.1626 11.9998 16.1626C11.8983 16.1626 11.7978 16.142 11.7044 16.102C11.6111 16.062 11.5269 16.0035 11.4568 15.9299Z"
                class="footer__btn-arrow" fill="white" />
            </g>
          </svg>    
            </button>
                <?php endif; ?>
                <?php wp_nav_menu(array('theme_location' => 'footer-contact', 'container_class' => 'footer__nav footer__nav-contact')); ?>
            </div>
            <div class="footer__box">
                <?php if ($companyHeading) : ?>
                <p class="footer__box-title">
                    <?php echo $companyHeading; ?>
                </p>
                <?php endif; ?>
                <?php if ($companyHeading) : ?>
                <button class="footer__btn ">
                <?php echo $companyHeading; ?>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="arrow-icon"
            xmlns="http://www.w3.org/2000/svg">
          <g id="type=ep:arrow-up">
              <path id="Vector"
                d="M11.4568 15.9299L3.49181 7.57045C3.35884 7.43096 3.28467 7.24565 3.28467 7.05295C3.28467 6.86024 3.35884 6.67493 3.49181 6.53545L3.50081 6.52645C3.56527 6.45859 3.64286 6.40456 3.72886 6.36764C3.81486 6.33072 3.90747 6.31168 4.00106 6.31168C4.09465 6.31168 4.18726 6.33072 4.27326 6.36764C4.35926 6.40456 4.43685 6.45859 4.50131 6.52645L12.0013 14.3984L19.4983 6.52645C19.5628 6.45859 19.6404 6.40456 19.7264 6.36764C19.8124 6.33072 19.905 6.31168 19.9986 6.31168C20.0921 6.31168 20.1848 6.33072 20.2708 6.36764C20.3568 6.40456 20.4343 6.45859 20.4988 6.52645L20.5078 6.53545C20.6408 6.67493 20.715 6.86024 20.715 7.05295C20.715 7.24565 20.6408 7.43096 20.5078 7.57045L12.5428 15.9299C12.4728 16.0035 12.3885 16.062 12.2952 16.102C12.2018 16.142 12.1014 16.1626 11.9998 16.1626C11.8983 16.1626 11.7978 16.142 11.7044 16.102C11.6111 16.062 11.5269 16.0035 11.4568 15.9299Z"
                class="footer__btn-arrow" fill="white" />
            </g>
          </svg>    
            </button>
                <?php endif; ?>
                <?php wp_nav_menu(array('theme_location' => 'footer-company', 'container_class' => 'footer__nav')); ?>
            </div>
            <div class="footer__box">
                <?php if ($categoriesHeading) : ?>
                <p class="footer__box-title">
                    <?php echo $categoriesHeading; ?>
                </p>
                <?php endif; ?>
                <?php if ($categoriesHeading) : ?>
                <button class="footer__btn">
                <?php echo $categoriesHeading; ?>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="arrow-icon"
            xmlns="http://www.w3.org/2000/svg">
          <g id="type=ep:arrow-up">
              <path id="Vector"
                d="M11.4568 15.9299L3.49181 7.57045C3.35884 7.43096 3.28467 7.24565 3.28467 7.05295C3.28467 6.86024 3.35884 6.67493 3.49181 6.53545L3.50081 6.52645C3.56527 6.45859 3.64286 6.40456 3.72886 6.36764C3.81486 6.33072 3.90747 6.31168 4.00106 6.31168C4.09465 6.31168 4.18726 6.33072 4.27326 6.36764C4.35926 6.40456 4.43685 6.45859 4.50131 6.52645L12.0013 14.3984L19.4983 6.52645C19.5628 6.45859 19.6404 6.40456 19.7264 6.36764C19.8124 6.33072 19.905 6.31168 19.9986 6.31168C20.0921 6.31168 20.1848 6.33072 20.2708 6.36764C20.3568 6.40456 20.4343 6.45859 20.4988 6.52645L20.5078 6.53545C20.6408 6.67493 20.715 6.86024 20.715 7.05295C20.715 7.24565 20.6408 7.43096 20.5078 7.57045L12.5428 15.9299C12.4728 16.0035 12.3885 16.062 12.2952 16.102C12.2018 16.142 12.1014 16.1626 11.9998 16.1626C11.8983 16.1626 11.7978 16.142 11.7044 16.102C11.6111 16.062 11.5269 16.0035 11.4568 15.9299Z"
                class="footer__btn-arrow" fill="white" />
            </g>
          </svg>    
            </button>
                <?php endif; ?>
                <?php wp_nav_menu(array('theme_location' => 'footer-categories', 'container_class' => 'footer__nav')); ?>
            </div>
            <div class="footer__box">
                <?php if ($infoHeading) : ?>
                <p class="footer__box-title">
                    <?php echo $infoHeading; ?>
                </p>
                <?php endif; ?>
                <?php if ($infoHeading) : ?>
                <button class="footer__btn">
                <?php echo $infoHeading; ?>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="arrow-icon"
            xmlns="http://www.w3.org/2000/svg">
          <g id="type=ep:arrow-up">
              <path id="Vector"
                d="M11.4568 15.9299L3.49181 7.57045C3.35884 7.43096 3.28467 7.24565 3.28467 7.05295C3.28467 6.86024 3.35884 6.67493 3.49181 6.53545L3.50081 6.52645C3.56527 6.45859 3.64286 6.40456 3.72886 6.36764C3.81486 6.33072 3.90747 6.31168 4.00106 6.31168C4.09465 6.31168 4.18726 6.33072 4.27326 6.36764C4.35926 6.40456 4.43685 6.45859 4.50131 6.52645L12.0013 14.3984L19.4983 6.52645C19.5628 6.45859 19.6404 6.40456 19.7264 6.36764C19.8124 6.33072 19.905 6.31168 19.9986 6.31168C20.0921 6.31168 20.1848 6.33072 20.2708 6.36764C20.3568 6.40456 20.4343 6.45859 20.4988 6.52645L20.5078 6.53545C20.6408 6.67493 20.715 6.86024 20.715 7.05295C20.715 7.24565 20.6408 7.43096 20.5078 7.57045L12.5428 15.9299C12.4728 16.0035 12.3885 16.062 12.2952 16.102C12.2018 16.142 12.1014 16.1626 11.9998 16.1626C11.8983 16.1626 11.7978 16.142 11.7044 16.102C11.6111 16.062 11.5269 16.0035 11.4568 15.9299Z"
                class="footer__btn-arrow" fill="white" />
            </g>
          </svg>    
            </button>
                <?php endif; ?>
                <?php wp_nav_menu(array('theme_location' => 'footer-info', 'container_class' => 'footer__nav')); ?>
            </div>
            <div class="footer__box">
                <?php if ($footerSocialsHeading) : ?>
                <p class="footer__box-title">
                    <?php echo $footerSocialsHeading; ?>
                </p>
                <?php endif; ?>
                <?php if ($socialsItems) : ?>
                    <div class="footer__socials">
                        <?php foreach ($socialsItems as $socialItem) : 
                            $item_icon_id = $socialItem['item-icon'];
                            $item_link = $socialItem['item-link'];
                            $item_icon_url = wp_get_attachment_image_url($item_icon_id, 'full'); // Pobranie URL obrazu na podstawie ID
                        ?>
                            <?php if ($item_icon_url && $item_link) : ?>
                                <a href="<?php echo esc_url($item_link); ?>" class="footer__socials-item" target="_blank" rel="noopener noreferrer">
                                    <img src="<?php echo esc_url($item_icon_url); ?>" alt="Social icon" class="footer__socials-icon">
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="footer__middle">
            <div class="footer__box">
            <a href="<?php echo esc_url(get_home_url()); ?>" class="footer__logo">
                    <?php if ($logoMobile): ?>
                    <img  src="<?php echo esc_url($logoMobile); ?>" alt="Logo M-PRO" />
                    <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-dark.png" alt="Logo M-PRO" />
                    <?php endif; ?>
                </a>
            </div>
            <?php if ($companyStreet) : ?>
            <div class="footer__box">
                <p>
                    <?php echo $companyStreet; ?>

                </p>
            </div>
            <?php endif; ?>
            <?php if ($companyPostalCode) : ?>
            <div class="footer__box">
                <p>
                    <?php echo $companyPostalCode; ?>

                </p>
            </div>
            <?php endif; ?>
            <?php if ($companyTax) : ?>
            <div class="footer__box">
                <p>
                    <span>NIP</span> <?php echo $companyTax; ?>

                </p>
            </div>
            <?php endif; ?>
            <?php if ($companyKrs) : ?>
            <div class="footer__box">
                <p>
                    <span>KRS</span> <?php echo $companyKrs; ?>

                </p>
            </div>
            <?php endif; ?>
            <?php if ($companyRegon) : ?>
            <div class="footer__box">
                <p>
                    <span>Regon</span> <?php echo $companyRegon; ?>

                </p>
            </div>
            <?php endif; ?>
        </div>
        <div class="footer__bottom">
        <?php if ($shippingText) : ?>
            <div class="footer__box">
                <p>
                <?php echo $shippingText; ?>

                </p>
                <img src="<?php echo esc_url(wp_get_attachment_image_url($shippingImg, 'full')); ?>" alt="Shipping image">
            </div>
            <?php endif; ?>
        <?php if ($paymentsText) : ?>
            <div class="footer__box">
                <p>
                <?php echo $paymentsText; ?>

                </p>
                <img src="<?php echo esc_url(wp_get_attachment_image_url($paymentsImg, 'full')); ?>" alt="Payments image">
            </div>
            <?php endif; ?>
        </div>
        <div class="footer__copy">
        <p class="footer__text"><span>M-Pro 2025</span> Wszelkie prawa zastrzeżone</p>
        <p class="footer__project"><span>Projekt</span> <a href="mailto:contact@cieslaszymon.pl">cieslaszymon.pl</a></p>
        </div>
    </div>
</footer>