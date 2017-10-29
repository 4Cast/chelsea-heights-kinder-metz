<?php 
	include_once "header.php";
	$type=$_GET['type'];
	
	if($type=="add")
	{
		$title="";
		$content="";
		$event_date="";
	}
	else if($type=="list")
	{
		$event_items=Event::get_all_events($connection);
	}
	else
	{
		$news_obj=new Event($type,$connection);
		$title=$news_obj->title;
		$content=$news_obj->content;
		$event_date=$news_obj->event_date;
		$image=$news_obj->image;

		if($image!="")
		{
			$image="<img width='450' src='{$default_path}images/events/$image' />";
		}
	}
?>
	<div class="main-content" id="staff">
      	<div class="row">				
			<div class="large-12 medium-12 small-12 columns">
				<?php
					if($type=="list")
					{
						echo '<p><a href="add">+ Add New Event</a></p>';
						
						echo "<ul>";
						foreach($event_items as $event_item)
						{
							if($event_item['image']!="")
							{
								//$image="<img src='{$default_path}images/newsletters/$event_item[image]' />";
							}
							
							echo "
							<li class='row'>
								<a href='$event_item[id]'>
									<div class='large-9 medium-9 small-12 column'>
										<p>$event_item[title] [".date("l, d M Y",strtotime($event_item['event_date']))."]</p>
									</div>
								</a>
							</li>
							";
						}
						echo "</ul>";
					}
					//else if($type=="add")//add a new member
					else
					{
				?>
					<fieldset>
					<legend>
						<?php 
							if($news_obj->id>0)
							{
								echo $news_obj->title;
							}
							else
							{
								echo "Add New Event";
							}
							
						?>
					</legend>
					
					<form id="news-item-submit-form" enctype="multipart/form-data" action="../handle/events.php" method="post">
						<input type="hidden" name="id" value="<?php echo $news_obj->id;?>" />
						<?php 
							if($news_obj->id>0)
							{
								echo "<p align='right'><a class='delete' href='../delete-event-item.php?id=$news_obj->id'>X Delete Event</a></p>";
							}
						?>
						
						<table>
							<tr>
								<td align="right">Image :</td>
								<td>
									<?php echo $image;?>
									<p>(width = 310px height = 215px - images will be auto resized</p>
									<input type="file" class="multii" name="image" />
								</td>
							</tr>
							
							<tr>
								<td valign="top" align="right"><span class="red">*</span> Event Title : </td>
								<td><input type="text" name="title" placeholder="Event title" value="<?php echo $title;?>" /></td>
							</tr>
							
							<tr>
								<td align="right"><span class="red">*</span> Event Date/Time : </td>
								<td><input type="text" class="datetimepicker required" placeholder="Event Date" name="event_date" value="<?php echo $event_date;?>" /></td>
							</tr>
							
							<tr>
								<td valign="top" align="right"><span class="red">*</span> Event Content : </td>
								<td>
									<textarea rows="10" cols="5" class="ckeditor" name="content" placeholder="Content"><?php echo $content;?></textarea>
								</td>
							</tr>
							
							<tr>
								<td></td>
								<td><input class="button" id="submit-button" type="submit" value="Submit" /></td>
							</tr>
						</table>
					</form>
				</fieldset>
				<?php
					}
				?>
			</div>
		</div>
	</div>