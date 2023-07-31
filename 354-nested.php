<!-- 
    Page: Nested Aggregate page.
    Description: User selects a table, then selects a column, and then selects an available aggregate function.

-->

<h2>FarmDB: Nested Aggregation</h2>
<h3>Pick a table.</h3>

<form method='post'> 
    <?php
        error_reporting(0); 
        include('354-dropdown-all-tables.php');
        include('354-dropdown-columns-nested.php');
        //include('354-dropdown-columns-nested2.php');
        //include('354-nested-functions.php');
    ?>
</form>

<!-- Pick Column -->
<!-- post means that it will all be saved in the URL but won't be shown in the URL -->
<form method='post'>
<?php
    
    


?>
</form>
