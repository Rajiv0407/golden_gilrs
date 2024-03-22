<?php $session_data=session()->get('admin_session');
 $user_per_info=user_permission($session_data['userId']);          
 $AddGoodiesManagment=checkAddRole($user_per_info,6);  
 $EditGoodiesManagment=checkEditRole($user_per_info,6);   
 $DeleteGoodiesManagment=checkDeleteRole($user_per_info,6); 
 $StatusGoodiesManagment=checkStatusRole($user_per_info,6); 
 
 ?> 
          <div class="carManagement__wrapper">
                <div class="breadcrumbWrapper d-flex align-items-center justify-content-between ">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Goodies Management</h3>
                        <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Goodies</li>
                        </ol>
                    </nav>
                    <!---== data-bs-toggle="modal" data-bs-target="#add_body" ==-->
					<?php if($AddGoodiesManagment == 1){ ?>
                    <div class="rightButton">
                        <a href="javascript:void(0);" onclick="showModal('add_coupon_body')" class="border-btn d-flax" ><i class="bi bi-plus"></i><span>Add Goodies</span></a>
                    </div>
					<?php } ?>
                </div>
                <form action="javascript:void(0);" method="post" id="featureCouponSearchForm">
                <div class="filterWrapper">
                    <div class="form filterWrapper__l s_I">
                       
                         <div class="form-group">
                            <label for="Manufacture">Title</label>
                            <input type="text" class="form-control"  id="s_goodies_title" placeholder="Goodies Title">
                        </div> 
						<div class="form-group">
                            <label for="Manufacture">Address</label>
                            <input type="text" class="form-control"  id="s_address" placeholder="Address">
                        </div>
						<div class="form-group">
                            <label for="status">Fee Type</label>  
                            <select name="fStatus_S" id="goodies_fee_type_Search" class="form-control">
							    <option value="">Select</option>
                                <option value="Paid">Paid</option>
                                <option value="Free">Free</option>
                            </select>  
                        </div>
						<div class="form-group">
                            <label for="Manufacture">Start Date</label>
                            <input type="date" class="form-control"  id="s_start_date" placeholder="" pattern="\d{4}-\d{2}-\d{2}">
                        </div>
						<div class="form-group">
                            <label for="Manufacture">End Date</label>
                            <input type="date" class="form-control"  id="s_end_date" placeholder="">
                        </div>
						
                        <div class="form-group">
                            <label for="status">Status</label>  
                            <select name="fStatus_S" id="goodies_status_Search" class="form-control">
							    <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">In Active</option>
                            </select>  
                        </div>
                        <div class="d-flex">
                            <a href="javascript:void(0);" onclick="searchForGoodies();"  class="search-btn">  
                                <i class="bi bi-search"></i><span>Search</span>
                            </a>
                            <a href="javascript:void(0);" class="search-btn clear-btn ml-5px" onclick="clearNForGoodies()">
                                <i class="bi bi-eraser-fill"></i><span>Clear</span>
                            </a>
                        </div>
                    </div>
                </div>
                       </form>
                <div class="table-area notification_table">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" width="10px">#</th>
                                <th scope="col ">Title</th>
                                 <th scope="col ">Address</th>
                                 <th scope="col ">Fee Type</th>
                                 <th scope="col ">Seats</th>								 
                                <th scope="col ">Start Date</th>	
                                <th scope="col ">End Date</th>
								<th scope="col ">Goodies Date</th>									
                                <th scope="col" >Status</th>
                                <th scope="col" >Action</th>
                            </tr>
                        </thead>
                        <tbody>                         
                        </tbody>
                    </table>
                    <!-- <div class="table-footer">
                        <p><span>Total Record</span>:<span>10</span></p>
                    </div> -->
                </div>
