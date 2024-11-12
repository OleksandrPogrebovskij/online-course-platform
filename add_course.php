<!-- /courses/add_course.php -->

<?php
// Олександр Погребовський - автор цього коду

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../users/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Підключення до бази даних
    include('../includes/db.php');

    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];

    // Додавання курсу
    $query = "INSERT INTO courses (name, description) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $course_name, $course_description);
    if ($stmt->execute()) {
        echo "Курс успішно додано!";
    } else {
        echo "Помилка при додаванні курсу.";
    }
}
?>

<form method="POST">
    <label for="course_name">Назва курсу</label>
    <input type="text" name="course_name" required>
    <label for="course_description">Опис курсу</label>
    <textarea name="course_description" required></textarea>
    <button type="submit">Додати курс</button>
</form>
