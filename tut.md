QUICK TUTORIAL ON PHP/HTML (mainly a summary on what I've been using the most today):

Name all your files <filename>.php

PHP is more for the "logic", and HTML is more for the "UI". AFAIK there are 2 ways for us to use PHP and HTML together:
1. Use <?php ?> inside HTML tags.
    Example:
        ```
        <form method='post'> 
            <?php 
                include('354-dropdown-all-tables.php');
            ?>
        </form>
        ```

2. Use `echo "<HTML CODE HERE>"` inside the PHP tag. 
    Example:
        ```
        echo "
        <form  method='post'> 
            $cols
            <input type='hidden' name='table' value=$table/>
            <input type='hidden' name='col_names' value=$col_names_str/>
            <input type='hidden' name='col_types' value=$col_types_str/>
            <input type='submit' id='input-data' value='Input data' formaction='354-insert-submitted.php'/>
        </form>";
        ```        

Basic PHP syntax:
    Variables all start with $. For example, `$i = 0` and `$name = "George";`
    
    Arrays
        $fruit = array();               // Make array
        array_push($fruit, "apple");    // Push to array
        $fruit[0] = "orange";           // Edit array entry

    Showing stuff on the screen
        echo 'Fruit'                    // Will display the text "Fruit" on the screen.

    Putting variables in the middle of strings
        $word = "there"
        echo "Hello $word"              // Will show "Hello there" on screen.


SQL queries
    1. Write SQL query.
    2. Send query.
    3. Get rows from result. The rows are your data.
    
    Tip: If you're not sure what is being returned, you can try various print (echo) statements. For example, if `count($row)` > 0, then it's an array and you can access and print each element.

        $sql = "SHOW TABLES FROM farm;";
        $result = $conn->query($sql);

        while ($row = $result->fetch_row()) {
            echo $row;
            echo count($row);
            echo $row[0];
        }



Getting user input through HTML
    As shown above, we use forms and POST to work with information that we receive from the user.
    To actually get the info from the user, we can put buttons, dropdowns, and input fields inside those forms.

    Submit button: We use a special type of input to tell the form that the user is done inputting stuff.
        <form method="post"> 
            <input type="submit" value="Search">
        </form>

    Input fields:
        <form method="post"> 
            <input name="fruits" type="text" placeholder="Type Fruit Here">
            <input type="submit" value="Search">
        </form>

    Dropdowns:
        <form method="post"> 
            <select name="fruits" id="fruits">
                <option value="apple">Apple</option>
                <option value="orange">Orange</option>
            </select>
            <input type="submit" value="Search">
        </form>



Passing variables between PHP files:
    There might be a better way of doing this, but I am using form and POST.
    1. Create an HTML <form> and give it the POST method.
    2. If you want to pass information without having it show up on screen, use a hidden input.
        Example where we pass the table variable:
        <form  method='post'> 
            <input type='hidden' name='table' value=$table/>
        </form>
    3. If you want to pass information and have it show up on screen (e.g. get user input and pass to another file), use a normal input.
        Example where we pick a table from a dropdown menu:
        <form  method='post'>
            <select name='Tables' id='ddTables'>
                // PHP code that creates items in the dropdown menu
            </select>
        </form>
    4. Access the information using $_POST:
        $table = $_POST['table'];
        $table = $_POST['Tables']; 

