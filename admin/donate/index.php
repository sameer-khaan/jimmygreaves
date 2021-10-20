<?php 
	require('../header.php');
?>
<div class="page-content">
	 <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                    </div>
                    <h4 class="page-title">Donation List</h4>
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
                                <th>#</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Donate Time</th>
                                <th>Donate Amount</th>
                                <th>Add Gift</th>
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
	show();
	var auctions = [];
	function show(){
		$.ajax({
	      url:"<?php echo $site_url?>api/ajax.php",
	      data: { 
	      		request:'get_donates',
	         },
	      type: 'post',
	      success: function(re) 
	      {

	        var result = JSON.parse(re);
	        if(result['status']=="200"){
    				var data = result['data'];
    				auctions = data;
    				var string = "";
    				for(var i=0; i<data.length; i++){
						const options = { hour12: true, year: 'numeric', month: 'numeric', day: 'numeric', hour: '2-digit', minute:'2-digit' };
						
						var create_time = data[i]['create_time'];
						create_time = create_time.replace('pm','');
						create_time = create_time.replace('am','');
						create_time = new Date(create_time);
						create_time = create_time.toLocaleString("en-UK", options);

						if(data[i]['add_gift'] == '1') {
							var gift = 'yes';
						} else {
							var gift = 'no';
						}

    					string+=`<tr>
                    		<td>
                          `+(i+1)+`
                    		</td>
                    		<td>`+data[i]['fullname']+`</td>
                    		<td>`+data[i]['email']+`</td>
                    		<td>`+create_time+`</td>
                    		<td>£`+data[i]['amount']+`</td>
							<td>`+gift+`</td>
                    	</tr>`;
    				}
    				$("tbody").html(string);
	        }
	      }
	    }); 
	}
	
   

    $('body').on('click', '.remove_btn', function () {
    	var id = $(this).attr('id');
    	swal({
	        title: 'Are you sure?',
	        text: "You won't be able to remove this!",
	        icon: 'warning',
	        showCancelButton: true,
	        confirmButtonColor: '#3085d6',
	        cancelButtonColor: '#d33',
	        confirmButtonText: 'Yes, delete it!'
	      }).then((result) => {
	      	remove(id);
	          swal(
	            'Deleted!',
	            'The auction has been deleted.',
	            'success'
	          )
	      })
    });
   
    function remove(id){
		$.ajax({
	      url:"<?php echo $site_url?>api/ajax.php",
	      data: { 
	      		request:'delete_donate',
	      		id:id
	         },
	      type: 'post',
	      success: function(re) 
	      {
	        var result = JSON.parse(re);
	        if(result['status']=="200"){
				    swal("Success","Successfully removed","success");
				    show();
	        }
	        else{

	        }
	      }
	    }); 
    }
    
</script>