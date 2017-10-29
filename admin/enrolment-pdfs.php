<?php 
	include_once "header.php";
	
	$file_name=$_GET['type'];
?>
	<div class="main-content" id="staff">
      	<div class="row">		
			<div class="small-12 large-12 columns">
				<h1>Upload Enrolment PDFs</h1>
				<?php
					if($_SESSION['upload']['error']!="")
					{
						echo "<div class='error-class'>";
						echo $_SESSION['upload']['error'];
						echo "</div>";
					}
					else if($_SESSION['upload']['success']!="")
					{
						echo "<div class='success-class'>";
						echo $_SESSION['upload']['success'];
						echo "</div>";
					}
					unset($_SESSION['upload']);
				?>
				<fieldset>
					<legend><?php echo $file_name?> Year Old Enrolments</legend>
	      			<form id="upload-pdfs" method="post" enctype="multipart/form-data" action='<?php echo $default_path;?>admin/handle/enrolment-pdfs.php'>      	
	      				<fieldset>
	      					<legend><?php echo $file_name?> Year Old Kindergarten</legend>
      						<p class="download" id="p-spring">
		                        <a href="<?php echo $default_path;?>documents/<?php echo $file_name?>-Year-Old-Kindergarten" target="_blank">
		                        	<img width='48' src="<?php echo $default_path;?>images/icons/document_pdf.png" /> <?php echo $file_name?>-Year-Old-Kindergarten.pdf
		                        </a>
		                        <input type="hidden" name="id[]" value="<?php echo $file_name?>-Year-Old-Kindergarten" />
		                        <input type="file" name="file[]" />
		                    </p>
		                    <input class="button" id="submit-button" type="submit" value="Submit PDF" />
	      				</fieldset>
	      				
	                    <fieldset>
	      					<legend><?php echo $file_name?> Year Old Fees</legend>
		      				<p class="download" id="p-autumn">
		                        <a href="<?php echo $default_path;?>documents/<?php echo $file_name?>-Year-Old-Fees" target="_blank">
		                       		<img width='48' src="<?php echo $default_path;?>images/icons/document_pdf.png" /> <?php echo $file_name?>-Year-Old-Fees.pdf
		                       	</a>
		                        <input type="hidden" name="id[]" value="<?php echo $file_name?>-Year-Old-Fees" />
		                        <input type="file" name="file[]" />
		                    </p>
		                    <input class="button" id="submit-button" type="submit" value="Submit PDF" />
	                    </fieldset>
	                    
	                     <fieldset>
	      					<legend><?php echo $file_name?> YO Info Booklet</legend>
		      				<p class="download" id="p-winter">
		                        <a href="<?php echo $default_path;?>documents/<?php echo $file_name?>-Year-Old-Info-Booklet" target="_blank">
		                        	<img width='48' src="<?php echo $default_path;?>images/icons/document_pdf.png" /> <?php echo $file_name?>-Year-Old-Info-Booklet.pdf
		                        </a>
		                        <input type="hidden" name="id[]" value="<?php echo $file_name?>-Year-Old-Info-Booklet" />
		                        <input type="file" name="file[]" />
		                    </p>
		                    <input class="button" id="submit-button" type="submit" value="Submit PDF" />
	                    </fieldset>
					</form>
				</fieldset>
			</div>
		</div>
	</div>