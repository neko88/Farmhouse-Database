<!-- 
    Page: Update Input.
    Description: Get values to be updated that are input by the user.
-->
<h2>FarmDB: Update Data</h2>

<?php
    include '354-connect.php';
    $conn = OpenCon();
    session_start();

    $update_data = $_POST['update_data'];
    $table = $_SESSION['table_chosen'];
    $pk_col_name = $_SESSION['pk_col_name'];

    echo"<h3>You are currently making updates in $table to the entry:</h3>";
    $old_data = array();

    // select the record to delete 
    $result = mysqli_query($conn,"
    SELECT * FROM $table
    WHERE $pk_col_name ='$update_data'");

    // print the to-update record info 
    echo "<table border='1'><tr>";
    $table_col_names = mysqli_fetch_fields($result);

    // print column names of table 
    foreach ($table_col_names as $col){
        echo "<th>{$col->name}</th>";
    }
    echo"</tr>";

    $i=0;
    // print rows in the table

    while ($row = mysqli_fetch_row($result)){
        echo "<tr>";
        foreach ($row as $data){
        echo "<td>{$data}</td>";
        $old_data[$i] = (string)$data;
        $i++;
        }
        echo"</tr>";
    }
    echo "</table>";

    // Get foreign keys of table.
    $sql = "SHOW CREATE TABLE $table;";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Unable to get foreign keys.\n";
        exit;
    }

    // Parse return statement and create an array with all the foreign keys and what they refer to.
    $create_statement = $result->fetch_row()[1];

    $needleLeft = "FOREIGN KEY (`";
    $needleRight = "`)";
    $pos = 0;
    $fks = array();
    $i = 0;

    // The end result we want is for each entry in $fks to represent the data of a single foreign key. Then,
    //      $fks[0][0] = name of the foreign key in our current table.
    //      $fks[0][1] = name of the table we are referring to.
    //      $fks[0][2] = name of the column we are referring to.
    // Example: FOREIGN KEY (`tends`) REFERENCES `Employee` (`id_employee`) 
    //      $fks[0][0] = 'tends'
    //      $fks[0][1] = 'Employee'
    //      $fks[0][2] = 'id_employee'
    while (($pos = strpos($create_statement, $needleLeft, $pos))!== false) {
        $fk_data = array();

        // 1. Find index after FOREIGN KEY (', e.g. tends.
        $i = $pos + strlen($needleLeft);
        $pos = $pos + strlen($needleLeft);
        $rest_of_statement = substr($create_statement, $i);
        array_push($fk_data, strstr($rest_of_statement, $needleRight, true));
        
        // 2. Now find REFERENCES table_name and push table_name into array, e.g. Employee.
        $i += strlen(strstr($rest_of_statement, $needleRight, true));
        $i += strlen("`) REFERENCES `");
        $rest_of_statement = substr($create_statement, $i);
        array_push($fk_data, strstr($rest_of_statement, "` (`", true));

        // 3. Finally, find the column that we are referring to, e.g. id_employee.
        $i += strlen(strstr($rest_of_statement, "` (`", true));
        $i += strlen("` (`");
        $rest_of_statement = substr($create_statement, $i);
        array_push($fk_data, strstr($rest_of_statement, "`)", true));

        array_push($fks, $fk_data);
    }

    // Get the foreign options for each foreign key.
    $fks_options = array();
    $i = 0;
    foreach ($fks as &$fk) {

        // Get all valid options in table.
        $sql = "SELECT $fk[2] FROM $fk[1];";
        $result = $conn->query($sql);

        if (!$result) {
            echo "Unable to show columns.\n";
            exit;
        }

        $options = '';
        while ($row = $result->fetch_row()) {
            $options .="<option value='{$row[0]}'>{$row[0]}</option>";
        }

        $fks_options[$i] = $options;
        $i++;
    }

    // Get columns of table.
    $sql = "SHOW COLUMNS FROM $table;";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Unable to show columns.\n";
        exit;
    }
    echo "<hr>";
    echo "<h4>Input desired updates.</h4>";

    $cols = '';
    $col_names = array();
    $col_types = array();
    // For each column in the table, create either a dropdown menu or an input field.

    $k=0;
    while ($row = $result->fetch_row()) {
        // $row[0]: column's name.
        // $row[1]: column's type e.g. VARCHAR(20) or INT.
        // $row[2]: Whether it can be nullable.
        // $row[3]: PRI if primary key, MUL if _, and nothing if neither.
        // $row[4]: Default value if any.
        // $row[5]: Extra info if any.

        array_push($col_names, $row[0]);
        array_push($col_types, $row[1]);

        if (str_contains($row[1], 'char')) {
            $type = 'type="text"';
        }
        else if (str_contains($row[1], 'int')) {
            $type = 'type="number" min="0"';
        } 
        else if (str_contains($row[1], 'date')) {
            $type = 'type="date"';
        }

        if ($row[2] == 'NO') {
            $required = 'required';
        } else {
            $required = '';
        }

        // If foreign key, display a dropdown menu.
        $i = 0;
        $cols .="<label>{$row[0]}: </label>";
        $is_fk = false;
        foreach ($fks as &$fk) {
            if ($fk[0] == $row[0]) {
                
                $cols .= "<select name='$row[0]' id='$row[0]-dropdown'>";
                // If nullable, add an empty option.
                if ($required == '') {
                    $cols .= "<option selected='selected' value='{$old_data[$k]}'>$old_data[$k]</option>";
                }
                $cols .= "$fks_options[$i] </select><br><br>";
                $is_fk = true;
                break;
            }
            $i++;
        }

        // Else display an input field:
        if (!$is_fk) {
            $cols .= "<input name='{$row[0]}' $type $required value='{$old_data[$k]}'><br><br>";
        }
        $k++;
    }

    $col_names_str =htmlspecialchars(serialize($col_names));
    $col_types_str =htmlspecialchars(serialize($col_types));
    $_SESSION['old_data'] = $old_data;
    $_SESSION['table_name'] = $table;
    $_SESSION['pk_col_name'] = $pk_col_name;
    $_SESSION['update_data'] = $update_data;

    echo "
    <form  method='post'> 
        $cols
        <input type='hidden' name='table' value=$table/>
        <input type='hidden' name='col_names' value=$col_names_str/>
        <input type='hidden' name='col_types' value=$col_types_str/>
        <input type='submit' id='update-data' value='Update Data' formaction='354-update-submitted.php'/>
    </form>";

    $conn->close();
?>