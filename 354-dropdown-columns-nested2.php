<!-- Display dropdown menu containing columns. -->

<h2>FarmDB: Nested Aggregation</h2>

<form method='post'>
<?php
    
    // $columnPickedAsPrimary = $_POST['Columns2'];
    // echo "You picked $columnPickedAsPrimary as your primary column";

    $table = $_POST['table']; // This means that we hit the button and selected the table and now we are storing it inside the $table variable
    // We got the table now we need to get the columns
    $primaryColumn = $_POST['Columns'];


    // Get columns of table.
    include '354-connect.php';
    $conn = OpenCon();
    $sql = "SHOW COLUMNS FROM $table;"; // e.g. $table = animal, this is the query
    $result = $conn->query($sql); // We pass this query

    // Case: Query failed
    if (!$result) {
        echo "Unable to show columns.\n";
        exit;
    }

    // echo "<hr>"; // horizontal line

    
    // STARTS HERE
    //echo "<h3>Pick secondary column from $table.</h3>";
    // Show a dropdown of all the columns in the table.
    echo "<h3>Pick secondary column from $table.</h3>";
    $cols = '';
    while ($row = $result->fetch_row()) {
        if ( $row[0] != $primaryColumn ) {
            $cols .="<option value='{$row[0]}'>{$row[0]}</option>";
        }
    }

    // 'Pick this column' button
    echo "<form method='post'> 
            <select name='Columns2' id='ddColumns2'>
                $cols
            </select>
            <input type='hidden' name='table' value='$table'/>
            <input type='hidden' name='primaryColumn' value='$primaryColumn'/>
            <input type='submit' id='Submit2' value='Pick this column' formaction='354-nested-page2.php'/>
        </form>";




    // connects to 354-aggregate-step2
    // Theoretically, the above statement should return the column selected

    // We cannot get column without table!!! Aka '354-dropdown-all-tables.php'

?>
</form>