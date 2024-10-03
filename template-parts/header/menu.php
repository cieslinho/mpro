<?php $logo = get_theme_mod('custom_logo'); ?>
<header class="top-navigation">
    <div class="top-navigation__container">
        <div class="top-navigation__wrapper">
            <a href="<?php echo esc_url(get_home_url()); ?>" class="top-navigation__wrapper-logo">
                <?php if ($logo): ?>
                <img class="top-navigation__logo" src="<?php echo esc_url($logo); ?>" alt="Logo schroniska" />
                <?php else: ?>
                <img class="top-navigation__logo"
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-schronisko-footer.png"
                    alt="Logo schroniska" />
                <?php endif; ?>
            </a>
            <button title="Zamknij menu" type="button" class="top-navigation__menu-toggle">
                <span class="top-navigation__toggle top-navigation__toggle-bar--top"></span>
                <span class="top-navigation__toggle top-navigation__toggle-bar--middle"></span>
                <span class="top-navigation__toggle top-navigation__toggle-bar--bottom"></span>
            </button>
        </div>
        <div class="top-navigation__main">
            <nav class="top-navigation__nav">
                <?php wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'top-navigation__menu')); ?>
            </nav>
        </div>
    </div>
</header>