<!-- 
    Page: Aggregate page.
    Description: User selects a table, then selects a column, and then selects an available aggregate function.

-->

<h2>FarmDB: Aggregate</h2>

<form method='post'> 
    <?php
        error_reporting(0);
        
        $function = $_POST['Functions'];
        //echo "The function selected is $function";
        //echo "<br>";

        $table = $_POST['table'];
        //echo "The table is $table";
        //echo "<br>";

        $column = $_POST['column'];
        //echo "The column is $column";
        //echo "<br>";

        include '354-connect.php';
        $conn = OpenCon();
        $sql = "SELECT $column FROM $table;"; // e.g. $table = animal, this is the query
        $result = $conn->query($sql); // We pass this query


        // Case: Query failed
        if (!$result) {
            echo "Unable to show columns.\n";
            exit;
        }


        if( $function == 'count' ) {
            //echo "Inside";
            $countCounter = 0;
            while ($row = $result->fetch_row()) {
                //echo "$row[0]";
                //echo "<br>";
                $countCounter++;
            }
            echo "$function = $countCounter";
        }


        else if( $function == 'average' ) {
            // Numerator
            $sum = 0;
            // Denominator
            $countCounter = 0;
            while ($row = $result->fetch_row()) {
                $sum+=$row[0];
                $countCounter++;
            }
            $average = $sum/$countCounter;
            echo "average = $average";
        }
        
        else if( $function == 'minimum' ) {
            $row = $result->fetch_row();
            $minimum = $row[0];
            while( $row = $result->fetch_row() ) {
                if( $row[0] < $minimum )
                    $minimum = $row[0];
            }
            echo "minimum = $minimum";
        }

        else if( $function == 'maximum' ) {
            $row = $result->fetch_row();
            $maximum = $row[0];
            while( $row = $result->fetch_row() ) {
                if( $row[0] > $maximum )
                    $maximum = $row[0];
            }
            echo "maximum = $maximum";
        }

        else if( $function == 'sum' ) {
            $sum = 0;
            while ($row = $result->fetch_row()) {
                $sum+=$row[0];
            }
            echo "sum = $sum";
        }




        //$thisResult = $_POST['resultToUse'];


        //while ($row = $thisResult->fetch_row()) {
            //echo "hi";
            //echo "$row[0]";
        //}


        // echo "<br>";

        // $col = $_POST['column'];
        // echo "The column is $col";

    ?>
</form>