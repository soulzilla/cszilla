'use strict';

$(document).ready(function ($) {
	function init(){

		$(window).on('load', function() {
			/*------------------
                Preloader
            --------------------*/
			$(".loader").fadeOut();
			$("#preloader").delay(400).fadeOut("slow");

		});

		$('.like-it').click(function () {
			var entity_id = $(this).attr('data-id'),
				entity_table = $(this).attr('data-table'),
				url = '/main/like/create?id=' + entity_id + '&table=' + entity_table;

			$.ajax({
				url: url,
				success: function (response) {
					let state = '#like-state-' + entity_id,
						count = '#likes-count-' + entity_id;

					$(count).html(response.count);
					if (response.event === 1) {
						$(state).removeClass('fa-heart-o');
						$(state).addClass('fa-heart');
					} else {
						$(state).addClass('fa-heart-o');
						$(state).removeClass('fa-heart');
					}
				}
			})
		});

		$('.take-part').click(function () {
			var entity_id = $(this).attr('data-contest'),
				url = '/main/giveaways/participate?id=' + entity_id;

			$.ajax({
				url: url,
				success: function (response) {
					$('#take-part').remove();
					$('#p-count').html(response.count);
				}
			});
		});

		$('.delete-comment').click(function () {
			var id = $(this).attr('data-id'),
				selector = '#comment-' + id,
				url = '/main/comments/delete?id=' + id;

			$.ajax({
				url: url,
				success: function (response) {
					$(selector).remove();
					$('.comments-count').html(response.count);
				}
			});
		});

		(function($) {
			/*------------------
                Navigation
            --------------------*/
			if ($(document).find('.slicknav_menu').length === 0) {
				$(".main-menu").slicknav({
					appendTo: '.header-section',
					allowParentLinks: true,
					label: ''
				});
			}

			/*------------------
                Background Set
            --------------------*/
			$('.set-bg').each(function() {
				var bg = $(this).data('setbg');
				$(this).css('background-image', 'url(' + bg + ')');
			});

			/*------------------
                Hero Slider
            --------------------*/
			var $slider = $('.hero-slider');
			var SLIDER_TIMEOUT = 10000;

			$slider.owlCarousel({
				items: 1,
				nav: false,
				dots: false,
				autoplay: true,
				autoplayTimeout: SLIDER_TIMEOUT,
				animateOut: 'fadeOut',
				animateIn: 'fadeIn',
				loop: true,
				onInitialized: ({target}) => {
					var animationStyle = '-webkit-animation-duration'+ SLIDER_TIMEOUT +'ms;animation-duration:'+ SLIDER_TIMEOUT+'ms';
					var progressBar = $('<div class="slider-progress-bar"><span class="progress" style='+ animationStyle +'></span></div>');
					$(target).append(progressBar);
				},
				onChanged: ({type, target}) => {
					if (type === 'changed') {
						var $progressBar = $(target).find('.slider-progress-bar');
						var clonedProgressBar = $progressBar.clone(true);

						$progressBar.remove();
						$(target).append(clonedProgressBar);
					}
				}
			});

			/*------------------
                Video Popup
            --------------------*/
			$('.video-play').magnificPopup({
				type: 'iframe'
			});

			/*------------------
                Testimonials
            --------------------*/
			$('.testimonial-slider').owlCarousel({
				items: 1,
				nav: false,
				dots: true,
				autoplay: true,
				loop: true,
				autoplayHoverPause: true,
				animateOut: 'slideOutDown',
				animateIn: 'slideInDown',
			});

			/*------------------
                Circle progress
            --------------------*/
			$('.circle-progress').each(function() {
				var cpvalue = $(this).data("cpvalue");
				var cpcolor = $(this).data("cpcolor");
				var cpid 	= $(this).data("cpid");

				$(this).append('<div class="'+ cpid +'"></div><div class="progress-value"><h3>'+ cpvalue +'%</h3></div>');

				if (cpvalue < 100) {

					$('.' + cpid).circleProgress({
						value: '0.' + cpvalue,
						size: 80,
						thickness: 4,
						fill: cpcolor,
						emptyFill: "rgba(0, 0, 0, 0)"
					});
				} else {
					$('.' + cpid).circleProgress({
						value: 1,
						size: 80,
						thickness: 4,
						fill: cpcolor,
						emptyFill: "rgba(0, 0, 0, 0)"
					});
				}
			});

		})(jQuery);

		$('.settings-select').click(function () {
			let id = $(this).attr('data-id'),
				type = $(this).attr('data-type'),
				checked = this.checked,
				url = '/main/default/settings?type='+type+'&id='+id+'&state='+checked;
			$.ajax({
				url: url
			})
		});

	}
	init();

	$(document).on('ready pjax:end', function (event) {
		init();
	});

});
