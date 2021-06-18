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

if (isset($_POST) & !empty($_POST)) {
	$location = ($_POST['location']);
	$price = ($_POST['price']);
	$description = ($_POST['description']);
	$owner = ($_POST['owner']);


	// store n upload image
	$image = $_FILES['image']['name'];
	$dir = $path . "img/house/";
	$temp_name = $_FILES['image']['tmp_name'];
	if ($image != "") {
		if (file_exists($dir . $image)) {
			$image = time() . '_' . $image;
		}
		$fdir = $dir . $image;
		move_uploaded_file($temp_name, $fdir);
	}


	// Execute query
	$query = "INSERT INTO `houses` (location, price, description, image) VALUES ('$location', '$price', '$description', '$image')";
	$res = mysqli_query($connection, $query);
	if ($res) {
		header('location: view.php');
	} else {
		$fmsg = "Failed to Insert data.";
		print_r($res);
		// print_r($res->error_list);
	}
}
?>

<?php require_once($path . 'templates/header.php') ?>

<div class="container">
	<?php if (isset($fmsg)) { ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
	<h2 class="my-4">Add New House</h2>

	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Location</label>
			<input type="text" class="form-control" name="location" value="" required />
		</div>
		<div class="form-group">
			<label>Price</label>
			<input type="text" class="form-control" name="price" value="" required />
		</div>
		<div class="form-group">
			<label>Description</label>
			<textarea type="text" class="form-control" name="description" value="" required></textarea>
		</div>
		<div class="form-group">
			<label>Owner</label>
			<textarea type="text" class="form-control" name="owner" value="" required></textarea>
		</div>
		<div class="form-group">
			<label>Image</label>
			<input type="file" class="form-control-file" name="image" accept=".png,.gif,.jpg,.webp" required />
		</div>
		<input type="submit" class="btn btn-primary" value="Add House" />
	</form>


</div>

<?php require_once($path . 'templates/footer.php') ?>