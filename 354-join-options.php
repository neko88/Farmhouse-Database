
<!-- 
    Page: Join - Options
    Description: Pick the type of join to perform.

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
    
    // Get columns of table one.
    $sql = "SHOW COLUMNS FROM $table_one;";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Unable to show columns from first table.\n";
        exit;
    }
    $col_names_one = array();
    while ($row = $result->fetch_row()) {
        // $row[0]: column's name.
        array_push($col_names_one, $row[0]);
    }

    // Get columns of table two.
    $sql = "SHOW COLUMNS FROM $table_two;";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Unable to show columns from second table.\n";
        exit;
    }
    // Get the mutual columns of table one and table two.
    $mutual_cols = array();
    while ($row = $result->fetch_row()) {
        // $row[0]: column's name.
        if (in_array($row[0], $col_names_one)) {
            array_push($mutual_cols, $row[0]);
        }
    }
    echo '<form method ="post">';
    // Show a dropdown containing the mutual columns from table one and table two.
    echo '<h4>Select the column to join on.</h4>';
    echo"<select name='JoinColumn' id='JoinColumn'>";
    foreach ($mutual_cols as $col) {
        echo "<option value='$col'>$col</option>";
    }
    echo "</select>";
    echo "<hr>";






    // Select the columns to display from 
    // Display table one choice
    echo"<h4>First table [$table_one]:</h4>";
    $result_one = $conn->query("SELECT * FROM $table_one");
    if (!$result_one) {
        echo "ERROR: Unable to SELECT from $table_one.\n";
        exit;
    }
    echo "<table border='1'><tr>";
    $table_one_cols = mysqli_fetch_fields($result_one);
    foreach ($table_one_cols as $c1){
        echo '<th>';
        echo $c1->name;
        echo '<br>';
        echo "<input type='checkbox' name='1_{$c1->name}' value='$c1->name'/> </th>";
    }
    echo"</tr>";
    while ($table_one_rows = mysqli_fetch_row($result_one)){
        echo "<tr>";
        foreach ($table_one_rows as $r1){
        echo "<td>{$r1}</td>";
        }
        echo"</tr>";
    }
    echo "</table>";

    // Display table two choice
    echo "<hr>";
    echo"<h4>Second table [$table_two]:</h4>";
    $result_two = $conn->query("SELECT * FROM $table_two");
    if (!$result_two) {
        echo "ERROR: Unable to SELECT from $table_two.\n";
        exit;
    } 
    echo "<table border='1'><tr>";
    $table_two_cols = mysqli_fetch_fields($result_two);
    foreach ($table_two_cols as $c2){
       echo '<th>';
       echo $c2->name;
       echo '<br> ';
       echo "<input type='checkbox' name='2_{$c2->name}' value='$c2->name'/> </th>";
    }
    echo"</tr>";
    while ($table_two_rows = mysqli_fetch_row($result_two)){
        echo "<tr>";
        foreach ($table_two_rows as $r2){
        echo "<td>{$r2}</td>";
        }
        echo"</tr>";
    }
    echo "</table>";
    $_SESSION['table_one'] = $table_one;
    $_SESSION['table_two'] = $table_two;
    $_SESSION['table_one_cols'] = $table_one_cols;
    $_SESSION['table_two_cols'] = $table_two_cols;






    echo "<hr>";
    echo '<h4>Select the type of join.</h4>';
    echo"
    <select name='Joins' id='ddJoins'>";
            $joins = array();
            array_push($joins, 'Left Join');
            array_push($joins, 'Right Join');
            array_push($joins, 'Inner Join');
            array_push($joins, 'Outer Join');

            $join_ops = '';
            foreach ($joins as $r) {
                $join_ops .="<option value='{$r}'>{$r}</option>";
            }
            echo $join_ops;

    echo "</select>";
    echo "<input type='hidden' name='myform' value=''/>";
    echo '<input type="submit" name="SubmitJoin" value="Join Tables" formaction="354-join-submitted.php">
    </form>';

?>
