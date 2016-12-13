(function($) {
	
	Drupal.behaviors.themename = {
		attach : function(context, settings) {
			//start custom script
			function createCookie(name,value,days) {
			    if (days) {
			        var date = new Date();
			        date.setTime(date.getTime()+(days*24*60*60*1000));
			        var expires = "; expires="+date.toGMTString();
			    }
			    else var expires = "";
			    document.cookie = name+"="+value+expires+"; path=/";
			}

			function readCookie(name) {
			    var nameEQ = name + "=";
			    var ca = document.cookie.split(';');
			    for(var i=0;i < ca.length;i++) {
			        var c = ca[i];
			        while (c.charAt(0)==' ') c = c.substring(1,c.length);
			        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			    }
			    return null;
			}

			function eraseCookie(name) {
			    createCookie(name,"",-1);
			}

			$(document).ready(function(){
				$(".box1 .dropdown div ul li").click(function() {
					var current_text_lang = $.trim($(this).text());
					var selected_lang = $.trim($(".box1 .dropdown span.selected").text());
					// Create a Cookie for one week
					createCookie('current_lang',selected_lang,1);
					var URL = document.URL;//====== for getting the current URL
					var splitedurl = URL.split('/');
					var current_text_lang = $.trim($(this).text());
					if (jQuery.inArray('en', splitedurl) != -1 && current_text_lang=="Cambodian") { //=========If en found in the URL address===
						URL = URL.replace('en', 'kh');
						window.location.replace(URL);
					} else if(jQuery.inArray('kh', splitedurl) != -1 && current_text_lang=="English"){
						URL = URL.replace('kh', 'en');
						window.location.replace(URL);
					}else if((jQuery.inArray('kh', splitedurl) != -1 && current_text_lang=="Cambodian") || (jQuery.inArray('en', splitedurl) != -1 && current_text_lang=="English")){
						//do nothing
					}else {
						if (current_text_lang=="Cambodian") {
							URL = URL+'kh';
						}else{
							URL = URL + 'en';
						}
					//window.location.replace(URL);
					}
				});

				var current_lang = readCookie('current_lang');
				if(current_lang==null){
					current_lang = 'Language';
				}
				//Set the current language selected at the top of the dropdown list
				$(".box1 .dropdown span.selected").text(current_lang);
				$(".box1 .dropdown div ul li").each(function( index ) {
					$(this).removeClass('active');
				  	var lang_list = $.trim($(this).text());
				  	if(lang_list==current_lang){
						$(this).addClass(' active');
					}

				});

				//Set current curency
				$(".box .dropdown div ul li").click(function() {
					var current_curency = $.trim($(this).text());
					var selected_curency = $.trim($(".box .dropdown span.selected").text());
					// Create a Cookie for one week
					createCookie('selected_curency',selected_curency,1);
					var URL = document.URL;//====== for getting the current URL
					window.location.replace(URL);
				});

				var current_curency = readCookie('selected_curency');
				if(current_curency==null){
					current_curency = 'Curency';
				}
				//Set the current language selected at the top of the dropdown list
				$(".box .dropdown span.selected").text(current_curency);
				$(".box .dropdown div ul li").each(function( index ) {
					$(this).removeClass('active');
				  	var curency_list = $.trim($(this).text());
				  	if(curency_list==current_curency){
						$(this).addClass(' active');
					}

				});
				
				
				
				//Add current menu here
				//$("div.menu_box ul.megamenu li>a").click(function(){
					//jQuery(this).removeClass("active");
			    //});
			    
				$("div.menu_box ul.megamenu li").each(function(){
					var current_menu = $.trim($(this).text());
					var getURL = decodeURI(document.location);
		            jQuery(this).removeClass("active");
		            var menu_link = jQuery($(this).find('a')).attr('href');
		            if(menu_link==getURL){
		            	$(this).addClass(' active grid');
		            }
		            //alert(menu_link + '\n' +getURL);
		           //alert(SplitedURL);
		            //jQuery.inArray(current_menu,SplitedURL) != -1
		           //if(){
		        	   //jQuery(this).addClass(" active");
	               //}
			    });
				
			    
			});
			//end custom script
		}
	};
})(jQuery);