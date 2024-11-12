<!-- /users/register.php -->

<?php
// Олександр Погребовський - автор цього коду

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Підключення до бази даних
    include('../includes/db.php');

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Перевірка, чи користувач вже існує
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Користувач з таким ім'ям вже існує!";
    } else {
        // Додавання нового користувача в базу
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            echo "Реєстрація успішна!";
        } else {
            echo "Помилка при реєстрації.";
        }
    }
}
?>

<form method="POST">
    <label for="username">Логін</label>
    <input type="text" name="username" required>
    <label for="password">Пароль</label>
    <input type="password" name="password" required>
    <button type="submit">Зареєструватися</button>
</form>
