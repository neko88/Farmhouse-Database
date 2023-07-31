<!-- Display dropdown menu containing columns. -->

<form method='post'>
<?php
    $table = $_POST['Tables']; // This means that we hit the button and selected the table and now we are storing it inside the $table variable
    // We got the table now we need to get the columns

    // Get columns of table.
    $conn = OpenCon();
    $sql = "SHOW COLUMNS FROM $table;"; // e.g. $table = animal, this is the query
    $result = $conn->query($sql); // We pass this query

    // Case: Query failed
    if (!$result) {
        echo "Unable to show columns.\n";
        exit;
    }


    echo "<br>";
    echo "<br>";

    echo "<hr>"; // horizontal line

    //echo "The table is $table";
    // STARTS HERE
    echo "<h3>Pick a column from $table.</h3>";
    // Show a dropdown of all the columns in the table.
    $cols = '';
    while ($row = $result->fetch_row()) {
        $cols .="<option value='{$row[0]}'>{$row[0]}</option>";
        //echo "$row[0]";
    }

    echo "<form method='post'> 
            <select name='Columns' id='ddColumns'>
                $cols
            </select>
            <input type='hidden' name='table' value='$table'/>
            <input type='submit' id='Submit' value='Pick this column'/>
        </form>";

    // echo "<form method='post'>
    //         <select name='Columns' id='ddColumns'>
    //             $cols
    //         </select>
    //         <input type='hidden' name='table' value=$table/>
    //         <input type='submit' id='Submit' value='Pick this column' formaction='354-aggregate-step2.php'/>
    //     </form>"; // table could be for example animal, we are passing table to step 2


    // connects to 354-aggregate-step2
    // Theoretically, the above statement should return the column selected

    // We cannot get column without table!!! Aka '354-dropdown-all-tables.php'

?>
</form>