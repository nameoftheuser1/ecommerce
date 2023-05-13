<?php

?>
<!doctype html>
<html lang="en">

<?php include('templates/header.php'); ?>

<section>
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-md-12 ">
                <div class="display-5 text-bolder text-center my-5">Welcome to Woodmart</div>

            </div>
        </div>
    </div>
    <div style="align-items: center;">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2000">
                    <img src="assets\images (4).jpeg" class="d-block w-100" alt="assets\images (4).jpeg" width="400px" height="650px">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="assets\images (7).jpeg" class="d-block w-100" alt="assets\images (7).jpeg" width="400px" height="650px">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="assets\images (3).jpeg" class="d-block w-100" alt="assets\images (3).jpeg" width="400px" height="650px">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

</section>

<br>


<section id="about" class="my-5">

    <div class="container-lg">
        <div class="display-5 text-center ">About Us</div>

        <div class="row justify-content-start">
            <div class="col-lg-8">
                <br><br>
                Woodmart Furnitures is one of the leading suppliers of
                high quality furniture in Batangas. We are a pioneer in
                the industry offering the market greater choice, innovative
                and ergonomic designs as well as environmentally
                friendly furniture.
                Since Our humble inception in 2023, the group has grown
                from strength to strength. Woodmart Furnitures started
                its establishment on Balayan Batangas. From the very beginning,
                the group has focused on its core principles of customer
                service, quality, value for money and innovation, and it is
                these principles that have enabled the group to gain the
                trust of customers

            </div>
            <div class="col-lg-4">
                <img src="assets\logo (2).png" class="img-fluid rounded-circle" alt="assets\logo (2).png" width="300px" height="300px">
            </div>
        </div>

    </div>  

</section>

<section id="contact" class="my-5">
    <div class="container-lg">
        <div class="display-5 text-center my-5">
            Contact Us
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="assets\PicsArt_05-13-07.40.19.jpg" class="card-img-top" alt="assets\PicsArt_05-13-07.40.19.jpg">
                    <div class="card-body">
                        <h5 class="card-title">France Joseph Cabral</h5>
                        <a href="#" class="btn btn-primary"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>

            </div>
            <div class="col-md-3">

                <div class="card" style="width: 18rem;">
                    <img src="assets\jeven.jpg" class="card-img-top" alt="assets\jeven.jpg">
                    <div class="card-body">
                        <h5 class="card-title">John Vincent Eguia</h5>
                        <a href="#" class="btn btn-primary"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <div class="card" style="width: 18rem;">
                    <img src="assets\PicsArt_05-13-07.35.38.jpg" class="card-img-top" alt="assets\PicsArt_05-13-07.35.38.jpg">
                    <div class="card-body">
                        <h5 class="card-title">Jewerly Mariz Catapang</h5>
                        <a href="#" class="btn btn-primary"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img src="assets\PicsArt_05-13-08.03.42.jpg" class="card-img-top" alt="assets\PicsArt_05-13-08.03.42.jpg">
                    <div class="card-body">
                        <h5 class="card-title">Angelo Posadas</h5>
                        <a href="#" class="btn btn-primary"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>



</section>
<?php include('templates/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</html>