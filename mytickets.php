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
			<p style="font-size: 28px; color: #343A42; font-weight: 500">My Tickets</p>
			<div id="bids_div" class="row">
				<!-- <div class="row">
					<img class="col-md-3" src="assets/img/auction2.png" />
					<div class="col-md-9">
						<p>Auction memorabilia item name goes here</p>
						<div id="status">
							<span class="bid_count bid_status">3 bids</span>
							<span id="timer"> <ion-icon name="alarm-outline"></ion-icon> 1d 17h left (Tue, 15:31)</span>
						</div>
						<p></p>
						<div class="row">
							<div class="col-6 col-md-4">
								<p style="font-size:18px">Amount Paid:</p>
								<p>£50</p>
							</div>
							<div class="col-6 col-md-4">
								<p style="font-size:18px">Tickets Bought:</p>
								<p>3</p>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>

<?php
require('footer.php');
?>

<script type="text/javascript">
  	var user_id = '<?php echo $user_id?>';
  	show();

  	var expire_flag=true;
	var biders = [];
	function show(){
		$.ajax({
			url:"api/ajax.php",
			data: { 
				request:'get_buyers_user',
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
						var expir_date = days>0 ? days+"d"+" "+hours+"h left ( "+to+" "+end_hour+":"+end_min+" "+pm_am+ ")" : "Expired ( "+to+" "+end_hour+":"+end_min+" "+pm_am+ ")";
						expire_flag = days>0 ? true : false;
						images = JSON.parse(data[i]['image']);
						string+=`<div class="row mb-5">
									<img class="col-md-3" src="api/upload/raffle/`+data[i]['id']+`/`+images[0]+`" />
									<div class="col-md-9">
										<p>`+data[i]['raffle_name']+`</p>
										<div id="status">
											<span id="timer"> <ion-icon name="alarm-outline"></ion-icon> `+expir_date+`</span>
										</div>
										<p></p>
										<div class="row">
											<div class="col-6 col-md-4">
												<p style="font-size:18px" class="m-0">Amount Paid:</p>
												<p>£`+data[i]['price']+`</p>
											</div>
											<div class="col-6 col-md-4">
												<p style="font-size:18px" class="m-0">Tickets Bought:</p>
												<p>`+data[i]['buy_amount']+`</p>
											</div>
										</div>
									</div>
								</div>`;
					}
					$("#bids_div").html(string);
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
