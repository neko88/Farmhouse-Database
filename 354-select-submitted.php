<!-- 
    Page: Select Submitted page.
    Description: Get data that the user wants from 354-select.php.

    TODO: 
        - Do the "SELECT Field_01 FROM" part later.
        - Test SQL query for more bugs.
-->

<?php
    $table = rtrim($_POST['table'], '/');
    $column = $_POST['Columns'];
    $col_names = unserialize($_POST['col_names']);
    $col_types = unserialize($_POST['col_types']);

    $sql = "SELECT $column FROM $table WHERE ";
    //SELECT Field_01 FROM Table_01 WHERE Field_02 >= 0

    $i = 0;
    $useWhere = false;
    foreach ($col_names as &$col) {
        $e = $_POST["{$col}E"];
        $ne = $_POST["{$col}NE"];

        if (str_contains($col_types[$i], 'int')) {
            if ($e != "") {
                $sql .= "$col = {$e} AND ";
                $useWhere = true;
            }
            
            if ($ne != "") {
                $sql .= "$col <> {$ne} AND ";
                $useWhere = true;
            }

        } else {
            if ($e != "") {
                $sql .= "$col = '{$e}' AND ";
                $useWhere = true;
            }
            
            if ($ne != "") {
                $sql .= "$col <> '{$ne}' AND ";
                $useWhere = true;
            }
        }
        $i++;
    }

    // Remove trailing "AND"
    if ($useWhere) {
        $sql = substr($sql, 0, -5);
    } else {
        // Remove trailing WHERE
        $sql = substr($sql, 0, -7);
    }

    $sql .= ';';
    echo $sql;

    include '354-connect.php';
    $conn = OpenCon();
    $result = $conn->query($sql);

    if (!$result) {
        echo "ERROR: Unable to SELECT from $table.\n";
        exit;
    } 

    echo "<table border='1'><tr>";
    $field_info = mysqli_fetch_fields($result);

    foreach ($field_info as $val){
        echo "<th>{$val->name}</th>";
    }
    echo"</tr>";

    while ($row = mysqli_fetch_row($result)){
        echo "<tr>";
        foreach ($row as $col){
        echo "<td>{$col}</td>";
        }
        echo"</tr>";
    }
    echo "</table>";



    echo '<br>
    <form action="354-home.php">
    <input type="submit" value="Back to Home" />
    </form>'
?>