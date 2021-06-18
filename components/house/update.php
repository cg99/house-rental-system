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

$id = $_GET['id'];

$SelSql = "SELECT * FROM `houses` WHERE id=$id";
$res = mysqli_query($connection, $SelSql);
$r = mysqli_fetch_assoc($res);


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
	$query = "UPDATE `houses` 
	SET location='$location',
		price='$price',
		description='$description',
		owner='$owner',
		image='$image'
	WHERE id='$id'";

	$res = mysqli_query($connection, $query); // get result
	if ($res) {
		header('location: view.php');
	} else {
		$fmsg = "Failed to Insert data.";
		// print_r($res);
	}
}
?>

<?php require_once($path . 'templates/header.php') ?>

<div class="container">
	<?php if (isset($fmsg)) { ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>

	<h2 class="my-4">Update Subject</h2>
	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Location</label>
			<input type="text" class="form-control" name="location" value="<?php echo $r['location']; ?>" required />
		</div>
		<div class="form-group">
			<label>Price</label>
			<input type="text" class="form-control" name="price" value="<?php echo $r['price']; ?>" required />
		</div>
		<div class="form-group">
			<label>Description</label>
			<input type="text" class="form-control" name="description" value="<?php echo $r['description']; ?>" required />
		</div>
		<div class="form-group">
			<label>Owner</label>
			<input type="text" class="form-control" name="owner" value="<?php echo $r['owner']; ?>" required />
		</div>
		<div class="form-group">
			<label>Image</label>
			<input type="file" class="form-control-file" name="image" accept=".png,.gif,.jpg,.webp" required />
		</div>

		<input type="submit" class="btn btn-primary" value="Update" />
	</form>
</div>

<?php require_once($path . 'templates/footer.php') ?>