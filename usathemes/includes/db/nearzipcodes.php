<?php


/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include 'includes/db/db.php';
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$sql = "SELECT * FROM zip WHERE state_zip LIKE '%". '62462' ."%'";

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
       
            ?>
               
            <?php

            
        while($row = mysqli_fetch_array($result)){
           echo "<div class='item'>";
            echo "<div class='properties'>";
            echo "<div class='text p-3'>";
            echo "<div class='d-flex'>";
            echo "<div class='one'>";
            echo "<h3><a href='https://internetserviceusa.com/".$row['url']."'>" . $row['city'] . "</a></h3>";
            echo "<p>" . $row['b_coverage'] . "% Broadband Coverage </p></div>";
            echo "<div class='two'>";
            echo "<span class='price'>" . $row['zip_code'] . " <small>" . $row['no_providers'] . " Providers</small></span>";
            echo "</div></div></div></div></div>";



        }
        echo "</div></div>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
    // Close connection
    mysqli_close($link);


    ?>