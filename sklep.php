<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sklep";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Rejestracja użytkownika
if (isset($_POST['register'])) {
    $login = $_POST['login'];
    $haslo = password_hash($_POST['haslo'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (login, haslo) VALUES ('$login', '$haslo')";
    $conn->query($sql);
}

// Logowanie użytkownika
if (isset($_POST['login_user'])) {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    $result = $conn->query("SELECT * FROM users WHERE login='$login'");
    if ($row = $result->fetch_assoc()) {
        if (password_verify($haslo, $row['haslo'])) {
            $_SESSION['user'] = $login;
            $_SESSION['cart'] = [];
        }
    }
}

// Wylogowanie użytkownika
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
}

// Dodawanie produktu (tylko dla zalogowanych)
if (isset($_POST['add_product']) && isset($_SESSION['user'])) {
    $nazwa = $_POST['nazwa'];
    $cena = $_POST['cena'];
    $opis = $_POST['opis'];
    $zdjecie = $_POST['zdjecie'];
    $kategoria = $_POST['kategoria'];
    $sql = "INSERT INTO produkty (nazwa, cena, opis, zdjecie, kategoria) VALUES ('$nazwa', '$cena', '$opis', '$zdjecie', '$kategoria')";
    $conn->query($sql);
}

// Dodawanie do koszyka
if (isset($_POST['add_to_cart']) && isset($_SESSION['user'])) {
    $_SESSION['cart'][] = $_POST['product_id'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sklep Allegro</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
        .navbar { display: flex; justify-content: space-between; background: #ff6600; padding: 15px; color: white; }
        .container { width: 80%; margin: auto; }
        .produkty { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .produkt { background: white; padding: 15px; width: 200px; border-radius: 10px; box-shadow: 2px 2px 10px #ccc; text-align: center; }
        .produkt img { max-width: 100%; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Sklep Allegro</h1>
        <div>
            <?php if (isset($_SESSION['user'])) { ?>
                Witaj, <?php echo $_SESSION['user']; ?> | 
                <form method="POST" style="display:inline;"><button type="submit" name="logout">Wyloguj</button></form>
            <?php } ?>
        </div>
    </div>
    
    <div class="container">
        <?php if (!isset($_SESSION['user'])) { ?>
            <h2>Zaloguj się</h2>
            <form method="POST">
                <input type="text" name="login" placeholder="Login" required>
                <input type="password" name="haslo" placeholder="Hasło" required>
                <button type="submit" name="login_user">Zaloguj</button>
            </form>
            <h2>Rejestracja</h2>
            <form method="POST">
                <input type="text" name="login" placeholder="Login" required>
                <input type="password" name="haslo" placeholder="Hasło" required>
                <button type="submit" name="register">Zarejestruj</button>
            </form>
        <?php } else { ?>
            <h2>Dodaj produkt</h2>
            <form method="POST">
                <input type="text" name="nazwa" placeholder="Nazwa" required>
                <input type="number" name="cena" placeholder="Cena" required>
                <input type="text" name="opis" placeholder="Opis" required>
                <input type="text" name="zdjecie" placeholder="URL zdjęcia" required>
                <input type="text" name="kategoria" placeholder="Kategoria" required>
                <button type="submit" name="add_product">Dodaj</button>
            </form>
        <?php } ?>

        <h2>Produkty</h2>
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
