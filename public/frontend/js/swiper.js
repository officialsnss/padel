var swiper4 = new Swiper(".calendar-swiper", {
	slidesPerView:8,
	spaceBetween:10,
	speed:1000,	
	navigation: {
		nextEl: ".calendar-button-next",
		prevEl: ".calendar-button-prev",
	},
	pagination: {
		el: ".swiper-pagination",
		clickable: true,
	},
	breakpoints: {
		640: {
			slidesPerView:3,
			spaceBetween:10,
		},
		768: {
			slidesPerView:6,
			spaceBetween: 5,
		},
		1024: {
			slidesPerView:8,
			spaceBetween:10,
		},		
	},
});	