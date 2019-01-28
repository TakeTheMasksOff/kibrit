/*---------------------------------------------
	CODYHOUSE Full-Screen Pushing Navigation
---------------------------------------------*/

jQuery(document).ready(function($){


    jQuery("#content-block").on("click", "button.outlined-btn", function(event){
        $(".hideEl").toggle();
	    	var productName = $( "h2.presenReq" ).text();
	      	$( "#RequestPresentationForm_productName" ).val(productName);
	});

	var isLateralNavAnimating = false;
	
	//open/close lateral navigation

	$('.sidebar-nav > li > a, .showRightBlock').on('click', function(){
		openRightBlock();
	});

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	   $(".cd-title").click(function(){
	   	  $(".see-more").css("opacity", "0");
	      $(this).find(".see-more").css("opacity", "1");
	   });
	}

	$(document).mouseup(function(event) {
		if ($(event.target).closest("#rightBlock").length || $("#rightBlock").css("width") == "0px") return;
		closeRightBlock();

		if ($(event.target).closest("#map-canvas").length) return;
		$("#map-canvas").css("width", "0");
		event.stopPropagation();

		if ($(event.target).closest(".modal-content").length || $(event.target).closest("#caption").length) return;
		$("#myModal").css("display", "none");
	});

	$('.sidebar-nav > li > a').click(function() {
		  $('.sidebar-nav > li').removeClass('active');
		  $(this).closest('li').addClass('active');	
	});

	$('.cd-nav-trigger').on('click', function(event){
		event.preventDefault();
		//stop if nav animation is running 
		if( !isLateralNavAnimating ) {
			if($(this).parents('.csstransitions').length > 0 ) isLateralNavAnimating = true; 
			
			// $('body').toggleClass('navigation-is-open');
			$('#menu-main > li').each(function(){
				$(this).toggleClass('inleft');
			});
			$('.cd-contact-info').toggleClass('inleft');
			// animation element
			function animation_element(){
				if($('.animation-element').length){
					$('.animation-element').each(function(index) {
						var delay = 0;
						delay = $(this).attr('data-delay');

						if($(this).hasClass('intop')){
							$(this).addClass("outtop").delay(delay).queue(function(){
								$(this).removeClass("intop").stop().dequeue();
							});	
						}
						else if($(this).hasClass('inleft')){
							$(this).addClass("outleft").delay(delay).queue(function(){
								$(this).removeClass("inleft").stop().dequeue();
							});	
						}
						else if($(this).hasClass('inright')){
							$(this).addClass("outright").delay(delay).queue(function(){
								$(this).removeClass("inright").stop().dequeue();
							});	
						}
						else if($(this).hasClass('inbottom')){
							$(this).addClass("outbottom").delay(delay).queue(function(){
								$(this).removeClass("inbottom").stop().dequeue();
							});
						}
			        });
				}	
			}

			animation_element();

			$('.cd-navigation-wrapper').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				//animation is over
				isLateralNavAnimating = false;
			});
		};
	});


	
});


function showLargeImg(img){
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");

    modal.style.display = "block";
    modalImg.src = img.src;
    captionText.innerHTML = img.alt;
}

function urlWithEndSlash(url)
{     
    window.location.href = url.replace(/\/$/, "");
} 

function changeMetaTags(link, title, description) {
	var urlPath = link.split("/");
	$("link[rel=canonical]").attr("href", link);
	$("link[hreflang=az]").attr("href", "http://kibrit.tech/az/"+urlPath[4]);
	$("link[hreflang=en]").attr("href", "http://kibrit.tech/en/"+urlPath[4]);
	$("link[hreflang=ru]").attr("href", "http://kibrit.tech/ru/"+urlPath[4]);
	$("title").html(title);
	if(description != "null") {
		$("meta[name=description]").attr("content", description);
		$('meta[property="og:description"]').attr('content', description);
	}
	$('meta[property="og:url"]').attr('content', link);
	$('meta[property="og:title"]').attr('content', title);
};

function hashbangInterceptor(url) {

	if (window.XMLHttpRequest) {
	    // code for modern browsers
	    xhttp = new XMLHttpRequest();
	 } else {
	    // code for old IE browsers
	    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function openRightBlock() {
	if (window.matchMedia('(max-width: 768px)').matches)
	{
	    	$("#rightBlock").css("width", "100%");
	} else {
    		$("#rightBlock").css("width", "66.666%");
	}

    $(".info-content").css("opacity", "1").css("height", "auto");
	$('body').css("overflow", "hidden");
	$('#rightBlock').css("overflow-y", "auto");

}

function closeRightBlock() {
    $(".hideEl").css("display", "none");
	$("#content-block").empty();
    $(".info-content").css("opacity", "0").css("height", "0");
    $("#rightBlock").css("width", "0");
	$('body').css("overflow", "auto");
	$('#rightBlock').css("overflow-y", "hidden");
}

function openGmapBlock() {
	if (window.matchMedia('(max-width: 768px)').matches)
	{
        	$(".map-canvas").css("width", "100%");
	} else {
			$(".map-canvas").css("width", "66.666%");
	}
    $(".map-canvas").css("visibility", "visible");
}

function closeGmapBlock() {
    $(".map-canvas").css("width", "0");
}

function DisableButton(b)
{
	b.disabled = true;
	b.value = 'Submitting';
	b.form.submit();
}