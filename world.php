<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    if (isset($_GET['country']) && !empty($_GET['country'])) {
        $country = $_GET['country'];

        if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
            $query = "SELECT cities.name AS city, cities.district, cities.population 
                      FROM cities 
                      WHERE cities.name LIKE :city";
            
            $stmt = $conn->prepare($query);
            $stmt->execute(['city' => "%$country%"]);
        } else {
            $query = "SELECT name, continent, independence_year, head_of_state 
                      FROM countries 
                      WHERE name LIKE :country";
            
            $stmt = $conn->prepare($query);
            $stmt->execute(['country' => "%$country%"]);
        }
    } else {
        $query = "SELECT name, continent, independence_year, head_of_state FROM countries";
        $stmt = $conn->query($query);
    }

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
            echo "<table border='1' style='width:100%; border-collapse: collapse;'>";
            echo "<tr><th>Name</th><th>District</th><th>Population</th></tr>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['city']) . "</td>";
                echo "<td>" . htmlspecialchars($row['district']) . "</td>";
                echo "<td>" . htmlspecialchars($row['population']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<table border='1' style='width:100%; border-collapse: collapse;'>";
            echo "<tr><th>Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
                echo "<td>" . htmlspecialchars($row['independence_year']) . "</td>";
                echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        echo "<p>No results found.</p>";
    }
} catch (PDOException $e) {
    echo "Error: Could not connect to the database.";
}
?>
