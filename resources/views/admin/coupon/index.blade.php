          <?php //echo "<pre>";print_r($fee_data[0]->id); ?>  
          <div class="carManagement__wrapper">
                <div class="breadcrumbWrapper d-flex align-items-center justify-content-between ">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Coupon Management</h3>
                        <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Coupon</li>

                        </ol>
                    </nav>

                    <!---== data-bs-toggle="modal" data-bs-target="#add_body" ==-->
                    <div class="rightButton">
                        <a href="javascript:void(0);" onclick="showModal('add_coupon_body')" class="border-btn d-flax" ><i class="bi bi-plus"></i><span>Add Coupon</span></a>
                    </div>
                </div>
                <form action="javascript:void(0);" method="post" id="featureCouponSearchForm">
                <div class="filterWrapper">
                    <div class="form filterWrapper__l s_I">
                       
                         <div class="form-group">
                            <label for="Manufacture">Coupon title</label>
                            <input type="text" class="form-control"  id="s_coupon_title" placeholder="Coupon Title">
                        </div> 
						<div class="form-group">  
                            <label for="Manufacture">Event Name</label>
                            <input type="text" class="form-control" id="s_event_name" placeholder="Event Name">
                        </div>
						<div class="form-group">
                            <label for="Manufacture">Coupon Type</label>
                            <select name="coupon_type" id="s_coupon_type" class="form-control">
							    <option value="">Select</option>
                                <option value="Flat">Flat</option>  
                                <option value="Percent">Percent</option>  
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>  
                            <select name="fStatus_S" id="coupon_status_Search" class="form-control">
							    <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">In Active</option>
                            </select>
                        </div>
                        <div class="d-flex">
                            <a href="javascript:void(0);" onclick="searchForCoupon();"  class="search-btn">
                                <i class="bi bi-search"></i><span>Search</span>
                            </a>
                            <a href="javascript:void(0);" class="search-btn clear-btn ml-5px" onclick="clearNForEvent()">
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
                                <th scope="col ">Coupon Title</th> 
                                <th scope="col ">Event Name</th>
								 <th scope="col ">Coupon Type</th>  
                                <th scope="col ">coupon_value</th>
                                <th scope="col ">Start Date</th>	
                                <th scope="col ">End Date</th>									
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
                <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
			
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" id="CouponForm" enctype="multipart/form-data">  
         
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="coupon_title">Coupon Title</label>
                         <input type="text" name="coupon_title" id="coupon_title"  class="form-control" placeholder="Coupon Title">
                         <span id="err_coupon_title" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_name">Event</label>
						 <select name="event_name" id="event_name" class="form-control">
							    <option value="">Select Event</option>
								<?php foreach($event_data as $event_datas){ ?>
                                <option value="<?php echo $event_datas->id; ?>"><?php echo $event_datas->event_name;  ?></option>
								<?php } ?>								
                            </select>
                         <span id="err_event_name" class="err" style="color:red"></span>
                    </div>
                </div>
				
				 <div class="form modal-form">
                    <div class="form-group">
                        <label for="value_type">Value Type</label>
                        <select name="value_type" id="value_type" class="form-control">
							    <option value="">Select</option>
								<?php foreach($coupon_type_data as $coupon_type_datas){ ?>
                                <option value="<?php echo $coupon_type_datas->id; ?>"><?php echo $coupon_type_datas->type;  ?></option>
								<?php } ?>								
                            </select>
                         <span id="err_value_type" class="err" style="color:red"></span>
                    </div>
                </div>
				
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="coupon_value">Value</label>
                         <input type="text" name="coupon_value" id="coupon_value"  class="form-control" placeholder="Coupon Value">
                         <span id="err_coupon_value" class="err" style="color:red"></span>
                    </div>
                </div>
				
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="start_date">Start date</label>
                         <input type="date" name="start_date" id="start_date"  class="form-control" placeholder="Event Start Date">
                         <span id="err_start_date" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                         <input type="date" name="end_date" id="end_date"  class="form-control" placeholder="Event End Date">  
                         <span id="err_end_date" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
				 <div class="form-group">
                            <label for="coupon_status">Status</label>
                            <select name="coupon_status" id="coupon_status" class="form-control">
							    <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">In Active</option>
                            </select>
                        </div>
				</div>
                <div class="mt-4">
                    <a href="javascript:void(0);" id="upload"  onclick="submitCoupon()" class="search-btn">Submit</a>
                    <a href="javascript:void(0);" id="cancelBType" onclick="cancelFeature()" class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
                </div>

            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade right_side" id="edit_coupon_body" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout edit_body_typ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body" id="editBodyCouponMb">                
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

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
                      "visible":false
                  } ,
                       {
                            "aTargets": [7],
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
                            "aTargets": [8],
                            "mRender" : function(data, type, full){

                                // data-bs-toggle="modal" data-bs-target="#edit_body"

                                var action = '<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <li><a class="dropdown-item" href="javascript:void(0);"  onclick="editCoupon('+full["id"]+')" >Edit</a></li></ul> </div> <div> <label class="switch">  ' ;

                            if(full['status']==1){
                                 action +='<input type="checkbox" onclick="changeCouponStatus('+full['id']+')" checked>' ;
                             }else{
                                action +='<input type="checkbox" onclick="changeCouponStatus('+full['id']+')" >' ;
                             }

                              action+='<span class="slider"></span> </label> </div> </div> '  ;

                               return action ;
                            }

                        
                        }
                        
                        ],

                    ajax: {
                              url: '{!! URL::asset('coupon_datatable') !!}', 
                            },
                     columns : [            
                                { data:'id' },  
								{ data:'coupon_title' },
								{ data:'event_name' },
								{ data:'coupon_type' },
								{ data:'coupon_value' },
								{ data:'start_date' },  
                                { data:'end_date' },
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
        url:baseUrl+'/deleteEventType',
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



    function submitCoupon(){
         ajaxCsrf();
		var coupon_title=$('#coupon_title').val();
		var event_name=$('#event_name').val();
		var value_type=$('#value_type').val();
		var coupon_value=$('#coupon_value').val();
		var start_date=$('#start_date').val();
		var end_date=$('#end_date').val();
		var coupon_status=$('#coupon_status').val();
        $('.err').html('');
     
       if(coupon_title==''){
          $('#err_coupon_title').html('Please enter coupon title.');
        }else if(event_name==''){
			$('#err_event_name').html('Please select event name');
		}else if(value_type==''){
			$('#err_value_type').html('Please select coupon type');
		}else if(coupon_value==''){
			$('#err_coupon_value').html('Please enter coupon value');
		}else if(start_date==''){
			$('#err_start_date').html('Please select start date');
		}else if(end_date==''){
			$('#err_end_date').html('Please select end date');
		}else if(coupon_status==''){
			$('#err_end_date').html('Please select coupon status');
		}else {
		
            var formData=new FormData($('#CouponForm')[0]);
              $.ajax({
                type: "POST",
                url: baseUrl + '/saveCoupon',
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
                        $('#CouponForm')[0].reset();  
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

    function editCoupon(updatedId){     
        ajaxCsrf();
        $('#edit_coupon_body').modal('show') ;
        $.ajax({
            type: "POST",
            url: baseUrl +'/editCoupon',
            data:{'updatedId':updatedId} ,           
            cache: 'FALSE',
            beforeSend: function () {
                   ajax_before();
            },
            success: function(html){
             ajax_success() ;
               $('#editBodyCouponMb').html(html) ;  
                }
            });   
    }

    function updateEvent(){
      ajaxCsrf();
        var edit_coupon_title=$('#edit_coupon_title').val();
		var edit_coupon_event_name=$('#edit_coupon_event_name').val();
		var edit_coupon_value_type=$('#edit_coupon_value_type').val();
		var edit_coupon_value=$('#edit_coupon_value').val();
		var edit_coupon_start_date=$('#edit_coupon_start_date').val();
		var edit_coupon_end_date=$('#edit_coupon_end_date').val();
		var edit_coupon_status=$('#edit_coupon_status').val();
        $('.err').html('');
     
       if(edit_coupon_title==''){
          $('#err_edit_event_name').html('Please enter coupon title.');
        }else if(edit_coupon_event_name==''){
			$('#err_edit_event_type').html('Please select event name');
		}else if(edit_coupon_value_type==''){
			$('#err_edit_event_fee_type').html('Please select coupon type');
		}else if(edit_coupon_value==''){
			$('#err_edit_event_address').html('Please enter coupon value');
		}else if(edit_coupon_start_date==''){
			$('#err_edit_event_price').html('Please select start date');
		}else if(edit_coupon_end_date==''){
			$('#err_edit_event_date').html('Please select end date');
		}else if(edit_coupon_status==''){
			$('#err_edit_event_descrption').html('Please select coupon status');
		}else{
        $('.err').html('');
        var formData=new FormData($('#editCouponForm')[0]);  
        

        $.ajax({
            type: "POST",
            url: baseUrl +'/updateCoupon',
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

                 modalHide_('edit_coupon_body'); 
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

function changeCouponStatus(id){

    ajaxCsrf();
    $.ajax({
        type:"POST",
        url:baseUrl+'/couponStatus',
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


function clearNForEvent(){  

    var table = $('#dataTable').DataTable();
    document.getElementById("featureCouponSearchForm").reset();
      couponList();    
     //$('#dataTable').DataTable().ajax.reload();        
  
}



   function searchForCoupon(){

        var s_coupon_title=$("#s_coupon_title").val();
		var s_event_name=$("#s_event_name").val();
		var s_coupon_type=$("#s_coupon_type").val();
        var couponStatus=$("#coupon_status_Search").val();
       //alert(s_event_name);

     if(s_coupon_title){
         $('#dataTable').DataTable().column(1).search(s_coupon_title).draw();
     }
	 if(s_event_name){
         $('#dataTable').DataTable().column(2).search(s_event_name).draw();
     }
	 if(s_coupon_type){
         $('#dataTable').DataTable().column(3).search(s_coupon_type).draw();
     }
	 if(couponStatus){
         $('#dataTable').DataTable().column(8).search(couponStatus).draw();
     }
	  
     
   
  }



</script>