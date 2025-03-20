<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

if (isset($_POST['remove_from_cart']) && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    if (($key = array_search($product_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); 
    }
}

if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = [];
if (!empty($_SESSION['cart'])) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $sql = "SELECT * FROM produkty WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $types = str_repeat('i', count($_SESSION['cart']));
        $stmt->bind_param($types, ...$_SESSION['cart']);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        
        $stmt->close();
    }
}

$total = 0;
foreach ($products as $product) {
    $total += $product['cena'];
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk</title>
    <link rel="stylesheet" href="css/ogolny.css">
    <link rel="stylesheet" href="css/sklep.css">
    <style>
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .cart-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }
        
        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }
        
        .cart-summary {
            margin-top: 30px;
            text-align: right;
        }
        
        .cart-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        .empty-cart {
            text-align: center;
            margin: 50px 0;
            color: #888;
        }
    </style>
</head>
<body>

    <section class="navbar">
        <section class="start">
            <a href="sklep.php" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                <img src="img/ruby.svg" alt="Logo sklepu">
                <h1 class="dwa">Sklep</h1>
            </a>
        </section>

        <section class="navbar">
            <section class="end">
                <?php 
                    $username = $_SESSION['user'];
                ?>

                Witaj, <b><?= $username; ?></b>
                <form method="POST" style="display:inline;">
                    <button type="submit" name="logout">Wyloguj</button>
                </form>
                <a href="sklep.php" class="btn">Wróć do sklepu</a>
            </section>
        </section>
    </section>

    <div class="cart-container">
        <h2>Twój koszyk</h2>
        
        <?php if (empty($products)): ?>
            <div class="empty-cart">
                <h3>Twój koszyk jest pusty</h3>
                <p>Wróć do sklepu, aby dodać produkty do koszyka.</p>
                <a href="sklep.php" class="btn">Kontynuuj zakupy</a>
            </div>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="cart-item">
                    <img src="<?= $product['zdjecie']; ?>" alt="<?= $product['nazwa']; ?>">
                    <div class="item-details">
                        <h3><?= $product['nazwa']; ?></h3>
                        <p><?= $product['opis']; ?></p>
                        <p><b>Cena:</b> <?= $product['cena']; ?> PLN</p>
                        <form method="POST">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                            <button type="submit" name="remove_from_cart">Usuń z koszyka</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="cart-summary">
                <h3>Suma: <?= $total; ?> PLN</h3>
                <div class="cart-buttons">
                    <form method="POST">
                        <button type="submit" name="clear_cart">Wyczyść koszyk</button>
                    </form>
                    <button type="button" onclick="alert('Funkcja zakupu jeszcze nie zaimplementowana')">Złóż zamówienie</button>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <br><br>
    <footer>
        Zrobione przez: Wojciech Dadok oraz Maciej Nadolny 4B  
    </footer>
</body>
</html>
