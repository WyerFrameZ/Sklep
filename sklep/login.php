<?php
session_start();
include 'config.php';

if (isset($_POST['login_btn'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['haslo'])) {
        $_SESSION['user'] = $user['login'];
        header("Location: sklep.php"); 
        exit();
    } else {
        $error = "Błędny login lub hasło!";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="shortcut icon" href="img/cart.ico" type="image/x-icon">
    <script src="JS/ogolny.js"></script>
</head>
<body>
    <div class="login-container">
        <form method="POST">
            <h2>Zaloguj sie</h2>
            <input type="text" name="login" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login_btn">Log in</button>
            <a href="register.php">Utwórz konto</a>
            <a href="#">Zapomniałes hasła??</a>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </div>

    <script>


</script>

</body>
</html>
