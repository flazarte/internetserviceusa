
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Internet Service USA | ILLINOIS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/base.css">
    
    

    
  </head>
  <body>
    <div id="top">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col">
                    <p >
                        <a id="socialfb" href="https://www.facebook.com/internetserviceusa"><span class="icon-facebook"></span>
                        <a  id="socialins" href="https://www.instagram.com/internetserviceusa1/"><span class="icon-instagram"></span></a>
                        </a>
                        <a  id="socialtweet" href="https://twitter.com/internetSVUSA"><span class="icon-twitter"></span></a>
                            <a id="socialins" href="https://www.pinterest.ph/internetserviceusa/"><span class="icon-pinterest"></span></a>
                    </p>
                </div>
                <div class="col d-flex justify-content-end" id="num">
                    <p  class="prag"><span class="icon-phone"></span> +1 313 554 9000</p>
                </div>
            </div>
        </div>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a href="#" class="brand pull-left"><img src="new/image/logo.png" id="logo"></a>
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
          </button>

          <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item"><a href="#" class="nav-link">All Providers</a></li>
                    <li class="nav-item"><a href="%" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="%" class="nav-link">Zip Code Search</a></li>
                    
            </ul>
          </div>
        </div>
      </nav>
    


    

    <section class="ftco-search" id="intro-illinois">
        <div class="container">
            <div class="row">
       
                    <div class="col-md-12 search-wrap">
                        <h2 class="heading h5 d-flex align-items-center pr-4"></h2>
                        <form action="#" class="search-property">
                        <div class="row d-flex justify-content-center">


          
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
              <h2>Internet Providers in Illinois,<small>USA</small></h2>
              <p>See Plans, prices, & Ratings for every Internet Providers Near You.</p>
              <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-8">
                  <form action="" method="get" class="subscribe-form">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control" required="required" name="searchField"  placeholder="Enter Zip Code" id="zipsearch">
                      <input type="submit" value="Search" name="searchButton" class=" submit px-3 " >
                    </div>

                      </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


                    <?php
         $link = mysqli_connect("localhost", "internetservice_wp", "1YPgCPi49fpp", "internetservice_wp");
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        if(isset($_GET['searchButton'])){
            
            $search_var = $_GET['searchField'];

            $sql = "SELECT * FROM wp_zip WHERE zip_code LIKE '%".$search_var."%'"; 
            
                
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){


                        echo " 

                            <div class='alert alert-info' role='alert'>
        <button type='button' class='close' data-dismiss='alert'aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h3>Searching Zip Code</h3>
        <div class='progress'>
            <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='2' aria-valuemin='0'aria-valuemax='100' >
                
            </div>

        </div>

        <br>
        <p><button class='btn btn-primary btn-sm' data-toggle='modal' data-target='#search-modal' >View Results</button></p>
        
    </div>

                        ";
     echo  '
                            <!--search modal-->
    <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <th>&nbsp; No. of Providers</th>

                            </tr>
                    
                    </thead>
                
        
                        '; 


                    
                    while($row = mysqli_fetch_array($result)){

                        echo " <tr>";

               

                echo "<td id='zip-color'>" . $row['zip_code'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td>" . $row['state'] . "</td>";
                echo "<td>" . $row['no_providers'] . " Providers</td>";
                echo "<td><a class='btn btn-success btn-sm' href='https://internetserviceusa.com/".$row['url']."'>More info.</a></td>"; 



echo "  </tr>";
    
                        
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
                    
                


                        
                        
                    </div>
                </form>
                    </div>
            </div>
        </div>
    </section>



    
    <section class="ftco-section ftco-properties">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Acess in Illinois</span>
            <h2 class="mb-4">INTERNET IN ILLINOIS</h2>
         <br><br>
          </div>
           

<section id="about-us" class="parallax"> 
	<div class="container">
	 <div class="row">
	  <div class="col-sm-6">
	   <div class="wow about-info fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 300ms;">
	    <h2 style="text-align:center">About Internet in Illinois</h2>
	     <br>
	      <p>About 79.3 percent of people in Illinois reported home high-speed Internet use. Champaign had one of the highest rates of high-speed Internet use at 83.4 percent, while Danville had one of the lowest rates at 62.0 percent. <br> <br> </p> 
<div class="parsys_column cq-colctrl-lt0 uscb-layout-row uscb-layout-column-sm uscb-flex-basis-auto-children"><div class="parsys_column cq-colctrl-lt0-c0 uscb-flex-row-50 uscb-flex-row-sm-100"><a name="par_textimage_1114295863" style="visibility:hidden"></a><div class="textimage parbase section"><div style="background-color: ; color: ;">
  
  
   
    
      
  
  

  
  
  <section>
    
    
  
    <div style="color: " class="uscb-text-image-text uscb-text-media-text uscb-padding-LR-0">
      <p class="uscb-body-text" style="color: ;">
        </p><table class="datatable" cellspacing="0" cellpadding="0" border="1" width="100%">
<thead><tr><th scope="col" style="text-align: left;">Metropolitan Areas with High Percentages</th>
<th scope="col" style="text-align: left;">Computer Use</th>
<th scope="col" style="text-align: left;">Internet Use</th>
</tr></thead><tbody><tr><td scope="row" class="rowhead">Champaign</td>
<td>91.4%</td>
<td>83.4%</td>
</tr><tr><td scope="row" class="rowhead">Bloomington</td>
<td>92.6%</td>
<td>82.8%</td>
</tr><tr><td scope="row" class="rowhead">Springfield</td>
<td>92.1%</td>
<td>81.7%</td>
</tr></tbody></table>

      <p></p>
    </div>
  </section>
  
  
</div>


</div>
</div>
                <div class="parsys_column cq-colctrl-lt0-c1 uscb-flex-row-50 uscb-flex-row-sm-100"><a name="par_textimage_774870385" style="visibility:hidden"></a><div class="textimage parbase section"><div style="background-color: ; color: ;">
  
<section>
    
    
  
    <div style="color: " class="uscb-text-image-text uscb-text-media-text uscb-padding-LR-0">
      <p class="uscb-body-text" style="color: ;">
        </p><table class="datatable" cellspacing="0" cellpadding="0" border="1" width="100%">
<thead><tr><th scope="col" style="text-align: left;">Metropolitan Areas with Low Percentages</th>
<th scope="col" style="text-align: left;">Computer Use</th>
<th scope="col" style="text-align: left;">Internet Use</th>
</tr></thead><tbody><tr><td scope="row" class="rowhead">Decatur</td>
<td>84.5%</td>
<td>73.0%</td>
</tr><tr><td scope="row" class="rowhead">Carbondale</td>
<td>81.8%</td>
<td>71.0%</td>
</tr><tr><td scope="row" class="rowhead">Danville</td>
<td>75.5%</td>
<td>62.0%</td>
</tr></tbody></table>

      <p></p>
    </div>
  </section>
  
  
</div>


</div>
</div></div>


	  </div>
	   </div> 
	   <div class="col-sm-6">
	    <div class="wow fadeInDown our-skills animated" data-wow-delay="300ms" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 300ms;">
	    	<div class="wow fadeInDown single-skill animated" data-wow-delay="300ms" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 300ms;"> <p class="lead">Broadband Coverage </p>
	    		<div class="progress"> 
	    			<div class="progress-bar progress-bar-primary six-sec-ease-in-out" aria-valuetransitiongoal="95" role="progressbar" style="width: 93%;">93%</div> </div>
	    			 </div> 
	    			 <div class="wow fadeInDown single-skill animated" data-wow-delay="400ms" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 400ms;"> <p class="lead">Wireless Coverage </p>
	    			 	<div class="progress"> <div class="progress-bar progress-bar-primary six-sec-ease-in-out" aria-valuetransitiongoal="80" role="progressbar" style="width: 100%;">100%</div> 
	    			 </div> 
	    			</div> 
	    			<div class="wow fadeInDown single-skill animated" data-wow-delay="500ms" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 500ms;"> <p class="lead">Wired Coverage </p>
	    				<div class="progress">
	    				 <div class="progress-bar progress-bar-primary six-sec-ease-in-out" aria-valuetransitiongoal="75" role="progressbar" style="width: 97.5%;">97.5%</div> </div> 
	    				</div> 
	    				<div class="wow fadeInDown single-skill animated" data-wow-delay="600ms" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 600ms;"> <p class="lead">Broadband Speeds </p>
	    					<div class="progress">
	    					 <div class="progress-bar progress-bar-primary six-sec-ease-in-out" aria-valuetransitiongoal="90" role="progressbar" style="width: 93.5%;">93.5%</div> </div> 
	    					 <div class="wow fadeInDown single-skill animated" data-wow-delay="600ms" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 600ms;"> <p class="lead">Population Underserved </p><div class="progress"> 
	    					 	<div class="progress-bar progress-bar-primary six-sec-ease-in-out" aria-valuetransitiongoal="70" role="progressbar" style="width: 10%;">10%</div> 
	    					 </div> 
	    					</div>
	    					 </div> 
	    					</div> 
	    				</div>
	    				 </div> 
	    				</div>
	    			</section>

</div></div></section>

<section class="ftco-section ftco-counter img" id="section-counter">
    	<div class="container">
    		<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
            <h2 class="mb-4">Fastest Speed in Illinois</h2>
          </div>
        </div>
    		<div class="row justify-content-center">
    			<div class="col-md-10">
		    		<div class="row">
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="119">0</strong><strong style="color: white;"> MBPS</strong>
		                <span>La Prairie</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="114">0</strong><strong style="color: white;"> MBPS</strong>
		                <span>Plymouth</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="108">0</strong><strong style="color: white;"> MBPS</strong>
		                <span>Sugar Groove</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="106">0</strong><strong style="color: white;"> MBPS</strong>
		                <span>Highland Park</span>
		              </div>
		            </div>
		          </div>
		        </div>
	        </div>
        </div>
    	</div>
    </section>



       
    	
    <section class="ftco-section ftco-properties" id="cities">
    	<div class="container">

    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Zip Code Near Illinois</span>
            <h2 class="mb-4">CITIES IN ILLINOIS</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="properties-slider owl-carousel ftco-animate">
    		

    			<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
 $link = mysqli_connect("localhost", "internetservice_wp", "1YPgCPi49fpp", "internetservice_wp");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$sql = "SELECT * FROM wp_zip WHERE state_zip LIKE '%". '62462' ."%'";

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
        </div>
    		</div></section>

         <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Providers</span>
            <h2 class="mb-4">Top Providers in Illinois</h2>
          </div>
        </div>        
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm col-md-6 col-lg ftco-animate">
            <div class="properties">
              <a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(new/xfinity.PNG);">
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </a>
              <div class="text p-3">
                
                <div class="d-flex">
                  <div class="one">
                    <h3><a href="#">Xfinity</a></h3>
                    <p>2 GBPS</p>
                  </div>
                  <div class="two">
                    <span class="price">$115 <small>/ month</small></span>

                  </div>
                </div>
                  <hr>

                <p>Satellite speeds in Illinois go up to 100Mbps</p>
                
                
              </div>
            </div>
          </div>
          <div class="col-sm col-md-6 col-lg ftco-animate">
            <div class="properties">
              <a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(new/century.PNG);">
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </a>
              <div class="text p-3">
                <div class="d-flex">
                  <div class="one">
                    <h3><a href="#">Centurylink</a></h3>
                    <p>100 MBPS</p>
                  </div>
                  <div class="two">
                    <span class="price">$65 <small>/ month</small></span>

                  </div>
                </div>
                  <hr>
                
                <p>Cable plans in Illinois offer speeds up to 1Gbps</p>
                
                
              </div>
            </div>
          </div>
          <div class="col-sm col-md-6 col-lg ftco-animate">
            <div class="properties">
              <a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(new/at.png);">
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </a>
              <div class="text p-3">
                <div class="d-flex">
                  <div class="one">
                    <h3><a href="#">AT&T U-verse</a></h3>
                    <p>1 GBPS</p>
                  </div>
                  <div class="two">
                    <span class="price">$70<small>/ month</small></span>

                  </div>
                </div>
                  <hr>
                
                <p>Fiber plans in Illinois offer speeds up to 1Gbps</p>
                
                
              </div>
            </div>
          </div>
          <div class="col-sm col-md-6 col-lg ftco-animate">
            <div class="properties">
              <a href="#" class="img img-2 d-flex justify-content-center align-items-center" style="background-image: url(new/spectrum.PNG);">
                <div class="icon d-flex justify-content-center align-items-center">
                  <span class="icon-search2"></span>
                </div>
              </a>
              <div class="text p-3">
                <div class="d-flex">
                  <div class="one">
                    <h3><a href="#">Spectrum</a></h3>
                    <p>100 MBPS</p>
                  </div>
                  <div class="two">
                    <span class="price">$75<small>/ month</small></span>

                  </div>
                </div>
                  <hr>
                
                <p>Satellite speeds in Illinois go up to 100Mbps</p>
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



		
	<footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        
        <div class="row">
          <div class="col-md-12 text-center">

            <p style="font-size: 12px;" >Disclaimer: All trademarks remain the property of their respective owners, and are used by INTERNETSERVICEUSA only to describe products and services offered by each respective trademark holder. The use of any third party trademarks on this site in no way indicates any relationship, connection, association, sponsorship, or affiliation between INTERNETSERVICEUSA and the holders of said trademarks.</p>
            <hr style="background-color: white;">


            <p>
  Copyright &copy;&nbsp;<script>document.write(new Date().getFullYear());</script> - INTERNETSERVICEUSA</p>
          </div>
        </div>
      </div>
    </footer>

  
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>