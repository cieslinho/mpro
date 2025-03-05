<?php
/**
 * @package MPro
 */

error_reporting( 0 );

if ( ! defined( '_S_VERSION' ) ) {
	define( 'S_VERSION', '1.6.7' );
}

require_once 'inc/menus.php';
require_once 'inc/theme-supports.php';
require_once 'inc/filters.php';
// require_once 'cpt.php';
require_once 'blocks.php';

require_once get_stylesheet_directory() . '/customizer/customizer.php';

function init_scripts() {
	/**
	 *  Main styles
	 */
	wp_register_style( 'main-css', get_template_directory_uri() . '/assets/css/main.css?v=7.3', array(), false, 'all' );
	wp_register_script( 'main-js', get_template_directory_uri() . '/assets/js/script.js?v=7.2', array(), false, 'all' );

	wp_enqueue_style( 'main-css' );
	wp_enqueue_script( 'main-js' );
}
add_action( 'wp_enqueue_scripts', 'init_scripts' );

add_action( 'admin_enqueue_scripts', 'enqueue_my_custom_admin_script' );

function enqueue_my_custom_admin_script() {
	wp_enqueue_media(); // Umożliwia korzystanie z mediów
	wp_enqueue_script( 'my-admin-script', plugin_dir_url( __FILE__ ) . 'js/my-admin-script.js', array( 'jquery' ), null, true );
}


function add_arrow_icon( $items, $args ) {
	if ( $args->theme_location == 'categories-menu' ) {
		$pattern = '/<li[^>]*\bclass="[^"]*\bmenu-item-has-children\b[^"]*"[^>]*>/';

		$arrow_btn = '
        <button type="button" class="nav__arrow">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="arrow-icon"
            xmlns="http://www.w3.org/2000/svg">
          <g id="type=ep:arrow-up">
              <path id="Vector"
                d="M11.4568 15.9299L3.49181 7.57045C3.35884 7.43096 3.28467 7.24565 3.28467 7.05295C3.28467 6.86024 3.35884 6.67493 3.49181 6.53545L3.50081 6.52645C3.56527 6.45859 3.64286 6.40456 3.72886 6.36764C3.81486 6.33072 3.90747 6.31168 4.00106 6.31168C4.09465 6.31168 4.18726 6.33072 4.27326 6.36764C4.35926 6.40456 4.43685 6.45859 4.50131 6.52645L12.0013 14.3984L19.4983 6.52645C19.5628 6.45859 19.6404 6.40456 19.7264 6.36764C19.8124 6.33072 19.905 6.31168 19.9986 6.31168C20.0921 6.31168 20.1848 6.33072 20.2708 6.36764C20.3568 6.40456 20.4343 6.45859 20.4988 6.52645L20.5078 6.53545C20.6408 6.67493 20.715 6.86024 20.715 7.05295C20.715 7.24565 20.6408 7.43096 20.5078 7.57045L12.5428 15.9299C12.4728 16.0035 12.3885 16.062 12.2952 16.102C12.2018 16.142 12.1014 16.1626 11.9998 16.1626C11.8983 16.1626 11.7978 16.142 11.7044 16.102C11.6111 16.062 11.5269 16.0035 11.4568 15.9299Z"
                class="dropdown-icon" fill="white" />
            </g>
          </svg>
        </button>';

		$items = preg_replace( $pattern, '$0' . $arrow_btn, $items );
	}

	return $items;
}

add_filter( 'wp_nav_menu_items', 'add_arrow_icon', 10, 2 );
function add_arrow_icon1( $items, $args ) {
	if ( $args->theme_location == 'header-menu' ) {
		$pattern = '/<li[^>]*\bclass="[^"]*\bmenu-item-has-children\b[^"]*"[^>]*>/';

		$arrow_btn = '
        <button type="button" class="nav__arrow">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="arrow-icon"
            xmlns="http://www.w3.org/2000/svg">
          <g id="type=ep:arrow-up">
              <path id="Vector"
                d="M11.4568 15.9299L3.49181 7.57045C3.35884 7.43096 3.28467 7.24565 3.28467 7.05295C3.28467 6.86024 3.35884 6.67493 3.49181 6.53545L3.50081 6.52645C3.56527 6.45859 3.64286 6.40456 3.72886 6.36764C3.81486 6.33072 3.90747 6.31168 4.00106 6.31168C4.09465 6.31168 4.18726 6.33072 4.27326 6.36764C4.35926 6.40456 4.43685 6.45859 4.50131 6.52645L12.0013 14.3984L19.4983 6.52645C19.5628 6.45859 19.6404 6.40456 19.7264 6.36764C19.8124 6.33072 19.905 6.31168 19.9986 6.31168C20.0921 6.31168 20.1848 6.33072 20.2708 6.36764C20.3568 6.40456 20.4343 6.45859 20.4988 6.52645L20.5078 6.53545C20.6408 6.67493 20.715 6.86024 20.715 7.05295C20.715 7.24565 20.6408 7.43096 20.5078 7.57045L12.5428 15.9299C12.4728 16.0035 12.3885 16.062 12.2952 16.102C12.2018 16.142 12.1014 16.1626 11.9998 16.1626C11.8983 16.1626 11.7978 16.142 11.7044 16.102C11.6111 16.062 11.5269 16.0035 11.4568 15.9299Z"
                class="dropdown-icon" fill="white" />
            </g>
          </svg>
        </button>';

		$items = preg_replace( $pattern, '$0' . $arrow_btn, $items );
	}

	return $items;
}

add_filter( 'wp_nav_menu_items', 'add_arrow_icon1', 10, 2 );

// Default images for new animals
// function set_default_acf_thumbnail_image($post_id) {
// Check if the post type is 'animals'
// if (get_post_type($post_id) === 'animals') {
// Check if the 'thumbnail-image' ACF field is empty
// if (empty(get_field('thumbnail-image', $post_id))) {
// Get the attachment ID for the default image
// $default_image_id = 305;

