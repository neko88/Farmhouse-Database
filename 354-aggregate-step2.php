<!-- 
    Page: Aggregate page 2.
    Description: User selects a table, then selects a column, and then selects an available aggregate function.

-->
<h2>FarmDB: Aggregate</h2>

<form method='post'> 
    <?php
        error_reporting(0); 
        include('354-dropdown-all-tables.php');
    ?>
</form>

<!-- Pick Aggregate Function -->
<form method='post'>
<?php
    error_reporting(0);
    // How does it find it
    $column = $_POST['Columns']; // We have access because of the form action
    // Here we only have a name, we don't have the array of columns

    // Get columns of table.
    // $sql = "SHOW COLUMNS FROM $table;";
    // $result = $conn->query($sql);

    // if (!$result) {
    //     echo "Unable to show columns.\n";
    //     exit;
    // }

    echo "<h4>Pick aggregate function.</h4>";
    // Text
    $table = $_POST['Tables'];

    echo "Test to see if table name appears";
    echo '<hr>';
    echo "$table";
    echo '<hr>';

    echo "Test to see if column name appears";
    echo '<hr>';
    echo "$column";
    echo '<hr>';


    if ( $column == "quantity" || $column == "salary_per_hour" ) {   
        echo '<form action="354-aggregate-average.php">
        <button type="submit">average</button>
        </form> <br>';

        echo '<form action="354-aggregate-count.php">
        <button type="submit">count</button>
        </form> <br>';

        echo '<form action="354-aggregate-sum.php">
        <button type="submit">sum</button>
        </form> <br>';

        echo '<form action="354-aggregate-minimum.php">
        <button type="submit">minimum</button>
        </form> <br>';

        echo '<form action="354-aggregate-maximum.php">
        <button type="submit">maximum</button>
        </form>';

        $count = 0;

    }
    else{
        echo '<form action="354-aggregate-count.php">
            <button type="submit">count</button>
            </form>';
    }
    
    echo '<br>';

    // // Get aggregate functions from table.
    // $sql = "SHOW COLUMNS FROM $column;";
    // $result = $conn->query($sql);

    // Show a dropdown of available aggregate functions.
    // $cols = '';
    // while ($row = $result->fetch_row()) {
    //     $cols .="<option value='{$row[0]}'>{$row[0]}</option>";
    // }

    // echo '<br>
    // <form action="354-home.php">
    // <input type="submit" value="Back to Home" />
    // </form>'
    // echo "
    // <form method='post'> 
    //     <select name='Columnss' id='ddColumns'>
    //         $cols
    //     </select>
    //     <input type='hidden' name='table' value=$table/>
    //     <input type='submit' id='Submit' value='Pick this column' formaction='354-aggregate-count.php'/>
    // </form>";

?>
</form>

