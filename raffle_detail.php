<?php 
	require('header.php');
	$id= $_GET['id'];
	$name= $_GET['n'];
?>
<link href="assets/css/raffle_detail.css?i=<?php echo rand(10,100);?>" rel="stylesheet" />
<link rel="stylesheet" href="assets/css/lightslider.css"/>

<title>Raffle Detail</title>

<div class="header container">
	<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="raffle.php">Raffle</a></li>
        <li class="breadcrumb-item active"><?php echo $name?></li>
    </ol>
</div>

<div class="container" style="margin-bottom:50px">
	<div class="row">
		<div class="col-md-5">
			<div class="demo">
		        <div class="item">            
		            <div class="clearfix" style="max-width:474px;">
		                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
		                </ul>
		            </div>
		        </div>
		    </div>	
		</div>
		<div class="col-md-7">
			<p id="title"><?php echo $name?></p>
			<div id="status" style="display:flex">
	    		<span id="timer"><ion-icon name="alarm-outline"></ion-icon> <span id="left_time"></span></span>
	    	</div> 

	    	<div id="bid_div" class="row">
	    		<div class="col-md-6">
	    			<div>
		    			<p style="font-size:16px">Price</p>
		    			<p style="font-size:26px;font-weight: 800;" id="price">£10.00</p>
		    		</div>
		    		<div class="if_not_expired">
		    			<span>Number of tickets</span><br>
		    			<select id="select_bid_amount">
		    				<option value="1" selected="">1</option>
		    				<option value="2" >2</option>
		    				<option value="3">3</option>
		    				<option value="4">4</option>
		    				<option value="5">5</option>
		    				<option value="6">6</option>
		    				<option value="7">7</option>
		    				<option value="8">8</option>
		    				<option value="9">9</option>
		    				<option value="10">10</option>

		    			</select>
		    			<span>Max. 10</span>
		    		</div>
	    		</div>
	    		
	    		<div class="col-md-6 if_not_expired" style="align-items: center;">
	    			<span id="total_price">£20.00</span>
					<div style="display: flex;flex-direction: column;align-items: center;">
						<div id="paypal-button" style="width: 100px; align-items: center; align-self: center; justify-content: center"></div>
						<?php
						if(!isset($_SESSION['login_flag']) || $_SESSION['login_flag']!="1"){
							echo '<div><small><i>- website sign up required</i></small></div>';
						}
						?>
					</div>
	    		</div>
	    	</div>
	    	<div id="description_div" style="margin-top:30px">
				<p>DESCRIPTION</p>
				<p id="desc_text"></p>
			</div>
			<div id="eiscription_div">
				<p>DELIVERY</p>
				<p id="delivery_text"></p>
			</div>
			<div id="description_div">
				<p>TERMS</p>
				<p id="terms_text"></p>
			</div>
		</div>
	</div>
</div>

<div id="raffle_slider_modal" class="modal sliderModal">
	<div class="modal-content">
		<div>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div>
			<div id="model-image-gallery">
			</div>
			
			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>

			<div id="bottom-image-gallery">
			</div>
		</div>
	</div>
</div>

<?php
require('footer.php');
?>
<script type="text/javascript">
	var id = '<?php echo $id?>';
</script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="assets/js/lightslider.js"></script> 
<script src="assets/js/raffle_detail.js?i=<?php echo rand(10,100);?>"></script> 
