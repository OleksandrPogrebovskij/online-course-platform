<!-- /courses/video.php -->

<?php
// Олександр Погребовський - автор цього коду

include('../includes/db.php');

$course_id = $_GET['id'];

// Отримуємо курс
$query = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();

echo "<h1>" . $course['name'] . "</h1>";
echo "<p>" . $course['description'] . "</p>";
echo "<video width='640' height='360' controls>
        <source src='../videos/example.mp4' type='video/mp4'>
        Ваш браузер не підтримує відео.
      </video>";
?>
