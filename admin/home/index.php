<?php 
	require('../header.php');
?>

<style>
	.auction_section #header {
		font-size: 14px;
		font-style: normal;
		font-weight: 500;
		letter-spacing: 0em;
	}
	.auction_section #price {
		font-size: 16px;
		font-style: normal;
		font-weight: 600;
		letter-spacing: 0em;
	}
	.auction_section #status span {
		background: #E1E6EB;
		padding: 5px 10px;
	}
	.auction_section #timer {
		display: flex;
		align-items: center;
	}
	.auction_section #timer ion-icon {
		margin-right: 5px;
	}
</style>

<div class="page-content">
	 <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->

		<div class="row mb-3">
			<div class="col-12 col-md-3">
                <div class="card">
					<div class="card-body pt-2 pb-0">
						<h4 class="card-title text-dark mb-3">Users</h4>
						<div class="card-text auction_section" id="users_section"></div>
                    </div>
                </div>
            </div> <!-- end col -->
			<!-- <div class="col-12 col-md-3">
                <div class="card">
					<div class="card-body pt-2 pb-0">
						<h4 class="card-title text-secondary mb-3">Message</h4>
						<div class="card-text auction_section" id="contact_section"></div>
                    </div>
                </div>
            </div> end col -->
			<div class="col-12 col-md-3">
                <div class="card">
					<div class="card-body pt-2 pb-0">
						<h4 class="card-title text-success mb-3">Bids</h4>
						<div class="card-text auction_section" id="bids_section"></div>
                    </div>
                </div>
            </div> <!-- end col -->
			<div class="col-12 col-md-3">
                <div class="card">
					<div class="card-body pt-2 pb-0">
						<h4 class="card-title text-secondary mb-3">Tickets</h4>
						<div class="card-text auction_section" id="tickets_section"></div>
                    </div>
                </div>
            </div> <!-- end col -->
			<div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-body pt-2 pb-0">
						<h4 class="card-title text-warning mb-3">Donations</h4>
						<div class="card-text auction_section" id="donation_section"></div>
                    </div>
                </div>
            </div> <!-- end col -->
		</div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body pt-3 pb-0">
						<h4 class="card-title text-danger mb-3">Auction</h4>
						<div class="card-text auction_section" id="auction_section"></div>
                    </div>
                </div>
            </div> <!-- end col -->
			<div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body pt-3 pb-0">
						<h4 class="card-title text-primary mb-3">Raffle</h4>
						<div class="card-text auction_section" id="raffle_section"></div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->  

    </div><!-- container -->
</div>


<?php
require('../footer.php');
?>

