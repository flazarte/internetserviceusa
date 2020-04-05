<?php


include 'includes/db/db.php'; 
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        if(isset($_GET['searchCity'])){
            
            $search_var = $_GET['city'];

            $sql = "SELECT * FROM wp_zip WHERE city LIKE '%".$search_var."%'"; 
            
                
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){


                        echo " 

                            <div class='alert alert-info' role='alert'>
        <button type='button' class='close' data-dismiss='alert'aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h3>Searching City</h3>
        <div class='progress'>
            <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='2' aria-valuemin='0'aria-valuemax='100' >
                
            </div>

        </div>

        <br>
        <p><button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#city-modal' >View Results</button></p>
        
    </div>

                        ";
     echo  '
                            <!--search modal-->
    <div class="modal fade" id="city-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Search Results </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                    
                </div>
                <div class="modal-body">  

                <table class="text-center white">

            
                    <thead>
                    <tr>
                        
                            <th>Zip Code</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Providers</th>

                            </tr>
                    
                    </thead>
                
                   

                  
                        

                            
                        '; 


                    
                    while($row = mysqli_fetch_array($result)){

               echo "  <tr>";

                echo "<td>" . $row['zip_code'] . "</td>";
                echo "<td id='zip-color'>" . $row['city'] . "</td>";
                echo "<td>" . $row['state'] . "</td>";
                echo "<td>" . $row['no_providers'] . " Providers</td>";
                echo "<td><a class='btn btn-success btn-sm' href='https://internetserviceusa.com/".$row['url']."'>More info.</a></td>"; 
           
                  echo " </tr>";      
                    }
                    
                        echo '     
                   
                   

                </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    ';


                    // Free result set
                    mysqli_free_result($result);
                } else {
                    echo "

                    <div class='alert alert-info' role='alert'>
        <button type='button' class='close' data-dismiss='alert'aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <p>No records matching your query were found!</p>
        </div>

                    ";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
             
            // Close connection
            mysqli_close($link);
            
        }
        ?>