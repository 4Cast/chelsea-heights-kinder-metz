<?php
	include_once "header.php";
	
	$sql="
		SELECT *
		FROM contacts
		ORDER BY id DESC
	";
	$query=$connection->query($sql);
	$enquiries=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row admin">
	<div class="large-12 small-12 columns">
		<h1>Online Enquiries <?php echo "(".count($enquiries).")";?></h1>
		<?php
			echo "
			<table>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Enquiry</th>
					<th>Signed up</th>
				</tr>
			";
			foreach($enquiries as $row)
			{
				echo "
					<tr>
						<td>$row[first_name] $row[last_name]</td>
						<td><a href='mailto:$row[email]'>$row[email]</a></td>
						<td>$row[comment]</td>
						<td>$row[date]</td>
					</tr>
				";
			}
			echo "</table>";
		?>
	</div>
</div>