<?php
// Include config file
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/houserental/";
require_once($path . 'connect.php');

// Initialize the session
session_start();

if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
    $url = 'http://' . $_SERVER['HTTP_HOST']; // Get server
    $url .= "/houserental/components/user/login.php";
    header('Location: ' . $url, TRUE, 302);
}

?>
<?php require($path . 'templates/header.php') ?>
<div class="d-flex mt-4 mx-4">
    <h3>Search Results: </h3>
    <div class="row mt-4 pt-4 justify-content-between">
        <?php
        if (!empty($_REQUEST['term'])) {

            $term = mysqli_real_escape_string($connection, $_REQUEST['term']);

            $sql = "SELECT * FROM houses WHERE location LIKE '%" . $term . "%'";
            $r_query = mysqli_query($connection, $sql);

            while ($r = mysqli_fetch_array($r_query)) {
                include($path . 'templates/house.php');
            }
        }
        ?>
    </div>
</div>

<?php require($path . 'templates/footer.php') ?>