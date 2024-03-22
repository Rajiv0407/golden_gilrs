<?php $session_data=session()->get('admin_session');?>
<?php $user_per_info=user_permission($session_data['userId']); 
$event_fee_type=checkAddRole($user_per_info,16);
$edit_event_fee_type=checkEditRole($user_per_info,16);
$status_event_fee_type=checkStatusRole($user_per_info,16);
$delete_event_fee_type=checkDeleteRole($user_per_info,16);
//print_r($event_type);die; 
?> 
<div class="carManagement__wrapper">
                <div class="breadcrumbWrapper d-flex align-items-center justify-content-between ">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Master</h3>
                        <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Master</li>
                            <li class="breadcrumb-item active" aria-current="page">Event Fee Type</li>

                        </ol>
                    </nav>

                    <!---== data-bs-toggle="modal" data-bs-target="#add_body" ==-->
					<?php if($event_fee_type==1){ ?>
                    <div class="rightButton">
                        <a href="javascript:void(0);" onclick="showModal('add_body456')" class="border-btn d-flax" ><i class="bi bi-plus"></i><span>Add Event Type Fee</span></a>
                    </div>
					<?php } ?>
                </div>
                <form action="javascript:void(0);" method="post" id="feeSearchForm">
                <div class="filterWrapper">
                    <div class="form master_event">
                        <div class="row align-items-center">
                            <div class="col-lg-3">
                            <div class="form-group">
                            <label for="Manufacture">Event Fee Type</label>
                            <input type="text" class="form-control" id="fee_type_Search" placeholder="Event Fee Type">
                        </div>
                            </div>
                            <div class="col-lg-3">
                            <div class="form-group">
                            <label for="status">Status</label>
                            <select name="fStatus_S" id="fee_status" class="form-control">
							    <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                            </div>
                            <div class="col-lg-3">
                            <div class="d-flex" style="margin-top:27px;">
                            <a href="javascript:void(0);" onclick="searchNFor();"  class="search-btn">
                                <i class="bi bi-search"></i><span>Search</span>
                            </a>
                            <a href="javascript:void(0);" class="search-btn clear-btn ml-5px" onclick="clearNFor()">
                                <i class="bi bi-eraser-fill"></i><span>Clear</span>
                            </a>
                        </div>
                            </div>
                        </div>
                       
                         
                        
                      
                       
                 
                    </div>
                </div>
                       </form>
                <div class="table-area notification_table">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" width="10px">#</th>
                                <th scope="col ">Event Fee Type</th>  
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
        


