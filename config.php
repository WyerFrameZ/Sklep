<?php

if (getenv('DOCKER_ENV') === 'true') {
    $servername = "db"; 
    $username = "root";
    $password = "ZSKZSKZSK";
    $dbname = "sklep";
} else {
    $servername = "localhost:3307";
    $username = "root";
    $password = "ZSKZSKZSK";
    $dbname = "sklep";
}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

$conn->set_charset("utf8");

if (isset($_POST['delete_product'])) {
    $product_id = intval($_POST['product_id']);
    $conn->query("DELETE FROM produkty WHERE id = $product_id");
    header("Location: ".$_SERVER['PHP_SELF']); 
    exit();
}
?>