// Update the 'thumbnail-image' ACF field with the default image ID
// update_field('thumbnail-image', $default_image_id, $post_id);

// Remove default classes from the default image
// $default_image_classes = array();
// update_post_meta($default_image_id, '_wp_attachment_image_class', $default_image_classes);

// Add the 'animal__image' class to the default image
// $new_image_classes = array('animal__image');
// update_post_meta($default_image_id, '_wp_attachment_image_class', $new_image_classes);
// }
// }
// }

// add_action('save_post', 'set_default_acf_thumbnail_image');

/*
 *Product ajax search code by WPCookie
 *[woo_search num="5" sku="on" description="on" price="on"]
 *https://redpishi.com/wordpress-tutorials/product-ajax-search-code/
 */
add_shortcode( 'woo_search', 'woo_search_func' );
function woo_search_func( $atts ) {
	$atts                         = shortcode_atts(
		array(
			'image'       => 'true',
			'check_stock' => '', // on
			'sku'         => '', // off
			'description' => '', // off
			'price'       => '', // off
			'num'         => '5',
			'cat'         => 'on', // on
		),
		$atts,
		'woo_search'
	);
	static $woo_search_first_call = 1;
	$image                        = $atts['image'];
	$stock                        = $atts['check_stock'];
	$sku                          = $atts['sku'];
	$description                  = $atts['description'];
	$price                        = $atts['price'];
	$num                          = $atts['num'];
	$cat                          = $atts['cat'];

	$woo_search_form =
		'<div class="woo_search_bar woo_bar_el">
    <form class="woo_search woo_bar_el" id="woo_search' .
		$woo_search_first_call .
		'" action="/" method="get" autocomplete="off">
		
        <input type="search" name="s" placeholder="Szukaj..." id="keyword" class="input_search woo_bar_el" onkeyup="searchFetch(this)">
		<span class="loading woo_bar_el" >
		<svg width="25px" height="25px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none" class="hds-flight-icon--animation-loading woo_bar_el">
<g fill="#676767" fill-rule="evenodd" clip-rule="evenodd">
<path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z" opacity=".2"/>
<path d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z"/>
</g>
</svg>
		</span>
		<button id="mybtn" class="search' .
		$woo_search_first_call .
		' woo_bar_el">
        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M16.6725 16.6412L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </svg>
        </button>
        <input type="hidden" name="post_type" value="product">
        <input type="hidden" name="search_id" value="' .
		$woo_search_first_call .
		'">
        <input type="hidden" name="check_stock" value="' .
		$stock .
		'">
        <input type="hidden" name="sku" value="' .
		$sku .
		'">
        <input type="hidden" name="description" value="' .
		$description .
		'">
        <input type="hidden" name="price" value="' .
		$price .
		'">
        <input type="hidden" name="num" value="' .
		$num .
		'">
        <input type="hidden" name="cat" value="' .
		$cat .
		'">
    </form><div class="search_result woo_bar_el" id="datafetch" style="display: none;">
        <ul>
            <li>Proszę poczekać..</li>
        </ul>
    </div></div>';
	$java            =
		'<script>
function searchFetch(e) {
const searchForm = e.parentElement;	
searchForm.querySelector(".loading").style.visibility = "visible";

var datafetch = e.parentElement.nextSibling
if (e.value.trim().length > 0) { datafetch.style.display = "block"; } else { datafetch.style.display = "none"; }

e.nextSibling.value = "Proszę poczekać..."
var formdata' .
		$woo_search_first_call .
		' = new FormData(searchForm);
formdata' .
		$woo_search_first_call .
		'.append("image", "' .
		$image .
		'") 
formdata' .
		$woo_search_first_call .
		'.append("action", "woo_search") 
Ajaxwoo_search(formdata' .
		$woo_search_first_call .
		',e) 

}
async function Ajaxwoo_search(formdata,e) {
  const url = "' .
		admin_url( 'admin-ajax.php' ) .
		'?action=woo_search";
  const response = await fetch(url, {
      method: "POST",
      body: formdata,
  });
  const data = await response.text();
if (data){	e.parentElement.nextSibling.innerHTML = data}else  {
e.parentElement.nextSibling.innerHTML = `<ul><a href="#" style="display: block; padding-inline-start: 14px;"><li>Przepraszamy, nic nie znaleziono</li></a></ul>`
}
e.parentElement.querySelector(".loading").style.visibility = "hidden";
}	
function goSearch(id){document.querySelector(id).click(); console.log(`clicked`) }

document.addEventListener("click", function(e) { if (document.activeElement.classList.contains("woo_bar_el") == false ) { [...document.querySelectorAll("div.search_result")].forEach(e => e.style.display = "none") } else {if  (e.target?.value.trim().length > 0) { e.target.parentElement.nextSibling.style.display = "block"}} })

</script>';
	if ( $woo_search_first_call == 1 ) {
		++$woo_search_first_call;
		return "{$woo_search_form}{$java}";
	} elseif ( $woo_search_first_call > 1 ) {
		++$woo_search_first_call;
		return "{$woo_search_form}";
	}
}

add_action( 'wp_ajax_woo_search', 'woo_search' );
add_action( 'wp_ajax_nopriv_woo_search', 'woo_search' );
function woo_search() {
	// sleep(1s);
	$search_id   = esc_attr( $_POST['search_id'] );
	$stock       = '';
	$sku         = esc_attr( $_POST['sku'] );
	$description = esc_attr( $_POST['description'] );
	$price       = esc_attr( $_POST['price'] );
	$num         = esc_attr( $_POST['num'] );
	$cat         = '';
	$search_term = esc_attr( $_POST['s'] );

	if ( $sku == 'off' ) {
		$sku = "style='display: none;'";
	}
	if ( $description == 'off' ) {
		$description = "style='display: none;'";
	}

	if ( $cat == 'on' ) {
		// Get categories

		$categories = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'name__like' => $search_term,
				'orderby'    => 'name',
				'order'      => 'ASC',
			)
		);

		if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
			echo '<p class="search_title">CATEGORIES</p> ';
			echo '<hr class="search_title">';
			echo '<ul class="cat_ul woo_bar_el">';

			foreach ( $categories as $category ) {
				$category_link = get_term_link(
					$category->term_id,
					'product_cat'
				);
				$product_count = $category->count;
				echo '<li class="cat_li woo_bar_el"><a class="cat_a woo_bar_el" href="' .
					esc_url( $category_link ) .
					'">' .
					esc_html( $category->name ) .
					' (' .
					$product_count .
					')</a></li>';
			}
			echo '</ul>';
		}
	}

	$the_query = new WP_Query(
		array(
			'posts_per_page' => $num,
			'post_type'      => 'product',
			's'              => $search_term,
		)
	);

	if ( ! $the_query->have_posts() ) {
		$the_query = new WP_Query(
			array(
				'posts_per_page' => $num,
				'post_type'      => 'product',
				'meta_query'     => array(
					array(
						'key'     => '_sku',
						'value'   => $search_term,
						'compare' => 'LIKE',
					),
				),
			)
		);
	}

	$number_of_result = $the_query->found_posts;
	if ( $number_of_result > 5 ) {
		$show_all =
			'<button class="show_all woo_bar_el" onclick="goSearch(`button.search' .
			$search_id .
			'`)"  >ZOBACZ WSZYSTKIE PRODUKTY.. (' .
			$number_of_result .
			')</button>';
	} else {
		$show_all = '';
	}

	if ( $the_query->have_posts() ) :
		if ( $cat == 'on' ) {
			echo '<p class="search_title">PRODUCTS</p> ';
			echo '<hr class="search_title">';
		}

		echo '<ul class="woo_bar_el">';
		while ( $the_query->have_posts() ) :

			$the_query->the_post();
			$product       = wc_get_product();
			$current_price = $product->get_price_html();
			if ( $current_price == '' ) {
				$current_price = 'SOLD OUT';
				$sold_style    =
					"style='font-size: 0.75em; font-weight: bold; color: red; '";
			} else {
				$sold_style = '';
			}
			if ( $current_price == 'SOLD OUT' && $stock == 'on' ) {
				$stock_hide = "style='display: none;'";
			} else {
				$stock_hide = '';
			}
			?>
		
			<a href="
			<?php
			echo esc_url(
				get_permalink()
			);
			?>
			" class="woo_bar_el" <?php echo $stock_hide; ?> >
			<?php
			$image = wp_get_attachment_image_src(
				get_post_thumbnail_id(),
				'single-post-thumbnail'
			);
			?>
						<?php
						if (
						$image[0] &&
						trim( esc_attr( $_POST['image'] ) ) == 'true'
						) {
							?>
				<img src="
							<?php
							the_post_thumbnail_url(
								'thumbnail'
							);
							?>
	" style="">
<li><span class="title_r_1"><h5><?php the_title(); ?></h5 class="product_name"><h5 class="sku" <?php echo $sku; ?> >(SKU:  <?php echo $product->get_sku(); ?>) </h5></span><p class="des" <?php echo $description; ?> > 
													<?php
													echo wp_trim_words(
														$product->get_short_description(),
														15,
														'...'
													);
													?>
</p> </li>  


							<?php if ( $price != 'off' ) { ?> 
	<span class="price" <?php echo $sold_style; ?> > <span> <?php echo $current_price; ?> </span></span>
								<?php
							}
						}
						?>
			</a>
			<?php
		endwhile;
		echo $show_all;
		echo '</ul>';
		wp_reset_postdata();
	endif;
	die();
}

