(function($) {
  "use strict";
  $(document).ready(function() {
    if ($("#cssmenu .company.has-sub li").hasClass("active")) {
      $("li.company > a")
        .next()
        .css("display", "block");
    }

    if ($("#cssmenu .services.has-sub li").hasClass("active")) {
      $("li.services > a")
        .next()
        .css("display", "block");
    }
    // Right Menu
    $("#cssmenu > ul > li > a").click(function() {
      var checkElement = $(this).next();
      if (checkElement.is("ul") && checkElement.is(":visible")) {
        checkElement.slideUp(10);
      }
      if (checkElement.is("ul") && !checkElement.is(":visible")) {
        $("#cssmenu ul ul:visible").slideUp(10);
        checkElement.slideDown(10);
      }
      if (
        $(this)
          .closest("li")
          .find("ul")
          .children().length == 0
      ) {
        return true;
      } else {
        return false;
      }
    });

    var $win = $(window);
    var $doc = $(document);
    var $body = $(".main");

    var bgHeight = 1000; //height of the background image;

    var docHeight, winHeight, maxScroll;

    // function onResize(){
    // 	if (!$(".main").is('.philosophy')) {
    // 		docHeight = $doc.height();
    // 		winHeight = $win.height();
    // 		maxScroll = docHeight - winHeight;
    // 		moveParallax();
    // 	}
    // }

    $(".container-fluid").css("display", "none");
    $(".container-fluid").fadeIn(700);
    // function moveParallax(){
    // 	if (!$(".main").is('.philosophy')) {
    // 		var bgYPos = -(bgHeight-winHeight)* ($win.scrollTop() / maxScroll);

    // 		TweenLite.to($body, 0.2, {backgroundPosition: "50% " + bgYPos + "px"});
    // 	}
    // }

    // $win.on("scroll", moveParallax).on("resize", onResize).resize();

    $(".dropdown dt a").click(function() {
      $(".dropdown i").toggleClass("fa-rotate-180");
      $(".dropdown dd ul").toggle();
    });

    $(".dropdown dd ul li a").click(function() {
      var text = $(this).html();
      $(this).addClass("active");
      $(".dropdown dt a span").html(text);
      $(".dropdown dd ul").hide();
    });

    function getSelectedValue(id) {
      return $("#" + id)
        .find("dt a span.value")
        .html();
    }

    $(document).bind("click", function(e) {
      var $clicked = $(e.target);
      if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
    });

    /*  [ Main menu ]
		- - - - - - - - - - - - - - - - - - - - */
    $("#menu ul").hide();
    $("#menu li span").click(function() {
      $(this)
        .next()
        .slideToggle("fast");
      $(this).toggleClass("active");
    });

    /*  [ add animation main menu ]
		- - - - - - - - - - - - - - - - - - - - */
    $("#menu-main > li").each(function(index) {
      $(this).addClass("animation-element fast");
    });
    $(".cd-contact-info").addClass("animation-element fast");
    /*  [ Click show/hide sub menu ]
		- - - - - - - - - - - - - - - - - - - - */
    $("#menu-main > li.has-children > a").click(function(event) {
      event.preventDefault();
      $(this)
        .parent()
        .find("> .sub-menu")
        .slideToggle();
    });
  });
})(jQuery);
