const navBtn = document.querySelector('.nav__btn')
const navWrapper = document.querySelector('.nav__wrapper')
const navOverlay = document.querySelector('.nav__overlay') // Dodajemy selektor dla nav__overlay
const closeBtn = document.querySelector('.nav__close')
const footerBtns = document.querySelectorAll('.footer__btn')

const handleNav = () => {
	navWrapper.classList.toggle('active')
	navBtn.classList.toggle('active')
	navOverlay.classList.toggle('active') // Toggling klasy active na nav__overlay

	const tabs = document.querySelectorAll('.nav__tab')
	const menus = document.querySelectorAll('.nav__menu, .nav__categories, .nav__account')

	tabs.forEach(tab => {
		tab.addEventListener('click', function () {
			// Usunięcie klasy active z innych zakładek i menu
			tabs.forEach(t => t.classList.remove('active'))
			menus.forEach(menu => menu.classList.remove('active'))

			// Dodanie klasy active do klikniętej zakładki
			this.classList.add('active')

			// Znalezienie odpowiadającego menu i dodanie klasy active
			const targetMenu = document.querySelector(`.menu[id='${this.id}']`)
			if (targetMenu) {
				targetMenu.parentElement.classList.add('active')
			}
		})
	})
}

document.querySelectorAll('.nav__arrow').forEach(button => {
	button.addEventListener('click', function () {
		const parentItem = this.closest('li') // Znalezienie elementu li
		const subMenu = parentItem.querySelector('.sub-menu') // Znalezienie submenu w tym li

		// Toggling active class na submenu
		if (subMenu) {
			subMenu.classList.toggle('active')
		}

		// Dodanie klasy active do klikniętego przycisku
		this.classList.toggle('active')
	})
})

const closeNav = () => {
	navWrapper.classList.remove('active')
	navOverlay.classList.remove('active')
}

var headerSwiper = new Swiper('.swiper-container', {
	loop: true, // Automatyczne zapętlanie slajdów
	slidesPerView: 1, // Pokaż jeden slajd naraz
	spaceBetween: 20, // Brak odstępu między slajdami
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
	},
})

footerBtns.forEach(btn => {
	btn.addEventListener('click', () => {
		btn.classList.toggle('active')
	})
})

document.addEventListener('DOMContentLoaded', function () {
	const thumbnails = document.querySelectorAll('.product__thumbnail')
	const mainImage = document.getElementById('main-image')

	thumbnails.forEach(thumbnail => {
		thumbnail.addEventListener('click', function () {
			const largeImgUrl = this.getAttribute('data-large-img')

			// Zmień główne zdjęcie
			if (mainImage) {
				mainImage.src = largeImgUrl
			}

			// Ustaw aktywną miniaturę (dodaj klasę 'active')
			thumbnails.forEach(th => th.classList.remove('active'))
			this.classList.add('active')
		})
	})
})

var categorySwiper = new Swiper('.menu-category-slider-menu-container', {
	loop: true, // Automatyczne zapętlanie slajdów
	slidesPerView: 1, // Pokaż jeden slajd naraz
	spaceBetween: 20, // Brak odstępu między slajdami
	autoplay: true,
	// centeredSlides: true,
	pagination: {
		el: '.category__pagination',
		clickable: true,
	},
	breakpoints: {
		368: {
			slidesPerView: 2,
			spaceBetween: 20,
		},
		568: {
			slidesPerView: 3,
			spaceBetween: 20,
		},
		768: {
			slidesPerView: 5,
			spaceBetween: 20,
		},

		1024: {
			slidesPerView: 7,
			spaceBetween: 20,
		},
	},
})

