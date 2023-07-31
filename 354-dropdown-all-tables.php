<!-- Display dropdown menu containing all tables. -->
<select name='Tables' id='ddTables'>
    <!-- select is a tag which gives options to the user to pick -->
    <?php
        error_reporting(0);
        include '354-connect.php';
        // $conn variable is used to connect PHP file to MySQL Farm Database
        $conn = OpenCon();

        // SQL Query to get tables from farm
        $sql = "SHOW TABLES FROM farm;";
        // We pass $sql as a parameter to get the tables
        $result = $conn->query($sql);
        // echo $result;

        // Case: result failed
        if (!$result) {
            echo "Unable to show tables.\n";
            exit;
        }

        // initialize $tables variable to collect tables
        // .= will concatenate the tables
        // option value refers to each table available
        // I don't understand '{$row[0]}'>{$row[0]}?
        $tables = '';
        while ($row = $result->fetch_row()) {
            $tables .="<option value='{$row[0]}'>{$row[0]}</option>";
        }
        
        // Print the tables, aka display the tables
        echo $tables;
        // type submit means it's a button and the text in the button is 'Pick this table'
    ?>
</select>
<input type='submit' id='tableSubmit' value='Pick this table'/>