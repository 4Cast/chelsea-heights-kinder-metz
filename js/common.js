function stristr(haystack, needle, bool) 
{
	// http://kevin.vanzonneveld.net
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   bugfxied by: Onno Marsman
	// *     example 1: stristr('Kevin van Zonneveld', 'Van');
	// *     returns 1: 'van Zonneveld'
	// *     example 2: stristr('Kevin van Zonneveld', 'VAN', true);
	// *     returns 2: 'Kevin '
	var pos = 0;

	haystack += '';
	pos = haystack.toLowerCase().indexOf((needle + '').toLowerCase());
	if (pos == -1) 
	{
		return false;
	} 
	else 
	{
		if (bool) 
		{
			return haystack.substr(0, pos);
		} 
		else 
		{
			return haystack.slice(pos);
		}
	}
}

function get_current_page_name(url)
{
	//alert(url);
	if(url)
	{
		//var m=url.toString().match(/.*\/(.+?)\./);//this is for analytics.php
		var m=url.split("/");
		if(m&&m.length>1)
		{
			return m[m.length-1];
		}
	}
	return "";
}
function ucwords(str) 
{
  // http://kevin.vanzonneveld.net
  // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // +   improved by: Waldo Malqui Silva
  // +   bugfixed by: Onno Marsman
  // +   improved by: Robin
  // +      input by: James (http://www.james-bell.co.uk/)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // *     example 1: ucwords('kevin van  zonneveld');
  // *     returns 1: 'Kevin Van  Zonneveld'
  // *     example 2: ucwords('HELLO WORLD');
  // *     returns 2: 'HELLO WORLD'
  return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function ($1) {
    return $1.toUpperCase();
  });
}
function center_on_screen(div)
{
	var msg_w = $(div).width();
	var div_w = $(window).width();
	var left = (div_w - msg_w) / 2;
	$(div).css("left", left + "px");

	var msg_h = $(div).height();
	var div_h = $(window).height();
	var top = (div_h - msg_h) / 2;
	$(div).css("top", top + "px");
}

function printObject(o) 
{
	var out='';
	for (var p in o) 
	{
		out += p + ': ' + o[p] + '\n';
	}
	alert(out);
}
function round_value(val)
{
	var dec = 2;
	var result = Math.round(val*Math.pow(10,dec))/Math.pow(10,dec);
	//alert(result);
	return result;
}

function numeric_only(textfield)
{	
	$(textfield).keydown(function(event) 
	{
		//alert(event.keyCode);
		// Allow only backspace and delete
		if
		(
			event.keyCode==190||//dot
			event.keyCode==46||//delete
			event.keyCode==8||//backspace
			event.keyCode==9||
			event.keyCode==37||//back arrow
			event.keyCode==39||//forward arrow
			event.keyCode==36||//home
			event.keyCode==35//end
			
		) 
		{
			// let it happen, don't do anything
		}
		else 
		{
			// Ensure that it is a number and stop the keypress
			if(event.keyCode<48||event.keyCode>57)
			{
				event.preventDefault();	
			}	
		}
	});
}
function get_file_name() 
{
	//this gets the full url
	var url = document.location.href;
	//this removes the anchor at the end, if there is one
	url = url.substring(0, (url.indexOf("#") == -1) ? url.length : url.indexOf("#"));
	//this removes the query after the file name, if there is one
	url = url.substring(0, (url.indexOf("?") == -1) ? url.length : url.indexOf("?"));
	//this removes everything before the last slash in the path
	url = url.substring(url.lastIndexOf("/") + 1, url.length);
	//return
	return url;	
}
function update_page_title(type)
{
	var number_of_message_notifications=parseInt($(".new-messages").html());
	var number_of_bid_notifications=parseInt($(".new-bids").html());

	if(isNaN(number_of_bid_notifications))
	{
		number_of_bid_notifications=0;
	}
	
	if(isNaN(number_of_message_notifications))
	{
		number_of_message_notifications=0;
	}
	
	if(type=="bids")
	{
		if(number_of_bid_notifications>0)
		{
			number_of_bid_notifications=number_of_bid_notifications-1;
		}
	}
	else
	{
		if(number_of_message_notifications>0)
		{
			number_of_message_notifications=number_of_message_notifications-1;
		}
	}	

	total_notifications=number_of_message_notifications+number_of_bid_notifications;

	if(number_of_message_notifications==0)
	{
		$(".left_menu_navigation .active .new-notification-available").remove();
	}
	else
	{
		$(".left_menu_navigation .active .new-notification-available").html(number_of_message_notifications);
	}

	var title=$(document).attr('title').split("(");	
	if(total_notifications==0)
	{
		title=title[0];
	}
	else
	{
		title=title[0]+"("+total_notifications+")";
	}
	$(document).attr('title',title);	
}

function escape_html(unsafe) 
{
	return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}