function redirectToFilteredPrice() {
	const minPrice = document.getElementById('minPriceInput').value
	const maxPrice = document.getElementById('maxPriceInput').value

	// Dynamically set the base URL (you might want to define this according to your setup)
	const baseUrl = window.location.origin + '/sklep'

	// Uzyskiwanie numeru aktualnej strony z URL
	const currentPath = window.location.pathname // np. '/sklep/page/477/'
	const currentPage = currentPath.split('/').pop() // Wydobycie ostatniego segmentu URL (numery strony)

	// Tworzenie nowego URL z parametrami min_cena i max_cena
	const url = `${baseUrl}/${currentPage}/?min_cena=${minPrice}&max_cena=${maxPrice}`

	// Przekierowanie do nowego URL
	window.location.href = url
}

// Funkcja do inicjalizacji filtracji
function initPriceFilter() {
	const minPriceInput = document.getElementById('minPriceInput')
	const maxPriceInput = document.getElementById('maxPriceInput')
	const minPriceSlider = document.getElementById('minPrice')
	const maxPriceSlider = document.getElementById('maxPrice')
	const filterButton = document.getElementById('filterButton')
	const minPriceValue = document.getElementById('minPriceValue')
	const maxPriceValue = document.getElementById('maxPriceValue')

	// Ustawienia wartości maksymalnej
	maxPriceSlider.max = maxPrice // Ustaw maksymalną wartość suwaka na maksymalną cenę

	// Ustawienia wartości minimalnej i maksymalnej
	minPriceInput.addEventListener('input', function () {
		minPriceSlider.value = this.value
		minPriceValue.textContent = this.value
	})

	maxPriceInput.addEventListener('input', function () {
		maxPriceSlider.value = this.value
		maxPriceValue.textContent = this.value
	})

	// Ustawianie wartości suwaków
	minPriceSlider.addEventListener('input', function () {
		minPriceInput.value = this.value
		minPriceValue.textContent = this.value
	})

	maxPriceSlider.addEventListener('input', function () {
		maxPriceInput.value = this.value
		maxPriceValue.textContent = this.value
	})

	// Dodanie nasłuchiwacza na przycisk
	filterButton.addEventListener('click', redirectToFilteredPrice)

	// Przycisk zwiększania wartości min
	document.getElementById('minPriceIncrease').addEventListener('click', function () {
		if (parseInt(minPriceInput.value) < parseInt(maxPriceInput.value)) {
			minPriceInput.value = parseInt(minPriceInput.value) + 1
			minPriceSlider.value = minPriceInput.value
			minPriceValue.textContent = minPriceInput.value
		}
	})

	// Przycisk zmniejszania wartości min
	document.getElementById('minPriceDecrease').addEventListener('click', function () {
		if (parseInt(minPriceInput.value) > 0) {
			minPriceInput.value = parseInt(minPriceInput.value) - 1
			minPriceSlider.value = minPriceInput.value
			minPriceValue.textContent = minPriceInput.value
		}
	})

	// Przycisk zwiększania wartości max
	document.getElementById('maxPriceIncrease').addEventListener('click', function () {
		if (parseInt(maxPriceInput.value) < maxPrice) {
			maxPriceInput.value = parseInt(maxPriceInput.value) + 1
			maxPriceSlider.value = maxPriceInput.value
			maxPriceValue.textContent = maxPriceInput.value
		}
	})

	// Przycisk zmniejszania wartości max
	document.getElementById('maxPriceDecrease').addEventListener('click', function () {
		if (parseInt(maxPriceInput.value) > parseInt(minPriceInput.value)) {
			maxPriceInput.value = parseInt(maxPriceInput.value) - 1
			maxPriceSlider.value = maxPriceInput.value
			maxPriceValue.textContent = maxPriceInput.value
		}
	})
}

