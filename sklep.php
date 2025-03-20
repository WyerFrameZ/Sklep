<?php
session_start();
include 'config.php';

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_to_cart']) && isset($_SESSION['user']) && isset($_POST['product_id'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = $_POST['product_id'];
}

function dodajGodzine($czasString) {
    $czas = strtotime($czasString);
    return date('Y-m-d H:i:s', strtotime('+1 hour', $czas));
}

$search_query = isset($_GET['search']) ? $_GET['search'] : '';
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
    <style>
        .search-container {
            display: flex;
            margin: 20px auto;
            max-width: 600px;
            width: 100%;
        }
        
        .search-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-right: none;
            border-radius: 5px 0 0 5px;
            font-size: 16px;
        }
        
        .search-button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
        
        .search-button:hover {
            background-color: #218838;
        }
        
        .search-results {
            margin-top: 20px;
        }
        
        .no-results {
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

        <div class="navbar">
        <div class="search-container">
        <form action="sklep.php" method="GET" style="display: flex; width: 100%;">
            <input type="text" name="search" class="search-input" placeholder="Wyszukaj produkt..." value="<?= htmlspecialchars($search_query) ?>">
            <button type="submit" class="search-button">Szukaj</button>
        </form>
    </div>
            <section class="end">
                <?php 
                    $isLoggedIn = isset($_SESSION['user']);
                    $username = $isLoggedIn ? $_SESSION['user'] : '';
                ?>

                <?php if ($isLoggedIn): ?>
                    Witaj, <b><?= $username; ?></b>
                    <form method="POST" style="display:inline;">
                        <button type="submit" name="logout" class="btn">Wyloguj</button>
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

    
    <?php if (!empty($search_query)): ?>
    <h2>Wyniki wyszukiwania dla: "<?= htmlspecialchars($search_query) ?>"</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $search = "%{$search_query}%";
        $stmt = $conn->prepare("SELECT * FROM produkty WHERE nazwa LIKE ? OR opis LIKE ? OR kategoria LIKE ? ORDER BY id DESC");
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='produkt'>";
                echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
                echo "<div class='produkt-kontener'>";
                echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
                echo "<div class='produkt-info'>";
                echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
                echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
                echo "<p class='produkt-data'>Data dodania: " . dodajGodzine($row['data_dodania']) . "</p>";
                echo "</div>";
                echo "<form method='POST'>";
                echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='add_to_cart' class='cart-btn'>🛒</button>";
                echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='no-results'>";
            echo "<h3>Nie znaleziono produktów pasujących do zapytania</h3>";
            echo "<p>Spróbuj wyszukać coś innego lub przeglądaj dostępne kategorie poniżej.</p>";
            echo "</div>";
        }
        $stmt->close();
        ?>
        </div>
    </div>
    <?php endif; ?>
    
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
        echo "<p class='produkt-data'>" . dodajGodzine($row['data_dodania']) . "</p>";
        echo "</div>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add_to_cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>

</div>

<h2>Elektronika</h2>
    <div class="container">
    <div class="produkty">
    <?php
     $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Elektronika' ORDER BY id DESC LIMIT 10;");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>Data dodania: " . dodajGodzine($row['data_dodania']) . "</p>";
        echo "</div>"; 
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add_to_cart' class='cart-btn'>🛒</button>";
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
 $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Sport i Hobby' ORDER BY id DESC LIMIT 10;");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>Data dodania: " . dodajGodzine($row['data_dodania']) . "</p>";
        echo "</div>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add_to_cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    ?>
        </div>
    </div>

    <h2>Moda</h2>
    <div class="container">
        <div class="produkty">
        <?php
 $result = $conn->query("SELECT * FROM produkty WHERE kategoria='moda' ORDER BY id DESC LIMIT 10;");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>Data dodania: " . dodajGodzine($row['data_dodania']) . "</p>";
        echo "</div>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add_to_cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    ?>
        </div>
    </div>

    <h2>Dom i Ogród</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Dom i Ogród' ORDER BY id DESC LIMIT 10;");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>Data dodania: " . dodajGodzine($row['data_dodania']) . "</p>";
        echo "</div>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add_to_cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    ?>
        </div>
    </div>

    <h2>Motoryzacja</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Motoryzacja' ORDER BY id DESC LIMIT 10;");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>Data dodania: " . dodajGodzine($row['data_dodania']) . "</p>";
        echo "</div>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add_to_cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    ?>
        </div>
    </div>

    <h2>Broń</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Broń' ORDER BY id DESC LIMIT 10;");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>Data dodania: " . dodajGodzine($row['data_dodania']) . "</p>";
        echo "</div>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add_to_cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    ?>
        </div>
    </div>

    <h2>Śmieci</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Śmieci' ORDER BY id DESC LIMIT 10;");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>Data dodania: " . dodajGodzine($row['data_dodania']) . "</p>";
        echo "</div>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='add_to_cart' class='cart-btn'>🛒</button>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    ?>
        </div>
    </div>

    <h2>Inne</h2>
    <div class="container">
        <div class="produkty">
        <?php
        $result = $conn->query("SELECT * FROM produkty WHERE kategoria='Inne' ORDER BY id DESC LIMIT 10;");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='produkt'>";
        echo "<h3 class='produkt-nazwa'>" . $row['nazwa'] . "</h3>";
        echo "<div class='produkt-kontener'>";
        echo "<img src='" . $row['zdjecie'] . "' class='produkt-img'>";
        echo "<div class='produkt-info'>";
        echo "<p><b>CENA:</b> " . $row['cena'] . " PLN</p>";
        echo "<p><b>OPIS:</b> " . $row['opis'] . "</p>";
        echo "<p class='produkt-data'>Data dodania: " . dodajGodzine($row['data_dodania']) . "</p>";
        echo "</div>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='delete_product' class='delete-btn'>✖</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
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
