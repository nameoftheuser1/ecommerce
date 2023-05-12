<?php

include('config/phpconnection.php');

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql ="DELETE FROM product WHERE product_id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        header('Location: product.php');

    }else{

        echo 'query error: ' . mysqli_error($conn);

    }
}

$product = NULL; // Initialize the $product variable to NULL

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM product WHERE product_id = $id";

    $result = mysqli_query($conn, $sql);

    $product = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}

?>
<!DOCTYPE html>

<html lang="en">
<?php include('templates/header.php'); ?>
<div class="cotainer-lg mx-5">
    <div class="display-5 text-center">Details</div>
    <div class="text-center m-5 p-5">
        <?php if ($product) : ?>

            <p> id : <?php echo htmlspecialchars($product['product_id']) ?></p>
            <h4><?php echo htmlspecialchars($product['product_name']) ?></h4>
            <p><?php echo htmlspecialchars($product['product_category']) ?></p>
            <p><?php echo htmlspecialchars($product['product_price']) ?></p>
            <p><?php echo htmlspecialchars($product['product_description']) ?></p>

            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $product['product_id']?>">
                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>

        <?php else : ?>
            <p>No product found.</p>
        <?php endif; ?>
    </div>
</div>
<?php include('templates/footer.php'); ?>

</html>