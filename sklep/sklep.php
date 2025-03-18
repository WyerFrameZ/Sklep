<?php
session_start();
include 'config.php';

// Wylogowanie użytkownika
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Dodawanie do koszyka
if (isset($_POST['add_to_cart']) && isset($_SESSION['user'])) {
    $_SESSION['cart'][] = $_POST['product_id'];
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep</title>
    <link rel="stylesheet" href="css/ogolny.css">
    <link rel="stylesheet" href="css/sklep.css">
</head>
<body>

    <section class="navbar">

        <section class="start">

            <img src="img/ruby.svg">
            <h1 class="dwa">Sklep</h1>
        </section>

        <div class="navbar">
            <section class="end">
                <?php 
                    $isLoggedIn = isset($_SESSION['user']);
                    $username = $isLoggedIn ? $_SESSION['user'] : '';
                ?>

                <?php if ($isLoggedIn): ?>
                    Witaj, <b><?= $username; ?></b>
                    <form method="POST" style="display:inline;">
                        <button type="submit" name="logout">Wyloguj</button>
                    </form>
                    <a href="dodaj.php" class="btn">Wystaw</a>
                    <a href="cart.php" id="cart">Koszyk</a>
                <?php else: ?>
                    <a href="login.php" class="btn">Zaloguj</a>
                    <a href="register.php" class="btn">Zarejestruj</a>
                <?php endif; ?>
            </section>
        </div>

    </section>
    
    <div class="container">
        <h2>Lista produktów</h2>
        <div class="produkty">
            <?php
            $result = $conn->query("SELECT * FROM produkty");
            while ($row = $result->fetch_assoc()) {
                echo "<div class='produkt'>";
                echo "<img src='" . $row['zdjecie'] . "'>";
                echo "<h3>" . $row['nazwa'] . "</h3>";
                echo "<p>" . $row['opis'] . "</p>";
                echo "<p><b>" . $row['cena'] . " PLN</b></p>";
                if (isset($_SESSION['user'])) {
                    echo "<form method='POST'><input type='hidden' name='product_id' value='" . $row['id'] . "'><button type='submit' name='add_to_cart'>Dodaj do koszyka</button></form>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
