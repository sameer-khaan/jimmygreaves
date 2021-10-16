<?php 
require('header.php');
if(!isset($_SESSION['login_flag']) || $_SESSION['login_flag']!="1"){
	redirect($site_url);
}
?>
<link href="assets/css/myaccount.css?i=<?php echo rand(10,100);?>" rel="stylesheet" />
<title>My Account</title>

<div class="header">
	<div class="container">
		<p>My Account</p>
		<div class="divider mb-4"></div>
	</div>
</div>

<div class="container" style="min-height:480px">
	<div class="row">
		<div class="col-md-3">
			<img src="assets/img/header_user1.png" />
	        <span id="user_header_name"><?php echo $user_name?></span>
	        <p id="user_header_email"><?php echo $email?></p>
			<a href="myaccount.php">
	        <div id="left_side_menu">
	        	<span>Bids</span>
	        	<ion-icon name="chevron-forward-outline"></ion-icon>
	        </div>
			</a>
			<a href="mytickets.php">
	        <div id="left_side_menu">
	        	<span>Tickets</span>
	        	<ion-icon name="chevron-forward-outline"></ion-icon>
	        </div>
			</a>
	        <!-- <div id="left_side_menu">
	        	<span>Account</span>
	        	<ion-icon name="chevron-forward-outline"></ion-icon>
	        </div> -->
	        <a href="javascript://" style="font-size: 13px; float: right; margin-bottom: 20px" id="user_header_signout">Sign out</a>
		</div>
		<div class="col-md-9" style="margin-bottom:30px">
			<p style="font-size: 28px; color: #343A42; font-weight: 500">My Bids</p>
			<div id="bids_div" class="row">
			</div>
		</div>
	</div>
</div>

<div class="modal" id="make_payment_modal" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title payment_head" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="current_payment_div">
	         
      </div>
    </div>
  </div>
</div>