<div class="modal fade right_side" id="add_coupon_body" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout add_motification_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Goodies</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" id="GoodiesForm" enctype="multipart/form-data">  
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="goodies_title">Goodies Title</label>
                         <input type="text" name="goodies_title" id="goodies_title"  class="form-control" placeholder="Goodies Title">
                         <span id="err_goodies_title" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="goodies_fee_type">Goodies Fee Type</label>
                          <select name="goodies_fee_type" id="goodies_fee_type" class="form-control">
							    <option value="">Select</option>
								<?php foreach($fee_data as $fee_datas){ ?>
                                <option value="<?php echo $fee_datas->id; ?>"><?php echo $fee_datas->fee_type;  ?></option>
								<?php } ?>								
                            </select>
							<span id="err_goodies_fee_type" class="err" style="color:red"></span>
                    </div>  
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="goodies_fee_type">Goodies Country</label>
                          <select name="goodies_country" id="goodies_country" class="form-control">
							    <option value="">Select</option>
								<?php foreach($country_data as $country_datas){ ?>
                                <option value="<?php echo $country_datas->id; ?>"><?php echo $country_datas->name;  ?></option>
								<?php } ?>								
                            </select>
							<span id="err_goodies_country" class="err" style="color:red"></span>
                    </div>  
                </div>
				<div class="form modal-form">
                    <div class="form-group" id="goodiesCity">
                        <label for="goodies_fee_type">Goodies City</label>
						<select name="goodies_city" id="goodies_city" class="form-control">
                          <option value="">Select</option>
						</select>
						<span id="err_goodies_city" class="err" style="color:red"></span>
                    </div>  
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="goodies_address">Goodies Address</label>
                         <input type="text" name="goodies_address" id="goodies_address"  class="form-control" placeholder="Goodies Address">
                         <span id="err_goodies_address" class="err" style="color:red"></span>
                    </div>
                </div>
				
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="goodies_seats">Goodies Seats</label>
                         <input type="number" name="goodies_seats" id="goodies_seats"  class="form-control" placeholder="Goodies Seats">
                         <span id="err_goodies_seats" class="err" style="color:red"></span>
                    </div>
                </div>
				
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="start_date">Start date</label>
                         <input type="date" name="start_date" id="start_date"  class="form-control" placeholder="Goodies Start Date">
                         <span id="err_start_date" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                         <input type="date" name="end_date" id="end_date"  class="form-control" placeholder="Goodies End Date">  
                         <span id="err_end_date" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="goodies_date">Goodies Date</label>
                         <input type="datetime-local" name="goodies_date" id="goodies_date"  class="form-control" placeholder="Goodies Date">  
                         <span id="err_goodies_date" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
				 <div class="form-group">
                            <label for="goodies_status">Status</label>
                            <select name="goodies_status" id="goodies_status" class="form-control">
							    <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
				</div>
				<div class="form modal-form">
                    <div class="form-group">  
                        <label for="goodies_image">Goodies Image</label>
                         <input type="file" name="goodies_image" id="goodies_image"  class="form-control" placeholder="Goodies Image">
                         <span id="err_goodies_image" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">  
                        <label for="goodies_descrption">Goodies Descrption</label>
                         <input type="text" name="goodies_descrption" id="goodies_descrption"  class="form-control" placeholder="Goodies Descrption">
                         <span id="err_goodies_descrption" class="err" style="color:red"></span>
                    </div> 
                </div>
                <div class="mt-4">
                    <a href="javascript:void(0);" id="upload"  onclick="submitGoodies()" class="search-btn">Submit</a>
                    <a href="javascript:void(0);" id="cancelBType" onclick="cancelFeature()" class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
                </div>

            </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade right_side" id="edit_goodies_body" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout edit_body_typ">
        <div class="modal-content">    
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Goodies</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body" id="editBodyGoodiesMb">                
                
            </div>
        </div>
    </div>
</div>

<script>
$('#goodies_country').change(function(e) {
        var selected = $('#goodies_country').val();
      if(selected!=''){
        ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/getGoodiesCity',
        data:{id:selected},
        success: function (response) {
          if(response.trim()!=='fail'){

            $('#goodiesCity').html(response);

          }else{
             $('#goodiesCity').html('<label for="goodies_fee_type">Goodies City</label><select name="goodies_city" id="goodies_city" class="form-control"><option value="">Select</option></select>');
          }
        }
    });
      }else{
        $('#goodiesCity').html('<label for="goodies_fee_type">Goodies City</label><select name="goodies_city" id="goodies_city" class="form-control"><option value="">Select</option></select>');
      } 
    });


</script>

