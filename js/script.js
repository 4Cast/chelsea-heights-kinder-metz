var SESSION_EXPIRY_TIME=900;

$(window).resize(function()
{
	//resize_window();
});

$(window).load(function()
{	
	resize_window();
});

window.resize_window=function()
{
	var width=$(document).width();
	console.log(width);
	/*var div_w = $(window).width();
	var footer_div=$("#footer-content .sitemap").width();
	
	var left = (div_w - footer_div) / 2;
	$("#footer-content .sitemap").css("left", left + "px");

	var top=$("#footer").position().top+400;
	
	$("#footer-content .sitemap").css('top',top+"px");
	//#footer-content .copyright*/
}

$(document).ready(function()
{	
	var url='';
	if
	(
		stristr(document.location.href,"/shop/")||
		stristr(document.location.href,"/product/")
	)
	{
		url="../";
	}

	$(".open-mobile-sub-menu").click(function()
	{
		$(".mobile-sub-menu").addClass("hidden");
		$(this).next().removeClass("hidden");
	});
	
	$("#menu-icon").click(function()
	{
		if(!$("#mobile-menu").hasClass("bring-to-front"))
		{
			$("#mobile-menu").addClass('bring-to-front');
		}
		else
		{
			$("#mobile-menu").removeClass('bring-to-front');
		}
	});
	
	$("#close-icon").click(function()
	{
		$("#mobile-menu").removeClass('bring-to-front');
	});

	$(".read-more-toggle").click(function()
	{
		$(this).parent().addClass("hidden");
		$(this).parent().parent().find(".read-more-content").eq(0).removeClass("hidden");	
		resize_window();
	});
	
	$(".hide-toggle").click(function()
	{
		var this_span=$(this);
		this_span.parent().parent().find(".original-content").eq(0).removeClass("hidden");
		this_span.parent().addClass("hidden");	
		resize_window();
		
		//$('html,body').animate({scrollTop:$('#header').offset().top},500);
	});
	
	$(".datepicker").datepicker
	({
		dateFormat		:	'dd-mm-yy',
		showButtonPanel	: 	true,		
		changeMonth		: 	true,
		changeYear		: 	true,
		showWeek		: 	true,
		numberOfMonths	: 	1,
		yearRange		: 	"-120:+30"
	});
	
	$(".gallery img").click(function()
	{
		var src=$(this).attr('src');	
		var caption=$(this).attr('data-caption');
		$("#thumbs #caption").html(caption);
		$("#gallery-image").attr('src',src);
	});
	
	$("#slideshow .cycle-slideshow img").click(function()
	{
		var link=$(this).attr('data-link');
		if(link!=undefined)
		{
			window.location=link;
		}
	});
	
	$('#image-row').slick({
		  dots: true,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 5,
		  slidesToScroll: 5,
		  responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true,
		        dots: true
		      }
		    },
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
		});
	
	numeric_only("#select-quantity");
	
	resize_window();

	$("#search-text").autocomplete
	({
		source		: 	url+"ajax/search.php",
		minLength	: 	3,
		select		:	function(event,ui) 
		{
			window.location=url+"product/"+ui.item.id;
		}
	});
	
	$(".roll-over").hover
	(
		function()
		{
			var src=$(this).attr("src");

			if(stristr(src,"_RO.png"))
			{
				//src=src.replace("_RO.png",".png"); 
			}
			else
			{
				src=src.replace(".png","_RO.png");
			}
			
			//src=src.replace(".jpg","_RO.jpg"); 
			$(this).attr("src",src);
			
			$(this).parent().parent().addClass("bring-to-front");
			$("#header-section").addClass("selected-border");
		},
		function()
		{
			var src=$(this).attr("src");

			if(stristr(src,"_RO.png"))
			{
				src=src.replace("_RO.png",".png"); 
			}
			else
			{
				src=src.replace(".png","_RO.png");
			}
			
			$(this).attr("src",src);
			$(this).parent().parent().removeClass("bring-to-front");
			//$("#header-section").removeClass("selected-border");
		}	
	);

	/*$('.cycle-slideshow').cycle
	({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
	
	$('.cycle-slideshow').cycle
	({
		fx		: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
		speed	: 5000, 
	    timeout	: 3000 
	});*/

