<?php
ob_start();
include __DIR__ . '/views/client/templates/encabezado.php';
$datosProductos = $producto->consultaEconomico();
// $productos = $cliente->selecionarProducto();
$categoriasMomento = $categoria->CategoriaMomento();
?>
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="/LicoreriaProject/views/client/assets/img/imagesLogo-removebg-preview.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>Viña</b>Nueva</h1>
                            <h3 class="h2">Los Mejores Licores del Perú</h3>
                            <p>
                                Viña NUeva es una Licoreria que produce sus propios licores, tenemos variedad de productos
                                Tenemos diferentes categorias de licores, al mejor calidad y precio
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="/LicoreriaProject/views/client/assets/img/banner_img_02.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Expertos en Vinos</h1>
                            <h3 class="h2">Ven a probar nuestros Vinos!</h3>
                            <p>
                                Somos una de las licorerias del Perú que produce el mejor vino del pais, ven y compruebalo tu mismo en nuestra localidad
                                <a href="#" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Viña Nueva Location</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="/LicoreriaProject/views/client/assets/img/banner_img_03.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Ubicanos Aqui!</h1>
                            <h3 class="h2">Direccion </h3>
                            <p>
                                Ubicanos en nuestra viña que se ubica en Pocollay-Tacna
                                <a href="#" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Viña Nueva Location</a>
                                Ven y disfruta de todas las actividades que tenemos para nuestros clientes
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Categorias del Momento</h1>
            <p>
                Estas son una de las categorias mas pedidas de este mes!
            </p>
        </div>
    </div>
    <div class="row">
        <?php foreach ($categoriasMomento as $catMomento) { ?>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="views/admin/<?php echo $catMomento["imagen"] ?>" class="rounded-circle img-fluid border w-100"></a>
                <h5 class="text-center mt-3 mb-3"><?php echo $catMomento["NomCat"] ?></h5>
                <p class="text-center"><a class="btn btn-success">Comprar ahora!</a></p>
            </div>
        <?php } ?>
        <!-- <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="./assets/img/category_img_02.jpg" class="rounded-circle img-fluid border"></a>
            <h2 class="h5 text-center mt-3 mb-3">Piscos</h2>
            <p class="text-center"><a class="btn btn-success">Comprar ahora!</a></p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="./assets/img/category_img_03.jpg" class="rounded-circle img-fluid border"></a>
            <h2 class="h5 text-center mt-3 mb-3">Macerados</h2>
            <p class="text-center"><a class="btn btn-success">Comprar ahora!</a></p>
        </div> -->
    </div>
</section>
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Lo mas economico!</h1>
                <p>
                    Estos son los productos mas economicos que y que tienen buen sabor!
                </p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($datosProductos as $producto) { ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="views/client/shop-single.php?id=<?php echo $producto["idProduct"] ?>">
                            <img src="/LicoreriaProject/views/admin/<?php echo $producto["imagen"] ?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">Precio: <?php echo $producto["precio"] ?></li>
                            </ul>
                            <a href="shop-single.html" class="h2 text-decoration-none text-dark"><?php echo $producto["NombreProduct"] ?></a>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt in culpa qui officia deserunt.
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="shop-single.html">
                        <img src="./assets/img/feature_prod_02.jpg" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                            </li>
                            <li class="text-muted text-right">$480.00</li>
                        </ul>
                        <a href="shop-single.html" class="h2 text-decoration-none text-dark">Cloud Nike Shoes</a>
                        <p class="card-text">
                            Aenean gravida dignissim finibus. Nullam ipsum diam, posuere vitae pharetra sed, commodo ullamcorper.
                        </p>
                        <p class="text-muted">Reviews (48)</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="shop-single.html">
                        <img src="./assets/img/feature_prod_03.jpg" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                            </li>
                            <li class="text-muted text-right">$360.00</li>
                        </ul>
                        <a href="shop-single.html" class="h2 text-decoration-none text-dark">Summer Addides Shoes</a>
                        <p class="card-text">
                            Curabitur ac mi sit amet diam luctus porta. Phasellus pulvinar sagittis diam, et scelerisque ipsum lobortis nec.
                        </p>
                        <p class="text-muted">Reviews (74)</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- End Featured Product -->
<?php
include './views/client/templates/footer.php';
ob_end_flush();
?>