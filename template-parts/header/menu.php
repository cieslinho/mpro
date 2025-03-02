<?php
$nav_boxes = get_field( 'nav_box', 'option' );



?>

<?php $logo = get_theme_mod( 'custom_logo' ); ?>
<?php $logoMobile = get_theme_mod( 'custom_logo-mobile' ); ?>
<nav class="nav">
	<div class="nav__mobile">
		<div class="nav__overlay">

		</div>
		<div class="container">
			<div class="nav__navbar">
				<a href="<?php echo esc_url( get_home_url() ); ?>" class="nav__mobile-logo">
					<?php if ( $logoMobile ) : ?>
					<img class="nav__navbar-logo" src="<?php echo esc_url( $logoMobile ); ?>" alt="Logo M-PRO" />
					<?php else : ?>
					<img class="nav__navbar-logo"
						src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-dark.png"
						alt="Logo M-PRO" />
					<?php endif; ?>
				</a>

				<div class="nav__wrapper">
					<div class="nav__tabs">
						<button id="menu-menu" class="nav__tab active">menu</button>
						<button id="menu-categories-menu" class="nav__tab">sklep</button>
						<button id="menu-panel-uzytkownika" class="nav__tab">konto</button>
					</div>
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'header-menu',
							'container_class' => 'nav__menu active',
						)
					);
					?>
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'categories-menu',
							'container_class' => 'nav__categories',
						)
					);
					?>
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'account-menu',
							'container_class' => 'nav__account',
						)
					);
					?>
					<button class="nav__close">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							style="transform: ;msFilter:;">
							<path
								d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z">
							</path>
						</svg>

					</button>
					<?php echo do_shortcode( '[woo_search num="3" sku="off" description="off" price="on"]' ); ?>
				</div>
				<button class="nav__btn">
					<div class="nav__btn-box">
						<div class="nav__btn-bars"></div>
					</div>

				</button>
			</div>
		</div>
	</div>
	<div class="nav__desktop">
		<div class="nav__top">
			<div class="container">
				<div class="nav__top-boxes">
					<div class="nav__top-left">
						<p>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
								style="transform: ;msFilter:;">
								<path
									d="M12 2C7.589 2 4 5.589 4 9.995 3.971 16.44 11.696 21.784 12 22c0 0 8.029-5.56 8-12 0-4.411-3.589-8-8-8zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z">
								</path>
							</svg>
							Plac Wolności 13, 16-075 Zawady
						</p>
						<p>
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
								style="transform: ;msFilter:;">
								<path
									d="m20.487 17.14-4.065-3.696a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a.997.997 0 0 0-.085-1.39z">
								</path>
							</svg>
							<a href="tel:+48782859525">+48 782 859 525</a>
						</p>
					</div>
					<div class="nav__top-right">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'account-menu',
								'container_class' => 'nav__navigation',
							)
						);
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="nav__middle">
			<div class="container">
				<div class="nav__middle-boxes">
					<a href="<?php echo esc_url( get_home_url() ); ?>" class="nav__middle-left">
						<?php if ( $logo ) : ?>
						<img class="nav__top-logo" src="<?php echo esc_url( $logo ); ?>" alt="Logo M-PRO" />
						<?php else : ?>
						<img class="nav__top-logo"
							src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-dark.png"
							alt="Logo M-PRO" />
						<?php endif; ?>
					</a>
					<div class="nav__middle-middle">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'header-menu',
								'container_class' => 'nav__menu',
							)
						);
						?>
					</div>
					<div class="nav__middle-right">
						<?php echo do_shortcode( '[woo_search num="5" sku="off" description="off" price="on"]' ); ?>

					</div>
				</div>

			</div>

		</div>
		<div class="nav__bottom">
			<div class="container">
				<?php
				if ( $nav_boxes ) :
					?>
					<div class="nav__bottom-boxes">
						<?php
						foreach ( $nav_boxes as $box ) :

							$text    = $box['text'] ?? '';
							$img_id  = $box['img'] ?? '';
							$img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'full' ) : ''; // Uzyskanie URL obrazka
							$img_alt = $img_id ? get_post_meta( $img_id, '_wp_attachment_image_alt', true ) : ''; // Tekst alternatywny
							?>
							<div class="nav__bottom-box">
								<?php if ( $img_url && $text ) : ?>
									
										<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
										<p><?php echo esc_html( $text ); ?></p>
									
								<?php endif; ?>
								
								
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			   
			</div>
		</div>
	</div>
</nav>