/**
 * Callback function that returns true if the current page is a WooCommerce page or false if otherwise.
 *
 * @return boolean true for WC pages and false for non WC pages
 */
function is_wc_page() {
	return class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() );
}

add_action( 'template_redirect', 'conditionally_remove_wc_assets' );
/**
 * Remove WC stuff on non WC pages.
 */
function conditionally_remove_wc_assets() {
	// if this is a WC page, abort.
	if ( is_wc_page() ) {
		return;
	}

	// remove WC generator tag
	remove_filter( 'get_the_generator_html', 'wc_generator_tag', 10, 2 );
	remove_filter( 'get_the_generator_xhtml', 'wc_generator_tag', 10, 2 );

	// unload WC scripts
	remove_action( 'wp_enqueue_scripts', array( WC_Frontend_Scripts::class, 'load_scripts' ) );
	remove_action( 'wp_print_scripts', array( WC_Frontend_Scripts::class, 'localize_printed_scripts' ), 5 );
	remove_action( 'wp_print_footer_scripts', array( WC_Frontend_Scripts::class, 'localize_printed_scripts' ), 5 );

	// remove "Show the gallery if JS is disabled"
	remove_action( 'wp_head', 'wc_gallery_noscript' );

	// remove WC body class
	remove_filter( 'body_class', 'wc_body_class' );
}

add_filter( 'woocommerce_enqueue_styles', 'conditionally_woocommerce_enqueue_styles' );
/**
 * Unload WC stylesheets on non WC pages
 *
 * @param array $enqueue_styles
 */
function conditionally_woocommerce_enqueue_styles( $enqueue_styles ) {
	return is_wc_page() ? $enqueue_styles : array();
}

add_action( 'wp_enqueue_scripts', 'conditionally_wp_enqueue_scripts' );
/**
 * Remove inline style on non WC pages
 */
