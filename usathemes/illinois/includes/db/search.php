<?php

		include 'includes/db/db.php';
		// Check connection
		if($link === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		if(isset($_GET['searchButton'])){
            
			$search_var = $_GET['searchField'];

            $sql = "SELECT * FROM wp_zip WHERE zip_code LIKE '%".$search_var."%'"; 
           	
				
			      
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){


                    
                    while($row = mysqli_fetch_array($result)){

                    

                      echo "
                <script type='text/javascript'>location.href = 'https://internetserviceusa.com/".$row['url']."';</script> 

                      ";

                      
                        
                    }

                   
                    
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