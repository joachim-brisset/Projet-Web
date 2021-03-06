
(function(){
	$.fn.jQLoupe = function(params){
		var paramsPlugin = $.extend({}, $.fn.jQLoupe.defaults, params);
		$loupe = $('<div>', {
			class:'jqloupe-loupe',
			css:{
				'border' : paramsPlugin.border,
				'-moz-border-radius':Math.ceil(paramsPlugin.diameter/2),
				'-webkit-border-radius':Math.ceil(paramsPlugin.diameter/2),
				'-o-border-radius':Math.ceil(paramsPlugin.diameter/2),
				'-khtml-border-radius':Math.ceil(paramsPlugin.diameter/2),
				'border-radius':Math.ceil(paramsPlugin.diameter/2),
				width:paramsPlugin.diameter,
				height:paramsPlugin.diameter
			}
		});
		
		return $(this).each(function(){
			var img = $(this).find('img');
			$(this).css({
				position : 'relative',
				display : 'block'
			});
			var x, y, ratioW, ratioH;
			var imgBack = new Image();
			
			
			$overlay = $('<div>', {
				class : 'jqloupe-overlayZoom',
				css:{
					width : img.width()
				}
			});
			
			$('.jqloupe-overlayZoom').live('mousemove', function(event){
				if(event.offsetX){
					x = event.offsetX;
					y = event.offsetY;
				} else {
					x = event.layerX;
					y = event.layerY;
				}
				ratioW = imgBack.width / $('.jqloupe-overlayZoom').width(); 
				ratioH = imgBack.height / $('.jqloupe-overlayZoom').height(); 
				$('.jqloupe-loupe').css({top:y-150, left:x-150});
				$('.jqloupe-loupe').css('background-position', '' + (-(x*ratioW) + 150) + 'px ' + (-(y*ratioH)+150) + 'px');
			});
			$(this).mouseenter(function(){
				
				imgBack.src = img.attr('src');
				$(this).append($loupe);
				$(this).append($overlay);
				$('.jqloupe-overlayZoom').height(img.height()).width(img.width());
				$('.jqloupe-loupe').css('backgroundImage', 'url("' + img.attr('src') + '")');
			});
			$(this).mouseleave(function(){

				$('.jqloupe-overlayZoom').unbind('mousemove');
				$('.jqloupe-loupe').add('.jqloupe-overlayZoom').remove();
			});
			$(this).click(function(){
				return false;
			});
		});
	};
	
	$.fn.jQLoupe.defaults = {
		diameter : 300,
		border : "solid 3px"
	};
})(jQuery);