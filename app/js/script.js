const navBtn = document.querySelector('.nav__btn')
const navWrapper = document.querySelector('.nav__wrapper')
const navOverlay = document.querySelector('.nav__overlay') // Dodajemy selektor dla nav__overlay
const closeBtn = document.querySelector('.nav__close')

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

var categorySwiper = new Swiper('.menu-category-slider-menu-container', {
	loop: true, // Automatyczne zapętlanie slajdów
	slidesPerView: 1, // Pokaż jeden slajd naraz
	spaceBetween: 20, // Brak odstępu między slajdami
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

navBtn.addEventListener('click', handleNav)
closeBtn.addEventListener('click', closeNav)