<script type="text/javascript">
	show();
	function show(){
		$.ajax({
	      url:"<?php echo $site_url?>api/ajax.php",
	      data: { 
	      		request:'get_auctions',
	         },
	      type: 'post',
	      success: function(re) 
	      {
	        var result = JSON.parse(re);
	        console.log(result)
	        if(result['status']=="200"){
				var data = result['data'];
				var string = "";
				for(var i=0; i<data.length; i++){
					var images = JSON.parse(data[i]['image']);
					var first_image = images.length==0 ? "" : "<?php echo $site_url?>api/upload/auction/"+data[i]['id']+"/"+images[0]+"";	

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

					 string+=`<div class="col-md-12 mb-4">
					 	<div class="row" style="justify-content:space-between;">
				    		<span><a href="../auction/manage_biders.php?id=`+data[i]['id']+`&n=`+data[i]['auction_name']+`"><p id="header">`+data[i]['auction_name']+`</p></a></span>
				    		<span id="price">£`+data[i]['max_amount']+`</span>
						</div>
				    	<div id="status" class="row" style="justify-content:space-between;">
				    		<span>`+data[i]['bid_count']+` bids</span>
				    		<span id="timer"><ion-icon name="alarm-outline"></ion-icon>`+expir_date+`</span>
				    	</div> 
						<hr>
				    </div>`;
				}
				$("#auction_section").html(string);
	        }
	      }
	    });

		$.ajax({
	      url:"<?php echo $site_url?>api/ajax.php",
	      data: { 
	      		request:'get_raffles',
	         },
	      type: 'post',
	      success: function(re) 
	      {
	        var result = JSON.parse(re);
	        console.log(result)
	        if(result['status']=="200"){
				var data = result['data'];
				var string = "";
				for(var i=0; i<data.length; i++){
					var images = JSON.parse(data[i]['image']);
					var first_image = images.length==0 ? "" : "<?php echo $site_url?>api/upload/raffle/"+data[i]['id']+"/"+images[0]+"";	

					var end_date = new Date(data[i]['end_time']);
		            var now   = new Date();
		            var diff  = new Date(end_date - now);
		            var days  = parseInt(diff/1000/60/60/24);
		            var hours  = parseInt(diff/1000/60/60 - (days*24));
		            // var weeks = ["Sun","Mon","Tues","Wednes","Thu","Fri","Satur"];
		            // var week = weeks[end_date.getDay()];

		            var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
					var month = months[end_date.getMonth()];
					// var year = end_date.getFullYear();
					var day = end_date.getDate();
					var to  = day+" "+month;

		            var end_hour = end_date.getHours();
		            var end_min  = end_date.getMinutes();
		            var pm_am = end_hour>=12 ? 'PM' : 'AM';
		            var expir_date = days>0 ? days+"d"+" "+hours+"h left ( "+to+" "+end_hour+":"+end_min+" "+pm_am+ ")" : "Expired ( "+to+" "+end_hour+":"+end_min+" "+pm_am+ ")";

					 string+=`<div class="col-md-12 mb-4">
						<div class="row" style="justify-content:space-between;">
				    		<span><a href="../raffle/manage_buyers.php?id=`+data[i]['id']+`&n=`+data[i]['raffle_name']+`"><p id="header">`+data[i]['raffle_name']+`</p></a></span>
				    		<span id="price">£`+data[i]['price']+`</span>
						</div>
				    	<div id="status" class="row" style="justify-content:space-between;">
				    		<span>`+data[i]['ticket_sold']+` ticket sold</span>
				    		<span id="timer"><ion-icon name="alarm-outline"></ion-icon>`+expir_date+`</span>
				    	</div> 
						<hr>
				    </div>`;
				}
				$("#raffle_section").html(string);
	        }
	        else{
	        }
	      }
	    });

		$.ajax({
	      url:"<?php echo $site_url?>api/ajax.php",
	      data: { 
	      		request:'total_users',
	         },
	      type: 'post',
	      success: function(re) 
	      {
	        var result = JSON.parse(re);
	        console.log(result)
	        if(result['status']=="200"){
				var string = "";
				string+=`<div class="col-md-12">
					<div class="row" style="justify-content:space-between;">
						<span><a href="../users/index.php"><p id="header">No of Users: </p></a></span>
						<span id="price">`+result['data']+`</span>
					</div>
				</div>`;
				$("#users_section").html(string);
	        }
	        else{
	        }
	      }
	    });
		
		// $.ajax({
	    //   url:"<?php echo $site_url?>api/ajax.php",
	    //   data: { 
	    //   		request:'total_contacts',
	    //      },
	    //   type: 'post',
	    //   success: function(re) 
	    //   {
	    //     var result = JSON.parse(re);
	    //     console.log(result)
	    //     if(result['status']=="200"){
		// 		var string = "";
		// 		string+=`<div class="col-md-12">
		// 			<div class="row" style="justify-content:space-between;">
		// 				<span><a href="../contact/index.php"><p id="header">Total Messages: </p></a></span>
		// 				<span id="price">`+result['data']+`</span>
		// 			</div>
		// 		</div>`;
		// 		$("#contact_section").html(string);
	    //     }
	    //     else{
	    //     }
	    //   }
	    // });

		$.ajax({
	      url:"<?php echo $site_url?>api/ajax.php",
	      data: { 
	      		request:'total_bids',
	         },
	      type: 'post',
	      success: function(re) 
	      {
	        var result = JSON.parse(re);
	        console.log(result)
	        if(result['status']=="200"){
				var string = "";
				string+=`<div class="col-md-12">
					<div class="row" style="justify-content:space-between;">
						<span><a href="../auction/index.php"><p id="header">Total Bids: </p></a></span>
						<span id="price">`+result['data']+`</span>
					</div>
				</div>`;
				$("#bids_section").html(string);
	        }
	        else{
	        }
	      }
	    });

		$.ajax({
	      url:"<?php echo $site_url?>api/ajax.php",
	      data: { 
	      		request:'total_tickets',
	         },
	      type: 'post',
	      success: function(re) 
	      {
	        var result = JSON.parse(re);
	        console.log(result)
	        if(result['status']=="200"){
				var string = "";
				string+=`<div class="col-md-12">
					<div class="row" style="justify-content:space-between;">
						<span><a href="../raffle/index.php"><p id="header">Tickets Sold: </p></a></span>
						<span id="price">`+result['data']+`</span>
					</div>
				</div>`;
				$("#tickets_section").html(string);
	        }
	        else{
	        }
	      }
	    });

		$.ajax({
	      url:"<?php echo $site_url?>api/ajax.php",
	      data: { 
	      		request:'total_donations',
	         },
	      type: 'post',
	      success: function(re) 
	      {
	        var result = JSON.parse(re);
	        console.log(result)
	        if(result['status']=="200"){
				var string = "";
				string+=`<div class="col-md-12">
					<div class="row" style="justify-content:space-between;">
						<span><a href="../donate/index.php"><p id="header">Total Donations: </p></a></span>
						<span id="price">£`+result['data']+`</span>
					</div>
				</div>`;
				$("#donation_section").html(string);
	        }
	        else{
	        }
	      }
	    });
	}
</script>