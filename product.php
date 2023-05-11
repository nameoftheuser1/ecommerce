<?php

$productName = $productPrice = $productDescription = "";

$errors = array('product-name' => '', 'product-price' => '', 'product-description' => '');

if (isset($_POST['submit'])) {

    if (empty($_POST['product-name'])) {
        $errors['product-name'] = 'An product-name is required <br/>';
    } else {
        $productName = $_POST['product-name'];
        if (!preg_match("/^[a-zA-Z0-9\s_()&!,.'\"]+(?<!-)$/", $productName)) {
            $errors['product-name'] = 'Product name contains invalid characters <br/>';
        }
    }

    $productCategory = $_POST['product-category'];

    if (empty($_POST['product-price'])) {
        $errors['product-price'] = 'A product-price is required <br/>';
    } else {
        $productPrice = $_POST['product-price'];
    }

    if (empty($_POST['product-description'])) {
        $errors['product-description'] = 'A product description is required <br/>';
    } else {
        $productDescription = $_POST['product-description'];
        if (!preg_match("/^[a-zA-Z0-9\s_()&!,.'\"\n\r\-\•]+$/", $productDescription)) {
            $errors['product-description'] = 'Product description contains invalid characters <br/>';
        }
    }
}

include('phpconnection.php');

if (!$conn) {
    echo 'Connection Error : ' . mysqli_connect_error();
}

$sql = "SELECT * FROM `product`";

$result = mysqli_query($conn, $sql);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates\header.php'); ?>

<div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <form action="product.php" method="POST">

                <label for="product-name" class="form-label">Product Name</label>
                <div class="mb-4 input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-tree"></i>
                    </span>
                    <input type="name" class="form-control capitalize-first-letter" name="product-name" placeholder="Monobloc" style="text-transform: capitalize;" value="<?php echo htmlspecialchars($productName) ?>">
                    <span class="input-group-text">
                        <span class="tt" data-bs-placement="bottom" title="input the Product Name">
                            <i class="fa-regular fa-circle-question"></i>
                        </span>
                    </span>
                </div>
                <div class="text-danger"><?php echo $errors['product-name'] ?></div>

                <select id="subject" class="form-select" name="product-category">
                    <option value="bed">Bed</option>
                    <option value="cabinet">Cabinet</option>
                    <option value="chair">Chair</option>
                    <option value="coffee-table">Coffee Table</option>
                </select>

                <label for="product-price" class="form-label">Product Price</label>
                <div class="mb-4 input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-peso-sign"></i>
                    </span>
                    <input type="number" class="form-control" name="product-price" placeholder="99.99" value="<?php echo htmlspecialchars($productPrice) ?>">
                    <span class="input-group-text">
                        <span class="tt" data-bs-placement="bottom" title="input the price of the item">
                            <i class="fa-regular fa-circle-question"></i>
                        </span>
                    </span>
                </div>
                <div class="text-danger"><?php echo $errors['product-price'] ?></div>

                <label for="product-description" class="form-label mt-2">Product Description</label>
                <textarea name="product-description" class="form-control" style="height: 140px;"><?php echo htmlspecialchars($productDescription) ?></textarea>
                <div class="text-danger"><?php echo $errors['product-description'] ?></div>

                <div class="mt-4 mb-4 text-center">
                    <input type="submit" name="submit" value="Submit" class="btn btn-danger">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-lg">
    <div class="row justify-content-center">
        <?php foreach ($products as $product) { ?>
            <div class="col-md-3 col-lg-5">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo htmlspecialchars($product['product_name']); ?>
                        </h5>
                        <p class="card-text">
                            <?php echo htmlspecialchars($product['product_description']); ?>
                        </p>
                        <a href="#" class="btn btn-primary">More Info</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<?php include('templates/footer.php'); ?>

</html>