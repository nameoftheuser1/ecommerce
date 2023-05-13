<?php
include('config/phpconnection.php');

$sql = "SELECT * FROM `product`";

if (!$conn) {
    echo 'Connection Error : ' . mysqli_connect_error();
}

$result = mysqli_query($conn, $sql);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($conn);

?>
<!doctype html>
<html>
<?php include('templates/header.php'); ?>


<div class="container-lg">
    <div class="row justify-content-center">
        <?php foreach ($products as $product) { ?>
            <div class="d-block col-lg-4 m-2 pb-5 justify-content-center">
                <div class="card text-center" style="height: 250px; width: 400px;">
                    <img src="uploads\<?php echo htmlspecialchars($product['img_url']); ?>" class="card-img-top w=100" alt="..." height="250">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo htmlspecialchars($product['product_name']); ?>
                        </h5>
                        <p class="card-text">
                            <?php echo htmlspecialchars($product['product_description']); ?>
                        </p>
                        <a href="details.php?id=<?php echo $product['product_id'] ?>" class="btn btn-primary">More Info</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>

</html>
