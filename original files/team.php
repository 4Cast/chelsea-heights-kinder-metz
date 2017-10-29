<?php
	include_once 'include/header.php';
?>
	<div class="heading  box-shadow">
		<div class="row">
			<div class="large-12 medium-12 small-12 column">
				<h2>Meet The Rosebud Pet Vet Team</h2>
			</div>
		</div>
	</div>
	
	<div class="content-with-background staff">
		<div class="row white-background">
			<?php
				$staff_members=Staff::get_staff($connection);

				foreach($staff_members as $staff_member)
				{
					if($staff_member['image']!="")
					{
						$image="<img src='{$default_path}images/team/$staff_member[image]' />";
					}
					
					echo "
					<li class='row'>
						<div class='large-3 medium-3 small-12 column mugshot box-shadow-image'>
							$image
							<div class='name'>$staff_member[name]</div>
						</div>
						<div class='large-9 medium-9 small-12 column'>
							<div class='introduction'>$staff_member[introduction]</div>
							<div class='description'>$staff_member[description]</div>
						</div>
					</li>
					";
				}
			?>
		</div>
	</div>
<?php
	include_once 'include/footer.php';
?>