function conditionally_wp_enqueue_scripts() {
	if ( ! is_wc_page() ) {
		wp_dequeue_style( 'woocommerce-inline' );
	}
}

// add_action( 'init', 'remove_wc_custom_action' );
function remove_wc_custom_action() {
	remove_action( 'wp_head', 'wc_gallery_noscript' );
}

function theme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );




add_theme_support(
	'post-thumbnails',
	array(
		'post',
		'page',
		'custom-post-type-name',
	)
);

// Modyfikacja struktury WooCommerce breadcrumbs
add_filter( 'woocommerce_breadcrumb_defaults', 'custom_woocommerce_breadcrumbs' );

function custom_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => '/', // Usuń domyślny separator
		'wrap_before' => '<ul class="woocommerce-breadcrumb breadcrumbs">', // Zmień wrapper na ul
		'wrap_after'  => '</ul>',
		'before'      => '<li>', // Każdy element breadcrumb w li
		'after'       => '</li>',
		'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ), // Zmień etykietę strony głównej, jeśli potrzebne
	);
}



function my_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => 'Shop Sidebar',
			'id'            => 'shop-sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'my_theme_widgets_init' );


add_action( 'woocommerce_product_query', 'filter_products_by_price' );

function filter_products_by_price( $query ) {
	if ( isset( $_GET['min_cena'] ) && isset( $_GET['max_cena'] ) ) {
		$meta_query = $query->get( 'meta_query' );

		$meta_query[] = array(
			'key'     => '_price',
			'value'   => array( floatval( $_GET['min_cena'] ), floatval( $_GET['max_cena'] ) ),
			'compare' => 'BETWEEN',
			'type'    => 'DECIMAL',
		);

		$query->set( 'meta_query', $meta_query );
	}
}

add_filter( 'woocommerce_get_query_vars', 'change_price_filter_query_vars' );

function change_price_filter_query_vars( $vars ) {
	if ( isset( $_GET['min_price'] ) ) {
		$vars['min_cena'] = $_GET['min_price'];
		unset( $vars['min_price'] );
	}
	if ( isset( $_GET['max_price'] ) ) {
		$vars['max_cena'] = $_GET['max_price'];
		unset( $vars['max_price'] );
	}

	return $vars;
}


// Dodaj klasę do elementu "Zobacz koszyk" po dodaniu do koszyka
add_filter( 'woocommerce_add_to_cart_fragments', 'add_custom_class_to_cart_link' );

function add_custom_class_to_cart_link( $fragments ) {
	ob_start();
	?>
	<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="added_to_cart products__btn-ajax" title="<?php esc_attr_e( 'Zobacz koszyk', 'woocommerce' ); ?>" rel="nofollow">
		<?php echo esc_html( __( 'Zobacz koszyk', 'woocommerce' ) ); ?>
	</a>
	<?php
	$fragments['a.added_to_cart'] = ob_get_clean();
	return $fragments;
}


function custom_product_sorting( $query ) {
	if ( ! is_admin() && $query->is_main_query() && ( is_post_type_archive( 'product' ) || is_tax( 'product_cat' ) ) ) {
		// Pobierz parametr 'orderby' z URL
		$orderby = isset( $_GET['orderby'] ) ? $_GET['orderby'] : '';

		switch ( $orderby ) {
			case 'date_asc':
				$query->set( 'orderby', 'date' );
				$query->set( 'order', 'ASC' );
				break;
			case 'date_desc':
				$query->set( 'orderby', 'date' );
				$query->set( 'order', 'DESC' );
				break;
			case 'price_asc':
				$query->set( 'meta_key', '_price' );
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'order', 'ASC' );
				break;
			case 'price_desc':
				$query->set( 'meta_key', '_price' );
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'order', 'DESC' );
				break;
		}
	}
}
add_action( 'pre_get_posts', 'custom_product_sorting' );

add_action( 'pre_get_posts', 'customize_woocommerce_products_per_page' );
function customize_woocommerce_products_per_page( $query ) {
	if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_product_category() ) ) {
		$query->set( 'posts_per_page', 12 );
	}
}




// add_action('save_post', 'update_product_price_from_acf', 10, 2);
// function update_product_price_from_acf($post_id, $post) {
// Sprawdź, czy to jest produkt WooCommerce
// if ($post->post_type !== 'product') {
// return;
// }

// Pobierz wartość z pola ACF
// $price_per_kg = get_field('group_content')['price_per_kg']; // Upewnij się, że używasz właściwej ścieżki do pola ACF

// Sprawdź, czy cena jest ustawiona
// if ($price_per_kg) {
// Ustaw cenę produktu na podstawie wartości ACF
// update_post_meta($post_id, '_regular_price', $price_per_kg);
// update_post_meta($post_id, '_price', $price_per_kg);
// }
// }


add_filter( 'woocommerce_add_to_cart_quantity', 'custom_cart_quantity', 10, 2 );

function custom_cart_quantity( $quantity, $product_id ) {
	// Sprawdzamy, czy formularz zawiera naszą niestandardową ilość
	if ( isset( $_POST['custom_quantity'] ) && is_numeric( $_POST['custom_quantity'] ) ) {
		$custom_quantity = floatval( $_POST['custom_quantity'] ); // Pobieramy ilość z formularza
		return $custom_quantity; // Zwracamy ilość jako wartość dziesiętną
	}
	return $quantity; // Jeśli nie, używamy standardowej ilości
}


// Przekierowanie na stronę koszyka po dodaniu produktu
function custom_redirect_to_cart() {
	if ( isset( $_REQUEST['add-to-cart'] ) ) {
		wp_safe_redirect( wc_get_cart_url() );
		exit;
	}
}
add_action( 'template_redirect', 'custom_redirect_to_cart' );

