<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_POST['add_product'])) {
    $nazwa = $_POST['nazwa'];
    $cena = $_POST['cena'];
    $opis = $_POST['opis'];
    $kategoria = $_POST['kategoria'];
    $zdjecie = ''; 
    
    if (isset($_FILES['zdjecie_plik']) && $_FILES['zdjecie_plik']['size'] > 0) {
        $fileName = basename($_FILES['zdjecie_plik']['name']);
        $targetFilePath = $uploadDir . time() . '_' . $fileName; 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        
        if (in_array(strtolower($fileType), $allowTypes)) {
            if (move_uploaded_file($_FILES['zdjecie_plik']['tmp_name'], $targetFilePath)) {
                $zdjecie = $targetFilePath; 
            } else {
                $error = "Wystąpił problem podczas przesyłania pliku.";
            }
        } else {
            $error = "Dozwolone są tylko pliki JPG, JPEG, PNG i GIF.";
        }
    } elseif (!empty($_POST['zdjecie_link'])) {
        $zdjecie = $_POST['zdjecie_link'];
    }

    $stmt = $conn->prepare("INSERT INTO produkty (nazwa, cena, opis, zdjecie, kategoria) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsss", $nazwa, $cena, $opis, $zdjecie, $kategoria);
    
    if ($stmt->execute()) {
        header("Location: sklep.php?success=1");
        exit();
    } else {
        $error = "Błąd dodawania produktu: " . $conn->error;
    }
    $stmt->close();
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
    <style>
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            display: none;
        }
        .file-input {
            margin: 10px 0;
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
    
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    
    <form method="POST" enctype="multipart/form-data">
        
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
            <label for="zdjecie_plik">Dodaj zdjęcie produktu:</label>
            <input type="file" name="zdjecie_plik" id="zdjecie_plik" class="file-input" accept="image/*" onchange="previewFile()">
            <img id="preview" class="preview-image" alt="Podgląd zdjęcia">
            <p>lub</p>
            <input type="text" name="zdjecie_link" id="zdjecie_link" placeholder="Wklej link do zdjęcia">
        </section>

        <button type="submit" name="add_product">Wystaw produkt</button>

    </form>
</section>

    <p>Powrót do sklepu <a href="sklep.php">tutaj</a></p>

    <script>
        function previewFile() {
            const preview = document.getElementById('preview');
            const file = document.getElementById('zdjecie_plik').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>