<?php
require('footer.php');
?>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script type="text/javascript">
  	var user_id = '<?php echo $user_id?>';
  	show();

  	var expire_flag=true;
	var biders = [];
	function show(){
		$.ajax({
			url:"api/ajax.php",
			data: { 
				request:'get_biders_user',
				user_id:user_id
			},
			type: 'post',
			success: function(re) 
			{
				var result = JSON.parse(re);
				console.log(result);
				if(result['status']=="200"){
					var data = result['data'];
					biders = data;
					var string = "";
					for(var i=0; i<data.length; i++){
						var end_date = new Date(data[i]['end_time']);
						var now   = new Date();
						var diff  = new Date(end_date - now);
						var days  = parseInt(diff/1000/60/60/24);
						var hours  = parseInt(diff/1000/60/60 - (days*24));
						var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
						var month = months[end_date.getMonth()];
						// var year = end_date.getFullYear();
						var day = end_date.getDate();
						var to  = day+" "+month;
						var end_hour = end_date.getHours();
						var end_min  = end_date.getMinutes();
						var pm_am = end_hour>=12 ? 'PM' : 'AM';
						var payment = '';
						var expir_date = days>0 ? days+"d"+" "+hours+"h left ( "+to+" "+end_hour+":"+end_min+" "+pm_am+ ")" : "Expired ( "+to+" "+end_hour+":"+end_min+" "+pm_am+ ")";
						expire_flag = days>0 ? true : false;
						images = JSON.parse(data[i]['image']);
						if(data[i]['bid_amount'] == data[i]['max_amount']) {
							if(!expire_flag){
								var tag = `<p class="btn btn-sm btn-success ml-5 mr-2" style="font-size:15px;"> You've won </p>`;
								if(data[i]['paid_status'] == 'paid'){
									var payment = `<p class="btn btn-sm btn-success mr-2" style="font-size:15px;font-weight:700;line-height:28px;"> Payment Paid </p>`;
								}else{
									var payment = `<p class="btn btn-sm btn-danger mr-2" style="font-size:15px;font-weight:700;line-height:28px;"> Payment Pending </p> <p><button class="btn btn-secondary make_payment" data-auction_id="`+data[i]['id']+`" data-total_price="`+data[i]['bid_amount']+`" data-auction_name="`+data[i]['auction_name']+`">Make Payment</button></p>`;
								}
							}else{
								var tag = `<p class="btn btn-sm btn-success mx-5" style="font-size:15px;"> Currently winning </p>`;
							}
						} else {
							var tag = `<p class="btn btn-sm btn-primary mx-5" style="font-size:15px;"> You've been outbid </p>`;
						}
						string+=`<div class="row col-md-12 mb-5">
									<img class="col-md-3" src="api/upload/auction/`+data[i]['id']+`/`+images[0]+`" />
									<div class="col-md-9">
										<p>`+data[i]['auction_name']+`</p>
										<div id="status">
											<p>£`+data[i]['bid_amount']+`</p>
											`+tag+`
											`+payment+`
										</div>
										<div id="status">
											<span class="bid_count bid_status" data-auction_id="`+data[i]['id']+`">`+data[i]['total_bids']+` bids</span>
											<span id="timer"> <ion-icon name="alarm-outline"></ion-icon> `+expir_date+`</span>
										</div>
									</div>
								</div>`;
					}
					$("#bids_div").html(string);

					$(".make_payment").click(function(){
						var auction_id = $(this).data('auction_id');
						var auction_name = $(this).data('auction_name');
						var total_price = $(this).data('total_price');
						
						var payment = `<div id="paypal-button" style="width: 100px; align-items: center; align-self: center; justify-content: center"></div>`;
						var string = "";
						string +=`<div>
									<p>£`+total_price+`</p>
									<p>`+payment+`</p>
								</div>`;
						
						$(".payment_head").html(auction_name);
						$("#current_payment_div").html(string);
						$("#make_payment_modal").modal('show');

						var paypalActions;
						paypal.Button.render({
							// Configure environment
							env: 'production',
							//env: 'sandbox',
							client: {
								//sandbox: 'AUOIw9T0HlHoFXrskX2L8M6WWkbH_QhN2k3BtJRUlx0IBEen8S_mOVgdIJ5h2ml37Hc4GX2WTR9KDF0u',
								//production: 'ASAq7Q3AwES6JQ9Mc_Od5doolAQkzGxjyQ74oNA0LkBEbVz2eO38eLnNOF7iOMWWp6vsUcWjFGvsjTCJ'
								production: 'ARiEn-rP-QtqFV7bROZWlrinq2AEjkoNkOVB7EIpJ183yxM_nqPdOE5zCNeIa0rlw-F8MrRi1DeBsjFz'
							},
							// Customize button (optional)
							locale: 'en_US',
							style: {
								size: 'responsive',
								color: 'blue',
								shape: 'rect',
								label:'paypal',
								tagline: false
							},
							validate: function(actions) {
								actions.disable(); // Allow for validation in onClick()
								paypalActions = actions; // Save for later enable()/disable() calls
							},
							onClick: function(data,actions){
								paypalActions.enable();
							},
							// Enable Pay Now checkout flow (optional)
							commit: true,
							// Set up a payment
							payment: function(data, actions) {
								var value = parseFloat(total_price);
								return actions.payment.create({
								transactions: [{
									amount: {
									total: value,
									currency: 'GBP',
									}
								}]
								});
							},
							// Execute the payment
							onAuthorize: function(data, actions) {
							return actions.payment.execute().then(function() {
								
								$.ajax({
								url:"api/ajax.php",
								data: { 
									request:'auction_paid',
									id:auction_id,
									amount:total_price
								},
								async:false,
								type: 'post',
								success: function(re)
								{
									var result = JSON.parse(re);
									if(result['status']=="200"){
										$("#make_payment_modal").modal('hide');
										swal("Success","Successfully Paid","success");
										location.reload();
										/*
										var data = {
											service_id: YOUR_SERVICE_ID,
											template_id: RAFFLE_TEMP_ID,
											user_id: YOUR_USER_ID,
											template_params: result['data']
										};
						
										$.ajax('https://api.emailjs.com/api/v1.0/email/send', {
											type: 'POST',
											data: JSON.stringify(data),
											contentType: 'application/json'
										}).done(function() {
											console.log('Your mail is sent!');
											swal("Success","Successfully Bought","success");
										}).fail(function(error) {
											console.log('Oops... ' + JSON.stringify(error));
											swal("Success","Successfully Bought","success");
										});
										*/
									}
								}
								});
							});
							}
						}, '#paypal-button');
					});
				}
				else {
					string=`<div class="row mb-5">
								<div class="col-md-12">
									<p>`+result['message']+`</p>
								</div>
							</div>`;
					$("#bids_div").html(string);
				}
			}
	    }); 
	}
</script>

<script src="assets/js/three_hover.js"></script>
