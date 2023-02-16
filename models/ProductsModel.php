<?php
class ProductModel
{
    public PDO $db;
    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . HOST . ';dbname=' . DB_NAME, USERNAME, PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM products";
        $query = $this->db->query($sql);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOneProduct($id)
    {
        $sql = $this->db->prepare("SELECT product_name, product_price, product_quantity FROM products WHERE id=?");
        $query = $sql->execute([intval($id)]);

        return $query;
    }

    public function addProduct($name, $price, $quantity)
    {
        $sql = $this->db->prepare("INSERT INTO products SET product_name=?, product_price=?, product_quantity=?");
        $query = $sql->execute([$name, $price, $quantity]);

        return $query;
    }

    public function deleteProduct($id)
    {
        $sql = $this->db->prepare("DELETE FROM products WHERE id=?");
        $query = $sql->execute([intval($id)]);

        return $query;
    }

    public function editProduct($newValues)
    {
        $sql = $this->db->prepare("UPDATE products SET product_name=?, product_price=?, product_quantity=? WHERE id=?");
        $query = $sql->execute([$newValues[1], $newValues[2], $newValues[3], intval($newValues[0])]);

        return $query;
    }
}