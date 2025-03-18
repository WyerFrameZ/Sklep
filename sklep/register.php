<?php
include 'config.php'; // Połączenie z bazą danych

if (isset($_POST['register'])) {
    $login = $_POST['login'];
    $haslo = password_hash($_POST['haslo'], PASSWORD_DEFAULT); // Hashowanie hasła

    // Sprawdzenie, czy login już istnieje
    $stmt = $conn->prepare("SELECT id FROM users WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Taki użytkownik już istnieje!";
    } else {
        // Dodanie użytkownika do bazy
        $stmt = $conn->prepare("INSERT INTO users (login, haslo) VALUES (?, ?)");
        $stmt->bind_param("ss", $login, $haslo);
        if ($stmt->execute()) {
            header("Location: login.php?success=1"); // Przekierowanie do logowania
            exit();
        } else {
            $error = "Błąd rejestracji!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css/form.css"> 
    <link rel="shortcut icon" href="img/cart.ico" type="image/x-icon">
</head>
<body>
    <div class="login-container">
        <h2>Utwórz konto</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="login" placeholder="Username" required>
            <input type="password" name="haslo" placeholder="Password" required>
            <button type="submit" name="register">Sign up</button>
        </form>
        <a href="login.php">Masz już konto?</a>
    </div>
</body>
</html>
