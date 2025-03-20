<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_product'])) {
    $nazwa = $_POST['nazwa'];
    $cena = $_POST['cena'];
    $opis = $_POST['opis'];
    $zdjecie = $_POST['zdjecie'];
    $kategoria = $_POST['kategoria'];

    $sql = "INSERT INTO produkty (nazwa, cena, opis, zdjecie, kategoria) VALUES ('$nazwa', '$cena', '$opis', '$zdjecie', '$kategoria')";
    if ($conn->query($sql)) {
        header("Location: sklep.php?success=1");
        exit();
    } else {
        $error = "Błąd dodawania produktu!";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj produkt</title>
    <link rel="stylesheet" href="css/ogolny.css">
    <link rel="stylesheet" href="css/dodaj.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
<section class="navbar">

        <section class="start">
     
            <img href="sklep.php" src="img/ruby.svg">
            <h1 href="sklep.php" class="dwa">Sklep</h1>
        </section>

        <section class="navbar">
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
                    <a href="cart.php" id="cart">Koszyk</a>
                <?php else: ?>
                    <a href="login.php" class="btn">Zaloguj</a>
                    <a href="register.php" class="btn">Zarejestruj</a>
                <?php endif; ?>
            </section>
                </section>

    </section>

    <section class="guwny">
    <h2>Wystaw produkt na aukcji</h2>
    
    <form method="POST">
        
        <section class="form">
            <label for="nazwa">Nazwa produktu:</label>
            <input type="text" name="nazwa" id="nazwa" placeholder="Podaj nazwę produktu" required>
        </section>

        <section class="form">
            <label for="cena">Cena (PLN):</label>
            <input type="number" name="cena" id="cena" placeholder="Podaj cenę" required>
        </section>

        <section class="form">
            <label for="kategoria">Kategoria:</label>
            <select name="kategoria" id="kategoria">
                <option value="Elektronika">Elektronika</option>
                <option value="Moda">Moda</option>
                <option value="Dom i Ogród">Dom i Ogród</option>
                <option value="Motoryzacja">Motoryzacja</option>
                <option value="Sport i Hobby">Sport i Hobby</option>
                <option value="Broń">Broń</option>
                <option value="Śmieci">Śmieci</option>
                <option value="Inne">Inne</option>
            </select>
        </section>

        <section class="form">
            <label for="opis">Opis produktu:</label>
            <textarea name="opis" id="opis" placeholder="Podaj szczegółowy opis" required></textarea>
        </section>

        <section class="form dodajZDJ">
            <input type = "image" id="zdj" for="zdjecie"></input>
            <input type="text" name="zdjecie" id="zdjecie" placeholder="lub wklej link do zjęcia">
        </section>

        <button type="submit" name="add_product">Wystaw produkt</button>

    </form>
</section>

    Powrót do sklepu <a href="sklep.php">tutaj</a>
</body>
</html>
