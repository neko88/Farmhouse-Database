<?php
    $val = $_POST['Columns'];
    $table = rtrim($_POST['table'], '/');

    // Get columns of table.
    $sql = "SELECT $val FROM $table;";

    include '354-connect.php';
    $conn = OpenCon();
    $result = $conn->query($sql);

    if (!$result) {
        echo "Unable to show columns.\n";
        exit;
    }

    echo "<table border='1'><tr>";
    $field_info = mysqli_fetch_fields($result);

    foreach ($field_info as $val){
        echo "<th>{$val->name}</th>";
    }
    echo"</tr>";

    // Keep an array with all vals
    $vals = array();

    while ($row = mysqli_fetch_row($result)){
        echo "<tr>";        
        foreach ($row as $val){
            // If duplicate value, don't add
            if (in_array($val, $vals)) {
                continue;
            } else {
                echo "<td>{$val}</td>";
                array_push($vals, $val);
            }
        }

        echo"</tr>";
    }
    echo "</table>";   

    echo '<br>
    <form action="354-home.php">
    <input type="submit" value="Back to Home" />
    </form>'
?>

