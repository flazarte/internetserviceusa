
<!DOCTYPE html>
<html lang="en">
  <head>
 <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Privacy Policy | Internet Service USA</title>
    <link rel="canonical" href="https://internetserviceusa.com/privacy" />
    <META NAME="ROBOTS" CONTENT="ALL"> 

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />     
    <?php
    include './usa/illinois/includes/analytics.php';
   ?>
   <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="./usa/illinois/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="./usa/illinois/css/animate.css">
    
    <link rel="stylesheet" href="./usa/illinois/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./usa/illinois/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./usa/illinois/css/magnific-popup.css">


    <link rel="stylesheet" href="./usa/illinois/css/aos.css">

    <link rel="stylesheet" href="./usa/illinois/css/ionicons.min.css">

    <link rel="stylesheet" href="./usa/illinois/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="./usa/illinois/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="./usa/illinois/css/flaticon.css">
    <link rel="stylesheet" href="./usa/illinois/css/icomoon.css">
    <link rel="stylesheet" href="./usa/illinois/css/style.css">
    <link rel="stylesheet" href="./usa/illinois/css/base.css">
    

    
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
                    <a  href="tel:+1-844-593-1734" class="prag"><span class="icon-phone"></span> Call Us:+1-844-593-1734</a>
                </div>
            
          </div>
        </div>
      </div>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a href="https://internetserviceusa.com/usa/search.php" class="brand pull-left"><img src="./usa/illinois/new/image/logo.png" id="logo" alt="internet-service-usa"></a>
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
          </button>

          <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item"><a href="#" class="nav-link">All Providers</a></li>
                    <li class="nav-item"><a href="%" class="nav-link">About Us</a></li>
                    <li class="nav-item"><a href="https://internetserviceusa.com/usa/search.php" class="nav-link">Zip Code Search</a></li>
                    
            </ul>
          </div>
        </div>
      </nav>

    <section class="ftco-search" id="intro-algonquin">
    	<div class="container">
    		<div class="row">
	   
					<div class="col-md-12 search-wrap">
						<h2 class="heading h5 d-flex align-items-center pr-4"></h2>
						<form action="#" class="search-property">
	        			<div class="row d-flex justify-content-center">


          
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
              <h1>Internet Service USA</h1><br>
              <p>See Plans, Prices, & Promos for every Internet Provider Near You.</p>
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

    include './usa/illinois/includes/db/db.php';
    // Check connection
    if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    if(isset($_GET['searchButton'])){
            
      $search_var = $_GET['searchField'];

            $sql = "SELECT * FROM zip WHERE zip_code LIKE '%".$search_var."%'"; 
            
        
            
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
	        			
	        		</div>
	        	</form>
					</div>
	    	</div>
	    </div>
    </section>

    
    


    

    <!--About Section-->
    <section id="about">
        <div class="container">
            <div>

              <h1>Privacy Policy of Internet Service USA</h1>

<p>Internet Service USA operates the https://internetserviceusa.com website, which provides the SERVICE.</p>

<p>This page is used to inform website visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service, the Internet Service USA website.</p>

<p>If you choose to use our Service, then you agree to the collection and use of information in relation with this policy. The Personal Information that we collect are used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.</p>

<p>The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at https://internetserviceusa.com, unless otherwise defined in this Privacy Policy.</p>

<h2>Information Collection and Use</h2>

<p>For a better experience while using our Service, we may require you to provide us with certain personally identifiable information, including but not limited to your name, phone number, and postal address. The information that we collect will be used to contact or identify you.</p>

<h2>Log Data</h2>

<p>We want to inform you that whenever you visit our Service, we collect information that your browser sends to us that is called Log Data. This Log Data may include information such as your computer’s Internet Protocol ("IP") address, browser version, pages of our Service that you visit, the time and date of your visit, the time spent on those pages, and other statistics.</p>

<h2>Cookies</h2>

<p>Cookies are files with small amount of data that is commonly used an anonymous unique identifier. These are sent to your browser from the website that you visit and are stored on your computer’s hard drive.</p>

<p>Our website uses these "cookies" to collection information and to improve our Service. You have the option to either accept or refuse these cookies, and know when a cookie is being sent to your computer. If you choose to refuse our cookies, you may not be able to use some portions of our Service.</p>

<h2>Service Providers</h2>

<p>We may employ third-party companies and individuals due to the following reasons:</p>

<ul>
    <li>To facilitate our Service;</li>
    <li>To provide the Service on our behalf;</li>
    <li>To perform Service-related services; or</li>
    <li>To assist us in analyzing how our Service is used.</li>
</ul>

<p>We want to inform our Service users that these third parties have access to your Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</p>

<h2>Security</h2>

<p>We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</p>

<h2>Links to Other Sites</h2>

<p>Our Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by us. Therefore, we strongly advise you to review the Privacy Policy of these websites. We have no control over, and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>

<p>Children’s Privacy</p>

<p>Our Services do not address anyone under the age of 13. We do not knowingly collect personal identifiable information from children under 13. In the case we discover that a child under 13 has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do necessary actions.</p>

<h2>Changes to This Privacy Policy</h2>

<p>We may update our Privacy Policy from time to time. Thus, we advise you to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately, after they are posted on this page.</p>

<h2>Contact Us</h2>

<p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us.</p>
<a  type="button" href="https://internetserviceusa.com/#Contact" class="btn btn-success btn-lg">Contact Us</a>


               </div>
        </div>
    </section>
<br>


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


   <script src="./usa/illinois/js/jquery.min.js"></script>
  <script src="./usa/illinois/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="./usa/illinois/js/popper.min.js"></script>
  <script src="./usa/illinois/js/bootstrap.min.js"></script>
  <script src="./usa/illinois/js/jquery.easing.1.3.js"></script>
  <script src="./usa/illinois/js/jquery.waypoints.min.js"></script>
  <script src="./usa/illinois/js/jquery.stellar.min.js"></script>
  <script src="./usa/illinois/js/owl.carousel.min.js"></script>
  <script src="./usa/illinois/js/jquery.magnific-popup.min.js"></script>
  <script src="./usa/illinois/js/aos.js"></script>
  <script src="./usa/illinois/js/jquery.animateNumber.min.js"></script>
  <script src="./usa/illinois/js/bootstrap-datepicker.js"></script>
  <script src="./usa/illinois/js/jquery.timepicker.min.js"></script>
  <script src="./usa/illinois/js/scrollax.min.js"></script>
  <script src="./usa/illinois/js/google-map.js"></script>
  <script src="./usa/illinois/js/main.js"></script>


                        
                 

    
  </body>
</html>