// Funkcja do aktualizacji pola ACF 'price_per_unit' na cenę WooCommerce
function sync_wc_price_to_acf_price_per_unit( $post_id ) {
	// Sprawdzamy, czy to jest zapis produktu (a nie innych postów)
	if ( get_post_type( $post_id ) !== 'product' ) {
		return;
	}

	// Pobierz produkt
	$product = wc_get_product( $post_id );

	// Pobierz cenę produktu
	$wc_price = $product->get_regular_price(); // Możesz także użyć get_sale_price() w zależności od wymagań

	// Pobierz jednostkę miary
	$unit_of_measure = get_field( 'unit_of_measure', $post_id );

	// Jeśli jednostka miary jest ustawiona na 'kg', 'mb', lub 'm2', kopiujemy cenę do ACF
	if ( in_array( $unit_of_measure, array( 'kg', 'mb', 'm2' ), true ) ) {
		// Zapisz cenę WooCommerce do ACF price_per_unit
		update_field( 'price_per_unit', $wc_price, $post_id );
	}
}
add_action( 'save_post', 'sync_wc_price_to_acf_price_per_unit', 10, 3 );


function hide_product_description_in_admin() {
	echo '<style>
        #postdivrich, #postexcerpt { display: none; } /* Ukrywa edytor opisu produktu */
    </style>';
}
add_action( 'admin_head', 'hide_product_description_in_admin' );



// Usuwamy domyślne pola imienia i nazwiska
// add_filter(
// 'woocommerce_checkout_fields',
// function ( $fields ) {
// unset( $fields['billing']['billing_first_name'] );
// unset( $fields['billing']['billing_last_name'] );
// return $fields;
// }
// );

// Dodajemy niestandardowe pola zamiast domyślnych
add_action(
	'woocommerce_checkout_billing',
	function () {
		?>
	<div class="checkout__billing-options">
		<label><input type="radio" name="purchase_type" value="private" checked> <span><?php esc_html_e( 'Osoba prywatna', 'woocommerce' ); ?></span></label>
		<label><input type="radio" name="purchase_type" value="business"><span> <?php esc_html_e( 'Zakupy na firmę', 'woocommerce' ); ?></span></label>
	</div>

		<?php
	},
	10
);


// Modyfikacja pól, ustawienie wymaganych pól oraz walidacja NIP
add_filter(
	'woocommerce_checkout_fields',
	function ( $fields ) {
		$is_business = isset( $_POST['purchase_type'] ) && $_POST['purchase_type'] === 'business';

		// Wymagane pola
		$fields['billing']['billing_nip']['required']       = $is_business;
		$fields['billing']['billing_company']['required']   = $is_business;
		$fields['shipping']['shipping_company']['required'] = $is_business;

		// Dodanie niestandardowego pola NIP
		$fields['billing']['billing_nip'] = array(
			'type'        => 'text',
			'label'       => __( 'NIP', 'woocommerce' ),
			'placeholder' => __( 'Wprowadź NIP', 'woocommerce' ),
			'class'       => array( 'form-row-wide', 'checkout__nip-field', 'validate-required' ),
			'priority'    => 25,
			'required'    => $is_business,
		);

		// Pole nazwa firmy
		$fields['billing']['billing_company'] = array(
			'type'        => 'text',
			'label'       => __( 'Nazwa firmy', 'woocommerce' ),
			'placeholder' => __( 'Wprowadź nazwę firmy', 'woocommerce' ),
			'class'       => array( 'form-row-wide', 'checkout__company-field', 'validate-required' ),
			'priority'    => 20,
			'required'    => $is_business,
		);

		return $fields;
	},
	10
);

// Zmiana etykiety NIP
add_filter(
	'woocommerce_checkout_field_label',
	function ( $label, $field ) {
		if ( $field['name'] === 'billing_nip' ) {
			$label = $field['required']
			? 'NIP <span class="required">(wymagane)</span>'
			: 'NIP <span class="optional">(opcjonalne)</span>';
		}
		return $label;
	},
	10,
	2
);

/**
 * Customizes the placeholder text for the "Address Line 1" field in WooCommerce.
 *
 * This function modifies the default placeholder text for the "address_2" field
 * in WooCommerce's billing and shipping forms. Useful for providing more specific
 * instructions to users about what to enter in this field.
 *
 * @param array $fields The default WooCommerce address fields.
 *                      Each field is represented as an associative array.
 *                      Example for `address_2`:
 *                      [
 *                          'type'        => 'text',
 *                          'label'       => 'Address line 1',
 *                          'placeholder' => 'Apartment, suite, unit, etc. (required)',
 *                          'required'    => true,
 *                          ...
 *                      ]
 * @return array The modified address fields array with updated placeholder for "address_1".
 */
function custom_address_line_1_placeholder( $fields ) {
	// Update the placeholder text for "Address Line 1".
	$fields['address_1']['placeholder'] = 'Nazwa ulicy';

	return $fields;
}
add_filter( 'woocommerce_default_address_fields', 'custom_address_line_1_placeholder' );
/**
 * Customizes the placeholder text for the "Address Line 2" field in WooCommerce.
 *
 * This function modifies the default placeholder text for the "address_2" field
 * in WooCommerce's billing and shipping forms. Useful for providing more specific
 * instructions to users about what to enter in this field.
 *
 * @param array $fields The default WooCommerce address fields.
 *                      Each field is represented as an associative array.
 *                      Example for `address_2`:
 *                      [
 *                          'type'        => 'text',
 *                          'label'       => 'Address line 2',
 *                          'placeholder' => 'Apartment, suite, unit, etc. (required)',
 *                          'required'    => true,
 *                          ...
 *                      ]
 * @return array The modified address fields array with updated placeholder for "address_2".
 */
