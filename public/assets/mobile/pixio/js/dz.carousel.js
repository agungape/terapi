/** 	=========================
	Template Name 	 : Dating Kit
	Author			 : DexignZone
	Version			 : 1.0
	File Name		 : custom.js
	Author Portfolio : https://themeforest.net/user/dexignzone/portfolio

	Core script to handle the entire theme and core functions
**/

/* JavaScript Document */
jQuery(document).ready(function() {
    'use strict';
	
    // Get Started ==========
	if(jQuery('.get-started').length > 0){
		var swiperGetStarted2 = new Swiper('.get-started2', {
			speed: 1500,
			spaceBetween: 0,
			effect: "fade",
			loop:true,
			// autoplay: {
			// 	delay: 1500,
			// },
		});
		var swiperGetStarted = new Swiper(".get-started", {
			speed: 1500,
			parallax: true,
			slidesPerView: "auto",
			spaceBetween: 0,
			loop:true,
			// autoplay: {
			// 	delay: 1500,
			// },
			pagination: {
                el: ".swiper-pagination",
                clickable: true,
			},
			thumbs: {
			  swiper: swiperGetStarted2,
			},
		});
	}


	if(jQuery('.banner-swiper').length > 0){
		var bannerSwiper = new Swiper('.banner-swiper', {
			speed: 1500,
			spaceBetween: 0,
			parallax: true,
			slidesPerView: "auto",
			effect: "fade",
			loop:true,
			// autoplay: {
			// 	delay: 1500,
			// },
		});
	}

	if(jQuery('.dz-category-swiper').length > 0){
		var dzCategorySwiper = new Swiper('.dz-category-swiper', {
			speed: 1000,
			slidesPerView: 4,
			spaceBetween: 15,
			loop: true,
			freeMode: true,
			// autoplay: {
			// 	delay: 1500,
			// },
		});
	}

	if(jQuery('.dz-category-swiper2').length > 0){
		var dzCategorySwiper2 = new Swiper('.dz-category-swiper2', {
			speed: 1500,
			slidesPerView: 3,
			spaceBetween: 15,
			loop: true,
			freeMode: true,
			// autoplay: {
			// 	delay: 2000,
			// },
		});
	}

	if(jQuery('.dz-category-swiper3').length > 0){
		var dzCategorySwiper3 = new Swiper('.dz-category-swiper3', {
			speed: 1500,
			slidesPerView: "auto",
			spaceBetween: 10,
			loop: false,
			freeMode: true,
		});
	}

	if(jQuery('.dz-product-swiper').length > 0){
		var dzProductSwiper = new Swiper('.dz-product-swiper', {
			speed: 1000,
			slidesPerView: 2.1,
			spaceBetween: 15,
			loop: true,
			freeMode: true,
			// autoplay: {
			// 	delay: 1000,
			// },
		});
	}

	if(jQuery('.dz-offer-banner').length > 0){
		var dzofferbanner = new Swiper('.dz-offer-banner', {
			speed: 1500,
			slidesPerView: 2,
			spaceBetween: 15,
			loop: true,
			freeMode: true,
			// autoplay: {
			// 	delay: 1500,
			// },
		});
	}

	if(jQuery('.dealSwiper').length > 0){
		var dealSwiper = new Swiper(".dealSwiper", {
			spaceBetween: 10,
			slidesPerView: "auto",
			freeMode: true,
			watchSlidesProgress: true,
		});
		var dealSwiper2 = new Swiper(".dealSwiper2", {
			speed: 1500,
			spaceBetween: 0,
			slidesPerView: "auto",
			parallax: true,
			thumbs: {
				swiper: dealSwiper,
			},
			// autoplay: {
			// 	delay: 1500,
			// },
		});
	}

	if(jQuery('.dz-featured-swiper').length > 0){
		var dzFeaturedSwiper = new Swiper('.dz-featured-swiper', {
			speed: 1500,
			slidesPerView: 1.1,
			spaceBetween: 15,
			loop: true,
			freeMode: true,
			// autoplay: {
			// 	delay: 1500,
			// },
		});
	}

	if(jQuery('.dz-featured-swiper2').length > 0){
		var dzFeaturedSwiper2 = new Swiper('.dz-featured-swiper2', {
			speed: 1500,
			slidesPerView: 1.5,
			spaceBetween: 15,
			loop: true,
			freeMode: true,
			// autoplay: {
			// 	delay: 2000,
			// },
		});
	}

	if(jQuery('.product-detail-swiper').length > 0){
		var productDetailSwiper = new Swiper('.product-detail-swiper', {
			speed: 1000,
			slidesPerView: 1,
			spaceBetween: 0,
			loop: true,
			effect: "fade",
			freeMode: true,
			pagination: {
                el: ".swiper-pagination",
                clickable: true,
			},
			// autoplay: {
			// 	delay: 1500,
			// },
		});
	}

	if(jQuery('.payment-card-swiper').length > 0){
		var paymentCardSwiper = new Swiper('.payment-card-swiper', {
			speed: 1000,
			slidesPerView: 1.2,
			spaceBetween: 10,
			freeMode: true,
		});
	}

});
/* Document .ready END */