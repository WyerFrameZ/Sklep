<?php
include 'config.php'; 

if (isset($_POST['register'])) {
    $login = $_POST['login'];
    $haslo = password_hash($_POST['haslo'], PASSWORD_DEFAULT); 

   
    $A = $conn->prepare("SELECT id FROM users WHERE login = ?");
    $A->bind_param("s", $login);
    $A->execute();
    $A->store_result();

    if ($A->num_rows > 0) {
        $error = "Taki użytkownik już istnieje!";
    } else {
     
        $A = $conn->prepare("INSERT INTO users (login, haslo) VALUES (?, ?)");
        $A->bind_param("ss", $login, $haslo);
        if ($A->execute()) {
            header("Location: login.php"); 
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
