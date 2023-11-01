
$('.lange-drop').click(function() {
  $('.drop-lange-select').slideToggle("slow"); 
  $('.notification-all').hide("slow");
  $('.category-lst').hide("slow");  
});

$('.notification-btn').click(function() {
  $('.notification-all').slideToggle("slow"); 
  $('.drop-lange-select').hide("slow");
  $('.category-lst').hide("slow"); 
});
$('.category-tile').click(function() {
  $('.category-lst').slideToggle("slow"); 
  $('.drop-lange-select').hide("slow");
  $('.notification-all').hide("slow"); 
});
$('.category-tile-inner').click(function() {
  $('.category-2nd').slideToggle("slow"); 
});


$(window).scroll(function() {
    if ($(document).scrollTop() > 50) {
        $('.header').addClass('affix');
        // console.log("OK");
    } else {
        $('.header').removeClass('affix');
    }
});
$('.navTrigger').click(function () {
    $(this).toggleClass('active');
    console.log("Clicked menu");
    $("#mainListDiv").toggleClass("show_list");
    $("#mainListDiv").fadeIn();

});
$('.menu-show-mn').click(function () {
  $('.menu-ul').toggleClass('show-mnu');
});


 


/*    $(document).ready(function() {
      $('.testimonial-slider').slick({
          autoplay: true,
          autoplaySpeed: 1000,
          speed: 600,
          draggable: true,
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
          dots: false,
          responsive: [
              {
                breakpoint: 991,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                }
              },
              {
                  breakpoint: 575,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                  }
              }
          ]
      });
      
	$(".prev-btn").click(function () {
		$(".testimonial-slider").slick("slickPrev");
	});

	$(".next-btn").click(function () {
		$(".testimonial-slider").slick("slickNext");
	});
	$(".prev-btn").addClass("slick-disabled");
	$(".testimonial-slider").on("afterChange", function () {
		if ($(".slick-prev").hasClass("slick-disabled")) {
			$(".prev-btn").addClass("slick-disabled");
		} else {
			$(".prev-btn").removeClass("slick-disabled");
		}
		if ($(".slick-next").hasClass("slick-disabled")) {
			$(".next-btn").addClass("slick-disabled");
		} else {
			$(".next-btn").removeClass("slick-disabled");
		}
	});
  }); */


  $("#mobile_code").intlTelInput({
    initialCountry: "in",
    separateDialCode: true,
  });





