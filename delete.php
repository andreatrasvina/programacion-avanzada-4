<?php
session_start();
include_once("app/ProductController.php");

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $productController = new ProductController();
    $productController->deleteProduct($productId);

    header("Location: home.php?status=deleted");
} else {
    header("Location: home.php?status=error");
}
?>
