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

$ReadSql = "SELECT DISTINCT 
	records.id as id,
	houses.id as houseId,
	houses.location as location,
	houses.price as price,
	users.name as name
	FROM records
	JOIN houses
	ON records.house_id = houses.id
	JOIN users
	ON records.user_id = users.id";

$res = mysqli_query($connection, $ReadSql);

?>

<?php require($path . 'templates/header.php') ?>
<div class="container-fluid my-4">
	<div class="row my-2">
		<h2>House Rental Management System - Rent Records</h2>
	</div>
	<table class="table ">
		<thead>
			<tr>
				<th>ID</th>
				<th>Rented By</th>
				<th>House ID</th>
				<th>Location</th>
				<th>Price</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($r = mysqli_fetch_assoc($res)) {
			?>
				<tr>
					<th scope="row"><?php echo $r['id']; ?></th>
					<td><?php echo $r['name']; ?></td>
					<td><?php echo $r['houseId']; ?></td>
					<td><?php echo $r['location']; ?></td>
					<td><?php echo $r['price']; ?></td>

					<td>
						<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $r['id']; ?>">Delete</button>

						<!-- Modal -->
						<div class="modal fade" id="myModal<?php echo $r['id']; ?>" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Delete Record</h5>
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