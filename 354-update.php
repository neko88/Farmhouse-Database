<!-- 
    Page: Update page.
    Description: User selects a table and updates its data.

    TODO: 
        - When the user picks a table, display an input form containing whatever info they might need to update. 
        - When the user submits their new data, update the data in the database.
        - Make sure to warn the user if some fields cannot be empty (NULL).
-->

<h2>FarmDB: Update Data</h2>
<h3>Pick a table to update.</h3>
<form method='post'> 
    <!-- Change action from sum.php to other when ready. -->
    <?php
        include('354-dropdown-all-tables.php');
        include('354-show-table.php');
    ?>
</form>

<?php
    session_start();
    $table = $_POST['Tables'];

    // query to get name of the column that is the primary key 
    $result = $conn->query("
        SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
        WHERE TABLE_NAME = '$table'
        AND CONSTRAINT_NAME = 'PRIMARY'
        ");
    if (!$result) {
        echo "ERROR: Unable to SELECT from columns.\n";
        exit;
    }

    $row = $result->fetch_row();

    echo '<h3> Select a record to update under ';
    if ($row){
        echo $row[0];
    }
    echo ':</h3>';

    // select the primary key column in the table 
    $res = $conn->query("SELECT $row[0] FROM $table");
    $_SESSION['pk_col_name'] = $row[0];
    $_SESSION['table_chosen'] = $table;
 
   if (!$res) {
        echo "ERROR: Unable to SELECT $row[0] FROM $table";
        exit;
    }

    // print primary key value options to delete within the specified table 
    $update_data ='';
    while($record = mysqli_fetch_row($res)){
        foreach($record as $rec){
        $update_data .="<option value = $rec>$rec</option>";
        }
    }

    // button which directs to deletion submitted page 
    echo"
    <form method ='post'>
        <select name='update_data' id='update_data-dropdown'>
        $update_data
        </select>
        <input type='submit' value='Update this record'formaction='354-update-input.php'/>
        </form>";

    $conn->close();
?>