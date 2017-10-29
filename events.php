<?php
	include_once 'include/header.php';
	
	$slug=$_REQUEST['slug'];
	
	if($slug=="")
	{
		$news_items=Event::get_all_events($connection);
	}
	else
	{
		$id=explode("-",$slug);
		$id=$id[count($id)-1];
		$newsletter_obj=new Event($id,$connection);
	}
?>
	<div class="heading box-shadow">
		<div class="row">
			<div class="large-12 medium-12 small-12 column">
				<h2>Events</h2>
			</div>
		</div>
	</div>
	
	<div class="content-with-background">
		<div class="row white-background news">
			<?php 
				if($slug=="")
				{
			?>
					<div class="content-area columns large-9 medium-9 small-12">
						<?php 
							foreach($news_items as $news_item)
							{
								$url="events/".create_slug($news_item['title'])."-".$news_item['id'];
								
								if(strlen(strip_tags($news_item['content']))>200)
								{
									$description=substr(strip_tags($news_item['content']),0,200)." ...";
								}
								else
								{
									$description=substr(strip_tags($news_item['content']),0,200);
								}
								
								$news_date="
									<span class='news-date-list'>
										".date("l, d/M/Y",strtotime($news_item['event_date']))."
                    				</span>
								";
								
								echo "
								<div class='news-item'>
									<h4><a href='$url'>$news_item[title]</a>$news_date</h4>
									<p>$description</p>
								</div>
								";
							}
						?>
					</div>
			<?php 
				}
				else
				{
			?>
				<div class="content-area columns large-12 medium-12 small-12">
					<?php 
						echo "<h1>$newsletter_obj->title</h1>";
						
						echo "<div class='news-date'>".date("l, d/M/Y g:i a",strtotime($newsletter_obj->event_date))."</div>";
						
						if($newsletter_obj->image!="")
						{
							$image="<img class='width-100 content-right-image' src='{$default_path}images/events/$newsletter_obj->image' />";
						}
						echo "<div class='news-content'>$newsletter_obj->content $image</div>";
					?>
				</div>
			<?php		
				}
			?>
		</div>
	</div>

<?php
	include_once 'include/footer.php';
?>