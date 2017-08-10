// (function($){
	jQuery(window).load(function() {
		jQuery('.container-banner').flexslider({
			'animation': 'slide',
			'directionNav': false,
			'controlNav': true,
			start: function(){
				jQuery('.container-banner').css('visibility', 'visible');
	      	}
		});

		jQuery('.slider-haras').owlCarousel({
		    loop: true,
		    margin: 20,
		    nav: false,
		    dots: true,
		    responsive:{
		        0:{
		            items:1
		        },
		        500:{
		            items:1
		        },
		        768:{
		            items:2
		        },
		        1000:{
		            items:3
		        }
		    }
		});

		jQuery('#slider-wrapper').flexslider({
		animation: "slide",
		controlNav: true,
		animationLoop: false,
		slideshow: true,
		  start: function(){
		      jQuery('#slider-wrapper').css('visibility', 'visible');
		  }
			});

		jQuery('#carousel').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    //smoothHeight: true,
		    itemWidth: 157,
		    itemMargin: 10,
		    asNavFor: '#slider',
		    start: function(){
		      jQuery('#slider-wrapper').css('visibility', 'visible');
		  }
		});

		jQuery('#slider').flexslider({
		    animation: "slide",
		    controlNav: false,
		    animationLoop: false,
		    slideshow: false,
		    sync: "#carousel",
		    smoothHeight: true,
		    start: function(){
		      jQuery('.container-foto-cavalo').css('visibility', 'visible');
		  	}
		});

	});
// })(jQuery);

	jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() > 600) {
			jQuery('.go-top').fadeIn();
		} else {
			jQuery('.go-top').fadeOut();
		}
	});

	jQuery(document).ready(function($) {
		jQuery(".lightbox").fancybox({
			padding: [15, 15, 40, 15],
			tpl:{
				closeBtn : '<a title="Fechar" class="fancybox-item fancybox-close" href="javascript:;"></a>',
			}
		});

		jQuery(".ir-topo").click(function() {
			jQuery("html, body").animate({ scrollTop: 0 }, "slow");
			return false;
		});

		$(".icon-busca").click(function(event) {
			event.preventDefault();
			$(".container-busca").slideToggle('show');
			$(".icon-busca").toggleClass('buscaAtiva');
		});

		$('.content-icons').click(function(event) {
			event.preventDefault();
			$(".menu-collpase").slideToggle();
		});

	});