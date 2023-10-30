
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
        console.log("OK");
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


(function () {
    const second = 1000,
          minute = second * 60,
          hour = minute * 60,
          day = hour * 24;
  
    //I'm adding this section so I don't have to keep updating this pen every year :-)
    //remove this if you don't need it
    let today = new Date(),
        dd = String(today.getDate()).padStart(2, "0"),
        mm = String(today.getMonth() + 1).padStart(2, "0"),
        yyyy = today.getFullYear(),
        nextYear = yyyy + 1,
        dayMonth = "09/30/",
        birthday = dayMonth + yyyy;
    
    today = mm + "/" + dd + "/" + yyyy;
    if (today > birthday) {
      birthday = dayMonth + nextYear;
    }
    //end
    
    const countDown = new Date(birthday).getTime(),
        x = setInterval(function() {    
  
          const now = new Date().getTime(),
                distance = countDown - now;
  
        //   document.getElementById("days").innerText = Math.floor(distance / (day)),
            // document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
            // document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
            // document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);
            
            // // document.getElementById("days1").innerText = Math.floor(distance / (day)),
            // document.getElementById("hours1").innerText = Math.floor((distance % (day)) / (hour)),
            // document.getElementById("minutes1").innerText = Math.floor((distance % (hour)) / (minute)),
            // document.getElementById("seconds1").innerText = Math.floor((distance % (minute)) / second);
            $("[id^='days']").text(Math.floor(distance / (day)));
            $("[id^='hours']").text(Math.floor((distance % (day)) / (hour)));
            $("[id^='minutes']").text(Math.floor((distance % (hour)) / (minute)));
            $("[id^='seconds']").text(Math.floor((distance % (minute)) / second));
  
          //do something later when date is reached
          if (distance < 0) {
            document.getElementById("headline").innerText = "It's my birthday!";
            document.getElementById("countdown").style.display = "none";
            document.getElementById("content").style.display = "block";
            clearInterval(x);
          }
          //seconds
        }, 0)
    }());
 


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





