<?php 
	include_once "header.php";
?>
	<div class="main-content" id="files">
      	<div class="row">		
			<div class="small-12 large-12 columns">
				<h1>Upload Files (PDF, docx....)</h1>
				<fieldset>
	      			<form id="upload-files" method="post" enctype="multipart/form-data" action='<?php echo $default_path;?>admin/handle/upload-files.php'>      	
	      				<fieldset>
	      					<legend>Upload file</legend>
      						<p class="download">
		                        <input type="text" name="title" id="title" placeholder="File Title" />
		                        <input type="file" name="file" id="file" />
		                    </p>
		                    <input class="button" id="submit-button" type="submit" value="Submit File" />
	      				</fieldset>
	      				
	      				<fieldset>
	      					<legend>Uploaded files</legend>
	      					<ul>
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
								
	      						$sql="
									SELECT *
									FROM documents
									WHERE identifier NOT IN 
									(
										'3-Year-Old-Kindergarten',
										'3-Year-Old-Fees',
										'3-Year-Old-Info-Booklet',
										'4-Year-Old-Kindergarten',
										'4-Year-Old-Fees',
										'4-Year-Old-Info-Booklet'
									)
									ORDER BY id DESC
								";
								$query=$connection->query($sql);
								$rows=$query->fetchAll(PDO::FETCH_ASSOC);
								//print_r_html($rows);
					
								foreach($rows as $row)
								{
									$identifier=$row['identifier'];
									$filename=$row['filename'];
									$url="http://".$_SERVER['HTTP_HOST']."/documents/$identifier";
									
									echo "
									<li>
										<a href='$url' target='_blank'>
				                        	<img width='40' src='{$default_path}images/icons/document_pdf.png' /> $url
				                        </a>
				                        
				                        <a class='pull-right delete' href='delete-upload-file.php?id=$row[id]'><img src='{$default_path}images/icons/no.png' />  Delete Item</a>
									</li>
									";
								}
	      					?>
	      					</ul>
	      				</fieldset>
					</form>
				</fieldset>
			</div>
		</div>
	</div>