<!-- 
    Page: Home page.
    Description: the first page that the user encounters. Here they can select what type of query they wish to make.

    TODO: 
        - Make the rest of the pages.
-->




<h2>FarmDB: Home</h2>
<h3>Welcome to the Farm Database! Please pick a query type.</h3>

<form action="354-insert.php">
    <input type="submit" value="Insert" />
</form>
<form action="354-delete.php">
    <input type="submit" value="Delete" />
</form>
<form action="354-update.php">
    <input type="submit" value="Update" />
</form>
<form action="354-select.php">
    <input type="submit" value="Select" />
</form>
<form action="354-project.php">
    <input type="submit" value="Project" />
</form>
<form action="354-join.php">
    <input type="submit" value="Join" />
</form>
<form action="354-aggregate.php">
    <input type="submit" value="Aggregate" />
</form>
<form action="354-nested.php">
    <input type="submit" value="Nested" />
</form>
<form action="354-divide.php">
    <input type="submit" value="Divide" />
</form>


<!-- START : NEKO EDIT JUL 23 -->

<!-- Pick a table to view on the home page -->
<h3>Pick a table view from the database.</h3>
<form method='post'> 
    <?php 
        include('354-dropdown-all-tables.php');
    ?>
</form>

<!-- Print the fields and values from chosen table. -->
<?php
    $table = $_POST['Tables'];
    echo"<h4>Viewing table from $table:</h4>";

    $result = mysqli_query($conn,"SELECT * FROM $table");
    if (!$result) {
        echo "ERROR: Unable to SELECT from $table.\n";
        exit;
    } 

    echo "<table border='1'><tr>";
    $field_info = mysqli_fetch_fields($result);

    foreach ($field_info as $val){
        echo "<th>{$val->name}</th>";
    }
    echo"</tr>";

    while ($row = mysqli_fetch_row($result)){
        echo "<tr>";
        foreach ($row as $col){
        echo "<td>{$col}</td>";
        }
        echo"</tr>";
    }
    echo "</table>";
    ?>

<!-- END : NEKO EDIT JUL 23 -->

<!-- Experimenting with a dropdown version 1-->
<!-- <div class="dropdown">
  <button class="dropbtn">Dropdown</button>
  <div class="dropdown-content">
    <a href="354-insert.php">Insert</a>
    <a href="354-delete.php">Delete</a>
    <a href="354-update.php">Update</a>
    <a href="354-select.php">Select</a>
    <a href="354-project.php">Project</a>
    <a href="354-join.php">Join</a>
    <a href="354-aggregate.php">Aggregate</a>
    <a href="354-nested.php">Nested</a>
    <a href="354-divide.php">Divide</a>
  </div>
</div> -->


<!-- Experimenting with a dropdown version 2-->
<!-- 
<form action="354-pick-query.php" method='post'> 
    <select name='Tables' id='ddTables'>
        <option value='insert'>Insert</option>
        <option value='delete'>Delete</option>
        <option value='update'>Update</option> 
        <option value='select'>Select</option> 
        <option value='project'>Project</option> 
        <option value='join'>Join</option> 
        <option value='aggregate'>Aggregate</option> 
        <option value='nested'>Nested</option>  
        <option value='divide'>Divide</option> 
    </select>
    <input type='submit' id='Submit' value='Submit'/>
</form> -->