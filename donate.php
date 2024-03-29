<?php 
require('header.php');
?>
<link href="assets/css/donate.css?i=<?php echo rand(10,100);?>" rel="stylesheet" />
<title>Make a donation | Jimmy Greaves Foundation</title>
<style type="text/css">
	@keyframes sharpen {
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


<div class="header mastheader">
	<!-- <img src="assets/img/home10.jpg" style="width:auto;position:absolute;" /> -->
	<div class="container">
		<p id="text_header">Make a donation</p>
		<div class="divider mb-4"></div>
		<p id="text_desc">
			‘Dad greeting his big pal, Dave McKay, with Bobby Charlton and Gordon Banks looking on’.
		</p>
		<div class="select_method_div" style="display: none;">
			<button class="select_method_button selected" id="one_off">One off</button>
			<button class="select_method_button" id="monthly" style="margin-left:30px">Monthly</button>
		</div>
		<div class="select_amount_div row mt-5">
			<div class="col-md-6">
				<p id="donate_method_text">Make a one off donation of:</p>	
				<div style="display: flex">
					<button class="amount_select_btn" id="10">£10.00</button>	
					<button class="amount_select_btn" id="25">£25.00</button>	
					<button class="amount_select_btn selected" id="50">£50.00</button>	
					<button class="amount_select_btn" id="100">£100.00</button>	
				</div>
			</div>
			<div class="col-md-6">
				<p>Or enter amount</p>
				<div style="display: flex;align-items: end;">
					<input id="input_donation_amount" value="50" type="number" />
					<div style="display: flex;flex-direction: column;align-items: center;">
						<div id="paypal-button" style="width: 200px; margin-left: 20px;align-items: center; align-self: center; justify-content: center"></div>
						<?php
						if(!isset($_SESSION['login_flag']) || $_SESSION['login_flag']!="1"){
							echo '<div style="margin-left: 15px;color: white;"><small><i>- website sign up required</i></small></div>';
						}
						?>
					</div>
				</div>
			</div>

			<div class="col-md-6" style="margin-top:20px">
				<div style="display: flex" >
					<!-- <input type="checkbox" id="checkbox_input" checked /> -->
					<input id="checkbox_input" type="checkbox"><label id="checkbox_input_label" for="checkbox_input"></label>
					<p style="margin-left: 10px">Add Gift Aid to my donation</p>
				</div>		
			</div>
		</div>
	</div>
</div>

<div class="row justify-content-center" id="donate_section_2">
    <div class="col-md-6" id="first_div" style="display: none;">
        <p id="text_header">Where will my money go?</p>
        <div class="divider mb-4" ></div>
        <p id="text_body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
		<span class="btn_underline"><a href="about.php">Causes we support</a></span>
    </div>
    <div class="col-md-6">
        <div class="row justify-content-center" style="padding:20px">
          	<div class="col-md-3">
                <img src="assets/img/about3.png" style="width:100%" />
            </div>
            <div class="col-md-3">
                <img src="assets/img/about4.png" style="width: 100%" />
            </div>
            <!-- <div class="col-md-3">
                <img src="assets/img/about5.png" style="width:100%" />
            </div> -->
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

<script type="text/javascript">
	var donate_value = 50;
	var add_gift = '0';
</script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script src="assets/js/donate.js"></script>
