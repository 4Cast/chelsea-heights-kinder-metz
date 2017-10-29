<?php
	include_once 'include/header.php';
?>
	<div class="content-with-background contact box-shadow" id="contact-image">
		<div class="row">
			<img src="images/contact/Image_ContactUs.png" class="large-12 medium-12 small-12 columns" />
		</div>
	</div>
	
	<div class="contact white-background" id="contact-block">
		<div class="row">
			<div class="large-12 medium-12 small-12 columns">
				<h2>Contact us or submit your enquiry below</h2>
				<p><strong>Address:</strong> <?php echo ADDRESS;?></p>
				<p><strong>Phone:</strong> <?php echo "<a href='tel:+61$phone_numebr'>$fomatted_phone_numebr</a>";?> <strong>Email:</strong> <a href="mailto:<?php echo EMAIL_TO;?>"><?php echo EMAIL_TO;?></a></p>
				
			</div>
		</div>
	</div>
	
	<div class="content-with-background contact box-shadow" id="contact-form">
		<div class="row">
			<div class="large-6 medium-6 small-12 column">
			
				<h2>Enquiry Form</h2>
				<div id="contact-form-div" class="box-shadow">
					<?php 
						if($_SESSION['update']!="")
						{
							echo "<div class='success-class'>";
							if($_SESSION['update'])
							{
								echo "Thank you for your message, we will contact you shortly!";
							}
							echo "</div>";
							
							unset($_SESSION['update']);
						}
					?>
					<form action="handle/contact.php" method="post">
						<span>Contact Name</span>
						<input type="text" name="name" id="name" value="<?php echo $_SESSION['contact']['name'];?>" class="<?php echo is_error($_SESSION['contact']['error'],"empty_name");?>"  />
						
						<span>Phone</span>
						<input type="text" name="phone" id="phone" value="<?php echo $_SESSION['contact']['phone'];?>" />
						
						<span>Email</span>
						<input type="text" name="email" id="email" value="<?php echo $_SESSION['contact']['email'];?>" class="<?php echo is_error($_SESSION['contact']['error'],"empty_email")." ".is_error($_SESSION['contact']['error'],"invalid_email");?>" />
						
						<span>Message</span>
						<textarea rows="" cols="" name="comment" id="comment" class="<?php echo is_error($_SESSION['contact']['error'],"empty_comment");?>"><?php echo $_SESSION['contact']['comment'];?></textarea>
						
						<span>Enter characters shown*</span>
						<div id="security-code-div" class="row">
							<img class="columns large-4 medium-4 small-4" src="<?php echo $default_path;?>include/CaptchaSecurityImages.php?width=100&height=40&characters=5" />
							<input class="<?php echo is_error($_SESSION['contact']['error'],"empty_security_code")." ".is_error($_SESSION['contact']['error'],"invalid_security_code");?>" columns large-3 medium-3 small-3" id="security_code" name="security_code" type="text" />
							<input type="image" src="images/contact/Button_Submit.png" class="roll-over columns large-5 medium-5 small-5" />
						</div>
					</form>
				</div>
			</div>
			
			<div class="large-6 medium-6 small-12 column">
				<h2>Location</h2>
				<div id="google-map">
					<div class="google-maps">
						<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=<?php echo GOOGLE_MAPS_EMBED_API_KEY?>&q=<?php echo str_ireplace(" ","+",ADDRESS);?>" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php
	include_once 'include/footer.php';
?>