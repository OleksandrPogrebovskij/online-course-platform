<!-- /courses/index.php -->

<?php
// Олександр Погребовський - автор цього коду

include('../includes/db.php');

// Отримуємо список курсів
$query = "SELECT * FROM courses";
$result = $conn->query($query);

echo "<h1>Курси</h1>";

while ($row = $result->fetch_assoc()) {
    echo "<h2>" . $row['name'] . "</h2>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<a href='video.php?id=" . $row['id'] . "'>Переглянути відео</a><br>";
}
?>