function display_message(message,type)
{
	if(type=="error")
	{
		type="showErrorToast";
	}
	else if(type=="success")
	{
		type="showSuccessToast";
	}
	else if(type=="warning")
	{
		type="showWarningToast";
	}
	else if(type=="notice")
	{
		type="showNoticeToast";
	}

	$().toastmessage({sticky: false});
	var toast_msg = $().toastmessage(type,message);
	center_on_screen(".toast-container");

	return toast_msg;
}
function numeric_text(value,exceptions)
{
	
}

$(document).ready(function()
{

	//create extended paddign at the top of the page for unijobs page
	//var myKey = /jobs/;
	//var myStringVar = window.location.pathname;
	//var myMatch = myStringVar.search(myKey);
	/*if(myMatch==-1)
	{
		$("#Content").addClass('GA_ONLY');
	} */
	//if(myMatch!=-1)
	//{
		//$("#Content").addClass('unijobsopen');
	//} 
	
	if ($("div#vActionBar").find("div#BottomRow").length != 0)
	{
		$("#Content").addClass('unijobsopen');
	} 

	//$("#vNavigationBox").corner();
	
	$("input[type='text']").keydown(function(event)
	{
	    // NO: backslash
    	//alert(event.keyCode);
	    if(event.keyCode==220)
	    {
	    	event.preventDefault();
	    }
	});
	
	$("input[type='text']").keyup(function(event)
	{
		var val=$(this).val();
		
	    if(val.substr(val.length-1)=="'")
        {
        	$(this).val(val.substr(0,val.length-1));
        }
	});
	
	$(".numeric_textbox").keydown(function(event)
	{
	    // Allow: backspace, delete, tab, escape, and enter
	    if
	    (
	    	event.keyCode==46|| 
	    	event.keyCode==8||
	    	event.keyCode==9||
	    	event.keyCode==27||
	    	event.keyCode==13||
	         // Allow: Ctrl+A
	        (event.keyCode==65 && event.ctrlKey === true)||
	         // Allow: home, end, left, right
	        (event.keyCode >= 35 && event.keyCode <= 39)
	    )
	    {
	         // let it happen, don't do anything
	         return;
	    }
	    else
	    {
	        // Ensure that it is a number and stop the keypress
	        if
	        (
	        	event.shiftKey||
	        	(event.keyCode<48||event.keyCode>57)&& 
	        	(event.keyCode<96||event.keyCode>105)
	        )
	        {
	            event.preventDefault(); 
	        }
	    }
	});


    //Change Radio Button Style
    /*
    $("input[type='radio']").each(function()
    {
        if($(this).attr("Checked") == "checked")
        {
            $(this).addClass("radioticked");
            $(this).after("<div class='ticked'>&nbsp;</div>");
        }
    });

    $("input[type='radio']").click(function(){
        $(this).removeClass("radioticked");
        if($(this).after().find("div.ticked"))
            $(this).after().remove();
        $(this).addClass("radioticked");
        $(this).after("<div class='ticked'>&nbsp;</div>");

        $("input[type='radio']").each(function(){
            if($(this).attr("Checked") != "checked")
            {
                $(this).removeClass("radioticked");
            }
        });
    });
    */


});

function validate_email_address(emailAddress)
{
	//anna_99@bigpond.net.au
	//var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
	var pattern = new RegExp(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i);
	return pattern.test(emailAddress);
}

function reset_border(container)
{
	$(container+' .error_border').removeClass("error_border");
	
	$(container+' input').each(function(index)
	{
		//$(this).css('border','1px solid #7F9DB9');
		$(this).css('border','');
	});
	$(container+' select').each(function(index)
	{
		$(this).css('border','');
	});

	$(container+' table').each(function(index)
	{
		$(this).css('border','');
	});
}

function centre_on_screen(div)
{
	var msg_w = $(div).width();
	var div_w = $(window).width();
	var left = (div_w - msg_w) / 2;
	$(div).css("left", left + "px");

	var msg_h = $(div).height();
	var div_h = $(window).height();
	var top = (div_h - msg_h) / 2;
	$(div).css("top", top + "px");
}

function format_textbox(textfield,text,div)
{
	var text_value=$(textfield).val();
	
	if(text_value!=text)
	{
		$(textfield).css('color','black');
	}

	if(div==undefined)
	{
		$(textfield).focus(function()	 
		{
			text_value=$(this).val();
			if(text_value==text)
			{
				$(this).attr('value','');
				$(this).css('color','black');
			}
		});
		
		$(textfield).blur(function()
		{
			text_value=$(this).val();
			if(text_value=='')
			{
				$(this).attr('value',text);
				$(this).css('color','#555555');
			}
		});
	}
	else
	{
		$(div).on("focus",textfield,function()
		{
			text_value=$(this).val();
			if(text_value==text)
			{
				$(this).attr('value','');
				$(this).css('color','black');
			}
		});
		
		$(div).on("blur",textfield,function()
		{
			text_value=$(this).val();
			//alert(text);
			if(text_value==text)
			{
				$(this).val(text);
				$(textfield).css('color','#555555');
			}
		});
	}
}
function clear_input_fields(container)
{
	$(container+' input[type="text"]').val('');
	$(container+' textarea').val('');
	$(container+' input[type="checkbox"]').removeAttr("checked");
	$(container+' input[type="radio"]').removeAttr("checked");	
}
function is_ckeditor_empty(instanceName)
{
    var ele = (new Element('div')).update(CKEDITOR.instances[instanceName].getData()); 
    return (ele.getInnerText() == '' || innerText.search(/^(&nbsp;)+$/i) == 0);
}

