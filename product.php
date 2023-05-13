<?php

$productName = $productPrice = $productDescription = "";

$errors = array('product-name' => '', 'product-price' => '', 'product-description' => '', 'my-image' => '');

if (isset($_POST['submit'])) {


    $img_name = $_FILES['my-image']['name'];
    $img_size = $_FILES['my-image']['size'];
    $img_type = $_FILES['my-image']['type'];
    $tmp_name = $_FILES['my-image']['tmp_name'];
    $error = $_FILES['my-image']['error'];

    if (empty($_POST['my-image'])) {
        if ($img_size > 3145728) {
            $errors['my-image'] = 'Image size must be less than 3mb';
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "png", "jpeg");
            if (in_array($img_ex, $allowed_exs)) {
                $new_img_name = uniqid("IMG", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            } else {
                $errors['my-image'] = 'There must be a valid image';
            }
        }
    }

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

    // If there are no errors, try to insert the data into the database
    if (array_filter($errors)) {
        echo 'Please fix the errors in the form';
    } else {
        include('config/phpconnection.php');

        if (!$conn) {
            echo 'Connection Error : ' . mysqli_connect_error();
        }

        $productName = mysqli_real_escape_string($conn, $_POST['product-name']);
        $productCategory = mysqli_real_escape_string($conn, $_POST['product-category']);
        $productPrice = mysqli_real_escape_string($conn, $_POST['product-price']);
        $productDescription = mysqli_real_escape_string($conn, $_POST['product-description']);

        $sqlinsert = "INSERT INTO `product` (product_name, product_category, product_price, product_description, img_url) VALUES ('$productName', '$productCategory', '$productPrice', '$productDescription', '$new_img_name')";

        if (mysqli_query($conn, $sqlinsert)) {
            echo 'Product added successfully!';
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}

include('config/phpconnection.php');

$sql = "SELECT * FROM `product`";

if (!$conn) {
    echo 'Connection Error : ' . mysqli_connect_error();
}

$result = mysqli_query($conn, $sql);

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
<?php include('templates\header.php'); ?>

<div class="container-lg mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="display-5 text-center mb-5">ADD PRODUCT</div>
        <div class="col-md-5">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

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

                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Image</label>
                    <input name="my-image" class="form-control" type="file" id="formFile" accept="image/png, image/jpeg, image/jpg">
                </div>
                <div class="text-danger"><?php echo $errors['my-image'] ?></div>


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