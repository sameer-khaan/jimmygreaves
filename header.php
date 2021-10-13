<?php 
session_start();
include __DIR__ . "/config.php";
$login_flag="0";
$user_name ="";
$user_id="";        
$email = "";
if(isset($_SESSION['login_flag']))
    if($_SESSION['login_flag']=="1"){
        $login_flag="1";
        $user_name = $_SESSION['user_name'];
        $user_id = $_SESSION['user_id'];
        $email = $_SESSION['email'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="hank you so much for taking the trouble to visit Dad’s special home here at the Jimmy Greaves Foundation. I promise you he'll be thrilled to know you're thinking of him. Our aim on this exclusive website is to create space and a place where people can support the Jimmy Greaves Foundation and possibly receive something in return. If you would like to make a donation in Jimmy’s name, it would be greatly appreciated. Every penny after expenses goes towards the causes chosen by Dad. To encourage you to return often to this website we will be featuring monthly auctions and raffles, so that you and all visitors can bid and maybe win some unique memorabilia. Please register, so that we can keep in touch and let you know what great prizes are on offer. Once again, thank you for your support. Our simple aim is to keep alive the Greavsie spirit. Good luck with the bidding and your raffle tickets." />
        <meta name="keywords" content="Jimmy, Jimmy Greaves, Foundation, Jimmy Greaves Foundation, Auction, Auction memorabilia, Tottenham Hotspur FC, Premier League">
        <meta name="author" content="Sameer Khan" />
        
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Third party plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css">

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />

        <script type="text/javascript">
          var YOUR_SERVICE_ID = 'service_9ewr7du';
          var RAFFLE_TEMP_ID = 'template_hyh70tp';
          var AUCTION_TEMP_ID = 'template_9o7iz1g';
          var DONATION_TEMP_ID = 'template_9wn313k';
          var CONTACT_FORM_ID = 'template_e38rgi2';
          var YOUR_USER_ID = 'user_xi7mUaoVTXsI7vhIe8BZn';
        </script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-PN40R34CQX"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', 'G-PN40R34CQX');
        </script>
    </head>

    <body id="page-top">
        <!-- Navigation-->
        <div class="loading-gif"></div>

        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 navbar-scrolled" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="<?php echo $site_url?>">
                    <img src="assets/img/logo2.png" />
                </a>
                <!-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  <label for="check" class="burgerMenu"><input type="checkbox" id="check">
                    <span></span>
                    <span></span>
                    <span></span>
                  </label>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive" >
                    <ul class="navbar-nav ml-auto my-2 my-lg-0" style="height:50px">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?php echo $site_url?>">Home</a>
                        </li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?php echo $site_url?>auction.php">Auction</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?php echo $site_url?>raffle.php">Raffle</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?php echo $site_url?>donate.php">Donate</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?php echo $site_url?>about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="<?php echo $site_url?>contact.php">Contact</a></li>
                        <li class="nav-item nav-separate"><span class="nav-link js-scroll-trigger" href="">|</span></li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="javascript://" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-style="mypops" id="user_pops">
                                <i class="far fa-user"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </body>
</html>

<div class="modal " id="signin_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="signin_modal_header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="signin_modal_body">
        <span id="header">Sign In</span>
        <input placeholder="Email address" id="email_signin" style="margin-top:20px" />
        <input placeholder="Password" type="password" id="password_signin" />
        <div style="display: flex; align-items: center; margin-top:20px; text-align: left">
            <input type="checkbox" id="remember_checkbox" style="margin-right: 5px">
            <span>Remember me</span>
            <a href="#" style="margin-left: auto">Forgot password?</a>
        </div>
        <button id="signin_button"> Sign In </button>
        <!-- <span style="font-size: 14px">Or</span> -->
        <!-- <button class="facebook_login"><ion-icon style="margin-right: 10px" name="logo-facebook"></ion-icon> Continue with Facebook </button> -->
        <span style="font-size: 14px">Don’t have an account? <span id="sign_up_link" style="border-bottom:1px solid gray">Sign up</span></span>

      </div>
    
    </div>
  </div>
</div>

<div class="modal " id="signup_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="signin_modal_header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="signin_modal_body">
        <span id="header">Sign Up</span>
        <input placeholder="Full Name" id="fullname_signup" style="margin-top:20px" />

        <input placeholder="Email address" id="email_signup"/>
        <input placeholder="Password" type="password" id="password_signup" />
        <input placeholder="Confirm Password" type="password" id="con_password_signup" />

        <div style="display: flex; align-items: center; margin-top:20px;text-align: left">
            <input type="checkbox" id="accept_checkbox" style="margin-right: 5px">
            <span>I would like to be kept informed of further news, upcoming auctions & raffles.</span>
        </div>
        <button id="signup_button"> Sign Up </button>
        <!-- <span style="font-size: 14px">Or</span> -->
        <!-- <button class="facebook_login"><ion-icon style="margin-right: 10px" name="logo-facebook"></ion-icon> Continue with Facebook </button> -->
        <span style="font-size: 14px">Already have an account?  <span id="sign_in_link" style="border-bottom:1px solid gray">Sign in</span></span>

      </div>
    
    </div>
  </div>
</div>
