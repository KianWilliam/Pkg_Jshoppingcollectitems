

(function($){
	
	var config = {};
	var global = {selected:'', selector:''};

	
	var init = $.prototype.init;
		$.prototype.init = function (selector, context)
	    {
		   var r = init.apply(this, arguments);
		   if(selector && selector.selector)
		   {
			r.context = selector.context;
			r.selector = selector.selector;
		   }
		   if(typeof selector == 'string')
		   {
			r.context = context || document,r.selector = selector,global.selector = r.selector;
		   }
		   global.selected = r;
		   return r;
	   }
	   $.prototype.init.prototype = $.prototype;
	  $.fn.CartHelper = {	  
		  config : function(options) {
			  setConfig($.extend({}, $.fn.CartHelper.defaults, options));
			

			  global.selected.CartHelper.init();
		  },
		  init : function(){
				
			 $("<form method='post'   action='"+config.uri+"plugins/system/jshoppingcollectitems/CartHelper.php'><input id='products' type='hidden' name='products' value=''><input type='submit' name='submit' style='font-family:"+config.fontfamily+"; font-size:"+config.fontsize+"em; color:"+config.color+"; background-color:"+config.bkcolor+";border:none; font-weight:"+config.fontweight+"; font-style:"+config.fontstyle+";  margin-left:"+config.addmarginleft+"; margin-top:"+config.addmargintop+"; ' value='Add all items'></form>").appendTo('.wishlish_buttons');
             $("<form method='post' action='"+config.uri+"plugins/system/jshoppingcollectitems/DeleteHelper.php'><input style='font-family:"+config.fontfamily+"; font-size:"+config.fontsize+"em; color:"+config.color+"; background-color:"+config.bkcolor+"; font-weight:"+config.fontweight+"; border:none; font-style:"+config.fontstyle+";  margin-left:"+config.deletemarginleft+"; margin-top:"+config.deletemargintop+"; ' type='submit' name='submit' value='Delete all items'></form>").appendTo('.wishlish_buttons');

				
			

		  }
		  
	  }
	  
	   function setConfig(value){config = value;}
	   function getConfig() {return config;}
	  
	   
	  
}(jQuery))
