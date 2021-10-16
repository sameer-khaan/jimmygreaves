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
                            <li class="breadcrumb-item"><a href="index.php">Raffle</a></li>
                            <li class="breadcrumb-item active">Buyers</li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?php echo $name?> Buyers List</h4>
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Bought time</th>
                                <th>Bought tickets</th>
                                <th>At price</th>
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
    	function show(){
    		$.ajax({
    	      url:"<?php echo $site_url?>api/ajax.php",
    	      data: { 
	      		request:'get_buyers',
                id:id
	         },
    	      type: 'post',
    	      success: function(re) 
    	      {
    	        var result = JSON.parse(re);
    	        if(result['status']=="200"){
        				var data = result['data'];
        				var string = "";
        				for(var i=0; i<data.length; i++){
                        
                            const options = { hour12: true, year: 'numeric', month: 'numeric', day: 'numeric', hour: '2-digit', minute:'2-digit' };
						
                            var buy_time = data[i]['buy_time'];
                            buy_time = buy_time.replace('pm','');
                            buy_time = buy_time.replace('am','');
                            buy_time = new Date(buy_time);
                            buy_time = buy_time.toLocaleString("en-UK", options);

                            string+=`<tr>
                                <td>`+data[i]['fullname']+`</td>
                                <td>`+data[i]['email']+`</td>
                                <td>`+buy_time+`</td>
                                <td>`+data[i]['buy_amount']+`</td>
                                <td>£`+data[i]['price']+`</td>
                            </tr>
                            `;
        				}
        			  $("tbody").html(string);
                }
    	      }
    	    }); 
    	}

    
</script>