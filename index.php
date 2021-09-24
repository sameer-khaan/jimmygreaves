<?php 
require('header.php');
?>
<link href="assets/css/home.css?i=<?php echo rand(10,100);?>" rel="stylesheet" />
<title>Home | Welcome to the Jimmy Greaves Foundation</title>
<style type="text/css">
    @keyframes sharpen {
		0% {
			background-image: url("assets/img/home1.jpg");
            filter: blur(1px);
		}
		100% {
			background-image: url("assets/img/home1.jpg");
            filter: blur(0px);
		}
	}
    @keyframes sharpen1 {
		0% {
			background-image: url("assets/img/home8.jpg");
            filter: blur(1px);
		}
		100% {
			background-image: url("assets/img/home8.jpg");
            filter: blur(0px);
		}
	}
    @keyframes sharpen2 {
		0% {
			background-image: url("assets/img/home9.jpg");
            filter: blur(1px);
		}
		100% {
			background-image: url("assets/img/home9.jpg");
            filter: blur(0px);
		}
	}
    @keyframes sharpen3 {
		0% {
			background-image: url("assets/img/home10.jpg");
            filter: blur(1px);
		}
		100% {
			background-image: url("assets/img/home10.jpg");
            filter: blur(0px);
		}
	}
</style>


<header class="masthead">
    <!-- <img src="assets/img/home1.jpg" style="width:auto;position:absolute;" /> -->
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
        <span class="btn_underline"><a href="about.php">About</a></span>
    </div>
</div>

<div id="home_section_2_mobile">
        <!-- <p id="text_header" >Supporting lorem ipsum dolor sit amet</p> -->
        <div class="divider mb-4" ></div>

        <img src="assets/img/home11.jpg" />
        <p id="text_body">
            Thank you so much for taking the trouble to visit Dad’s special  home here at the Jimmy Greaves Foundation. I promise you he'll be thrilled to know you're thinking of him.  Our aim on this exclusive website is to create space and a place where people can support the Jimmy Greaves Foundation and possibly receive something in return. If you would like to make a donation in Jimmy’s name, it would be greatly appreciated. Every penny after expenses goes towards the causes chosen by Dad. To encourage you to return often to this website  we will be featuring monthly auctions and raffles, so that you and all visitors can bid and maybe win some unique memorabilia. Please register, so that we can keep in touch and let you know what great prizes are on offer. Once again, thank you for your support. Our simple aim is to keep alive the Greavsie spirit. 
            Good luck with the bidding and your raffle tickets.<br><br>
            
            Warm regards,<br>
            Danny.
        </p>
        <span class="btn_underline"><a href="about.php">About</a></span>
</div>

<div id="home_section_3">
    <div class="home_section_3">
        <a href="<?php echo $site_url?>auction.php">
            <div class="three_hover_div" id="1">
                <p id="header">Auction</p>
                <div class="bottom_boder"></div>
                <p id="description">
                ‘Dad scoring his famous goal against Manchester United with the great Georgie Best, Bobby Charlton, Nobby Styles and Alan Gilzean all looking on’
                </p>
                <div id="arraw">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div>
            </div>
        </a>
        <a href="<?php echo $site_url?>raffle.php">
            <div class="three_hover_div" id="2">
                <p id="header">Raffle</p>
                <div class="bottom_boder"></div>
                <p id="description">
                ‘Dad making his debut for Chelsea, ironically at White Hart Lane against the Spurs’
                </p>
                <div id="arraw">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div>
            </div>
        </a>
        <a href="<?php echo $site_url?>donate.php">
            <div class="three_hover_div" id="3">
                <p id="header">Donate</p>
                <div class="bottom_boder"></div>
                <p id="description">
                ‘Dad greeting his big pal, Dave McKay, with Bobby Charlton and Gordon Banks looking on’
                </p>
                <div id="arraw">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row justify-content-center" id="home_section_4">
    <!-- <div class="col-md-6" id="first_div" style="display: none;">
        <p id="text_header">Supporting causes lorem ipsum dolor sit amet</p>
        <div class="divider mb-4" ></div>
        <p id="text_body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <span class="btn_underline"><a href="about.php">Causes we support</a></span>
    </div> -->
    <div class="col-md-6">
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
        <span class="btn_underline"><a href="about.php">Causes we support</a></span>
    </div>
</div>

<?php
require('footer.php');
?>
<script src="assets/js/home.js?i=<?php echo rand(10,100);?>"></script>
<script src="assets/js/three_hover.js"></script>

