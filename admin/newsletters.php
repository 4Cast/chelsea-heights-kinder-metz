<?php 
	include_once "header.php";
	$type=$_GET['type'];
	
	if($type=="add")
	{
		$title="";
		$pdf="";
		$image="";
		$content="";
		$news_date="";
	}
	else if($type=="list")
	{
		$news_items=News::get_all_news_items($connection);
	}
	else
	{
		$news_obj=new News($type,$connection);
		$title=$news_obj->title;
		$content=$news_obj->content;
		$news_date=$news_obj->news_date;
		$pdf=$news_obj->pdf;
		$image=$news_obj->image;
		
		if($image!="")
		{
			$image="<img width='450' src='{$default_path}images/newsletters/$image' />";
		}
	}
?>
	<div class="main-content" id="staff">
      	<div class="row">				
			<div class="large-12 medium-12 small-12 columns">
				<p><a href="add">+ Add Newsletter Item</a></p>
				<?php
					if($type=="list")
					{
						echo "<ul>";
						foreach($news_items as $news_item)
						{
							if($news_item['image']!="")
							{
								//$image="<img src='{$default_path}images/newsletters/$news_item[image]' />";
							}
							
							echo "
							<li class='row'>
								<a href='$news_item[id]'>
									<div class='large-9 medium-9 small-12 column'>
										<p>$news_item[title] [".date("l, d M Y",strtotime($news_item['news_date']))."]</p>
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
								echo "Add newsletter item";
							}
							
						?>
					</legend>
					
					<form id="news-item-submit-form" enctype="multipart/form-data" action="../handle/newsletters.php" method="post">
						<input type="hidden" name="id" value="<?php echo $news_obj->id;?>" />
						<?php 
							if($news_obj->id>0)
							{
								echo "<p align='right'><a class='delete' href='../delete-news-item.php?id=$news_obj->id'>X Delete Item</a></p>";
							}
						?>
						
						<table>
							<tr>
								<td align="right">Image :</td>
								<td>
									<?php echo $image;?>
									 (width = 310px height = 215px - images will be auto resized<br />
									<input type="file" class="multii" name="image" />
								</td>
							</tr>
							
							<tr>
								<td align="right">Newsletter PDF : </td>
								<td>
									<?php 
										if($pdf!="")
										{
											echo "<a href='{$default_path}documents/$pdf' target='_blank'>
					                        	<img width='48' src='{$default_path}images/icons/document_pdf.png' /> $pdf
					                        </a>";
										}
									?>
									<input type="file" name="pdf" />
								</td>
							</tr>
							
							<tr>
								<td valign="top" align="right"><span class="red">*</span> Title : </td>
								<td><input type="text" name="title" placeholder="Newsletter title" value="<?php echo $title;?>" /></td>
							</tr>
							
							
							<tr>
								<td valign="top" align="right"><span class="red">*</span> Content : </td>
								<td>
									<textarea rows="10" cols="5" class="ckeditor" name="content" placeholder="Content"><?php echo $content;?></textarea>
								</td>
							</tr>
							<tr>
								<td align="right"><span class="red">*</span> Date : </td>
								<td><input type="text" class="required datepicker" name="news_date" readonly value="<?php echo $news_date;?>" /></td>
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