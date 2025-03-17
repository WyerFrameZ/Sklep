    <?php
    include 'config.php';
    if (isset($_POST['register'])) {
        $login = $_POST['login'];
        $haslo = password_hash($_POST['haslo'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (login, haslo) VALUES ('$login', '$haslo')";
        $conn->query($sql);
        header("Location: login.php");
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Rejestracja</title>
        <link rel="stylesheet" href="css/rejestracja.css">
    </head>
    <body>
        <section class="rejestr">
            <h2>Rejestracja</h2>
            <form method="POST">
                <input type="text" name="login" placeholder="Login" required>
                <input type="password" name="haslo" placeholder="Hasło" required>
                <button type="submit" name="register">Zarejestruj</button>
            </form>
            <a href="login.php">Masz już konto? Zaloguj się</a>
        </section>
    </body>
    </html>