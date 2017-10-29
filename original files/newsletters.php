<?php
	include_once 'include/header.php';
	
	$slug=$_REQUEST['slug'];
	
	if($slug=="")
	{
		$news_items=News::get_all_news_items($connection);
	}
	else
	{
		$id=explode("-",$slug);
		$id=$id[count($id)-1];
		$newsletter_obj=new News($id,$connection);
	}
?>
	<div class="heading box-shadow">
		<div class="row">
			<div class="large-12 medium-12 small-12 column">
				<h2>News</h2>
			</div>
		</div>
	</div>
	
	<div class="content-with-background">
		<div class="row white-background news">
			<?php 
				if($slug=="")
				{
			?>
					<div class="content-area columns large-8 medium-8 small-12">
						<?php 
							foreach($news_items as $news_item)
							{
								$url="newsletters/".create_slug($news_item['title'])."-".$news_item['id'];
								
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
										".date("l, d/M/Y",strtotime($news_item['news_date']))."
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
					
					<div class="small-12 medium-4 large-4 columns">
						<?php 
							include 'events-calendar-widget.php';
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
						
						echo "<div class='news-date'>".date("l, d/M/Y",strtotime($newsletter_obj->news_date))."</div>";
						
						if($newsletter_obj->pdf!="")
						{
							echo "<div class=''><a href='../documents/$newsletter_obj->pdf'><img src='../images/news/Button_Newsletter.png' class='roll-over download-document'></a></div>";
						}
						
						if($newsletter_obj->image!="")
						{
							$image="<img class='content-right-image' src='{$default_path}images/newsletters/$newsletter_obj->image' />";
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