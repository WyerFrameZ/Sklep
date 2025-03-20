<?php
session_start();
include 'config.php';

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

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
    <link rel="shortcut icon" href="img/cart.ico" type="image/x-icon">
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
    
    <h2>Ostatnio wystawione</h2>
    <div class="container">
    <div class="produkty">
    <?php
    $result = $conn->query("SELECT * FROM produkty ORDER BY id DESC LIMIT 10;");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>" . $row['data_dodania'] . "</p>";
        echo "</div>"; // zamknięcie produkt-info
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add to cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>"; // zamknięcie produkt-kontener
        echo "</div>"; // zamknięcie produkt
    }
    ?>
</div>

</div>

<h2>Elektronika</h2>
    <div class="container">
    <div class="produkty">
    <?php
     $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Elektronika' ORDER BY id DESC LIMIT 10;"); //  malejące po ID
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>" . $row['data_dodania'] . "</p>";
        echo "</div>"; 
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add to cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>"; 
        echo "</div>"; 
    }
    ?>
    </div>
</div>

    <h2>Sport i Hobby</h2>
    <div class="container">
        <div class="produkty">
        <?php
 $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Sport i Hobby' ORDER BY id DESC LIMIT 10;"); //  malejące po ID
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>" . $row['data_dodania'] . "</p>";
        echo "</div>"; // zamknięcie produkt-info
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add to cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>"; // zamknięcie produkt-kontener
        echo "</div>"; // zamknięcie produkt
    }
    ?>
        </div>
    </div>

    <h2>Moda</h2>
    <div class="container">
        <div class="produkty">
        <?php
 $result = $conn->query("SELECT * FROM produkty WHERE kategoria='moda' ORDER BY id DESC LIMIT 10;"); //  malejące po ID
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>" . $row['data_dodania'] . "</p>";
        echo "</div>"; // zamknięcie produkt-info
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add to cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>"; // zamknięcie produkt-kontener
        echo "</div>"; // zamknięcie produkt
    }
    ?>
        </div>
    </div>

    <h2>Dom i Ogród</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Dom i Ogród' ORDER BY id DESC LIMIT 10;"); // Sortowanie malejące po ID
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>" . $row['data_dodania'] . "</p>";
        echo "</div>"; // zamknięcie produkt-info
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add to cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>"; // zamknięcie produkt-kontener
        echo "</div>"; // zamknięcie produkt
    }
    ?>
        </div>
    </div>

    <h2>Motoryzacja</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Motoryzacja' ORDER BY id DESC LIMIT 10;"); // Sortowanie malejące po ID
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>" . $row['data_dodania'] . "</p>";
        echo "</div>"; // zamknięcie produkt-info
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add to cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>"; // zamknięcie produkt-kontener
        echo "</div>"; // zamknięcie produkt
    }
    ?>
        </div>
    </div>

    <h2>Broń</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Broń' ORDER BY id DESC LIMIT 10;"); // Sortowanie malejące po ID
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>" . $row['data_dodania'] . "</p>";
        echo "</div>"; // zamknięcie produkt-info
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add to cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>"; // zamknięcie produkt-kontener
        echo "</div>"; // zamknięcie produkt
    }
    ?>
        </div>
    </div>

    <h2>Śmieci</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Śmieci' ORDER BY id DESC LIMIT 10;"); // Sortowanie malejące po ID
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>" . $row['data_dodania'] . "</p>";
        echo "</div>"; // zamknięcie produkt-info
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add to cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>"; // zamknięcie produkt-kontener
        echo "</div>"; // zamknięcie produkt
    }
    ?>
        </div>
    </div>

    <h2>Inne</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Inne' ORDER BY id DESC LIMIT 10;"); // Sortowanie malejące po ID
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>" . $row['data_dodania'] . "</p>";
        echo "</div>"; // zamknięcie produkt-info
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>"; // zamknięcie produkt-kontener
        echo "</div>"; // zamknięcie produkt
    }
    ?>
        </div>
    </div>
</body>
<br><br>
<footer>
    Zrobione przez: Wojciech Dadok oraz Maciej Nadolny 4B  
</footer>
</html>
