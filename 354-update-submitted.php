<!-- 
    Page: Update Submitted Page
    Description: Run request to update data to the database & confirm if successful.
-->
<h2>FarmDB: Update Data</h2>

<?php

    include '354-connect.php';
    $conn = OpenCon();
    session_start();

    $old_data = $_SESSION['old_data'];
    $table = rtrim($_POST['table'], '/');
    $pk_col_name = $_SESSION['pk_col_name'];
    $update_data = $_POST['update_data'];
    $col_names = unserialize($_POST['col_names']);
    $col_types = unserialize($_POST['col_types']);

    $sql = "UPDATE $table SET ";
            foreach($col_names as $v){
                if ($_POST[$v] == ''){
                } else{
                    $sql .= "$v = '$_POST[$v]'";
                    if ($v === end($col_names)){
                    }else{
                        $sql .= ",";
                    }
                }
            }
            $sql .= " WHERE $pk_col_name = '$old_data[0]';";

    $result = $conn->query($sql);
    if (!$result) {
        echo "ERROR: Unable to update data.\n";
        exit;
    }

    $j = 0;
    echo "<h2>Successfully Updated in $table: </h2>";
    foreach($col_names as $val){
        echo "<span style='font-size:125%'>[";
        echo $val;
        echo "]: </span></br>";
        echo $old_data[$j];
        echo " --> ";
        if ($_POST[$val] == '' || $old_data[$j] == $_POST[$val]){
            "<span style='color:black; font-size:20px'>";
            echo "$_POST[$val]</span>";
        }else{
            echo "<span style='color:green; font-size:20px'>";
            echo "$_POST[$val]</span>";
        }
        echo "</br></br>";
        $j++;
    }
    // navigation buttons 
    echo'<form method ="post">
        <input type="button" value="Update Another Record" onClick="javascript:history.go(-3)"/>
        </form>';
    echo '
    <form action="354-home.php">
    <input type="submit" value="Go Home" />
    </form>';

    session_close();
    $conn->close();
?>
