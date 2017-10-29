<?php
	include_once '../../../include/db.php';
	include_once '../../../include/common.php';
	include_once '../../../include/functions.php';
	include_once '../../../include/include-classes.php';
	
	$connection=db_connect();
	
	$events_row=Event::get_all_events($connection);
	
	foreach($events_row as $event)
	{
		$event_date_display=date("D, jS F Y",strtotime($event['event_date']));
		
		$event_date=date("Y-n-j",strtotime($event['event_date']));
		
		$event_date=explode("-",$event_date);
		
		$events[]=array
		(
			'month'	=>	$event_date[1],
	    	'day'	=> 	$event_date[2],
	    	'year'	=>	$event_date[0],
	    	'title'	=>	$event['title'],
			'display_date'=>$event_date_display,
	    	'url'	=>	create_slug($event['title']."-".$event['id'])
		);
	}
	
	header("Content-type:application/json");
	echo json_encode($events);
?>								