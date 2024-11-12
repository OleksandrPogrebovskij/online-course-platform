<!-- /users/login.php -->

<?php
// Олександр Погребовський - автор цього коду

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Підключення до бази даних
    include('../includes/db.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Перевірка користувача в базі
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: ../home/index.php");
        } else {
            echo "Невірний пароль.";
        }
    } else {
        echo "Користувач не знайдений.";
    }
}
?>

<form method="POST">
    <label for="username">Логін</label>
    <input type="text" name="username" required>
    <label for="password">Пароль</label>
    <input type="password" name="password" required>
    <button type="submit">Увійти</button>
</form>
