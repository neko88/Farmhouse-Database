<!-- 
    Page: Division page.
    Description: Show the data of all the Animals that eat all the Plants.

    TODO: 
        - Show descriptive error message, outlining exactly what went wrong, when SQL query doesn't work.
-->

<h2>FarmDB: Divide</h2>
<h3>Division query: Show the data of all the Animals that eat all the Plants.</h3>
<?php
    // R(x, y) div S(y)
    // Eats(animal_name, plant_name) div Plant(plant_name)
    include '354-connect.php';
    $conn = OpenCon();
    $sql = "SELECT animal_name FROM Eats E1 WHERE NOT EXISTS( (SELECT plant_name FROM Eats) EXCEPT (SELECT plant_name FROM Eats E2 WHERE E2.animal_name = E1.animal_name) );";

    $result = $conn->query($sql);
    if (!$result) {
        echo "Unable to get animal_names.\n";
        exit;
    } 

    $animal_names = [];
    echo "<table border='1'><tr>";
    echo "<th>Animal Names</th>";
    echo"</tr>";

    while ($row = $result->fetch_row()) {
        if (!in_array($row[0], $animal_names)) {
            array_push($animal_names, $row[0]);
                echo "<td>{$row[0]}</td>";
        }
    }
    echo "</table>";
    
?>