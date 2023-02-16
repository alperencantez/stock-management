<?php
error_reporting(E_ALL);

class ProductsController
{
    static public function listAll()
    {
        $ProductModel = new ProductModel();
        $data = $ProductModel->getAllProducts();

        return $data;
    }

    static public function addProduct($REQ_DATA)
    {
        $name = strtoupper($REQ_DATA["name"]);
        $price = $REQ_DATA["price"];
        $quantity = $REQ_DATA["quantity"];

        $ProductModel = new ProductModel();

        try {
            $ProductModel->addProduct($name, $price, $quantity);
            return true;
        } catch (PDOException $e) {
            // echo $e;
            return false;
        }
    }

    static public function deleteProduct($product_id)
    {
        $ProductModel = new ProductModel();

        try {
            $ProductModel->deleteProduct($product_id);
            header("Location: index.php");
        } catch (PDOException $e) {
            // echo $e;
            return false;
        }
    }

    static public function getOneProduct($product_id)
    {
        $ProductModel = new ProductModel();
        $ProductModel->getOneProduct($product_id);
    }

    static public function updateProduct($newValues)
    {
        $ProductModel = new ProductModel();
        $ProductModel->editProduct($newValues);
    }

}