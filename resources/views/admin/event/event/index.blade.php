<?php $session_data=session()->get('admin_session');
  $user_per_info=user_permission($session_data['userId']);   
  $AddEventManagement=checkAddRole($user_per_info,4);
  $EditEventManagment=checkEditRole($user_per_info,4);  
  $StatusEventManagment=checkStatusRole($user_per_info,4);
   //echo "<pre>";print_r($session_data);die; 

  ?>  
 
          <div class="carManagement__wrapper">
                <div class="breadcrumbWrapper d-flex align-items-center justify-content-between ">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Event Management</h3>
                        <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Event</li>

                        </ol>
                    </nav>

                    <!---== data-bs-toggle="modal" data-bs-target="#add_body" ==-->
					<?php if($AddEventManagement==1){ ?>
                    <div class="rightButton">
                        <a href="javascript:void(0);" onclick="showModal('add_event_body')" class="border-btn d-flax" ><i class="bi bi-plus"></i><span>Add Event</span></a>
                    </div>
					<?php } ?>
                </div>
                <form action="javascript:void(0);" method="post" id="featureEventSearchForm">
                <div class="filterWrapper">
                    <div class="form filterWrapper__l s_I">
                       
                         <div class="form-group">
                            <label for="Manufacture">Event Name</label>
                            <input type="text" class="form-control" id="event_name_Search" placeholder="Event  Name">
                        </div>
                        <div class="form-group">
                            <label for="Manufacture">Start Date</label>
                            <input type="date" class="form-control" id="event_start_date_Search" placeholder="Start Date">
                        </div>

                       <div class="form-group">
                            <label for="Manufacture">End Date</label>
                            <input type="date" class="form-control" id="event_end_date_Search" placeholder="End Date">
                        </div>						
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="fStatus_S" id="event_status_Search" class="form-control">
							    <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                        <div class="d-flex">
                            <a href="javascript:void(0);" onclick="searchForEvent();"  class="search-btn">
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
                                <th scope="col ">Event Name</th> 
                                <th scope="col ">Event Type</th>
                                <th scope="col ">Address</th>
                                <th scope="col ">Price</th>
                                <th scope="col ">Start Date</th>
                                <th scope="col ">End Date</th>	  							
                                <th scope="col ">Event Date</th>									
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
        


<div class="modal fade right_side" id="add_event_body" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout add_motification_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
			
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" id="EventTypeForm" enctype="multipart/form-data">  
         
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="event_name">Event Name</label>
                         <input type="text" name="event_name" id="event_name"  class="form-control" placeholder="Event Name">
                         <span id="err_event_name" class="err" style="color:red"></span>
                    </div>
                </div>
				 <div class="form modal-form">
                    <div class="form-group">
                        <label for="event_type">Event Type</label>
                        <select name="event_type" id="event_type" class="form-control">
							    <option value="">Select</option>
								<?php foreach($event_type_data as $event_type_datas){ ?>
                                <option value="<?php echo $event_type_datas->id; ?>"><?php echo $event_type_datas->type_name;  ?></option>
								<?php } ?>								
                            </select>
                         <span id="err_event_type" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_country">Event Country</label>
                          <select name="event_country" id="event_country" class="form-control">
							    <option value="">Select</option>
								<?php foreach($country_data as $country_datas){ ?>
                                <option value="<?php echo $country_datas->id; ?>"><?php echo $country_datas->name;  ?></option>
								<?php } ?>								
                            </select>
							<span id="err_event_country" class="err" style="color:red"></span>
                    </div>  
                </div>
				<div class="form modal-form">
                    <div class="form-group" id="eventCity">
                        <label for="event_city">Event City</label>
						<select name="event_city" id="event_city" class="form-control">
                          <option value="">Select</option>
						</select>
						<span id="err_event_city" class="err" style="color:red"></span>
                    </div>  
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_fee_type">Event Fee Type</label>
						 <select name="event_fee_type" id="event_fee_type" class="form-control">
							    <option value="">Select</option>
								<?php foreach($fee_data as $fee_datas){ ?>
                                <option value="<?php echo $fee_datas->id; ?>"><?php echo $fee_datas->fee_type;  ?></option>
								<?php } ?>								
                            </select>
                         <span id="err_event_fee_type" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_address">Event Address</label>
                         <input type="text" name="event_address" id="event_address"  class="form-control" placeholder="Event Address">
                         <span id="err_event_address" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_price">Event Price</label>
                         <input type="number" min="0" inputmode="numeric" pattern="[0-9]*" name="event_price" id="event_price"  class="form-control" placeholder="Event Price" onchange="allowOnlyNumbers()" />
                         <span id="err_price" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_price">Quantity</label>
                         <input type="number" min="0" inputmode="numeric" pattern="[0-9]*" name="event_seats" id="event_seats"  class="form-control" placeholder="Quantity" onchange="allowOnlyNumbers()">
                         <span id="err_event_seats" class="err" style="color:red"></span>
                    </div>
                </div>
				
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_date">Event start date</label>
                         <input type="date" name="event_start_date" id="event_start_date"  class="form-control" placeholder="Event Start Date">
                         <span id="err_event_start_date" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_date">Event End Date</label>
                         <input type="date" name="event_end_date" id="event_end_date"  class="form-control" placeholder="Event End Date">  
                         <span id="err_event_end_date" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_date">Event Date</label>
                         <input type="datetime-local" name="event_date" id="event_date"  class="form-control" placeholder="Event Date">
                         <span id="err_event_date" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_descrption">Event Descrption</label>
                         <input type="text" name="event_descrption" id="event_descrption"  class="form-control" placeholder="Event Descrption"> 
                         <span id="err_event_descrption" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="event_image">Event Image</label>
                         <input type="File" name="event_image[]" id="event_image"  class="form-control" placeholder="Event Image" accept="image/*">
                         <span id="err_event_type_image" class="err" style="color:red"></span>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="javascript:void(0);" id="upload"  onclick="submitEvent()" class="search-btn" class="disabled">Submit</a>
                      <a href="javascript:void(0);" id="upload_" style="display: none ;" class="search-btn" class="disabled">Submit</a>
                    <a href="javascript:void(0);" id="cancelBType" onclick="cancelFeature()" class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
                </div>

            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade right_side" id="edit_event_body" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout edit_body_typ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Event</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body" id="editBodyEventMb">                
                
            </div>
        </div>
    </div>
