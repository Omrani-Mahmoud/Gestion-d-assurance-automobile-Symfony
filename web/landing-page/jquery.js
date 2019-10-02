$(document).ready(function() {

	"use strict";

	jQuery("#contactForm").validator().on("submit", function (event) {

		"use strict";

		if (event.isDefaultPrevented()) {
			// handle the invalid form...
			formError();
			submitMSG(false, "Please Follow Error Messages and Complete as Required");
		} else {
			// everything looks good!
			event.preventDefault();
			submitForm();
		}
	});

	function submitForm(){
		
		"use strict";

		// Initiate Variables With Form Content
		var name = $("#name").val();
		var email = $("#email").val();

		$.ajax({
			type: "POST",
			url: "php/form-process.php",
			data: "name=" + name + "&email=" + email,
			success : function(text){
				if (text == "success"){
					formSuccess();
				} else {
					formError();
					submitMSG(false,text);
				}
			}
		});
	}

	function formSuccess(){
		
		"use strict";

		$("#contactForm")[0].reset();
		submitMSG(true, "Thank you for your submission :)")
	}

	function formError(){
		
		"use strict";

		$("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			$(this).removeClass();
		});
	}

	function submitMSG(valid, msg){
		
		"use strict";

		if(valid){
			var msgClasses = "success form-message";
		} else {
			var msgClasses = "error form-message";
		}
		$("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
	}

	initbackTop();
	function initbackTop() {
		
		"use strict";

		var jQuerybackToTop = jQuery("#back-top");
		jQuery(window).on('scroll', function() {
			if (jQuery(this).scrollTop() > 100) {
				jQuerybackToTop.addClass('show');
			} else {
				jQuerybackToTop.removeClass('show');
			}
		});
		jQuerybackToTop.on('click', function(e) {
			jQuery("html, body").stop().animate({scrollTop: 0}, 1500, 'easeInOutExpo');
		});
	}
	
	$.scrollIt({
		topOffset: 0,
		scrollTime: 1500,
		easing: 'easeInOutExpo'
	});

	initSlickSlider();
	// Slick Slider init
	function initSlickSlider() {

		jQuery('.main-slider').slick({
			fade: true,
			speed: 800,
			dots: false,
			arrows: false,
			infinite: true,
			autoplay: true,
			slidesToShow: 1,
			slidesToMove: 1,
			autoplaySpeed: 2000,
			adaptiveHeight: true
		});
	}

	initLightbox();
	// modal popup init
	function initLightbox() {
		
		"use strict";

		jQuery('a.lightbox, a[rel*="lightbox"]').fancybox({
			padding: 0
		});
	}

	initVegasSlider();
	// Video Embed
	function initVegasSlider() {
	  jQuery("#bgvid").vegas({
	      slides: [
	        {   src: 'images/polina.jpg',
	            video: {
	                src: [
	                    'video/polina.webm',
	                    'video/polina.mp4'
	                ],
	                loop: true,
	                timer: false,
	                mute: true
	            }
	        }
	    ]
	  });
	}

	initMarquee();
	// running line init
	function initMarquee() {
		"use strict";

		jQuery('.line-box').marquee({
			line: '.line',
			animSpeed: 50
		});
	}


}); 
$( window ).on( "load" , function() {
	"use strict";

	$( "#loader" ).delay( 600 ).fadeOut( 300 );
});