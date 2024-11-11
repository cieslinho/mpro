const navBtn=document.querySelector(".nav__btn"),navWrapper=document.querySelector(".nav__wrapper"),navOverlay=document.querySelector(".nav__overlay"),closeBtn=document.querySelector(".nav__close"),footerBtns=document.querySelectorAll(".footer__btn"),handleNav=()=>{navWrapper.classList.toggle("active"),navBtn.classList.toggle("active"),navOverlay.classList.toggle("active");const e=document.querySelectorAll(".nav__tab"),t=document.querySelectorAll(".nav__menu, .nav__categories, .nav__account");e.forEach(n=>{n.addEventListener("click",function(){e.forEach(e=>e.classList.remove("active")),t.forEach(e=>e.classList.remove("active")),this.classList.add("active");const n=document.querySelector(`.menu[id='${this.id}']`);n&&n.parentElement.classList.add("active")})})};document.querySelectorAll(".nav__arrow").forEach(e=>{e.addEventListener("click",function(){const e=this.closest("li").querySelector(".sub-menu");e&&e.classList.toggle("active"),this.classList.toggle("active")})});const closeNav=()=>{navWrapper.classList.remove("active"),navOverlay.classList.remove("active")};var headerSwiper=new Swiper(".swiper-container",{loop:!0,slidesPerView:1,spaceBetween:20,pagination:{el:".swiper-pagination",clickable:!0}});footerBtns.forEach(e=>{e.addEventListener("click",()=>{e.classList.toggle("active")})}),document.addEventListener("DOMContentLoaded",function(){const e=document.querySelectorAll(".product__thumbnail"),t=document.getElementById("main-image");e.forEach(n=>{n.addEventListener("click",function(){const n=this.getAttribute("data-large-img");t&&(t.src=n),e.forEach(e=>e.classList.remove("active")),this.classList.add("active")})})});var categorySwiper=new Swiper(".menu-category-slider-menu-container",{loop:!0,slidesPerView:1,spaceBetween:20,pagination:{el:".category__pagination",clickable:!0},breakpoints:{368:{slidesPerView:2,spaceBetween:20},568:{slidesPerView:3,spaceBetween:20},768:{slidesPerView:5,spaceBetween:20},1024:{slidesPerView:7,spaceBetween:20}}});function redirectToFilteredPrice(){const e=document.getElementById("minPriceInput").value,t=document.getElementById("maxPriceInput").value,n=`${window.location.origin+"/sklep"}/${window.location.pathname.split("/").pop()}/?min_cena=${e}&max_cena=${t}`;window.location.href=n}function initPriceFilter(){const e=document.getElementById("minPriceInput"),t=document.getElementById("maxPriceInput"),n=document.getElementById("minPrice"),a=document.getElementById("maxPrice"),c=document.getElementById("filterButton"),i=document.getElementById("minPriceValue"),o=document.getElementById("maxPriceValue");a.max=maxPrice,e.addEventListener("input",function(){n.value=this.value,i.textContent=this.value}),t.addEventListener("input",function(){a.value=this.value,o.textContent=this.value}),n.addEventListener("input",function(){e.value=this.value,i.textContent=this.value}),a.addEventListener("input",function(){t.value=this.value,o.textContent=this.value}),c.addEventListener("click",redirectToFilteredPrice),document.getElementById("minPriceIncrease").addEventListener("click",function(){parseInt(e.value)<parseInt(t.value)&&(e.value=parseInt(e.value)+1,n.value=e.value,i.textContent=e.value)}),document.getElementById("minPriceDecrease").addEventListener("click",function(){parseInt(e.value)>0&&(e.value=parseInt(e.value)-1,n.value=e.value,i.textContent=e.value)}),document.getElementById("maxPriceIncrease").addEventListener("click",function(){parseInt(t.value)<maxPrice&&(t.value=parseInt(t.value)+1,a.value=t.value,o.textContent=t.value)}),document.getElementById("maxPriceDecrease").addEventListener("click",function(){parseInt(t.value)>parseInt(e.value)&&(t.value=parseInt(t.value)-1,a.value=t.value,o.textContent=t.value)})}document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll(".wc-block-product-categories-list-item").forEach(e=>{const t=e.querySelector("a"),n=e.querySelector(".wc-block-product-categories-list");if(n&&t){const a=document.createElement("button");a.classList.add("categories__btn"),a.setAttribute("aria-expanded","false"),a.innerHTML='\n                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="arrow-icon-category" xmlns="http://www.w3.org/2000/svg">\n                    <path d="M11.4568 15.9299L3.49181 7.57045C3.35884 7.43096 3.28467 7.24565 3.28467 7.05295C3.28467 6.86024 3.35884 6.67493 3.49181 6.53545L3.50081 6.52645C3.56527 6.45859 3.64286 6.40456 3.72886 6.36764C3.81486 6.33072 3.90747 6.31168 4.00106 6.31168C4.09465 6.31168 4.18726 6.33072 4.27326 6.36764C4.35926 6.40456 4.43685 6.45859 4.50131 6.52645L12.0013 14.3984L19.4983 6.52645C19.5628 6.45859 19.6404 6.40456 19.7264 6.36764C19.8124 6.33072 19.905 6.31168 19.9986 6.31168C20.0921 6.31168 20.1848 6.33072 20.2708 6.36764C20.3568 6.40456 20.4343 6.45859 20.4988 6.52645L20.5078 6.53545C20.6408 6.67493 20.715 6.86024 20.715 7.05295C20.715 7.24565 20.6408 7.43096 20.5078 7.57045L12.5428 15.9299C12.4728 16.0035 12.3885 16.062 12.2952 16.102C12.2018 16.142 12.1014 16.1626 11.9998 16.1626C11.8983 16.1626 11.7978 16.142 11.7044 16.102C11.6111 16.062 11.5269 16.0035 11.4568 15.9299Z" class="dropdown-icon" fill="white"></path>\n                </svg>\n            ',t.appendChild(a),a.addEventListener("click",function(t){t.preventDefault(),function(e){const t=e.parentElement;Array.from(t.children).forEach(t=>{if(t!==e){const e=t.querySelector(".categories__btn"),n=t.querySelector(".wc-block-product-categories-list");n&&e&&"true"===e.getAttribute("aria-expanded")&&(n.classList.remove("submenu-open"),e.classList.remove("active"),e.setAttribute("aria-expanded","false"))}})}(e);const c="true"===a.getAttribute("aria-expanded");n.classList.toggle("submenu-open",!c),a.classList.toggle("active",!c),a.setAttribute("aria-expanded",!c)})}})});const tabButtons=document.querySelectorAll(".product__tab"),tabContents=document.querySelectorAll(".product__tabs-content");tabButtons.forEach(e=>{e.addEventListener("click",function(){const t=e.getAttribute("data-target");tabContents.forEach(e=>e.style.display="none"),tabButtons.forEach(e=>e.classList.remove("active")),document.getElementById(t).style.display="block",e.classList.add("active")})}),document.addEventListener("DOMContentLoaded",initPriceFilter),navBtn.addEventListener("click",handleNav),closeBtn.addEventListener("click",closeNav);