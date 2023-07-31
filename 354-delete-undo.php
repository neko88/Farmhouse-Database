<!-- 
    Page: Undo Delete Page
    Description: Delete data as per selected row.
-->
<h2>FarmDB: Restore Deleted Record</h2>

<?php
    include '354-connect.php';
    $conn = OpenCon();
    session_start();

    $table = $_SESSION['table_chosen'];
    $entry_data = $_SESSION['entry_data'];
    $num_fields = $_SESSION['num_fields'];
    $col_name = $_SESSION['col_name'];
    $deleteRecord = $_SESSION['deleteRecord'];

    // query sql delete to record from table
    $i = $num_fields;
    $sql = "INSERT INTO $table VALUES (";
            foreach ($entry_data as $data){
            $sql.="'";
            $sql.=$data;
            $sql.="'";
            if ($i != 1){
               $sql.=",";
            }
            $i--;
            }
    $sql.=");";

    $result = $conn->query($sql);
    if ($result){
        echo "\n<h3>Record has been successfully restored.</h3>";
    }else{
        echo "<h3>Error reversing deletion.</h3>" . $conn->error;
    }

    //print the restored record
    $show_record = mysqli_query($conn,"
        SELECT * FROM $table
        WHERE $col_name ='$deleteRecord'");

    echo "<table border='1'><tr>";
    $field_info = mysqli_fetch_fields($show_record);
    // print column names of table 
    foreach ($field_info as $v){
        echo "<th>{$v->name}</th>";
    }
    echo"</tr>";
    while ($row = mysqli_fetch_row($show_record)){
        echo "<tr>";
        foreach ($row as $col){
            echo "<td>{$col}</td>";
        }
        echo"</tr>";
    }
    echo "</table>";

    // button to return home 
    echo '
    <form action="354-home.php">
    <input type="submit" value="Go Home" />
    </form>';
?>