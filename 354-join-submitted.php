
<!-- 
    Page: Join - Submit
    Description: Perform the join

Join tables by one of the following options:

(INNER) JOIN: Returns records that have matching values in both tables
LEFT (OUTER) JOIN: Returns all records from the left table, and the matched records from the right table
RIGHT (OUTER) JOIN: Returns all records from the right table, and the matched records from the left table
FULL (OUTER) JOIN: Returns all records when there is a match in either left or right table
-->

<h2>FarmDB: Join Tables</h2>


<?php
    include '354-connect.php';
    $conn = OpenCon();
    if (!$conn){
        echo "ERROR: Unable to connect to database.\n";
        exit;
    }
    session_start();
    $table_one = $_SESSION['table_one'];
    $table_two = $_SESSION['table_two'];
    $table_one_cols = $_SESSION['table_one_cols'];
    $table_two_cols = $_SESSION['table_two_cols'];

    $sql = "SELECT ";

    $sql_one = "";
    $sql_two = "";
    foreach ($table_one_cols as $c1){
        if ($_POST["1_$c1->name"] != "") {
            $sql_one .= $table_one;
            $sql_one .= ".";
            $sql_one .= $_POST["1_$c1->name"];
            $sql_one .= ", ";
        }
    }
    foreach ($table_two_cols as $c2){
        if ($_POST["2_$c2->name"] != "") {
            $sql_two .= $table_two;
            $sql_two .= ".";
            $sql_two .= $_POST["2_$c2->name"];
            $sql_two .= ", ";
        }
    }
    // If both empty, we don't want any columns.
    if ($sql_one == "" && $sql_two == "") {
        echo "User did not request any columns.";
    } else {
        $sql .= $sql_one;
        $sql .= $sql_two;
        $sql = substr($sql, 0, -2);
    }

    $join = $_POST['Joins'];
    $col = $_POST['JoinColumn'];

    if ($join == "Inner Join"){
        $sql .= " FROM $table_one INNER JOIN $table_two ON $table_one.$col = $table_two.$col";
    }else if($join == "Left Join"){
        $sql .= " FROM $table_one LEFT JOIN $table_two ON $table_one.$col = $table_two.$col";
    }else if($join == "Right Join"){
        $sql .= " FROM $table_one RIGHT JOIN $table_two ON $table_one.$col = $table_two.$col";
    }else if($join == "Outer Join"){
        $sql .= " FROM $table_one CROSS JOIN $table_two ON $table_one.$col = $table_two.$col";
    }



    // echo $sql;

    $result = $conn->query($sql);

    if ($result){
        echo "<h3>$join between $table_one and $table_two on column $col was successful.</h3>";
    }else{
        echo "<h3>Error.</h3>" . $conn->error;
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
    
    echo '
    <form action="354-home.php">
    <input type="submit" value="Go Home" />
    </form>';

?>