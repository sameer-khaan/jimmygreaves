<?php 
require('header.php');
?>
<link href="assets/css/auction.css?i=<?php echo rand(10,100);?>" rel="stylesheet" />
<title>Contact</title>
<style type="text/css">
	@keyframes sharpen {
		0% {
			background-image: url("assets/img/home2.jpg");
            filter: blur(1px);
		}
		100% {
			background-image: url("assets/img/home2.jpg");
            filter: blur(0px);
		}
	}

	.contactForm .form-control {
		border: none;
		border-radius: 0;
		padding: 2px;
		border-bottom: 1px solid #343a42ba;
	}

	.contactForm .form-control:focus {
		border-color: #62b5f1!important;
    	box-shadow: none;
	}

	.contactForm .form-group label {
		position: relative;
		top: 36px;
	}
</style>


<header class="masthead">
	<!-- <img src="assets/img/home2.jpg" style="width:auto;position:absolute;" /> -->
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mt-5 mb-5">
                <p class="text-white" style="font-size:50px;">Contact us</p>
                <div class="divider mb-4" style="margin:auto"></div>
            </div>
            <div class="col-lg-8 align-self-baseline mt-5 mb-5" id="section07">
                <a id="arrow_bottom" href="#contact_section_2"><span></span><span></span><span></span></a>
            </div>
        </div>
    </div>
</header>

<div class="container row" id="contact_section_2" style="padding-top:50px;padding-bottom:50px;display:none">
	<div class="col-md-6">
		<!-- <p style="font-size: 40px; font-weight: 500">Get in touch</p>
		<div class="divider mb-4"></div>
		<p style="font-size: 14px; line-height: 22px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi </p> -->
		<img src="assets/img/home9.jpg" style="width: 100%">
	</div>
	<div class="col-md-6">
		<div style="background-color: #1F2226; width: 100%; height: 100%; padding:20px">
			<p style="color:#2D95C2; font-size: 28px; font-weight: 500">General enquiries</p>
			<div style="display: flex; align-items: center;">
				<ion-icon name="mail-outline" style="color: #62B5F1;"></ion-icon>
				<span style="color: white; margin-left: 10px; font-size: 16px">emailaddress@emailaddress.com</span>
			</div>
			<div style="display: flex; align-items: center;">
				<ion-icon name="phone-portrait-outline" style="color: #62B5F1;"></ion-icon>
				<span style="color: white; margin-left: 10px; font-size: 16px">01234 567890</span>
			</div>

			<p style="color:#2D95C2; font-size: 28px; font-weight: 500; margin-top:10px">Media & press</p>
			<div style="display: flex; align-items: center;">
				<ion-icon name="mail-outline" style="color: #62B5F1;"></ion-icon>
				<span style="color: white; margin-left: 10px; font-size: 16px">emailaddress@emailaddress.com</span>
			</div>
			<div style="display: flex; align-items: center;">
				<ion-icon name="phone-portrait-outline" style="color: #62B5F1;"></ion-icon>
				<span style="color: white; margin-left: 10px; font-size: 16px">01234 567890</span>
			</div>
		</div>
	</div>
</div>

<div class="container row m-auto" id="contact_section_2" style="padding-top: 80px;padding-bottom: 80px;">
	<div class="col-md-6 d-flex">
    	<img src="assets/img/home9.jpg" style="width: 100%;max-height: 350px;">
	</div>
	<div class="col-md-6">
		<div class="contact-wrap pt-3 pb-2 px-2">
			<h3 class="mb-2">Contact Us</h3>
			<div class="divider mb-4"></div>	
			<form method="POST" id="contactForm" name="contactForm" class="contactForm">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group mb-4">
							<input type="text" class="form-control" name="name" id="name" placeholder="Your Name *" required>
						</div>
					</div>
					<div class="col-md-6"> 
						<div class="form-group mb-4">
							<input type="text" class="form-control" name="number" id="number" placeholder="Your Phone">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group mb-4">
							<input type="email" class="form-control" name="email" id="email" placeholder="Your Email *" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group mb-4">
							<textarea class="form-control" name="message" id="message" cols="30" rows="3" placeholder="Message *" required></textarea>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group text-right mb-0">
							<input type="submit" value="Send Message" class="btn btn-primary">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
$("#contactForm").submit(function(e){
	e.preventDefault();
	var name = $("#contactForm #name").val();
	var number = $("#contactForm #number").val();
	var email = $("#contactForm #email").val();
	var message = $("#contactForm #message").val();

	if(name && email && message) {
		$("input[type='submit']").attr('disabled',true);
		$("input[type='submit']").after('<img src="assets/img/spinner.gif" style="width:30px;">');
		$.ajax({
			url:"api/ajax.php",
			data: { 
				request:'contact',
				name:name,
				number:number,
				email:email,
				message:message
			},
			async:false,
			type: 'post',
			success: function(re)
			{
				var result = JSON.parse(re);
				if(result['status']=="200"){

					var data = {
					service_id: YOUR_SERVICE_ID,
					template_id: CONTACT_FORM_ID,
					user_id: YOUR_USER_ID,
					template_params: result['data']
					};

					$.ajax('https://api.emailjs.com/api/v1.0/email/send', {
						type: 'POST',
						data: JSON.stringify(data),
						contentType: 'application/json'
					}).done(function() {
						console.log('Your mail is sent!');
						swal("Success","Successfully Sent","success");
						$('#contactForm')[0].reset();
						$("input[type='submit']").removeAttr('disabled');
						$("input[type='submit']").next('img').remove();
					}).fail(function(error) {
						console.log('Oops... ' + JSON.stringify(error));
						swal("Success","Successfully Sent","success");
						$('#contactForm')[0].reset();
						$("input[type='submit']").removeAttr('disabled');
						$("input[type='submit']").next('img').remove();
					});
				}
			}
		});
	}
});
</script>

<?php
require('footer.php');
?>
<script src="assets/js/home.js?i=<?php echo rand(10,100);?>"></script>