//	$('.cycle-slideshow').cycle
//	({
//		fx		: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
//		speed	: 3000, 
//	    timeout	: 1000 
//	});
	
	$(".top-bar-links li").mouseenter(function()
	{
		//$(".what-we-do-sub-menu").addClass("hidden");
	});

	$("#main-menu li").mouseenter(function(e)
	{
		$(".drop-down-menu").addClass("hidden");
	});
	
	$("#main-menu li.submenu").mouseenter(function(e)
	{
		var id=$(this).attr('data-id');
		var position=$(this).offset();
		$("#"+id).css('left',position.left);
		$("#"+id).removeClass("hidden");
	});
	$("#main-menu li.submenu").mouseleave(function(e)
	{
		//$(".drop-down-menu").addClass("hidden");
	});

	$("#patientes-form-submit").click(function(e)
	{
		$("#first_name").removeClass("error-border");
		$("#surname").removeClass("error-border");
		$("#day").removeClass("error-border");
		$("#month").removeClass("error-border");
		$("#year").removeClass("error-border");
		$("#email").removeClass("error-border");
		
		var error=false;
		
		if($("#first_name").val()=="")
		{
			error=true;
			$("#first_name").addClass("error-border");
		}
		if($("#surname").val()=="")
		{
			error=true;
			$("#surname").addClass("error-border");
		}
		if($("#day").val()=="")
		{
			error=true;
			$("#day").addClass("error-border");
		}
		
		if($("#email").val()!=""&&!validate_email_address($("#email").val()))
		{
			error=true;
			$("#email").addClass("error-border");
		}
		
		if($("#month").val()=="")
		{
			error=true;
			$("#month").addClass("error-border");
		}
		if($("#year").val()=="")
		{
			error=true;
			$("#year").addClass("error-border");
		}
		if(error)
		{
			e.preventDefault();
			return;
		}
		else
		{
			$("#patientes-form").submit();
		}
	});
	
	//click to get to the top of the page
	$("#to-top").click(function()
	{
		$(this).addClass("hidden");
		$('html,body').animate({scrollTop:$('#main-content-section').offset().top},500);
	});
	
	//Sign up box footer
	$("#btn-subscribe").click(function()
	{
		$("#txt-subscribe").removeClass("error-border");
		var email=$("#txt-subscribe").val();
		
		if(email=="")
		{
			$("#txt-subscribe").addClass("error-border");
		}
		else if(!validate_email_address(email))
		{
			$("#txt-subscribe").addClass("error-border");
		}
		else
		{
			$.ajax
			({
				type	:	"POST",
				url		:	url+"ajax/subscribe.php",
				data	:
				{
					email		:	email
				},
				beforeSend: function()
				{
					//$("#subscribe-button").css("background-image","url('../../images/icons/loading-bar.gif')");
				},
				complete	:	function(jqXHR,textStatus)
				{
					//$("#subscribe-button").css("background-image","url('../../images/icons/tick.png')");
				},
				success	:	function(result) 
				{
					$("#txt-subscribe").val('')
					
					alert("Thank you for subscribing");
					//$.cookie('subscribed_email_address',email,{expires:365});
				}
			});
		}
	});
});
$(window).load(function()
{
    
});

$(window).resize(function()
{
    
});


$(window).scroll(function(e)
{
	if($(document).height()-50<=($(window).height()+$(window).scrollTop())) 
	{
		$("#to-top").removeClass("hidden");
	}
	else
	{
		$("#to-top").addClass("hidden");
	}
});