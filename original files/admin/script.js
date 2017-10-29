$(document).ready(function()
{
	var page='';
	
	$(".jquery-accordion").accordion();

	$(".jquery-tabs").tabs();
	
	$(".datepicker").datepicker
	({
		dateFormat		:	'yy-mm-dd',
		showButtonPanel	: 	true,		
		changeMonth		: 	true,
		changeYear		: 	true,
		showWeek		: 	true,
		numberOfMonths	: 	1,
		yearRange		: 	"-120:+30"
	});
	
	$("#background_color").blur(function()
	{
		$("#background_color_div").css('background-color',$(this).val());
	});
	
	$("#change-order").click(function()
	{
		$.each($("#animation-slides div.animation-slide"),function(index,value)
		{
			var id=$(this).attr('data-id');
			var priority=$("#priority-"+id).val();
			var text=$("#text-"+id).val();
			
			$.ajax
			({
				type	:	"post",
				url		:	"ajax/change-home-animation-order.php",
				data	:	
				{
					id			:	id,
					priority	:	priority,
					text		:	text
					
				},
				beforeSend	:	function()
				{
					//$("#loading-image").removeClass("hidden");
				},
				success	:	function(result)
				{
				}
			});
		});
		alert("Order changed!");
	});

	$("#change-order-around-the-globe").click(function()
	{
		$.each($("#animation-slides div.animation-slide"),function(index,value)
		{
			var id=$(this).attr('data-id');
			var priority=$("#priority-"+id).val();
			
			$.ajax
			({
				type	:	"post",
				url		:	"ajax/change-around-the-globe-animation-order.php",
				data	:	
				{
					id			:	id,
					priority	:	priority
					
				},
				beforeSend	:	function()
				{
					//$("#loading-image").removeClass("hidden");
				},
				success	:	function(result)
				{
				}
			});
		});
		alert("Order changed!");
	});	

	$(".delete").click(function()
	{
		if(!confirm("Delete?"))
		{
			return false;
		}
	});
});