function __getIEVersion() {
    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    return rv;
}

function __getOperaVersion() {
    var rv = 0; // Default value
    if (window.opera) {
        var sver = window.opera.version();
        rv = parseFloat(sver);
    }
    return rv;
}

var __userAgent = navigator.userAgent;
var __isIE =  navigator.appVersion.match(/MSIE/) != null;
var __IEVersion = __getIEVersion();
var __isIENew = __isIE && __IEVersion >= 8;
var __isIEOld = __isIE && !__isIENew;

var __isFireFox = __userAgent.match(/firefox/i) != null;
var __isFireFoxOld = __isFireFox && ((__userAgent.match(/firefox\/2./i) != null) || 
	(__userAgent.match(/firefox\/1./i) != null));
var __isFireFoxNew = __isFireFox && !__isFireFoxOld;

var __isWebKit =  navigator.appVersion.match(/WebKit/) != null;
var __isChrome =  navigator.appVersion.match(/Chrome/) != null;
var __isOpera =  window.opera != null;
var __operaVersion = __getOperaVersion();
var __isOperaOld = __isOpera && (__operaVersion < 10);

function __parseBorderWidth(width) {
    var res = 0;
    if (typeof(width) == "string" && width != null && width != "" ) {
        var p = width.indexOf("px");
        if (p >= 0) {
            res = parseInt(width.substring(0, p));
        }
        else {
     		//do not know how to calculate other values 
		//(such as 0.5em or 0.1cm) correctly now
    		//so just set the width to 1 pixel
            res = 1; 
        }
    }
    return res;
}

//returns border width for some element
function __getBorderWidth(element) {
	var res = new Object();
	res.left = 0; res.top = 0; res.right = 0; res.bottom = 0;
	if (window.getComputedStyle) {
		//for Firefox
		var elStyle = window.getComputedStyle(element, null);
		res.left = parseInt(elStyle.borderLeftWidth.slice(0, -2));  
		res.top = parseInt(elStyle.borderTopWidth.slice(0, -2));  
		res.right = parseInt(elStyle.borderRightWidth.slice(0, -2));  
		res.bottom = parseInt(elStyle.borderBottomWidth.slice(0, -2));  
	}
	else {
		//for other browsers
		res.left = __parseBorderWidth(element.style.borderLeftWidth);
		res.top = __parseBorderWidth(element.style.borderTopWidth);
		res.right = __parseBorderWidth(element.style.borderRightWidth);
		res.bottom = __parseBorderWidth(element.style.borderBottomWidth);
	}
   
	return res;
}

//returns the absolute position of some element within document
function getElementAbsolutePos(element) 
{
	var res = new Object();
	res.x = 0; res.y = 0;
	if (element !== null) { 
		if (element.getBoundingClientRect) {
			var viewportElement = document.documentElement;  
 	        var box = element.getBoundingClientRect();
		    var scrollLeft = viewportElement.scrollLeft;
 		    var scrollTop = viewportElement.scrollTop;

		    res.x = box.left + scrollLeft;
		    res.y = box.top + scrollTop;

		}
		else { //for old browsers
			res.x = element.offsetLeft;
			res.y = element.offsetTop;

			var parentNode = element.parentNode;
			var borderWidth = null;

			while (offsetParent != null) {
				res.x += offsetParent.offsetLeft;
				res.y += offsetParent.offsetTop;
				
				var parentTagName = 
					offsetParent.tagName.toLowerCase();	

				if ((__isIEOld && parentTagName != "table") || 
					((__isFireFoxNew || __isChrome) && 
						parentTagName == "td")) {		    
					borderWidth = kGetBorderWidth
							(offsetParent);
					res.x += borderWidth.left;
					res.y += borderWidth.top;
				}
				
				if (offsetParent != document.body && 
				offsetParent != document.documentElement) {
					res.x -= offsetParent.scrollLeft;
					res.y -= offsetParent.scrollTop;
				}


				//next lines are necessary to fix the problem 
				//with offsetParent
				if (!__isIE && !__isOperaOld || __isIENew) {
					while (offsetParent != parentNode && 
						parentNode !== null) {
						res.x -= parentNode.scrollLeft;
						res.y -= parentNode.scrollTop;
						if (__isFireFoxOld || __isWebKit) 
						{
						    borderWidth = 
						     kGetBorderWidth(parentNode);
						    res.x += borderWidth.left;
						    res.y += borderWidth.top;
						}
						parentNode = parentNode.parentNode;
					}    
				}

				parentNode = offsetParent.parentNode;
				offsetParent = offsetParent.offsetParent;
			}
		}
	}
    return res;
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}