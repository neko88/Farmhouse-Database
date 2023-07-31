<!-- 
    Page: Deleted Submitted Page
    Description: Delete data as per selected row.
-->
<h2>FarmDB: Record Delete</h2>

<?php
    include '354-connect.php';
    $conn = OpenCon();
    session_start();

    $deleteRecord = $_POST['deleteRecord'];
    $table = $_SESSION['table_chosen'];
    $col_name = $_SESSION['col_name'];
    

    $num_fields = 0;
    $entry_data = array();  // array to store the deleted record incase of undo deletion

    // select the record to delete 
    $result = mysqli_query($conn,"
    SELECT * FROM $table
    WHERE $col_name ='$deleteRecord'");


    // print the deleted record info 
    echo "<table border='1'><tr>";
    $field_info = mysqli_fetch_fields($result);
    // print column names of table 
    foreach ($field_info as $v){
        echo "<th>{$v->name}</th>";
        $num_fields++;
    }
    echo"</tr>";
    // print rows in the table

    $i = 0;
    while ($row = mysqli_fetch_row($result)){
        echo "<tr>";
        foreach ($row as $col){
        echo "<td>{$col}</td>";
        $entry_data[$i]=$col;
        $i++;
        }
        echo"</tr>";
    }
    echo "</table>";

    // query sql delete to record from table
    $sql = "DELETE FROM $table
            WHERE $col_name = '$deleteRecord'
            ;";

    $result = $conn->query($sql);

    if ($result){
        echo "\n<h3>Record deleted successfully.</h3>";
    }else{
        echo "<h3>Error deleting record </h3>" . $conn->error;
    }

    $_SESSION['table_chosen'] = $table;
    $_SESSION['num_fields'] = $num_fields;
    $_SESSION['entry_data'] = $entry_data;
    $_SESSION['col_name'] = $col_name;
    $_SESSION['deleteRecord'] = $deleteRecord;


    // navigation buttons 
    echo'<form method ="post">
        <input type="button" value="Delete Another Record" onClick="javascript:history.go(-2)"/>
        </form>';
    echo '
    <form action="354-home.php">
    <input type="submit" value="Go Home" />
    </form>';
    echo"
        <form method ='post'>
        <input type='submit' value='Undo Delete' formaction='354-delete-undo.php'/>
        </form>";

?>

