<?php
// Bu projede XAMPP Server kullandım

require "controllers/ProductsController.php";
require "models/ProductsModel.php";
require "config.php";

$data = ProductsController::listAll();

if (isset($_GET["del"])) {
    ProductsController::deleteProduct($_GET["del"]);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stok Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link href="styles/main.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php require "partials/navbar.php" ?>

    <!-- Content -->
    <div class="container">
        <h1 class="py-4">Mevcut Ürün Stokları</h1>
        <div class="col-12">
            <div class="row">
                <?php foreach ($data as $product) { ?>
                    <div class="col-4 py-3">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h4 class="text-center text-danger"><?= $product['product_name'] ?></h4>
                            </div>

                            <!-- Product attributes & values -->

                            <div class="card-body" id="cardBody">
                                <form onsubmit="return false">
                                    <ul>
                                        <li>
                                            <h4>
                                                <strong class="text-danger">Ürün ID:</strong>
                                                <?= $product['id'] ?>
                                            </h4>
                                        </li>

                                        <li>
                                            <h4>
                                                <strong class="text-danger">Fiyat:</strong>
                                                <?= $product['product_price'] ?>₺
                                            </h4>
                                        </li>

                                        <li>
                                            <h4>
                                                <strong class="text-danger">Stok:</strong>
                                                <?= $product['product_quantity'] ?>
                                                <small>adet</small>
                                            </h4>
                                        </li>
                                    </ul>

                                    <div class="d-flex justify-content-center mt-4">
                                        <button class="btn btn-danger" id="del-btn">
                                            <a href="index.php?del=<?= $product['id'] ?>" class="text-white">Ürünü Sil</a>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>