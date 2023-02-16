<?php
require "controllers/ProductsController.php";
require "models/ProductsModel.php";
require "config.php";

$err_message = null;
$success_message = null;

if ($_POST) {
    foreach ($_POST as $prop) {
        if (empty($prop)) {
            $err_message = "Gerekli alanlar doldurulmamış!";
            break;
        }
    }

    if ($err_message == null) {
        $result = ProductsController::addProduct($_POST);

        if (!$result) {
            $err_message = "Bir sorun oluştu";
        } else {
            $success_message = "Ürün kaydınız başarılı";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="styles/main.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <?php require "partials/navbar.php" ?>

    <div class="container">
        <div class="row" style="height: 70vh">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                    class="d-flex flex-column gap-4 w-50 mx-auto">
                    <h1 class="py-4 text-center">Bir Ürün Ekleyin</h1>
                    <div class="form-group">
                        <label for="name" class="h4">Ürün İsmi</label>
                        <input type="text" class="form-control" name="name" id="name" required />
                    </div>

                    <div class="form-group">
                        <label for="price" class="h4">Ürün Fiyatı</label>
                        <input type="number" step="0.1" class="form-control" name="price" id="price" required />
                    </div>

                    <div class="form-group">
                        <label for="quantity" class="h4">Ürün Stok Adeti</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" required />
                    </div>

                    <button class="btn btn-primary w-50 mx-auto" type="submit">
                        <h4>Bu Ürünü Ekle</h4>
                    </button>


                    <h3 class="<?= $err_message == null ? 'text-success' : 'text-danger' ?> text-center">
                        <?= $err_message ?>
                        <?= $success_message ?>
                    </h3>
                </form>
            </div>
        </div>
    </div>
</body>


</html>