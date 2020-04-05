
<!DOCTYPE html>
<html lang="en">
  <head>
 <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Terms & Conditions | Internet Service USA</title>
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
    <style type="text/css">
      #link{

    color: blue;
    text-decoration: none;
    background-color: transparent;
    -webkit-text-decoration-skip: objects;
}
      }
    </style>
    

    
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

              <h2><strong>Terms and Conditions</strong></h2>

<p>Welcome to Internet Service USA!</p>

<p>These terms and conditions outline the rules and regulations for the use of Internet Service USA's Website, located at <a href="https://internetserviceusa.com" id="link">https://internetserviceusa.com.</a> </p>

<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use Internet Service USA if you do not agree to take all of the terms and conditions stated on this page. 

<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>

<h3><strong>Cookies</strong></h3>

<p>We employ the use of cookies. By accessing Internet Service USA, you agreed to use cookies in agreement with the Internet Service USA's <a href="https://internetserviceusa.com/privacy.php">Privacy Policy.</a></p>

<p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>

<h3><strong>License</strong></h3>

<p>Unless otherwise stated, Internet Service USA and/or its licensors own the intellectual property rights for all material on Internet Service USA. All intellectual property rights are reserved. You may access this from Internet Service USA for your own personal use subjected to restrictions set in these terms and conditions.</p>

<p>You must not:</p>
<ul>
    <li>Republish material from Internet Service USA</li>
    <li>Sell, rent or sub-license material from Internet Service USA</li>
    <li>Reproduce, duplicate or copy material from Internet Service USA</li>
    <li>Redistribute content from Internet Service USA</li>
</ul>

<p>This Agreement shall begin on the date hereof.</p>

<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Internet Service USA does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Internet Service USA,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Internet Service USA shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>

<p>Internet Service USA reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>

<p>You warrant and represent that:</p>

<ul>
    <li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>
    <li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>
    <li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>
    <li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>
</ul>

<p>You hereby grant Internet Service USA a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>

<h3><strong>Hyperlinking to our Content</strong></h3>

<p>The following organizations may link to our Website without prior written approval:</p>

<ul>
    <li>Government agencies;</li>
    <li>Search engines;</li>
    <li>News organizations;</li>
    <li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>
    <li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>
</ul>

<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.</p>

<p>We may consider and approve other link requests from the following types of organizations:</p>

<ul>
    <li>commonly-known consumer and/or business information sources;</li>
    <li>dot.com community sites;</li>
    <li>associations or other groups representing charities;</li>
    <li>online directory distributors;</li>
    <li>internet portals;</li>
    <li>accounting, law and consulting firms; and</li>
    <li>educational institutions and trade associations.</li>
</ul>

<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Internet Service USA; and (d) the link is in the context of general resource information.</p>

<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.</p>

<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Internet Service USA. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>

<p>Approved organizations may hyperlink to our Website as follows:</p>

<ul>
    <li>By use of our corporate name; or</li>
    <li>By use of the uniform resource locator being linked to; or</li>
    <li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li>
</ul>

<p>No use of Internet Service USA's logo or other artwork will be allowed for linking absent a trademark license agreement.</p>

<h3><strong>iFrames</strong></h3>

<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>

<h3><strong>Content Liability</strong></h3>

<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>

<h3><strong>Your Privacy</strong></h3>

<p>Please read <a href="https://internetserviceusa.com/privacy.php" id="link"> Privacy Policy</a></p>

<h3><strong>Reservation of Rights</strong></h3>

<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>

<h3><strong>Removal of links from our website</strong></h3>

<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>

<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>

<h3><strong>Disclaimer</strong></h3>

<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>

<ul>
    <li>limit or exclude our or your liability for death or personal injury;</li>
    <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
    <li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
    <li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
</ul>

<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>

<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>


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
            
           
<p style="text-align: center;"><a href="https://internetserviceusa.com/#About">About</a> | <a href="https://internetserviceusa.com/#Contact">Contact</a> | <a href="https://internetserviceusa.com/usa/all-providers.php">All Providers</a> | <a href="https://internetserviceusa.com/speedtest/">Speed Test</a> | <a href="https://internetserviceusa.com/usa/search.php">Search by Zip Code</a> |<a href="https://internetserviceusa.com/privacy.php"> Privacy Policy</a> | <a href="https://internetserviceusa.com/terms.php">Terms and Conditions</a></p>


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