</div>
<!--  -->
<script>
$('#event_country').change(function(e) {
        var selected = $('#event_country').val();
      if(selected!=''){
        ajaxCsrf();
    $.ajax({
        type: "post",
        url: baseUrl + '/getEventCity',
        data:{id:selected},
        success: function (response) {
          if(response.trim()!=='fail'){

            $('#eventCity').html(response);

          }else{
             $('#eventCity').html('<label for="event_city">Event City</label><select name="event_city" id="event_city" class="form-control"><option value="">Select</option></select>');
          }
        }
    });
      }else{
        $('#eventCity').html('<label for="event_city">Event City</label><select name="event_city" id="event_city" class="form-control"><option value="">Select</option></select>');
      } 
    });


</script>

<script type="text/javascript">

     $(document).ready(function($k){
          var edit_event_per='<?php echo $EditEventManagment; ?>'; 
          var StatusEventManagment='<?php echo $StatusEventManagment ; ?>' ;
          
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
                         response='<img src="'+full['image']+'" width="50px" height="50px" /> '+full['event_name'];
                        }else{
                          response=full['event_name'];  
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
								
								if(edit_event_per == 1){
									
									var edit='<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <li><a class="dropdown-item" href="javascript:void(0);"  onclick="editEvent('+full["id"]+')" >Edit</a></li></ul> </div><div style="text-align: right;"> <label class="switch">';
									
								}else{
									
									var edit='<div style="text-align: right;"> <label class="switch">';
								}


                                // data-bs-toggle="modal" data-bs-target="#edit_body"
                                var action = edit;
								      if(StatusEventManagment==1){

                            if(full['status']==1){
                                 action +='<input type="checkbox" onclick="changeStatus('+full['id']+')" checked>' ;
                             }else{
                                action +='<input type="checkbox" onclick="changeStatus('+full['id']+')" >' ;
                             }
                        }
                              action+='<span class="slider"></span> </label> </div> </div> '  ;

                               return action ;
                            }

                        
                        }
                        
                        ],

                    ajax: {
                              url: '{!! URL::asset('event_datatable') !!}', 
                            },
                     columns : [            
                                { data:'id' },  
								{ data:'event_name' },
								{ data:'event_type' },
								{ data:'address' },
								{ data:'event_price' },
                                { data:'start_date' },
                                { data:'end_date' },								
                                { data:'event_end_date' },
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



    function submitEvent(){

    
      
         ajaxCsrf();
		 
        var event_name=$('#event_name').val();
		var event_type=$('#event_type').val();
		var event_fee_type=$('#event_fee_type').val();
		var event_country=$('#event_country').val();
		var event_city=$('#event_city').val();
		var event_address=$('#event_address').val();
		var event_price=$('#event_price').val();
		var event_seats=$('#event_seats').val();
		var event_start_date=$('#event_start_date').val();
		var event_end_date=$('#event_end_date').val();
		var event_date=$('#event_date').val();
		var event_descrption=$('#event_descrption').val();
		var event_image=$('#event_image').val(); 
        $('.err').html('');
    console.log('event_name'+event_name);
       if(event_name==''){
          $('#err_event_name').html('Please enter event name.');
        }else if(event_type==''){
			$('#err_event_type').html('Please select event type');
		}else if(event_country==''){
			$('#err_event_country').html('Please select country');
		}else if(event_city==''){
			$('#err_event_city').html('Please select city');
		}else if(event_fee_type==''){
			$('#err_event_fee_type').html('Please select event fee type');
		}else if(event_address==''){
			$('#err_event_address').html('Please enter address');
		}else if(event_price==''){
			$('#err_price').html('Please enter price in number');
		}else if(event_seats==''){
			$('#err_event_seats').html('Please enter quantity');
		}else if(event_start_date==''){
			$('#err_event_start_date').html('Please select event start date');
		}else if(event_end_date==''){
			$('#err_event_end_date').html('Please select event end date');
		}else if(event_date==''){
			$('#err_event_date').html('Please select event date');
		}else if(event_descrption==''){
			$('#err_event_descrption').html('Please enter event descrption');
		}else if(event_image==''){
			$('#err_event_type_image').html('Please select event image');
		}else {
			  $('#upload').css('display','none');
              $('#upload_').css('display','block');
            var formData=new FormData($('#EventTypeForm')[0]);
              $.ajax({
                type: "POST",
                url: baseUrl + '/saveEvent',
                data:formData ,
				dataType:'json',
                cache:false,
                contentType:false,
                processData:false,
                beforeSend: function () {
                       ajax_before();
                },
                success: function(html){
                   $('#upload').css('display','block');
                  $('#upload_').css('display','none');
                 ajax_success() ;
                    if(html.status==1){
                        $('#EventTypeForm')[0].reset();  
                        $('#add_event_body').modal('hide'); 
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

    function editEvent(updatedId){   

        ajaxCsrf();
        $('#edit_event_body').modal('show') ;
        $.ajax({
            type: "POST",
            url: baseUrl +'/editEvent',
            data:{'updatedId':updatedId} ,           
            cache: 'FALSE',
            beforeSend: function () {
                   ajax_before();
            },
            success: function(html){
             ajax_success() ;
               $('#editBodyEventMb').html(html) ;
                }
            });   
    }

    function updateEvent(){
      ajaxCsrf();
        var event_name=$('#edit_event_name').val();
		var event_type=$('#edit_event_type').val();
		var event_fee_type=$('#edit_event_fee_type').val();
		var event_address=$('#edit_event_address').val();
		var event_price=$('#edit_event_price').val();
		var event_date=$('#edit_event_date').val();
		var edit_start_date=$('#edit_start_date').val();
		var edit_end_date=$('#edit_end_date').val();
		var event_descrption=$('#edit_event_descrption').val();
      var event_country=$('#edit_event_country').val();
    var event_city=$('#edit_event_city').val();
     var event_seat=$('#edit_event_seats').val();
		//var event_image=$('#edit_event_image').val();
        $('.err').html('');
     
       if(event_name==''){
          $('#err_edit_event_name').html('Please enter event name.');
        }else if(event_type==''){
			$('#err_edit_event_type').html('Please select event type');
		}else if(event_fee_type==''){
			$('#err_edit_event_fee_type').html('Please select event fee type');
		}else if(event_country==''){
      $('#err_edit_event_country').html('Please select country');
    }else if(event_city==''){
      $('#err_edit_event_city').html('Please select city');
    }else if(event_address==''){
			$('#err_edit_event_address').html('Please enter address');
		}else if(event_price==''){
			$('#err_edit_event_price').html('Please enter event price in number');
		}else if(event_seat==''){
      $('#err_edit_event_seat').html('Please enter quantity in number');
    }
    else if(edit_start_date==''){     
			$('#err_edit_event_start_date').html('Please select event start date');
		}else if(edit_end_date==''){
			$('#err_edit_event_end_date').html('Please select event end date');
		}else if(event_date==''){
      $('#err_edit_event_date').html('Please select event date');
    }else if(event_descrption==''){
			$('#err_edit_event_descrption').html('Please enter event descrption');
		}else{
        $('.err').html('');
        var formData=new FormData($('#editEventForm')[0]);  
        

        $.ajax({
            type: "POST",
            url: baseUrl +'/updateEvent',
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

                 modalHide_('edit_event_body'); 
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

function changeStatus(id){

    ajaxCsrf();
    $.ajax({
        type:"POST",
        url:baseUrl+'/eventStatus',
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
    document.getElementById("featureEventSearchForm").reset();
      eventList();  
     //$('#dataTable').DataTable().ajax.reload();        
  
}



   function searchForEvent(){

        var fevent_name=$("#event_name_Search").val();
		var event_start_date_Search=$("#event_start_date_Search").val();
		var event_end_date_Search=$("#event_end_date_Search").val();
        var EventStatus=$("#event_status_Search").val();
       

     if(fevent_name){
         $('#dataTable').DataTable().column(1).search(fevent_name).draw();
    }
	if(event_start_date_Search){
         $('#dataTable').DataTable().column(5).search(event_start_date_Search).draw();
    }
	if(event_end_date_Search){
         $('#dataTable').DataTable().column(6).search(event_end_date_Search).draw();
    }
     if(EventStatus){
              $('#dataTable').DataTable().column(9).search(EventStatus).draw();
    }
   
  }

function allowOnlyNumbers(e){
    // check input using regex
    var regex = RegExp(/[0-9]+/g);
    const test_result = regex.test(e.target.value);

    if(test_result){
      e.target.defaultValue = e.target.value;
    }else{
      e.target.value = e.target.defaultValue;
    }
}

</script>