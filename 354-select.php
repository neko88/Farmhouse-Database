<!-- 
    Page: Select page.
    Description: User selects data from a specific table that meet specific requirements.

    TODO: 
        - Show descriptive error message, outlining exactly what went wrong, when SQL query doesn't work.
-->

<h2>FarmDB: Select</h2>
<h3>Pick a table.</h3>
<form method='post'> 
    <?php 
        include('354-dropdown-all-tables.php');
    ?>
</form>

<?php
    $table = $_POST['Tables'];

    // Get columns of table.
    $sql = "SHOW COLUMNS FROM $table;";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Unable to show columns.\n";
        exit;
    }

    // Show a dropdown of all the columns in the table.
    $pickACol = '';
    $pickACol .=  "<hr>";
    $pickACol .=  "<h4>Pick a column from $table (optional).</h4>";
    $pickACol .= "<select name='Columns' id='ddColumns'>";
    $pickACol .="<option value='*'>*</option>";

    // Now show a field for each column in the table.
    $cols = '';
    $col_names = array();
    $col_types = array();
    while ($row = $result->fetch_row()) {
        $pickACol .="<option value='{$row[0]}'>{$row[0]}</option>";
        // $row[0]: column's name.
        // $row[1]: column's type e.g. VARCHAR(20) or INT.
        // $row[2]: Whether it can be nullable.
        // $row[3]: PRI if primary key, MUL if _, and nothing if neither.
        // $row[4]: Default value if any.
        // $row[5]: Extra info if any.
        array_push($col_names, $row[0]);
        array_push($col_types, $row[1]);

        
        // For each column in the table, depending on type, create a field where the user can (optionally) specify a requirement. 
        if (str_contains($row[1], 'char')) {
            $type = 'type="text"';
        }
        else if (str_contains($row[1], 'int')) {
            $type = 'type="number" min="0"';
        } 
        else if (str_contains($row[1], 'date')) {
            $type = 'type="date"';
        }

        $cols .= "<table border='1' cellpadding='10'><tr><td>";
        $cols .="<label> {$row[0]} == </label>";
        $cols .= "<input name='{$row[0]}E' $type $required placeholder='Type Here'><br>";

        $cols .="<label> {$row[0]} != </label>";
        $cols .= "<input name='{$row[0]}NE' $type $required placeholder='Type Here'>";
        $cols .= "</td></tr></table><br>";
    }

    $col_names_str =htmlspecialchars(serialize($col_names));
    $col_types_str =htmlspecialchars(serialize($col_types));

    // HTML for the dropdown menus/input fields.
    // Also, use <input type='hidden' ...> to pass information to 354-insert-submitted.php through POST.


    $pickACol .= "</select>
    <hr>
    <h4>Add requirements (optional).</h4>";
    
    echo "
    <form  method='post'> 
        $pickACol
        $cols
        <input type='hidden' name='table' value=$table/>
        <input type='hidden' name='col_names' value=$col_names_str/>
        <input type='hidden' name='col_types' value=$col_types_str/>
        <input type='submit' id='input-data' value='Input data' formaction='354-select-submitted.php'/>
    </form>";

    
?>