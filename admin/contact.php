<?php 
	include_once "header.php";

	$sql="
		SELECT *
		FROM contact
		WHERE type='rosebud'
	";
	$query=$connection->query($sql);
	$row_seaford=$query->fetch(PDO::FETCH_ASSOC);
?>
	<div class="main-content" id="blurb">
      	<div class="row">				
			<div class="small-12 large-12 columns">
				<?php 
					if($_SESSION['update']!="")
					{
						echo "<div class='success-class'>";
						if($_SESSION['update'])
						{
							echo "Updated";
						}
						echo "</div>";
						
						unset($_SESSION['update']);
					}
				?>
				<fieldset>
					<legend>Rosebud Pet VET Contact Details</legend>
					
					<form id="staff-submit-form" enctype="multipart/form-data" action="<?php echo $default_path;?>admin/handle/contact.php" method="post">
						<img src='../images/contact/contact-Rosebud-Pet-Vet.png' />
						<input type="file" name="image" />
						<p>Width=960px</p>
						<input type="submit" value="Submit" class="button" />
					</form>
					
					<form action="<?php echo $default_path;?>admin/handle/contact.php" method="post">
						<input type="hidden" name="type" value="rosebud" />
						<table>
							<tr>
								<td>Phone # : </td>
								<td><input type="text" name="phone" value="<?php echo $row_seaford['phone'];?>" maxlength="10" /></td>
							</tr>
							<tr>
								<td>Fax # : </td>
								<td><input type="text" name="fax" value="<?php echo $row_seaford['fax'];?>" maxlength="10" /></td>
							</tr>
							
							<tr>
								<td>Address : </td>
								<td><input type="text" name="address" value="<?php echo $row_seaford['address'];?>" /></td>
							</tr>
							
							<tr>
								<td>Email : </td>
								<td><input type="text" name="email" value="<?php echo $row_seaford['email'];?>" /></td>
							</tr>
							
							<tr>
								<td>Monday-Friday Opening Hours : </td>
								<td>
									<select name="mon_fri_open">
										<?php
											echo "<option value='closed'";
										    if($row_seaford['mon_fri_open']=="closed")
										    {
										    	echo " selected='selected'";	
										    }
										    echo ">CLOSED</option>";
											$iTimestamp = mktime(7,0,0,1,1,2011);
											for ($i = 1; $i < 36; $i++) 
											{
											    $time=date('H:i',$iTimestamp);
											    $time_am_pm=date('h:i a',$iTimestamp);
											    echo "<option value='$time'";
											    if($time==$row_seaford['mon_fri_open'])
											    {
											    	echo " selected='selected'";	
											    }
											    echo ">$time_am_pm</option>";
											    $iTimestamp += 1800;
											}
										?>				
									</select>
								</td>
							</tr>
							<tr>
								<td>Monday-Friday Closing Hours : </td>
								<td>
									<select name="mon_fri_close">
										<?php
											echo "<option value='closed'";
										    if($row_seaford['mon_fri_close']=="closed")
										    {
										    	echo " selected='selected'";	
										    }
										    echo ">CLOSED</option>";
										    
											$iTimestamp = mktime(7,0,0,1,1,2011);
											for ($i = 1; $i < 36; $i++) 
											{
											    $time=date('H:i',$iTimestamp);
											    $time_am_pm=date('h:i a',$iTimestamp);
											    echo "<option value='$time'";
											    if($time==$row_seaford['mon_fri_close'])
											    {
											    	echo " selected='selected'";	
											    }
											    echo ">$time_am_pm</option>";
											    $iTimestamp += 1800;
											}
										?>				
									</select>
								</td>
							</tr>
							<tr>
								<td>Saturday Opening Hours : </td>
								<td>
									<select name="sat_open">
										<?php
											echo "<option value='closed'";
										    if($row_seaford['sat_open']=="closed")
										    {
										    	echo " selected='selected'";	
										    }
										    echo ">CLOSED</option>";
											$iTimestamp = mktime(7,0,0,1,1,2011);
											for ($i = 1; $i < 36; $i++) 
											{
											    $time=date('H:i',$iTimestamp);
											    $time_am_pm=date('h:i a',$iTimestamp);
											    echo "<option value='$time'";
											    if($time==$row_seaford['sat_open'])
											    {
											    	echo " selected='selected'";	
											    }
											    echo ">$time_am_pm</option>";
											    $iTimestamp += 1800;
											}
										?>				
									</select>
								</td>
							</tr>
							<tr>
								<td>Saturday Closing Hours : </td>
								<td>
									<select name="sat_close">
										<?php
											echo "<option value='closed'";
										    if($row_seaford['sat_close']=="closed")
										    {
										    	echo " selected='selected'";	
										    }
										    echo ">CLOSED</option>";
											$iTimestamp = mktime(7,0,0,1,1,2011);
											for ($i = 1; $i < 36; $i++) 
											{
											    $time=date('H:i',$iTimestamp);
											    $time_am_pm=date('h:i a',$iTimestamp);
											    echo "<option value='$time'";
											    if($time==$row_seaford['sat_close'])
											    {
											    	echo " selected='selected'";	
											    }
											    echo ">$time_am_pm</option>";
											    $iTimestamp += 1800;
											}
										?>				
									</select>
								</td>
							</tr>
							<tr>
								<td>Sunday Opening Hours : </td>
								<td>
									<select name="sun_open">
										<?php
											echo "<option value='closed'";
										    if($row_seaford['sun_open']=="closed")
										    {
										    	echo " selected='selected'";	
										    }
										    echo ">CLOSED</option>";
											$iTimestamp = mktime(7,0,0,1,1,2011);
											for ($i = 1; $i < 36; $i++) 
											{
											    $time=date('H:i',$iTimestamp);
											    $time_am_pm=date('h:i a',$iTimestamp);
											    echo "<option value='$time'";
											    if($time==$row_seaford['sun_open'])
											    {
											    	echo " selected='selected'";	
											    }
											    echo ">$time_am_pm</option>";
											    $iTimestamp += 1800;
											}
										?>				
									</select>
								</td>
							</tr>
							<tr>
								<td>Sunday Closing Hours : </td>
								<td>
									<select name="sun_close">
										<?php
											echo "<option value='closed'";
										    if($row_seaford['sun_close']=="closed")
										    {
										    	echo " selected='selected'";	
										    }
										    echo ">CLOSED</option>";
											$iTimestamp = mktime(7,0,0,1,1,2011);
											for ($i = 1; $i < 36; $i++) 
											{
											    $time=date('H:i',$iTimestamp);
											    $time_am_pm=date('h:i a',$iTimestamp);
											    echo "<option value='$time'";
											    if($time==$row_seaford['sun_close'])
											    {
											    	echo " selected='selected'";	
											    }
											    echo ">$time_am_pm</option>";
											    $iTimestamp += 1800;
											}
										?>				
									</select>
								</td>
							</tr>
						</table>
						<input type="submit" value="Submit" class="button" />
					</form>
				</fieldset>
			</div>
		</div>
	</div>