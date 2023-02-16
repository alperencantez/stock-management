<?php
require "controllers/ProductsController.php";
require "models/ProductsModel.php";
require "config.php";

$data = ProductsController::listAll();
$selectedProduct = null;

$err_message = null;
$success_message = null;

if (isset($_GET["product_id"])) {
    foreach ($data as $product) {
        if ($product["id"] == $_GET["product_id"]) {
            $selectedProduct = $product;
        }
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedValues = [$_POST["id"], $_POST["name"], $_POST["price"], $_POST["quantity"]];
    foreach ($updatedValues as $value) {
        if (empty($value)) {
            $err_message = "Alanlar boş bırakılamaz";
            break;
        }
    }

    if ($err_message == null) {
        ProductsController::updateProduct($updatedValues);
        $success_message = "Güncelleme başarılı!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="styles/main.css" rel="stylesheet">
</head>

<body>
    <?php require "partials/navbar.php" ?>

    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <h1 class="text-center py-3">Ürünlerinizi Düzenleyin</h1>

                <div class="form-group text-center mt-5">
                    <label for="product_id">
                        <h4>Düzenlemek istediğiniz ürünü seçin</h4>
                    </label>
                    <br>

                    <div class="d-flex mx-auto mt-3 gap-4 w-25 align-items-center justify-content-center">
                        <select name="product_id" id="product_id" class="form-control ">
                            <?php foreach ($data as $product) { ?>
                                <option value="<?= $product['id'] ?>"> <?= $product["product_name"] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <button class="btn btn-primary">
                            SEÇ
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <?php if ($selectedProduct !== null) { ?>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">İSİM</th>
                        <th scope="col">FİYAT</th>
                        <th scope="col">STOK ADETİ</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <tr>
                            <th scope="row"><?= $selectedProduct['id'] ?></th>
                            <input type="hidden" name="id" value=<?= $selectedProduct['id'] ?>>
                            <td>
                                <input type="text" name="name" class="form-control"
                                    value="<?= $selectedProduct['product_name'] ?>">
                            </td>

                            <td>
                                <input type="number" name="price" step="0.01" class="form-control"
                                    value="<?= $selectedProduct['product_price'] ?>">
                            </td>

                            <td>
                                <input type="number" name="quantity" class="form-control"
                                    value="<?= $selectedProduct['product_quantity'] ?>">
                            </td>

                            <td>
                                <button class="btn btn-primary">Güncelle</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        <?php } ?>

        <h3 class="<?= $err_message == null ? 'text-success' : 'text-danger' ?> text-center  mt-4">
            <?= $err_message ?>
            <?= $success_message ?>
        </h3>
    </div>
</body>

</html>