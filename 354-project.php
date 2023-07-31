<!-- 
    Page: Project page.
    Description: User selects a table to see a single column from, with no duplicates.

    TODO: 
        - Show descriptive error message, outlining exactly what went wrong, when SQL query doesn't work.
-->

<h2>FarmDB: Project</h2>
<h3>Pick a table to view a single column from.</h3>
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
    echo "<hr>";
    echo "<h4>Pick a column from $table.</h4>";

    // Show a dropdown of all the columns in the table.
    $cols = '';
    while ($row = $result->fetch_row()) {
        $cols .="<option value='{$row[0]}'>{$row[0]}</option>";
    }

    echo "
    <form  method='post'> 
        <select name='Columns' id='ddColumns'>
            $cols
        </select>
        <input type='hidden' name='table' value=$table/>
        <input type='submit' id='Submit' value='Pick this column' formaction='354-project-submitted.php'/>
    </form>";
?>
