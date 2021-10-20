<?php 
	require('../header.php');
  $id= $_GET['id'];
  $name = $_GET['n'];
?>
<div class="page-content">
	 <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Auctions</a></li>
                            <li class="breadcrumb-item active">Bidders</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?php echo $name?> Biders List</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Bid time</th>
                                <th>Bid amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            	
                            </tbody>
                        </table>        
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
  var id = '<?php echo $id?>';
  show();

	var biders = [];
	function show(){
		$.ajax({
	      url:"<?php echo $site_url?>api/ajax.php",
	      data: { 
	      	request:'get_biders',
            id:id
	      },
	      type: 'post',
	      success: function(re) 
	      {
	        var result = JSON.parse(re);
	        if(result['status']=="200"){
                var data = result['data'];
                biders = data;
                var string = "";
                for(var i=0; i<data.length; i++){

                    const options = { hour12: true, year: 'numeric', month: 'numeric', day: 'numeric', hour: '2-digit', minute:'2-digit' };
						
                    var bid_time = data[i]['bid_time'];
                    bid_time = bid_time.replace('pm','');
                    bid_time = bid_time.replace('am','');
                    bid_time = new Date(bid_time);
                    bid_time = bid_time.toLocaleString("en-UK", options);
                    
                    string+=`<tr>
                        <td>`+data[i]['fullname']+`</td>
                        <td>`+data[i]['email']+`</td>
                        <td>`+bid_time+`</td>
                        <td>£`+data[i]['bid_amount']+`</td>
                    </tr>
                    `;
                }
                $("tbody").html(string);
            }
	      }
	    }); 
	}
</script>