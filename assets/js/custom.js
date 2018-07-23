$(document).on('ready', function () {
    
    "use strict";
    
    var win = $(window);
            
    
    win.on('load', function () {
        $('.loading-overlay').fadeOut(100);
    });
    
   
  
    win.on("scroll", function () {
      var wScrollTop  = $(window).scrollTop();    
        
        if (wScrollTop > 150) {
            $("#pageHeader").addClass("shrink");
            $("#shrink_mine").addClass("shrink-mine");
            $("#shrink_mine1").addClass("shrink-mine1");
   			$("#shrink_mine2").addClass("shrink-mine2");
            
        } else {
            $("#pageHeader").removeClass("shrink");
            $("#shrink_mine").removeClass("shrink-mine");
            $("#shrink_mine1").removeClass("shrink-mine1");
   			$("#shrink_mine2").removeClass("shrink-mine2");
        }
    });


     // Bootstrap Scroll Spy //
       
    $("body").scrollspy({
        target: ".navbar-collapse",
        offset: 70
    });
    
     // Collapse navigation on click on nav anchor in Mobile //
       
    $(".nav a").on('click', function () {
        $("#myNavbar").removeClass("in").addClass("collapse");
    });

     // navbar Scroll //
     
    $(".navbar-nav li a, .navbar-brand, .button a, .a-btn").on("click", function (e) {
        var anchor = $(this);
        $("html, body").stop().animate({
            
            scrollTop: $(anchor.attr("href")).offset().top - 60
        }, 1000);
        e.preventDefault();
    });
    
   var mixerContainer = $('#work #change'),
        // portfolio (MIXITUP)
        mixer = mixitup(mixerContainer, {
            selectors: {
                control: '#work ul > li'
            }
        }),
        
        scrollButton = $('#scroll-top');
    
   
    $('.work ul li').on('click', function () {
        $(this).addClass('selected').siblings().removeClass('selected');
    });
     
    
    // Caching The Scroll Top Element
    
    win.on('scroll', function () {
        if ($(this).scrollTop() >= 700) {
            
            scrollButton.show();
            
        } else {
            
            scrollButton.hide();
        }
        
    });
    
    // Click On Button To Scroll Top
    
    scrollButton.on('click', function () {
        
        $('html,body').animate({ scrollTop : 0 }, 1100);
        
    });
	
	// slider of team section
    $('.team .owl-carousel').owlCarousel({
        items: 4,
        loop: true,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        smartSpeed: 650,
        responsiveClass:true,
        responsive : {
            992 : {
                items: 4
            },
    
            768 : {
                items: 3
            },
            
            0 : {
                items: 1
            }
        }
        
    });
    
    
    $('.clients .owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        smartSpeed: 650,
    });
	
	$('.twitter .owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        smartSpeed: 650,
    });
	
	$('.slider .owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        smartSpeed: 650,
    });
    
    $('.counter').counterUp({
        delay: 70,
        time: 1500
    });	
    
	
	$('.element').typed({
        strings: [ " Creative page", " Parallax Page"],
        loop: true,
        showCursor: true,
        startDelay: 1500,
        backDelay: 2500,
		typeSpeed: 60
    });
	
	
	// skills section
	
	var wind = $(window);

    var main_height = $(".main-height").outerHeight();
 
    wind.on('scroll', function () {
        $(".skills-progress span").each(function () {
            var bottom_of_object = 
            $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = 
            $(window).scrollTop() + $(window).height();
            var myVal = $(this).attr('data-value');
            if(bottom_of_window > bottom_of_object) {
                $(this).css({
                  width : myVal
                });
            }
        });
    });
	
	
	// contact form
    $('#contact-form').validator();

    $('#contact-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "contact.php";

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#contact-form').find('.messages').html(alertBox);
                        $('#contact-form')[0].reset();
                    }
                }
            });
            return false;
        }
    });
    
    
    
});