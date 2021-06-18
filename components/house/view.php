<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/houserental/";

require_once($path . 'connect.php');

// Initialize the session
session_start();

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['type'] == 'admin')) {
	echo "Unauthorized Access";
	return;
}

$ReadSql = "SELECT * FROM `houses`";
$res = mysqli_query($connection, $ReadSql);

?>

<?php require($path . 'templates/header.php') ?>
<div class="container-fluid my-4">
	<div class="row my-2">
		<h2>House Rental Management System - Houses</h2>
		<a href="add.php"><button type="button" class="btn btn-primary ml-4 pl-2">Add New</button></a>
	</div>
	<table class="table ">
		<thead>
			<tr>
				<th>SN</th>
				<th>Location</th>
				<th>Price</th>
				<th>Description</th>
				<th>Owner</th>
				<th>Date Added</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($r = mysqli_fetch_assoc($res)) {
			?>
				<tr>
					<th scope="row"><?php echo $r['id']; ?></th>
					<td><?php echo $r['location']; ?></td>
					<td><?php echo $r['price']; ?></td>
					<td><?php echo $r['description']; ?></td>
					<td><?php echo $r['owner']; ?></td>
					<td><?php
						$date = new DateTime($r['date_added']);
						echo $date->format('Y-m-d');
						?>
					</td>

					<td>
						<a href="update.php?id=<?php echo $r['id']; ?>"><button type="button" class="btn btn-info">Edit</button></a>

						<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $r['id']; ?>">Delete</button>

						<!-- Modal -->
						<div class="modal fade" id="myModal<?php echo $r['id']; ?>" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Delete House</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>Are you sure?</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										<a href="delete.php?id=<?php echo $r['id']; ?>"><button type="button" class="btn btn-danger"> Yes, Delete</button></a>
									</div>
								</div>

							</div>
						</div>

					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>



<?php require($path . 'templates/footer.php') ?>