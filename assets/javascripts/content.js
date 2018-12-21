$(document).ready(function(){;
		var seoHrefs = {'f34bb62f734d1cecaa4de6a8b8efab53':'aHR0cDovL3d3dy5kc2MuYXov', 
						'f34bb62f734d1cecaa4de6a8b8efab52':'aHR0cDovL3d3dy5zaW1icmVsbGEuY29tLw==',
						'f34bb62f734d1cecaa4de6a8b8efab54':'aHR0cDovL3d3dy50YW5kZW0uYXov',
						'f34bb62f734d1cecaa4de6a8b8efab55':'aHR0cDovL3d3dy5jcnlzdGFsaGFsbC5hei9lbg==',
						'f34bb62f734d1cecaa4de6a8b8efab56':'aHR0cDovL2V1cm9kZXNpZ24uYXov',
						'f34bb62f734d1cecaa4de6a8b8efab57':'aHR0cDovL21hZ251bS5hei8=',
						'f34bb62f734d1cecaa4de6a8b8efab58':'aHR0cDovL2JlYXQuYXovZW4='};
		
		var $elements = $("[data-key]");
		for(var i = 0, count = $elements.length; i < count; i++) {

			var $element = $elements.eq(i);
			var key = $element.data("key");
			switch($element.data("type")) {
				case "href": 
					$element.attr("href", Base64.decode(seoHrefs[key]));
					break;
				case "content": 
					$element.replaceWith("href", Base64.decode(seoContent[key]));
					break;
			}
		}
		$(document).trigger( "renderpage.finish");
});
