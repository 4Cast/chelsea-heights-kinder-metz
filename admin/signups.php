<?php
	include_once "header.php";
	
	$sql="
		SELECT *
		FROM subscriptions
		ORDER BY id DESC
	";
	$query=$connection->query($sql);
	$subscriptions=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row admin">
	<div class="large-12 small-12 columns">
		<h1>Subscriptions <?php echo "(".count($subscriptions).")";?></h1>
		<?php
			echo "
			<table>
				<tr>
					<th>Email</th>
					<th>Signed up</th>
				</tr>
			";
			foreach($subscriptions as $row)
			{
				echo "
					<tr>
						<td>$row[email]</td>
						<td>$row[created]</td>
					</tr>
				";
			}
			echo "</table>";
		?>
	</div>
</div>