<div class="modal fade right_side" id="add_body456" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout add_motification_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Event fee type</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" id="feeTypeForm" enctype="multipart/form-data">  
         
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="event_type_fee">Event Fee Type </label>
                         <input type="text" name="event_type_fee" id="event_type_fee"  class="form-control" placeholder="Event Fee Type">
                         <span id="err_fee_type" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                            <label for="fee_status">Status</label>
                            <select name="fee_status" id="fee_status" class="form-control">
							    <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
							<span id="err_fee_status" class="err" style="color:red"></span>
                </div>
				
                <div class="mt-0">
                    <a href="javascript:void(0);" id="upload"  onclick="submitEventFeetype()" class="search-btn">Submit</a>
                    <a href="javascript:void(0);" id="cancelBType" onclick="cancelFeature()" class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
                </div>

            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade right_side" id="edit_body_event_fee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout edit_body_typ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Event Fee Type</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body" id="editEventFee">                
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

     $(document).ready(function($k){
   
         var status_event_fee_type_per= '<?php echo $status_event_fee_type; ?>';
		 var edit_event_fee_type_per= '<?php echo $edit_event_fee_type; ?>';
		 var delete_event_fee_type_per= '<?php echo $delete_event_fee_type; ?>';
		 
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
                            "aTargets": [2],
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
                            "aTargets": [3],
                            "mRender" : function(data, type, full){

                              if(edit_event_fee_type_per== 1 && delete_event_fee_type_per== 1){
                               var EditEventFeeType ='<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <li><a class="dropdown-item" href="javascript:void(0);"  onclick="editEventFee('+full["id"]+')" >Edit</a></li> <li><a class="dropdown-item" href="javascript:void(0);" onclick="ConfirmDelete('+full['id']+')" >Delete</a></li> </ul> </div> <div> <label class="switch">';
							   
							  }else if(edit_event_fee_type_per== 1){
								  var EditEventFeeType='<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <li><a class="dropdown-item" href="javascript:void(0);"  onclick="editEventFee('+full["id"]+')" >Edit</a></li>  </ul> </div> <div style="text-align: right;"> <label class="switch">';
							  }else if(delete_event_fee_type_per== 1){
								  var EditEventFeeType='<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"><li><a class="dropdown-item" href="javascript:void(0);" onclick="ConfirmDelete('+full['id']+')" >Delete</a></li> </ul> </div> <div style="text-align: right;"> <label class="switch">';
							  }else{
								  var EditEventFeeType='<div style="text-align: right;"> <label class="switch">';
							  }
                                var action =  EditEventFeeType;  
								
                             if(status_event_fee_type_per == 1){
                            if(full['status']==1){
                                 action +='<input type="checkbox" onclick="changeStateStatus('+full['id']+')" checked>' ;
                             }else{
                                action +='<input type="checkbox" onclick="changeStateStatus('+full['id']+')" >' ;
                             }

                              action+='<span class="slider"></span> </label> </div> </div> '  ;
							 }
                               return action ;
                            }

                        
                        }
                        
                        ],

                    ajax: {
                              url: '{!! URL::asset('event_fee_type_datatable') !!}', 
                            },
                     columns : [            
                                { data:'id' },
                                { data:'fee_type' },
                                { data:'status_' },
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
        url:baseUrl+'/deleteEventFeeType',
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



    function submitEventFeetype(){

         ajaxCsrf();
       
        var event_type_fee=$('#event_type_fee').val();
		var fee_status=$('#fee_status').val();
        $('.err').html('');
     
       if(event_type_fee==''){
          $('#err_fee_type').html('Please enter event fee type.');
        }else if(fee_status==''){
			$('#err_fee_status').html('Please select status');
		}else {
		
            var formData=new FormData($('#feeTypeForm')[0]);
              $.ajax({
                type: "POST",
                url: baseUrl + '/saveEventFeeType',
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
                        $('#feeTypeForm')[0].reset();  
                        $('#add_body456').modal('hide'); 
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

    function editEventFee(updatedId){    

        ajaxCsrf();
        $('#edit_body_event_fee').modal('show') ;
        $.ajax({
            type: "POST",
            url: baseUrl +'/editEventFeeType',
            data:{'updatedId':updatedId} ,           
            cache: 'FALSE',
            beforeSend: function () {
                   ajax_before();
            },
            success: function(html){
             ajax_success() ;
               $('#editEventFee').html(html) ;
                }
            });   
    }

    function updateEventfee(){

      var edit_event_fee_type= $('#edit_event_fee_type').val() ;
	  var edit_fee_status= $('#edit_fee_status').val() ;
      
      ajaxCsrf();

      $('.err').html('');

      if(edit_event_fee_type==''){
         $('#err_editSFee').html("Please enter event fee type");
      }else if(edit_fee_status==''){
        $('#err_fee_status').html("Please select status");
	  }else{
        $('.err').html('');
        var formData=new FormData($('#editFeeTypeForm')[0]);  
        

        $.ajax({
            type: "POST",
            url: baseUrl +'/updateEventFeeType',
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

                 modalHide_('edit_body_event_fee'); 
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

function changeStateStatus(id){

    ajaxCsrf();

    $.ajax({
        type:"POST",
        url:baseUrl+'/eventFeeTypeStatus',
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


function clearNFor(){

    var table = $('#dataTable').DataTable();
    document.getElementById("feeSearchForm").reset();
      eventfeetypeList();    
     //$('#dataTable').DataTable().ajax.reload();        
  
}



   function searchNFor(){

        var fTitleS=$("#fee_type_Search").val();
        var fStatus_S=$("#fee_status").val();
       

     if(fTitleS){
         $('#dataTable').DataTable().column(1).search(fTitleS).draw();
    }

     if(fStatus_S){
              $('#dataTable').DataTable().column(3).search(fStatus_S).draw();
    }
   
  }



</script>