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
                    <h4 class="page-title">Contact List</h4>
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
                                <th>User Phone</th>
                                <th>User Email</th>
                                <th>Message</th>
								<th>Mailing List</th>
                                <th>Time</th>
                                <th>Action</th>
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
	      		request:'get_contact',
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
						
						var time = data[i]['time'];
						time = new Date(time);
						time = time.toLocaleString("en-UK", options);

						if(data[i]['mailing_list'] == '1') {
							var list = 'yes';
						} else {
							var list = 'no';
						}
						
    					string+=`<tr>
                    		<td>
                          `+(i+1)+`
                    		</td>
                    		<td>`+data[i]['name']+`</td>
                    		<td>`+data[i]['number']+`</td>
                    		<td>`+data[i]['email']+`</td>
                    		<td>`+data[i]['message']+`</td>
							<td>`+list+`</td>
                    		<td>`+time+`</td>
                    		<td>
                        	    <button class="btn btn-xs btn-danger remove_btn" id="`+data[i]['id']+`"><i class="far fa-trash-alt"></i></button>
                        	</td>
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
	      		request:'delete_contact',
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