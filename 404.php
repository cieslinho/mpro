<?php
/**
 * Template Name: 404 Page Template
 * Description: Custom 404 error page
 */
get_header();
?>

<section class="page404">
	<div class="container">
		<div class="page404__boxes">

			<div class="page404__box">
				<h1 class=" page404__title">404</h1>
				<h2 class="page404__text">Oops! Strona nie została znaleziona.</h2>
				<p class="page404__description">
					Niestety, nie możemy znaleźć strony, której szukasz. Może spróbujesz wrócić do strony głównej lub
					sprawdzisz ofertę sklepu?
				</p>
			</div>
			<div class="page404__box">
				<a href="<?php echo home_url(); ?>" class="page404__btn">Strona Główna</a>
				<a href="/sklep" class="page404__btn page404__btn-cta">Sklep</a>
			</div>
		</div>
	</div>
</section>


<?php
get_footer();
?>
