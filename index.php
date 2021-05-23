<?php 
require('header.php');
?>
<link href="assets/css/home.css?i=<?php echo rand(10,100);?>" rel="stylesheet" />
<title>Home</title>


<header class="masthead bg-image lazy" style="background-image: linear-gradient(to bottom, rgb(10 27 80 / 30%) 0%, rgb(52 58 66 / 60%) 100%), url(assets/img/home1.jpg)">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mt-5 mb-5">
                <p class="text-white" style="font-size:50px;">Welcome to the Jimmy Greaves Foundation</p>
                <div class="divider mb-4" style="margin:auto"></div>
            </div>
            <div class="col-lg-8 align-self-baseline mt-5 mb-5" id="section07">
                <a id="arrow_bottom" href="#home_section_2_desktop"><span></span><span></span><span></span></a>
            </div>
        </div>
    </div>
</header>

<div class="row" id="home_section_2_desktop">
    <div class="col-md-5">
        <img src="assets/img/home11.jpg" />
    </div>
    <div class="col-md-7" style="text-align:left">
        <!-- <p id="text_header"></p> -->
        <div class="divider mb-4" ></div>
        <p id="text_body">
            Thank you so much for taking the trouble to visit Dad’s special  home here at the Jimmy Greaves Foundation. I promise you he'll be thrilled to know you're thinking of him.  Our aim on this exclusive website is to create space and a place where people can support the Jimmy Greaves Foundation and possibly receive something in return. If you would like to make a donation in Jimmy’s name, it would be greatly appreciated. Every penny after expenses goes towards the causes chosen by Dad. To encourage you to return often to this website  we will be featuring monthly auctions and raffles, so that you and all visitors can bid and maybe win some unique memorabilia. Please register, so that we can keep in touch and let you know what great prizes are on offer. Once again, thank you for your support. Our simple aim is to keep alive the Greavsie spirit. 
            Good luck with the bidding and your raffle tickets.<br><br>
            
            Warm regards,<br>
            Danny.
        </p>
        <a href="about.php"><button >About</button></a>
    </div>
</div>

<div id="home_section_2_mobile">
        <p id="text_header" >Supporting lorem ipsum dolor sit amet</p>
        <div class="divider mb-4" ></div>

        <img src="assets/img/home11.jpg" />
        <p id="text_body" style="font-weight:500; font-size:14px; line-height:22px">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <a href="about.php"><button>About</button></a>
</div>

<div style="overflow-x:auto">

    <div id="home_section_3">
        <div style="background-color: rgba(0,0,0,0.2); width: 100%; display: flex">

        <a href="<?php echo $site_url?>auction.php" style="width: 33.333333%">
            <div class="three_hover_div" id="1">
                <p id="header">Auction</p>
                <div class="bottom_boder"></div>
                <p id="description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div id="arraw">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div>
            </div>
        </a>
        <a href="<?php echo $site_url?>raffle.php" style="width: 33.333333%">
            <div class="three_hover_div" id="2">
                <p id="header">Raffle</p>
                <div class="bottom_boder"></div>
                <p id="description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div id="arraw">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div>
            </div>
        </a>
        <a href="<?php echo $site_url?>donate.php" target="_blank" style="width: 33.333333%">
            <div class="three_hover_div" id="3">
                <p id="header">Donate</p>
                <div class="bottom_boder"></div>
                <p id="description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div id="arraw">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div>
            </div>
        </a>
    </div>
    </div>
<div>

<div class="row" id="home_section_4">
    <div class="col-md-7" id="first_div" >
        <p id="text_header">Supporting causes lorem ipsum dolor sit amet</p>
        <div class="divider mb-4" ></div>
        <p id="text_body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <a href="contact.php"><button id="button_desktop">Causes we support</button></a>
    </div>
    <div class="col-md-5">
        <div class="row" style="padding:20px">
            <div class="col-md-3">
                <img src="assets/img/about3.png" style="width:100%" />
            </div>
            <div class="col-md-3">
                <img src="assets/img/about4.png" style="width: 100%" />
            </div>
            <div class="col-md-3">
                <img src="assets/img/about5.png" style="width:100%" />
            </div>
            <div class="col-md-3">
                <img src="assets/img/about6.png" style="width: 100%" />
            </div>
        </div>
        <a href="contact.php"><button id="button_mobile">Causes we support</button></a>

    </div>
</div>

<?php
require('footer.php');
?>
<script src="assets/js/home.js?i=<?php echo rand(10,100);?>"></script>
<script src="assets/js/three_hover.js"></script>

