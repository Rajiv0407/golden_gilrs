<?php $session_data=session()->get('admin_session');
 $user_per_info=user_permission($session_data['userId']);            
 $EditBookRequest=checkEditRole($user_per_info,12);
 $statusGoodiesBooking=checkStatusRole($user_per_info,12);
  //print_r($statusGoodiesBooking);die; 
 ?>       
          <div class="carManagement__wrapper">
                <div class="breadcrumbWrapper d-flex align-items-center justify-content-between ">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Goodies Booking Request</h3>
                        <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Booking</li>
                        </ol>
                    </nav>
                    <!---== data-bs-toggle="modal" data-bs-target="#add_body" ==-->
                    <!--<div class="rightButton">
                        <a href="javascript:void(0);" onclick="showModal('add_coupon_body')" class="border-btn d-flax" ><i class="bi bi-plus"></i><span>Add Booking</span></a>
                    </div> -->
                </div>
                <form action="javascript:void(0);" method="post" id="featureBookingSearchForm">
                <div class="filterWrapper">
                    <div class="form filterWrapper__l s_I">
                       
                         <div class="form-group">
                            <label for="Manufacture">User Name</label>
                            <input type="text" class="form-control"  id="g_user_name" placeholder="User Name">
                        </div> 
						<div class="form-group">
                            <label for="Manufacture">Email</label>
                            <input type="text" class="form-control"  id="g_user_email" placeholder="User Email">
                        </div>
						<div class="form-group">
                            <label for="Manufacture">Mobile Number</label>
                            <input type="text" class="form-control"  id="g_user_phone" placeholder="Mobile Number">
                        </div>
						<div class="form-group">
                            <label for="Manufacture">Goodies Name</label>
                            <input type="text" class="form-control"  id="g_event_name" placeholder="Goodies Name">
                        </div>
						<div class="form-group">
                            <label for="Manufacture">Booking Request Date</label>
                            <input type="date" class="form-control"  id="g_goodies_request_date" placeholder="Start Date">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>  
                            <select name="fStatus_S" id="g_booking_status_Search" class="form-control">  
							    <option value="">Select</option>
                                <option value="1">Pending</option>
                                <option value="2">Accepted</option>
								<option value="3">Cancel</option>
                            </select>  
                        </div>
                        <div class="d-flex">  
                            <a href="javascript:void(0);" onclick="searchForBooking();"  class="search-btn">  
                                <i class="bi bi-search"></i><span>Search</span>
                            </a>
                            <a href="javascript:void(0);" class="search-btn clear-btn ml-5px" onclick="clearNForBooking()">
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
                                <th scope="col ">Goodies Name</th> 
                                <th scope="col ">Email</th>	
								<th scope="col ">Mobile Number</th>	
                                <th scope="col ">User Name</th>
                                <th scope="col ">Booking Request Date</th>								
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
                <h5 class="modal-title" id="exampleModalLabel">Add Booking</h5>
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
                        <label for="goodies_image">Goodies Image</label>
                         <input type="file" name="goodies_image" id="goodies_image"  class="form-control" placeholder="Goodies Image">
                         <span id="err_goodies_image" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
				 <div class="form-group">
                            <label for="goodies_status">Status</label>
                            <select name="goodies_status" id="goodies_status" class="form-control">
							    <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">In Active</option>
                            </select>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body" id="editBodyGoodiesMb">                
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
         var status_goodies_book_per ='<?php echo $statusGoodiesBooking;  ?>';
		 var edit_goodies_book_per ='<?php echo $EditBookRequest; ?>';
     $(document).ready(function($k){
		 
		
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
                       "mRender": function (data, type, full) {
						return '<td class="text-center"><a href="'+baseUrl+'/administrator/dashboard#goodies_booking_detail/'+full['id']+'" onclick="goodies_booking_detail('+full['id']+')"><i class="bi bi-chevron-right"></i></a></td>';  
					}  
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
                            "aTargets": [6],
                            "mRender" : function(data, type, full){ 
                              var action='' ;
                               var className='' ;
                            if(full['status']==1){
                              className='inactiveNFor' ;
                            }else if(full['status']==2){
								               className='activeNFor' ;
							              }else{
                              className='inactiveNFor' ;
                            }
                            action+='<span class="'+className+'">'+full['status_']+'</span>';

                            return action ;
                            }
                        } ,
                          {
                            "aTargets": [7],
                            "mRender" : function(data, type, full){
                               
								if(edit_goodies_book_per==1){
                  if(full['status']==1){
									var editGoodies='<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <li><a class="dropdown-item" href="javascript:void(0);" onclick="ConfirmDelete('+full['id']+')" >Cancel</a></li><li><a class="dropdown-item" href="javascript:void(0);" onclick="acceptStatus('+full['id']+')" >Accept</a></li> </ul> </div> <div> <label class="switch">'; 
                  }else{
                    var editGoodies='<div class="align-items-center d-flex"><div> <label class="switch">';


                  }
								}else{
									var editGoodies='<div> <label class="switch">';
								} 
                              var action = editGoodies;        
                               return action ;
                            }

                        
                        },
						{
						  "aTargets": [8],
						  "visible":false 
						   } 
                        
                        ],

                    ajax: {
                              url: '{!! URL::asset('goodies_booking_datatable') !!}',     
                            },  
                     columns : [            
                  { data:'id' },  
  								{ data:'title'},
  								{ data:'email' },
                  { data:'phone' },								
                  { data:'name' },
  								{ data:'booking_request_date' },
  								{ data:'status_' } ,
                  { data:'status' },
  								{ data:'booking_date'}
								
                  ],
                });

              $k('.input-group-addon').click(function() {
                $k(this).prev('input').focus();
            });      
        });

    function ConfirmDelete(id) {  
        if(confirm("Are you sure cancel this booking ?")) {
            cancal_nfor(id);
        }
    }
    function acceptStatus(id) {  
        if(confirm("Are you sure confirm this booking ?")) {
            changeBookingStatus(id);
        }
    }
    
    function cancal_nfor(id){
       ajaxCsrf();
        $.ajax({
        type:"POST",
        url:baseUrl+'/cancalBooking',
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
          statusMesage('Goodies Booking cancel successfully','success');
        }else{
           statusMesage('Something went wrong','error');
        }
        }

        });

    }

    function submitGoodies(){
         ajaxCsrf();
		var goodies_title=$('#goodies_title').val();
		var start_date=$('#start_date').val();
		var end_date=$('#end_date').val();
		var goodies_status=$('#goodies_status').val();
		var goodies_image=$('#goodies_image').val();
        $('.err').html('');  
     
       if(goodies_title==''){
          $('#err_goodies_title').html('Please enter goodies title.');
        }else if(start_date==''){
			$('#err_start_date').html('Please select start date');
		}else if(end_date==''){
			$('#err_end_date').html('Please select end date');
		}else if(goodies_status==''){
			$('#err_goodies_status').html('Please select coupon status');
		}else if(goodies_image==''){
			$('#err_goodies_image').html('Please select goodies image');
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
		var edit_goodies_start_date=$('#edit_goodies_start_date').val();
		var edit_goodies_end_date=$('#edit_goodies_end_date').val();
		var edit_goodies_status=$('#edit_goodies_status').val();
		var goodies_image=$('#edit_goodies_image').val();
        $('.err').html('');
     
       if(edit_goodies_title==''){
          $('#err_edit_event_name').html('Please enter goodies title.');
        }else if(edit_goodies_start_date==''){
			$('#err_goodies_start_date').html('Please select start date');
		}else if(edit_goodies_end_date==''){
			$('#err_goodies_end_date').html('Please select end date');
		}else if(edit_goodies_status==''){
			$('#err_edit_goodies_status').html('Please select goodies status');
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

			function changeBookingStatus(id){
			ajaxCsrf();
			$.ajax({
			type:"POST",
			url:baseUrl+'/bookingStatus',  
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
			statusMesage('Goodies Booking accepted successfully','success');
			}else{
			statusMesage('Something went wrong','success');
			}
			}

			});
			}
		function clearNForBooking(){  
			var table = $('#dataTable').DataTable();
			document.getElementById("featureBookingSearchForm").reset();
			  goodiesBookingRequest();      
			 //$('#dataTable').DataTable().ajax.reload();        
		  
		}
		   function searchForBooking(){
				var s_user_name=$("#g_user_name").val();
				var s_user_email=$("#g_user_email").val();
				var g_user_phone=$("#g_user_phone").val();
				var s_event_name=$("#g_event_name").val();
				var bookingStatus=$("#g_booking_status_Search").val();
				var s_goodies_request_date=$("#g_goodies_request_date").val();

			 if(s_user_name){
				 $('#dataTable').DataTable().column(4).search(s_user_name).draw();
			 }
			  if(s_user_email){
				 $('#dataTable').DataTable().column(2).search(s_user_email).draw();
			 }
			 if(g_user_phone){
				 $('#dataTable').DataTable().column(3).search(g_user_phone).draw();
			 }
			  if(s_event_name){
				 $('#dataTable').DataTable().column(1).search(s_event_name).draw();
			 }
			 
			 if(bookingStatus){
				 $('#dataTable').DataTable().column(7).search(bookingStatus).draw();
			 }
			 if(s_goodies_request_date){
				 $('#dataTable').DataTable().column(8).search(s_goodies_request_date).draw();
			 }
		  }



</script>