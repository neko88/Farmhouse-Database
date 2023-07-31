
<!-- 
    Page: Join - Table 2
    Description: Pick the 2nd table

Join tables by one of the following options:

(INNER) JOIN: Returns records that have matching values in both tables
LEFT (OUTER) JOIN: Returns all records from the left table, and the matched records from the right table
RIGHT (OUTER) JOIN: Returns all records from the right table, and the matched records from the left table
FULL (OUTER) JOIN: Returns all records when there is a match in either left or right table
-->


<h2>FarmDB: Join Tables</h2>
<h3>Pick the second table to join.</h3>
<form method='post'> 
    <!-- Change action from sum.php to other when ready. -->
    <?php
        include('354-dropdown-all-tables.php');
        include('354-show-table.php');
    ?>
</form>

<?php
    session_start();
    $table_one = $_SESSION['table_one'];
    $table_two = $_POST['Tables'];
    $_SESSION['table_one'] = $table_one;
    $_SESSION['table_two'] = $table_two;
    
    echo"
    <form method ='post'>
        <input type='submit' value='NEXT' formaction='354-join-options.php'/>
        </form>";
    $conn->close();
?>