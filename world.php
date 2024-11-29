<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    if (isset($_GET['country']) && !empty($_GET['country'])) {
        $country = $_GET['country'];
        $query = "SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE '%$country%'";
        $stmt = $conn->query($query);
    } else {
        $query = "SELECT name, continent, independence_year, head_of_state FROM countries";
        $stmt = $conn->query($query);
    }

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($results) {
        echo "<table border='1' style='width:100%; border-collapse: collapse;'>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Continent</th>";
        echo "<th>Independence Year</th>";
        echo "<th>Head of State</th>";
        echo "</tr>";

        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
            echo "<td>" . htmlspecialchars($row['independence_year']) . "</td>";
            echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No countries found.</p>";
    }
} catch (PDOException $e) {
    echo "Error: Could not connect to the database.";
}
?>