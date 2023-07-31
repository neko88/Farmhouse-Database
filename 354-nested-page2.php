<!-- 
    Page: Nested Aggregate page.
    Description: User selects a table, then selects a column, and then selects an available aggregate function.

-->

<h2>FarmDB: Nested Aggregation</h2>

<!-- Pick Column -->
<!-- post means that it will all be saved in the URL but won't be shown in the URL -->
<form method='post'>
<?php
    error_reporting(0);
    $table = $_POST['table'];
    $primaryColumn = $_POST['primaryColumn'];
    $secondaryColumn = $_POST['Columns2']; // We have access because of the form action
    
    //echo "The table selected is $table <br>";
    //echo "The primary column selected is $primaryColumn <br>";
    //echo "The secondary column selected is $secondaryColumn <br>";
    
    $resultToUse = $_POST['result'];

    // STARTS HERE
    $colss = '';
    if ( $secondaryColumn == "quantity" || $secondaryColumn == "salary_per_hour" ) {   
        //echo "<hr>";

        echo "<h3>Pick an aggregate function to apply to $secondaryColumn.</h3>";

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
                <input type='hidden' name='table' value='$table'/>
                <input type='hidden' name='primaryColumn' value='$primaryColumn'/>
                <input type='hidden' name='secondaryColumn' value='$secondaryColumn'/>
                <input type='submit' id = 'functionSubmit' value = 'Pick this function' formaction='354-nested-submitted.php'/>
            </form>";

        //$function = $_POST['Functions'];
        //echo "function: $function";
    }
    else{
        echo "<hr>";

        echo "<h3>Pick an aggregate function to apply to $secondaryColumn.</h3>";

        // Concatenate
        $colss .= "<option value='count'>count</option>";

        // Below we have the dropdown menu for aggregate functions
        echo "<form method='post'> 
                <select name='Functions' id='ddFunctions'>
                    $colss
                </select>
                <input type='hidden' name='table' value='$table'/>
                <input type='hidden' name='primaryColumn' value='$primaryColumn'/>
                <input type='hidden' name='secondaryColumn' value='$secondaryColumn'/>
                <input type='submit' id = 'functionSubmit' value = 'Pick this function' formaction='354-nested-submitted.php'/>
            </form>";
        
        //$function = $_POST['Functions'];
        //echo "function: $function";
    }
    


?>
</form>