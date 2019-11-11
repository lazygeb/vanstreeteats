<?php
    //function to open connection to database
    function openConnection(&$connection) {
        //open the connection to the database
        $connection = mysqli_connect("localhost", "root", "", "gabriele_dalcengio"); 

        // Test if connection succeeded 
        if(mysqli_connect_errno()) { 
            // if connection failed, skip the rest of PHP code, and print an error 
            die("Database connection failed: " . 
                mysqli_connect_error() . 
                " (" . mysqli_connect_errno() . ")" 
                ); 
        } 
    }
    
    
    //function to perform the query to the table
    function performQuery(&$connection, &$result, $queryToPerform) {
        //Perform database query
        $result = mysqli_query($connection, $queryToPerform);

        //Test if there was a query error 
        if (!$result) { 
            die("Database query failed."); 
        } 
    }


    //function to select the right listing for content.php
    function getListing(&$connection, &$result) {
        $query = "SELECT * FROM vendors WHERE id=\"".$_GET["id"]."\";";
        // echo $query;

        performQuery($connection, $result, $query);   //now perform the query
    }

    //function to select the right listing for profile.php
    function getUser(&$connection, &$result) {
        $query = "SELECT * FROM users WHERE username=\"".$_SESSION["set_user"]."\";";   //primary key so only returns one user
        // echo $query;

        performQuery($connection, $result, $query);   //now perform the query
    }

    //prints out each row of information into a list in listings.php
    function printRows(&$result) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<a href=\"content.php?id=".$row['id']."\" class=\"card-link\">".$row['id'];
                echo "<article class=\"box card\">";
                    echo "<h2 class=\"vendor-name\">".$row['name']."</h2>";
                                // <h3 class="food-type">_____vendor type _____</h3>
                    //         <div class="card-info-right">
                    echo "<p class=\"location\">".$row['location']."</p>";
                //         </div>
                echo "</article>";
            echo "</a>";
        }
    }
    
    
    //function to close the connection to the database
    function closeConnection(&$connection, &$result) {
        //Release returned data 
        @mysqli_free_result($result);
        //Close database connection 
        mysqli_close($connection); 
    }
    
?>