function custom_address_line_2_placeholder( $fields ) {
	// Update the placeholder text for "Address Line 2".
	$fields['address_2']['placeholder'] = 'Numer budynku / Numer lokalu';

	return $fields;
}
add_filter( 'woocommerce_default_address_fields', 'custom_address_line_2_placeholder' );


/**
 * Wyświetlanie niestandardowych pól w panelu administracyjnym zamówienia WooCommerce
 *
 * Dodaje pola: NIP, Firma (Billing), Firma (Shipping) w szczegółach zamówienia oraz zapisuje je z formularza checkout.
 */

/**
 * Wyświetla niestandardowe pola w sekcji adresu płatnika w szczegółach zamówienia.
 *
 * @param WC_Order $order Obiekt zamówienia WooCommerce.
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'custom_display_billing_fields_in_admin_order', 10, 1 );
function custom_display_billing_fields_in_admin_order( $order ) {
	// Pobierz i wyświetl pole NIP
	$billing_nip = $order->get_meta( '_billing_nip' );
	if ( $billing_nip ) {
		echo '<p><strong>' . __( 'NIP', 'woocommerce' ) . ':</strong> ' . esc_html( $billing_nip ) . '</p>';
	}

	// Pobierz i wyświetl pole Firma (Billing)
	$billing_company = $order->get_meta( '_billing_company' );
	if ( $billing_company ) {
		echo '<p><strong>' . __( 'Firma (Billing)', 'woocommerce' ) . ':</strong> ' . esc_html( $billing_company ) . '</p>';
	}
}

/**
 * Wyświetla niestandardowe pola w sekcji adresu dostawy w szczegółach zamówienia.
 *
 * @param WC_Order $order Obiekt zamówienia WooCommerce.
 */
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'custom_display_shipping_fields_in_admin_order', 10, 1 );
function custom_display_shipping_fields_in_admin_order( $order ) {
	// Pobierz i wyświetl pole Firma (Shipping)
	$shipping_company = $order->get_meta( '_shipping_company' );
	if ( $shipping_company ) {
		echo '<p><strong>' . __( 'Firma (Shipping)', 'woocommerce' ) . ':</strong> ' . esc_html( $shipping_company ) . '</p>';
	}
}

/**
 * Zapisuje wartości niestandardowych pól z formularza checkout do metadanych zamówienia.
 *
 * @param int $order_id ID zamówienia WooCommerce.
 */
add_action( 'woocommerce_checkout_update_order_meta', 'custom_save_checkout_fields_to_order_meta' );
function custom_save_checkout_fields_to_order_meta( $order_id ) {
	if ( ! empty( $_POST['billing_nip'] ) ) {
		update_post_meta( $order_id, '_billing_nip', sanitize_text_field( $_POST['billing_nip'] ) );
	}
	if ( ! empty( $_POST['billing_company'] ) ) {
		update_post_meta( $order_id, '_billing_company', sanitize_text_field( $_POST['billing_company'] ) );
	}
	if ( ! empty( $_POST['shipping_company'] ) ) {
		update_post_meta( $order_id, '_shipping_company', sanitize_text_field( $_POST['shipping_company'] ) );
	}
}


/**
 * Dodaje niestandardowe pola do skrótów adresów na stronie "order-received".
 */

/**
 * Dodaje niestandardowe dane do skrótów adresów.
 *
 * @param array    $address_array Tablica danych adresowych.
 * @param WC_Order $order Obiekt zamówienia WooCommerce.
 * @return array Zaktualizowana tablica danych adresowych.
 */
add_filter( 'woocommerce_order_formatted_billing_address', 'custom_add_billing_fields_to_formatted_address', 10, 2 );
add_filter( 'woocommerce_order_formatted_shipping_address', 'custom_add_shipping_fields_to_formatted_address', 10, 2 );

function custom_add_billing_fields_to_formatted_address( $address_array, $order ) {
	// Dodaj pole NIP
	$billing_nip = $order->get_meta( '_billing_nip' );
	if ( ! empty( $billing_nip ) ) {
		$address_array['billing_nip'] = __( 'NIP', 'woocommerce' ) . ': ' . $billing_nip;
	}

	// Dodaj pole Firma (Billing)
	$billing_company = $order->get_meta( '_billing_company' );
	if ( ! empty( $billing_company ) ) {
		$address_array['billing_company'] = __( 'Firma', 'woocommerce' ) . ': ' . $billing_company;
	}

	return $address_array;
}

function custom_add_shipping_fields_to_formatted_address( $address_array, $order ) {
	// Dodaj pole Firma (Shipping)
	$shipping_company = $order->get_meta( '_shipping_company' );
	if ( ! empty( $shipping_company ) ) {
		$address_array['shipping_company'] = __( 'Firma (dostawa)', 'woocommerce' ) . ': ' . $shipping_company;
	}

	return $address_array;
}

/**
 * Wyświetla niestandardowe dane w skrótach adresów na stronie "order-received".
 *
 * @param string   $formatted_address Sformatowany adres.
 * @param array    $address_array Tablica danych adresowych.
 * @param WC_Order $order Obiekt zamówienia WooCommerce.
 * @return string Zaktualizowany sformatowany adres.
 */
add_filter( 'woocommerce_order_get_formatted_billing_address', 'custom_format_billing_address', 10, 3 );
add_filter( 'woocommerce_order_get_formatted_shipping_address', 'custom_format_shipping_address', 10, 3 );

function custom_format_billing_address( $formatted_address, $address_array, $order ) {
	// Pobierz niestandardowe dane
	$billing_nip     = $order->get_meta( '_billing_nip' );
	$billing_company = $order->get_meta( '_billing_company' );

	// Dodaj do sformatowanego adresu
	if ( ! empty( $billing_nip ) ) {
		$formatted_address .= '<br>' . __( 'NIP', 'woocommerce' ) . ': ' . esc_html( $billing_nip );
	}
	if ( ! empty( $billing_company ) ) {
		$formatted_address .= '<br>' . __( 'Firma', 'woocommerce' ) . ': ' . esc_html( $billing_company );
	}

	return $formatted_address;
}

