'use strict';

function deleteComment(){
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
}

function sendComment(){
	$('.send-comment').click(function () {
		let that = $(this),
			comment = $('#comment-body-form textarea'),
			text = comment.val(),
			id = that.attr('data-id'),
			table = that.attr('data-table');

		if ((text.length > 1) && (comment.hasClass('is-invalid') === false)) {
			let url = '/main/comments/create',
				data = {
					entity_id: id,
					entity_table: table,
					content: text
				};

			$.post({
				url: url,
				data: data,
				success: function (response) {
					$('.comments-list').append(response.html);
					$('.comments-count').html(response.count);
					comment.val('');
					comment.removeClass('is-valid')
					deleteComment();
				}
			})
		} else {
			comment.addClass('is-invalid');
		}
	})
}

function rateIt(){
	$('.rate-it').click(function () {
		var entity_id = $(this).attr('data-id'),
			entity_table = $(this).attr('data-table'),
			rate = $(this).val(),
			url = '/main/rating/create',
			data = {
				entity_id: entity_id,
				entity_table: entity_table,
				rate: rate
			};

		$.post({
			url: url,
			data: data,
			success: function (response) {
				$('.rating-area').html(response.html);
				$('.average-rate').html(response.average);
				$('.total-rates').html(response.count);
				rateIt();
			}
		})
	});
}

function deleteComplaint(){
	$('.delete-complaint').click(function () {
		var id = $(this).attr('data-id'),
			selector = '#complaint-' + id,
			url = '/main/complaints/delete?id=' + id;

		$.ajax({
			url: url,
			success: function () {
				$(selector).remove();
			}
		});
	});
}

function deleteOverview(){
	$('.delete-overview').click(function () {
		var id = $(this).attr('data-id'),
			selector = '#overview-' + id,
			url = '/main/overviews/delete?id=' + id;

		$.ajax({
			url: url,
			success: function () {
				$(selector).remove();
			}
		});
	});
}

function loadVideos(){
	let videosContainer = $('.videos-widget-placeholder'),
		streamContainer = $('.stream-widget-placeholder');
	if (videosContainer.hasClass('initialized') === false) {
		$.ajax({
			url: '/main/videos/index',
			success: function (response) {
				videosContainer.html(response.html);
				videosContainer.addClass('initialized');
			}
		})
	}

	if (streamContainer.hasClass('initialized') === false) {
		$.ajax({
			url: '/main/videos/stream',
			success: function (response) {
				streamContainer.html(response.html);
				streamContainer.addClass('initialized');
			}
		})
	}
}

function likeIt(){
	$('.like-it').click(function () {
		var entity_id = $(this).attr('data-id'),
			entity_table = $(this).attr('data-table'),
			url = '/main/like/create?id=' + entity_id + '&table=' + entity_table;

		$.ajax({
			url: url,
			success: function (response) {
				let state = '#like-state-' + entity_table + '-' + entity_id,
					count = '#likes-count-' + entity_table + '-' + entity_id;

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
}

$(document).ready(function ($) {

	function init(){

		/* $(window).on('load', function() {
			/*------------------
                Preloader
            --------------------/
			$(".loader").fadeOut();
			$("#preloader").delay(400).fadeOut("slow");

		}); */

		/* $(window).scroll(function() {
			var scrolled = $(window).scrollTop();

			if (scrolled > 400) {
				$('.header-section').css('position', 'fixed');
			} else {
				$('.header-section').css('position', 'relative');
			}
		}); */

		deleteComment();

		sendComment();

		rateIt();

		deleteComplaint();

		deleteOverview();

		loadVideos();

		likeIt();

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

	}
	init();

	$(document).on('ready pjax:end', function (event) {
		init();
	});

});