document.addEventListener('DOMContentLoaded', function () {
	// Wybierz wszystkie elementy z podkategoriami
	const categoryItems = document.querySelectorAll('.wc-block-product-categories-list-item')

	categoryItems.forEach(item => {
		const link = item.querySelector('a')
		const submenu = item.querySelector('.wc-block-product-categories-list')

		// Jeśli istnieje submenu, dodaj przycisk do rozwijania wewnątrz elementu <a>
		if (submenu && link) {
			// Stwórz przycisk z ikoną SVG
			const button = document.createElement('button')
			button.classList.add('categories__btn')
			button.setAttribute('aria-expanded', 'false')
			button.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="arrow-icon-category" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.4568 15.9299L3.49181 7.57045C3.35884 7.43096 3.28467 7.24565 3.28467 7.05295C3.28467 6.86024 3.35884 6.67493 3.49181 6.53545L3.50081 6.52645C3.56527 6.45859 3.64286 6.40456 3.72886 6.36764C3.81486 6.33072 3.90747 6.31168 4.00106 6.31168C4.09465 6.31168 4.18726 6.33072 4.27326 6.36764C4.35926 6.40456 4.43685 6.45859 4.50131 6.52645L12.0013 14.3984L19.4983 6.52645C19.5628 6.45859 19.6404 6.40456 19.7264 6.36764C19.8124 6.33072 19.905 6.31168 19.9986 6.31168C20.0921 6.31168 20.1848 6.33072 20.2708 6.36764C20.3568 6.40456 20.4343 6.45859 20.4988 6.52645L20.5078 6.53545C20.6408 6.67493 20.715 6.86024 20.715 7.05295C20.715 7.24565 20.6408 7.43096 20.5078 7.57045L12.5428 15.9299C12.4728 16.0035 12.3885 16.062 12.2952 16.102C12.2018 16.142 12.1014 16.1626 11.9998 16.1626C11.8983 16.1626 11.7978 16.142 11.7044 16.102C11.6111 16.062 11.5269 16.0035 11.4568 15.9299Z" class="dropdown-icon" fill="white"></path>
                </svg>
            `

			// Dodaj przycisk jako ostatnie dziecko elementu <a>
			link.appendChild(button)

			// Dodaj zdarzenie kliknięcia do przycisku
			button.addEventListener('click', function (event) {
				event.preventDefault() // Zapobiega przejściu do linku przy kliknięciu przycisku

				// Zamknij inne submeny tylko na tym samym poziomie
				closeSiblingSubmenus(item)

				const isExpanded = button.getAttribute('aria-expanded') === 'true'

				// Toggle widoczności submenu, klasy 'active' na przycisku, oraz klasy 'submenu-open' na submenu

				submenu.classList.toggle('submenu-open', !isExpanded)
				button.classList.toggle('active', !isExpanded)
				button.setAttribute('aria-expanded', !isExpanded)
			})
		}
	})

	// Funkcja zamykająca inne submeny na tym samym poziomie
	function closeSiblingSubmenus(currentItem) {
		// Znajdź rodzica bieżącego elementu
		const parent = currentItem.parentElement

		// Zamknij wszystkie inne elementy w tym samym poziomie
		Array.from(parent.children).forEach(sibling => {
			if (sibling !== currentItem) {
				const button = sibling.querySelector('.categories__btn')
				const submenu = sibling.querySelector('.wc-block-product-categories-list')

				if (submenu && button && button.getAttribute('aria-expanded') === 'true') {
					submenu.classList.remove('submenu-open')
					button.classList.remove('active')
					button.setAttribute('aria-expanded', 'false')
				}
			}
		})
	}
})

const tabButtons = document.querySelectorAll('.product__tab')
const tabContents = document.querySelectorAll('.product__tabs-content')

tabButtons.forEach(button => {
	button.addEventListener('click', function () {
		const targetId = button.getAttribute('data-target')

		// Zamknij wszystkie zakładki
		tabContents.forEach(content => (content.style.display = 'none'))

		// Usuń klasę 'active' z wszystkich przycisków
		tabButtons.forEach(btn => btn.classList.remove('active'))

		// Pokaż tylko klikniętą zakładkę
		document.getElementById(targetId).style.display = 'block'

		// Dodaj klasę 'active' do klikniętego przycisku
		button.classList.add('active')
	})
})

// Inicjalizowanie funkcji po załadowaniu dokumentu
document.addEventListener('DOMContentLoaded', initPriceFilter)

navBtn.addEventListener('click', handleNav)
closeBtn.addEventListener('click', closeNav)
