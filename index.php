<!--
<?php /*
include('phpconnection.php');

if(!$conn){
    echo 'Connection Error : '.mysqli_connect_error();
}

$sql = "SELECT * FROM `product`";

$result = mysqli_query($conn, $sql);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

print_r($products)
*/
?>
-->
<html lang="en">

    <?php include('templates/header.php'); ?>

    <div class="container-lg">
        <div class="row "></div>
    </div>


    <?php include('templates/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</html>