function custom_format_shipping_address( $formatted_address, $address_array, $order ) {
	// Pobierz niestandardowe dane
	$shipping_company = $order->get_meta( '_shipping_company' );

	// Dodaj do sformatowanego adresu
	if ( ! empty( $shipping_company ) ) {
		$formatted_address .= '<br>' . __( 'Firma (dostawa)', 'woocommerce' ) . ': ' . esc_html( $shipping_company );
	}

	return $formatted_address;
}

function assign_custom_fields_to_new_account( $customer_id ) {
	// Pobierz wartości pól z formularza checkout
	if ( isset( $_POST['_shipping_company'] ) ) {
		$shipping_company = sanitize_text_field( $_POST['_shipping_company'] );
		update_user_meta( $customer_id, '_shipping_company', $shipping_company );
	}

	if ( isset( $_POST['_billing_nip'] ) ) {
		$billing_nip = sanitize_text_field( $_POST['_billing_nip'] );
		update_user_meta( $customer_id, '_billing_nip', $billing_nip );
	}

	if ( isset( $_POST['_billing_company'] ) ) {
		$billing_company = sanitize_text_field( $_POST['_billing_company'] );
		update_user_meta( $customer_id, '_billing_company', $billing_company );
	}
}
add_action( 'woocommerce_created_customer', 'assign_custom_fields_to_new_account' );

add_action(
	'wp_enqueue_scripts',
	function () {
		if ( is_woocommerce() || is_cart() || is_checkout() ) {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}
	}
);


add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_product_category() || is_product_tag() ) ) {
			$query->set( 'post_status', 'publish' );
		}
	}
);


add_filter(
	'woocommerce_my_account_my_orders_columns',
	function ( $columns ) {
		$columns['rt-invoice'] = __( 'Dokument sprzedaży', 'woocommerce' );
		return $columns;
	}
);

add_action(
	'woocommerce_my_account_my_orders_column_rt-invoice',
	function ( $order ) {
		$dirs    = wp_get_upload_dir();
		$dir     = rtrim( $dirs['basedir'], '/' ) . '/rt-invoices';
		$invoice = get_post_meta( $order->get_id(), 'rt-invoice', true );
		$path    = $dir . '/' . sanitize_file_name( $invoice );
		$url     = $dirs['baseurl'] . '/rt-invoices/' . sanitize_file_name( $invoice );

		if ( $invoice && file_exists( $path ) ) {
			echo '<a class="button wc-action-button wc-action-button-rt-invoice rt-invoice link" href="' . esc_url( $url ) . '" aria-label="' . __( 'Pobierz dokument sprzedaży', 'woocommerce' ) . '" title="' . __( 'Pobierz dokument sprzedaży', 'woocommerce' ) . '" target="_blank">' . __( 'Pobierz dokument sprzedaży', 'woocommerce' ) . '</a>';
		}
	}
);

// Dodanie sekcji do edycji zamówienia w WooCommerce
add_action(
	'woocommerce_admin_order_data_after_billing_address',
	function ( $order ) {
		// Pobranie wartości faktury z metadanych zamówienia
		$invoice = get_post_meta( $order->get_id(), 'rt-invoice', true );

		if ( $invoice ) {
			// Pobranie ścieżki do katalogu uploadów
			$upload_dir  = wp_get_upload_dir();
			$invoice_url = $upload_dir['baseurl'] . '/rt-invoices/' . sanitize_file_name( $invoice );

			echo '<p><strong>' . __( 'Dokument sprzedaży:', 'woocommerce' ) . '</strong><br>';
			echo '<a href="' . esc_url( $invoice_url ) . '" target="_blank" class="button button-primary">' . esc_html( $invoice ) . '</a></p>';
		} else {
			echo '<p><strong>' . __( 'Dokument sprzedaży:', 'woocommerce' ) . '</strong><br>';
			echo '<em>' . __( 'Brak dokumentu', 'woocommerce' ) . '</em></p>';
		}
	},
	10,
	1
);


// Dodanie przycisku w edycji zamówienia
add_action(
	'woocommerce_admin_order_data_after_order_details',
	function ( $order ) {
		$order_id = $order->get_id();
		?>
	<div class="order_rt_invoice">
		<p><strong><?php _e( 'Dokument sprzedaży:', 'woocommerce' ); ?></strong></p>
		<?php
		$invoice = get_post_meta( $order_id, 'rt-invoice', true );
		if ( $invoice ) {
			$upload_dir  = wp_get_upload_dir();
			$invoice_url = $upload_dir['baseurl'] . '/rt-invoices/' . sanitize_file_name( $invoice );
			?>
			<p><a href="<?php echo esc_url( $invoice_url ); ?>" target="_blank" class="button"><?php _e( 'Pobierz fakturę', 'woocommerce' ); ?></a></p>
			<p><button type="button" class="button button-primary send_rt_invoice" data-order-id="<?php echo esc_attr( $order_id ); ?>">
				<?php _e( 'Wyślij fakturę do klienta', 'woocommerce' ); ?>
			</button></p>
			<?php
		} else {
			echo '<p><em>' . __( 'Brak dokumentu', 'woocommerce' ) . '</em></p>';
		}
		?>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.send_rt_invoice').on('click', function() {
				var order_id = $(this).data('order-id');
				var button = $(this);
				button.prop('disabled', true).text('<?php _e( 'Wysyłanie...', 'woocommerce' ); ?>');

				$.post(ajaxurl, {
					action: 'send_rt_invoice',
					order_id: order_id
				}, function(response) {
					alert(response.data.message);
					button.prop('disabled', false).text('<?php _e( 'Wyślij fakturę do klienta', 'woocommerce' ); ?>');
				});
			});
		});
	</script>
		<?php
	}
);