<script type="text/javascript">

     $(document).ready(function($k){
		 
		 var edit_goodies_per ='<?php echo $EditGoodiesManagment; ?>';
		 var delete_goodies_per ='<?php echo $DeleteGoodiesManagment; ?>';
		 var status_goodies_per ='<?php echo $StatusGoodiesManagment; ?>';
        datatablePagination($k); 
         $('#dataTable').DataTable({
              processing: true,
              serverSide: true,
              pageLength: 10,
              retrieve: true,
              sDom: 'lrtip',
              lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
              sPaginationType: "bootstrap",
              "aaSorting": [[ 0, 'desc' ]],   
              columnDefs: [  
                  {
                      "aTargets": [0],
                      "visible":false
                  } ,
				  {
                    "aTargets": [1],
                    "mRender": function(data, type, full){
                        var response ='' ;
                         
                        if(full['image']!='' || full['image']==undefined ){
                         response='<img src="'+full['image']+'" width="50px" height="50px" /> '+full['title'];
                        }else{
                          response=full['title'];
                        }
                        return response ;
                    }
                },
                       {
                            "aTargets": [8],
                            "mRender" : function(data, type, full){ 
                              var action='' ;
                               var className='' ;
                            if(full['status']==1){
                              className='activeNFor' ;
                            }else{
                              className='inactiveNFor' ;
                            }
                            action+='<span class="'+className+'">'+full['status_']+'</span>';

                            return action ;
                            }
                        } ,
                          {
                            "aTargets": [9],
                            "mRender" : function(data, type, full){

                                // data-bs-toggle="modal" data-bs-target="#edit_body"
								if(edit_goodies_per == 1 && delete_goodies_per==1){
									var edit='<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <li><a class="dropdown-item" href="javascript:void(0);"  onclick="editGoodies('+full["id"]+')" >Edit</a></li></ul> </div> <div style="text-align: right;"> <label class="switch">';
                  // <li><a class="dropdown-item" href="javascript:void(0);" onclick="ConfirmDelete('+full['id']+')" >Delete</a></li> 
								 }
								 
								 else if(edit_goodies_per == 1){
									var edit='<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <li><a class="dropdown-item" href="javascript:void(0);"  onclick="editGoodies('+full["id"]+')" >Edit</a></li> </ul> </div> <div style="text-align: right;"> <label class="switch">';
								 }
								 else if(delete_goodies_per == 1){
									var edit='<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> </ul> </div> <div style="text-align: right;"> <label class="switch">';
								 }else{
									 var edit='<div style="text-align: right;"> <label class="switch">';
								 }
                 // <li><a class="dropdown-item" href="javascript:void(0);" onclick="ConfirmDelete('+full['id']+')" >Delete</a></li> 

                                var action = edit;      
                            if(status_goodies_per == 1){
                            if(full['status']==1){
                                 action +='<input type="checkbox" onclick="changeGoodiesStatus('+full['id']+')" checked>' ;
                             }else{
								
                                action +='<input type="checkbox" onclick="changeGoodiesStatus('+full['id']+')" >' ;
                             }
							
                              action+='<span class="slider"></span> </label> </div> </div> '  ;
                             }
                               return action ;
                            }

                        
                        }
                        
                        ],

                    ajax: {
                              url: '<?php echo URL::asset('goodies_datatable'); ?>',     
                            },
                     columns : [            
                                { data:'id' },  
								{ data:'title'},
								{ data:'goodies_address'},
								{ data:'goodies_fee_type'},
								{ data:'goodies_seats'},
								{ data:'start_date' },  
                                { data:'end_date' },
								{ data:'goodies_date' },
								{ data:'status_' } ,
                                { data:'status' }
								
								
                  ],
                });

              $k('.input-group-addon').click(function() {
                $k(this).prev('input').focus();
            });      
        });

    function ConfirmDelete(id) {  
        if(confirm("Are you sure ?")) {
            delete_nfor(id);
        }
    }
    function delete_nfor(id){
       ajaxCsrf();
        $.ajax({
        type:"POST",
        url:baseUrl+'/deleteGoodies',
        data:{"id":id},
        dataType:'json',
        beforeSend:function()
        {
             ajax_before();
        },
        success:function(res)
        {
             ajax_success() ;

        if(res.status==1){
      
          $('#dataTable').DataTable().ajax.reload();                
          statusMesage('Deleted successfully','success');
        }else{
           statusMesage('Something went wrong','error');
        }
        }

        });

    }

    function submitGoodies(){
         ajaxCsrf();
		var goodies_title=$('#goodies_title').val();
		var goodies_address=$('#goodies_address').val();
		var goodies_fee_type=$('#goodies_fee_type').val();
		var goodies_country=$('#goodies_country').val();
		var goodies_city=$('#goodies_city').val();
		var goodies_seats=$('#goodies_seats').val();  
		var start_date=$('#start_date').val();
		var end_date=$('#end_date').val();
		var goodies_date=$('#goodies_date').val();
		var goodies_status=$('#goodies_status').val();
		var goodies_image=$('#goodies_image').val();
		var goodies_descrption=$('#goodies_descrption').val();
		
        $('.err').html('');    
     
       if(goodies_title==''){
          $('#err_goodies_title').html('Please enter goodies title.');
        }else if(goodies_fee_type==''){
			$('#err_goodies_fee_type').html('Please select fee type');
		}else if(goodies_country==''){
			$('#err_goodies_country').html('Please select Country');
		}else if(goodies_city==''){
			$('#err_goodies_city').html('Please select city');
		}else if(goodies_address==''){
			$('#err_goodies_address').html('Please enter goodies address');  
		}else if(goodies_seats==''){
			$('#err_goodies_seats').html('Please enter goodies seats');  
		}else if(start_date==''){
			$('#err_start_date').html('Please select start date');
		}else if(end_date==''){
			$('#err_end_date').html('Please select end date');
		}else if(goodies_date==''){
			$('#err_goodies_date').html('Please select goodies date');
		}else if(goodies_status==''){
			$('#err_goodies_status').html('Please select coupon status');
		}else if(goodies_image==''){
			$('#err_goodies_image').html('Please select goodies image');
		}else if(goodies_descrption==''){
			$('#err_goodies_descrption').html('Please enter goodies descrption');
		}else {
            var formData=new FormData($('#GoodiesForm')[0]);
              $.ajax({
                type: "POST",
                url: baseUrl + '/saveGoodies',
                data:formData ,  
				dataType:'json',
                cache:false,
                contentType:false,
                processData:false,
                beforeSend: function () {
                       ajax_before();
                },
                success: function(html){
                 ajax_success() ;
                    if(html.status==1){  
                        $('#GoodiesForm')[0].reset();  
                        $('#add_coupon_body').modal('hide'); 
                        $('.modal-backdrop').remove();    
                         removeModelOpen();
                        $('#dataTable').DataTable().ajax.reload();
                          statusMesage('Save successfully','success');
                      }else{
                          statusMesage(html.message,'error');
                      }
                
                        }
                    });   

        }
    }

    function cancelFeature(){

        $('#fTitle').val('');
        $('#featureIcon').val('');
    }

    function editGoodies(updatedId){     
        ajaxCsrf();
        $('#edit_goodies_body').modal('show') ;
        $.ajax({
            type: "POST",
            url: baseUrl +'/editGoodies',
            data:{'updatedId':updatedId} ,           
            cache: 'FALSE',
            beforeSend: function () {
                   ajax_before();
            },
            success: function(html){
             ajax_success() ;
               $('#editBodyGoodiesMb').html(html);  
                }
            });   
    }

    function updateGoodies(){
      ajaxCsrf();
        var edit_goodies_title=$('#edit_goodies_title').val();
		var edit_goodies_fee_type=$('#edit_goodies_fee_type').val();
		var edit_goodies_country=$('#edit_goodies_country').val();
		var edit_goodies_city=$('#edit_goodies_city').val();  
		var edit_goodies_address=$('#edit_goodies_address').val();
		var edit_goodies_seats=$('#edit_goodies_seats').val();
		var edit_goodies_start_date=$('#edit_goodies_start_date').val();
		var edit_goodies_end_date=$('#edit_goodies_end_date').val();
		var edit_goodies_date=$('#edit_goodies_date').val();
		var edit_goodies_status=$('#edit_goodies_status').val();
		var goodies_image=$('#edit_goodies_image').val();
		var edit_goodies_descrption=$('#edit_goodies_descrption').val();
        $('.err').html('');
     
       if(edit_goodies_title==''){
          $('#err_edit_event_name').html('Please enter goodies title.');
        }else if(edit_goodies_fee_type==''){
			$('#err_edit_goodies_fee_type').html('Please select fee type');
		}else if(edit_goodies_country==''){
			$('#err_edit_goodies_country').html('Please select country');
		}else if(edit_goodies_city==''){
			$('#err_edit_goodies_city').html('Please select city');
		}else if(edit_goodies_address==''){
			$('#err_edit_goodies_address').html('Please enter address');
		}else if(edit_goodies_seats==''){
			$('#err_edit_goodies_seats').html('Please enter seats');
		}else if(edit_goodies_start_date==''){
			$('#err_goodies_start_date').html('Please select start date');
		}else if(edit_goodies_end_date==''){
			$('#err_goodies_end_date').html('Please select end date');
		}else if(edit_goodies_date==''){
			$('#err_edit_goodies_date').html('Please select goodies date');
		}else if(edit_goodies_status==''){
			$('#err_edit_goodies_status').html('Please select goodies status');
		}else if(edit_goodies_descrption==''){
			$('#err_edit_goodies_descrption').html('Please enter goodies descrption');
		}else{
        $('.err').html('');
        var formData=new FormData($('#editGoodiesForm')[0]);  
        

        $.ajax({
            type: "POST",
            url: baseUrl +'/updateGoodies',
            data:formData ,
            dataType:'json',
            cache: 'FALSE',
                contentType:false,
                processData:false,
            beforeSend: function () {
                   ajax_before();
            },
            success: function(html){
             ajax_success() ;
             if(html.status==1){

                 modalHide_('edit_goodies_body');    
                // $('.modal-backdrop').hide();    
                $('#dataTable').DataTable().ajax.reload();
                statusMesage('Update successfully','success');
                // $('#edit_fuel').modal('hide');  
                           
             }else{
                 statusMesage('Something went wrong','error');
             } 
              
            
                 }
            });      
      }
     
        
    }

			function changeGoodiesStatus(id){

			ajaxCsrf();
			$.ajax({
			type:"POST",
			url:baseUrl+'/goodiesStatus',  
			data:{"id":id},
			dataType:'json',
			beforeSend:function()
			{
			ajax_before();
			},
			success:function(res)
			{
			ajax_success() ;
			if(res.status==1){
			var table = $('#dataTable').DataTable();
			table.draw( false );
			statusMesage('Changed status successfully','success');
			}else{
			statusMesage('Something went wrong','success');
			}
			}

			});
			}
		function clearNForGoodies(){  
			var table = $('#dataTable').DataTable();
			document.getElementById("featureCouponSearchForm").reset();
			  goodiesList();    
			 //$('#dataTable').DataTable().ajax.reload();        
		  
		}
		   function searchForGoodies(){
				var s_goodies_title=$("#s_goodies_title").val();
				var s_address=$("#s_address").val();
				var goodies_fee_type_Search=$("#goodies_fee_type_Search").val();
				var s_start_date=$("#s_start_date").val();
				var s_end_date=$("#s_end_date").val();
				var goodiesStatus=$("#goodies_status_Search").val();
			   //alert(s_event_name);
        
			 if(s_goodies_title){
				 $('#dataTable').DataTable().column(1).search(s_goodies_title).draw();
			 }
			 if(s_address){
				 $('#dataTable').DataTable().column(2).search(s_address).draw();
			 }
			 if(goodies_fee_type_Search){
				 $('#dataTable').DataTable().column(3).search(goodies_fee_type_Search).draw();
			 }
			 if(s_start_date){
				 $('#dataTable').DataTable().column(5).search(s_start_date).draw();
			 }
			 if(s_end_date){
				 $('#dataTable').DataTable().column(6).search(s_end_date).draw();
			 }
			 if(goodiesStatus){
				 $('#dataTable').DataTable().column(9).search(goodiesStatus).draw();
			 }
		  }



</script><?php /**PATH C:\xampp\htdocs\golden\resources\views/admin/goodies/index.blade.php ENDPATH**/ ?>