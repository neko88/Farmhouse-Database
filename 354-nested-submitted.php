<!-- 
    Page: Nested Aggregate page.
    Description: User selects a table, then selects a column, and then selects an available aggregate function.

-->

<h2>FarmDB: Nested Aggregation</h2>

<form method='post'> 
    <?php
        error_reporting(0);
        
        $table = $_POST['table'];
        $primaryColumn = $_POST['primaryColumn'];
        $secondaryColumn = $_POST['secondaryColumn'];
        $function = $_POST['Functions'];
        
        // echo "table = $table <br>";
        // echo "primary column = $primaryColumn <br>";
        // echo "secondary column = $secondaryColumn <br>";
        // echo "aggregate function selected = $function <br>"; 

        // echo "<br>";
        echo "$primaryColumn : $function($secondaryColumn)";
        echo "<br>";

        include '354-connect.php';
        $conn = OpenCon();

        
        if ( $function == 'count' ) {
            $var = 'COUNT';
        }
        else if ( $function == 'sum' ) {
            $var = 'SUM';
        }
        else if ( $function == 'average' ) {
            $var = 'AVG';
        }
        else if ( $function == 'minimum' ) {
            $var = 'MIN';
        }
        else if ( $function == 'maximum' ) {
            $var = 'MAX';
        }
        
        echo "<br>";

        $sql = "SELECT $primaryColumn FROM $table;"; // e.g. $table = animal, this is the query
        $result = $conn->query($sql); // We pass this query

        while ($row = $result->fetch_row()) {
            //echo "$row[0]<br>";
            $sql2 = "SELECT $var($secondaryColumn) FROM $table WHERE $primaryColumn = '$row[0]';"; // e.g. $table = animal, this is the query
            $result2 = $conn->query($sql2); // We pass this query
            $row2 = $result2->fetch_row();
            $res = $row2[0];
            echo "$row[0] : $res<br>";
        }
        
        echo "<br>";

        // Button to go back to home
        echo "<br>
        <form method='post'>
            <input type='submit' value='Back to Home' formaction='354-home.php' />
        </form>"


    ?>
</form>