// Obsługa AJAX do wysyłania faktury
add_action(
	'wp_ajax_send_rt_invoice',
	function () {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			wp_send_json_error( array( 'message' => __( 'Brak uprawnień!', 'woocommerce' ) ) );
		}

		// Pobranie ID zamówienia
		$order_id = isset( $_POST['order_id'] ) ? intval( $_POST['order_id'] ) : 0;
		if ( ! $order_id ) {
			wp_send_json_error( array( 'message' => __( 'Nieprawidłowe zamówienie!', 'woocommerce' ) ) );
		}

		// Pobranie zamówienia
		$order = wc_get_order( $order_id );
		if ( ! $order ) {
			wp_send_json_error( array( 'message' => __( 'Nie znaleziono zamówienia!', 'woocommerce' ) ) );
		}

		// Pobranie e-maila klienta
		$customer_email = $order->get_billing_email();
		if ( ! $customer_email ) {
			wp_send_json_error( array( 'message' => __( 'Brak e-maila klienta!', 'woocommerce' ) ) );
		}

		// Pobranie faktury
		$invoice = get_post_meta( $order_id, 'rt-invoice', true );
		if ( ! $invoice ) {
			wp_send_json_error( array( 'message' => __( 'Brak faktury dla tego zamówienia!', 'woocommerce' ) ) );
		}

		// Ścieżki do faktury
		$upload_dir   = wp_get_upload_dir();
		$invoice_path = $upload_dir['basedir'] . '/rt-invoices/' . sanitize_file_name( $invoice );
		$invoice_url  = $upload_dir['baseurl'] . '/rt-invoices/' . sanitize_file_name( $invoice );

		// Sprawdzenie czy plik istnieje
		if ( ! file_exists( $invoice_path ) ) {
			wp_send_json_error( array( 'message' => __( 'Plik faktury nie istnieje!', 'woocommerce' ) ) );
		}

		// Przygotowanie e-maila
		$subject = __( 'Twoja faktura za zamówienie', 'woocommerce' );
		$message = sprintf( __( 'Dzień dobry,<br><br>Załączamy fakturę do Twojego zamówienia #%1$s.<br><br>Możesz także pobrać ją klikając w ten link: <a href="%2$s">%3$s</a>.<br><br>Pozdrawiamy,<br>Zespół sklepu.', 'woocommerce' ), $order->get_order_number(), esc_url( $invoice_url ), esc_html( $invoice ) );

		$headers = array( 'Content-Type: text/html; charset=UTF-8' );

		// Wysyłka wiadomości e-mail z załącznikiem
		$sent = wp_mail( $customer_email, $subject, $message, $headers, array( $invoice_path ) );

		if ( $sent ) {
			wp_send_json_success( array( 'message' => __( 'Faktura została wysłana do klienta!', 'woocommerce' ) ) );
		} else {
			wp_send_json_error( array( 'message' => __( 'Nie udało się wysłać e-maila!', 'woocommerce' ) ) );
		}
	}
);

// Funkcja do dodania liczby produktów w koszyku do menu
function custom_add_cart_count_to_menu( $items, $args ) {
	// Sprawdzamy, czy to właściwe menu
	if ( $args->theme_location == 'account-menu' ) {  // Zmień 'primary' na nazwę lokalizacji menu, którą chcesz edytować
		// Sprawdzamy liczbę produktów w koszyku
		$cart_count = WC()->cart->get_cart_contents_count();

		// Dodajemy element HTML z liczbą produktów
		if ( $cart_count >= 0 ) {
			$items .= '<li class="menu-item cart-item-count">';
			$items .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle></svg> <a class="cart-link" href="' . wc_get_cart_url() . '">Koszyk <span>(' . $cart_count . ')</span></a>';
			$items .= '</li>';
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'custom_add_cart_count_to_menu', 10, 2 );


add_action('wp_loaded', function () {
    $upload_dir = wp_get_upload_dir();
    $invoice_dir = $upload_dir['basedir'] . '/rt-invoices/';

    if (!is_dir($invoice_dir)) {
        return;
    }

    $files = glob($invoice_dir . '/*.pdf'); // Pobiera wszystkie pliki PDF w folderze

    foreach ($files as $file) {
        $filename = basename($file);

        // Sprawdzenie, czy już został przetworzony
        if (get_transient('sent_invoice_' . $filename)) {
            continue;
        }

        // Wydobywamy numer zamówienia (np. 82471_xxxxx.pdf → 82471)
        if (preg_match('/^(\d+)_/', $filename, $matches)) {
            $order_id = intval($matches[1]);
            $order = wc_get_order($order_id);

            if ($order) {
                $customer_email = $order->get_billing_email();

                if ($customer_email) {
                    $invoice_url = $upload_dir['baseurl'] . '/rt-invoices/' . $filename;

                    // Tworzymy treść e-maila
                    $subject = __('Twoja faktura za zamówienie', 'woocommerce');
                    $message = sprintf(
                        __('Dzień dobry,<br><br>Załączamy fakturę do Twojego zamówienia #%s.<br><br>Możesz także pobrać ją klikając w ten link: <a href="%s">%s</a>.<br><br>Pozdrawiamy,<br>Zespół sklepu.', 'woocommerce'),
                        $order->get_order_number(),
                        esc_url($invoice_url),
                        esc_html($filename)
                    );

                    $headers = ['Content-Type: text/html; charset=UTF-8'];
                    $sent = wp_mail($customer_email, $subject, $message, $headers, [$file]);

                    if ($sent) {
                        set_transient('sent_invoice_' . $filename, true, 24 * HOUR_IN_SECONDS); // Zapamiętujemy wysłany plik
                    }
                }
            }
        }
    }
});
