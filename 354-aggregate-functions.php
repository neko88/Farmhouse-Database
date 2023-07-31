<!-- 
    Page: Aggregate functions.
    Description: User selects a table, then selects a column, and then selects an available aggregate function.

-->

<!-- post means that it will all be saved in the URL but won't be shown in the URL -->
<form method='post'>
<?php
    $column = $_POST['Columns']; // We have access because of the form action
    
    $table = $_POST['table'];
    //echo "The table is $table";
    
    $resultToUse = $_POST['result'];

    // STARTS HERE
    $colss = '';
    if ( $column == "quantity" || $column == "salary_per_hour" ) {   
        echo "<hr>";

        echo "<h3>Pick an aggregate function from $column.</h3>";

        // Concatenate
        $colss .= "<option value='count'>count</option>";
        $colss .= "<option value='average'>average</option>";
        $colss .= "<option value='minimum'>minimum</option>";
        $colss .= "<option value='maximum'>maximum</option>";
        $colss .= "<option value='sum'>sum</option>";
        
        // Below we have the dropdown menu for aggregate functions
        echo "<form method='post'> 
                <select name='Functions' id='ddFunctions'>
                    $colss
                </select>
                <input type='hidden' name='column' value='$column'/>
                <input type='hidden' name='table' value='$table'/>
                <input type='submit' id = 'functionSubmit' value = 'Pick this function' formaction='354-aggregate-submitted.php'/>
            </form>";

        //$function = $_POST['Functions'];
        //echo "function: $function";
    }
    else if ( !is_null($column) ){
        echo "<hr>";

        echo "<h3>Pick an aggregate function from $column.</h3>";

        // Concatenate
        $colss .= "<option value='count'>count</option>";

        // Below we have the dropdown menu for aggregate functions
        echo "<form method='post'> 
                <select name='Functions' id='ddFunctions'>
                    $colss
                </select>
                <input type='hidden' name='column' value='$column'/>
                <input type='hidden' name='table' value='$table'/>
                <input type='submit' id = 'functionSubmit' value = 'Pick this function' formaction='354-aggregate-submitted.php'/>
            </form>";
        
        //$function = $_POST['Functions'];
        //echo "function: $function";
    }

    

    //<input type='submit' id='tableSubmit' value='Pick this table'/>
    //<input type='submit' id='Submit' value='Pick this column'/>
    //<button type='button'>submit</button> 


?>
</form>