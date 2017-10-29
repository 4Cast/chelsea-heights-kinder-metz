<?php 
	include_once "header.php";
	$type=$_GET['type'];
	
	if($type=="add")
	{
		$name="";
		$url="";
		$type="";
		$introduction="";
	}
	else
	{
		$community_obj=new Community($type,$connection);
		$name=$community_obj->name;
		$url=$community_obj->url;
		$type_id=$community_obj->type_id;
	}
?>
	<div class="main-content" id="staff">
      	<div class="row">				
			<div class="large-12 medium-12 small-12 columns">
				<p><a href="add">+ Add Community Link</a></p>
				
				<?php
					if($type=="list")
					{
						echo '<div class="jquery-accordion">';
						
						$community_types=Community::get_community_types($connection);
						foreach($community_types as $community_type)
						{
							echo "<h3>$community_type[type]</h3>";
							echo "<div><ul>";
							$community_links=Community::get_community_links($connection,$community_type['id']);
							//print_r_html($community_links);
							foreach($community_links as $community_link)
							{	
								echo "<li><a href='$community_link[id]'>$community_link[name]</a></li>";
							}
							echo "</ul></div>";
						}
						echo '</div>';
					}
					else
					{
				?>
					<fieldset>
					<legend>
						<?php 
							if($community_obj->id>0)
							{
								echo $community_obj->name;
							}
							else
							{
								echo "Add Community Link";
							}
							
						?>
					</legend>
					
					<form id="staff-submit-form" enctype="multipart/form-data" action="../handle/community.php" method="post">
						<input type="hidden" name="id" value="<?php echo $community_obj->id;?>" />
						<?php 
							if($community_obj->id>0)
							{
								echo "<p align='right'><a class='delete' href='../delete-community-link.php?id=$community_obj->id'>X Delete Item</a></p>";
							}
						?>
						
						<table>
							<tr>
								<td valign="top" align="right">Community Link Title : </td>
								<td><input type="text" name="name" placeholder="i.e. Central Animal Records" value="<?php echo $name;?>" /></td>
							</tr>
							
							<tr>
								<td valign="top" align="right">URL : </td>
								<td>
									<input type="text" name="url" placeholder="i.e. www.car.com.au" value="<?php echo $url;?>" />
								</td>
							</tr>
							
							<tr>
								<td valign="top" align="right">Type : </td>
								<td>
									<select name="type_id">
										<?php 
											$sql="
												SELECT *
												FROM community_types
												ORDER BY type
											";
											$query=$connection->query($sql);
											$community_types_rows=$query->fetchAll(PDO::FETCH_ASSOC);
											foreach($community_types_rows as $community_types_row)
											{
												echo "<option value='$community_types_row[id]'";
												if($type_id==$community_types_row['id'])
												{
													echo " selected='selected' ";
												}
												echo ">$community_types_row[type]</option>";
											}
										?>
									</select>
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