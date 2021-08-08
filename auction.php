<?php 
require('header.php');
?>
<link href="assets/css/auction.css?i=<?php echo rand(10,100);?>" rel="stylesheet" />
<title>Auction</title>
<style type="text/css">
	.tooltip-custom {
	    .tooltip-inner {
	        background-color: red !important;    
	    }
	}
	@keyframes sharpen {
		0% {
			background-image: url("assets/img/home8.jpg");
            filter: blur(1px);
		}
		100% {
			background-image: url("assets/img/home8.jpg");
            filter: blur(0px);
		}
	}
</style>


<header class="masthead">
	<!-- <img src="assets/img/home8.jpg" style="width:auto;position:absolute;" /> -->
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mt-5 mb-5">
                <p class="text-white" style="font-size:50px;">Auction memorabilia</p>
                <div class="divider mb-4" style="margin:auto"></div>
                <p class="text-white" style="font-size:20px;">All proceeds go to the Jimmy Greaves Foundation, which lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="col-lg-8 align-self-baseline mt-5 mb-5" id="section07">
                <a id="arrow_bottom" href="#auction_section_2"><span></span><span></span><span></span></a>
            </div>
        </div>
    </div>
</header>


<div class="container">
	<div class="row justify-content-center" id="auction_section_2"></div>
</div>


<div class="row" id="donate_section_2">
    <div class="col-md-7" id="first_div" >
        <p id="text_header">Where will my money go?</p>
        <div class="divider mb-4" ></div>
        <p id="text_body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
		<span class="btn_underline"><a href="contact.php">Causes we support</a></span>
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
		<span class="btn_underline"><a href="contact.php">Causes we support</a></span>
    </div>
</div>

<?php
require('footer.php');
?>

<script type="text/javascript">
	show();
	var auctions = [];
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
				auctions = data;
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

					 string+=`<div class="col-md-5" style="margin:1% 3%;padding:20px;box-shadow:2px 2px 20px rgb(0 0 0 / 40%);">
				    	<a href="auction_detail.php?id=`+data[i]['id']+`&n=`+data[i]['auction_name']+`"><img class="img-thumbnail" style="width:100%; max-height:450px; max-width:450px;" src="`+first_image+`" /></a>
				    	<a href="auction_detail.php?id=`+data[i]['id']+`&n=`+data[i]['auction_name']+`"><p id="header">`+data[i]['auction_name']+`</p></a>
				    	<p id="price">£`+data[i]['init_price']+`</p>
				    	<p id="desc">`+data[i]['description']+`</p>
				    	<div id="status" style="display:flex">
				    		<span>`+data[i]['bid_count']+` bids</span>
				    		<span id="timer"><ion-icon name="alarm-outline"></ion-icon>`+expir_date+`</span>
				    	</div> 
				    </div>`;
				}
				$("#auction_section_2").html(string);
	        }
	        else{
	        }
	      }
	    }); 
	}
</script>
<script src="assets/js/home.js?i=<?php echo rand(10,100);?>"></script>
