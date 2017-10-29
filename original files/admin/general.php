<?php 
	include_once "header.php";
	$type=$_GET['type'];
	
	if($type=="add")
	{
		$name="";
		$image="";
		$type="";
		$introduction="";
	}
	else if($type=="list")
	{
		$general_infos=General::get_general_info($connection);
	}
	else
	{
		$general_obj=new General($type,$connection);
		$title=$general_obj->title;
		$image=$general_obj->image;
		$description=$general_obj->description;
		$created=$general_obj->created;
		
		if($image!="")
		{
			$image="<img src='{$default_path}images/general/$image' />";
		}
	}
?>
	<div class="main-content" id="staff">
      	<div class="row">				
			<div class="large-12 medium-12 small-12 columns">
				<p><a href="add">+ Add New General Item</a></p>
				<?php
					if($type=="list")
					{
						echo "<ul>";
						foreach($general_infos as $general_info)
						{
							if($general_info['image']!="")
							{
								$image="<img src='{$default_path}images/general/$general_info[image]' />";
							}
							
							echo "
							<li class='row'>
								<a href='$general_info[id]'>
									<div class='large-4 medium-4 small-12 column'>$image</div>
									<div class='large-8 medium-8 small-12 column'>
										<h1>$general_info[title]</h1>
										<div>$general_info[description]</p>
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
							if($general_obj->id>0)
							{
								echo $general_obj->title;
							}
							else
							{
								echo "Add New General Item";
							}
							
						?>
					</legend>
					
					<form id="staff-submit-form" enctype="multipart/form-data" action="../handle/general.php" method="post">
						<input type="hidden" name="id" value="<?php echo $general_obj->id;?>" />
						<?php 
							if($general_obj->id>0)
							{
								echo "<p align='right'><a class='delete' href='../delete-general-item.php?id=$general_obj->id'>X Delete Item</a></p>";
							}
						?>
						
						<table>
							<tr>
								<td valign="top" align="right">Image (width=290px, height=260px) : <br />Image will be auto resized</td>
								<td>
									<?php echo $image;?>	
									<input type="file" name="image" />									
								</td>
							</tr>
							<tr>
								<td valign="top" align="right">Item Title : </td>
								<td><input type="text" name="title" placeholder="i.e. MICROCHIPS, CANCER TREATMENT" value="<?php echo $title;?>" /></td>
							</tr>
							
							
							<tr>
								<td valign="top" align="right">Description : </td>
								<td>
									<textarea class="ckeditor" rows="10" cols="5" name="description" placeholder="Description"><?php echo $description;?></textarea>
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