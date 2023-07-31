<!-- 
    Page: Insert Submitted page.
    Description: Insert data that the user entered from 354-insert.php.

    TODO: 
        - Test SQL query for more bugs.
-->

<?php
    $table = rtrim($_POST['table'], '/');
    $col_names = unserialize($_POST['col_names']);
    $col_types = unserialize($_POST['col_types']);

    $sql = "INSERT INTO $table VALUES (";
    
    $i = 0;
    $n = count($col_names);
    $entries = array();

    // Add all the inputs to an array first. This is to prevent skipping over empty inputs.
    foreach ($col_names as &$col) {
        array_push($entries, "NULL");
        if (isset($_POST["$col"])) {
            $entries[$i] = $_POST["$col"];
        }
        $i++;
    }

    $j = 0;
    // Now add each input to the SQL query.
    // Add single quotation marks to strings and Dates.
    $nl = "NULL";
    foreach ($entries as &$entry) {
        if (!str_contains($col_types[$j], 'int') && $entry != "") {
            $sql .= '\'';
        }

        $sql .= $entry;

        if (!str_contains($col_types[$j], 'int') && $entry != "") {
            $sql .= '\'';
        }

        if ($entry == "") {
            // Add other chars around NULL otherwise PHP thinks we are adding an empty string.
            $sql .= " NULL, ";
        } else {
            $sql .= ', ';
        }
        $j++;
    }

    // Remove extra ', '
    if ($n > 0) {
        $sql = substr($sql, 0, -2);
    }

    $sql .= ');';
    // echo $sql;

    include '354-connect.php';
    $conn = OpenCon();
    $result = $conn->query($sql);

    if ($result) {
        echo "Successfully inserted data with SQL query $sql";
    } else {
        echo "Failed. Please ensure all types are correct.";
    }    

    echo '<br>
    <form action="354-home.php">
    <input type="submit" value="Back to Home" />
    </form>'
?>