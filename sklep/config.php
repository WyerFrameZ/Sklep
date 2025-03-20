<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sklep";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}


if (isset($_POST['delete_product'])) {
    $product_id = intval($_POST['product_id']);
    $conn->query("DELETE FROM produkty WHERE id = $product_id");
    header("Location: ".$_SERVER['PHP_SELF']); // Odświeżenie strony po usunięciu
    exit();
}

?>
