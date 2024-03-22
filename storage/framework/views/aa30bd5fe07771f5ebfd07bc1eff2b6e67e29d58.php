  <div class="carManagement__wrapper">
                <div class="breadcrumbWrapper d-flex align-items-center justify-content-between ">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Master</h3>
                        <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Master</li>
                            <li class="breadcrumb-item active" aria-current="page">City</li>

                        </ol>
                    </nav>

                    <!---== data-bs-toggle="modal" data-bs-target="#add_body" ==-->
					
                    <div class="rightButton">
                        <a href="javascript:void(0);" onclick="showModal('add_body456')" class="border-btn d-flax" ><i class="bi bi-plus"></i><span>Add City</span></a>
                    </div>  
                </div>
                <form action="javascript:void(0);" method="post" id="featureSearchForm">
                <div class="filterWrapper">
                    <div class="form filterWrapper__l s_I">
                       
                         <div class="form-group">
                            <label for="Manufacture">City</label>
                            <input type="text" class="form-control" id="City_Search" placeholder="City">
                        </div> 
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="fStatus_S" id="fStatus_S" class="form-control">
							    <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
                        </div>
                        <div class="d-flex">
                            <a href="javascript:void(0);" onclick="searchNFor();"  class="search-btn">
                                <i class="bi bi-search"></i><span>Search</span>
                            </a>
                            <a href="javascript:void(0);" class="search-btn clear-btn ml-5px" onclick="clearNFor()">
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
                                <th scope="col ">City</th>  
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
                <h5 class="modal-title" id="exampleModalLabel">Add City</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" id="cityForm" enctype="multipart/form-data">  
         
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="Manufacture">City</label>
                         <input type="text" name="city" id="city"  class="form-control" placeholder="City">
                         <span id="err_city" class="err" style="color:red"></span>
                    </div>
                </div>				
				<div class="form modal-form">
                            <label for="city_status">Status</label>
                            <select name="city_status" id="city_status" class="form-control">
							    <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>
                            </select>
							<span id="err_city_status" class="err" style="color:red"></span>
                </div>
                <div class="mt-4">
                    <a href="javascript:void(0);" id="upload"  onclick="submitNotifyFor()" class="search-btn">Submit</a>
                    <a href="javascript:void(0);" id="cancelBType" onclick="cancelFeature()" class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
                </div>

            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade right_side" id="edit_body" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout edit_body_typ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body" id="editBodyTypeMb">  
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
                            "aTargets": [2],
                            "mRender" : function(data, type, full){ 
                              var action='' ;
                               var className='' ;
                            if(full['flag']==1){
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

                                // data-bs-toggle="modal" data-bs-target="#edit_body"

                                var action = '<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <li><a class="dropdown-item" href="javascript:void(0);"  onclick="editNFor('+full["id"]+')" >Edit</a></li> <li><a class="dropdown-item" href="javascript:void(0);" onclick="ConfirmDelete('+full['id']+')" >Delete</a></li> </ul> </div> <div> <label class="switch">  ' ;

                            if(full['flag']==1){
                                 action +='<input type="checkbox" onclick="changeStateStatus('+full['id']+')" checked>' ;
                             }else{
                                action +='<input type="checkbox" onclick="changeStateStatus('+full['id']+')" >' ;
                             }

                              action+='<span class="slider"></span> </label> </div> </div> '  ;

                               return action ;
                            }

                        
                        }
                        
                        ],

                    ajax: {
                              url: '<?php echo URL::asset('city_datatable'); ?>', 
                            },
                     columns : [            
                                { data:'id' },
                                { data:'name' },
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
        url:baseUrl+'/deleteCity',
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



    function submitNotifyFor(){
         ajaxCsrf();
		 
        var city=$('#city').val();
		var city_status=$('#city_status').val();
        $('.err').html('');
       if(city==''){
          $('#err_city').html('Please enter city.');
        }else if(city_status==''){                  
			$('#err_city_status').html('Please select status.');
		}else {	
            var formData=new FormData($('#cityForm')[0]);
              $.ajax({
                type: "POST",
                url: baseUrl + '/saveCity',  
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
                        $('#cityForm')[0].reset();  
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

    function editNFor(updatedId){   

        ajaxCsrf();
        $('#edit_body').modal('show') ;
        $.ajax({
            type: "POST",
            url: baseUrl +'/editCity',
            data:{'updatedId':updatedId} ,           
            cache: 'FALSE',
            beforeSend: function () {
                   ajax_before();
            },
            success: function(html){
             ajax_success() ;
               $('#editBodyTypeMb').html(html) ;
                }
            });   
    }

    function updateNForCity(){  
      var edit_city= $('#edit_city').val() ;
	  var edit_city_status= $('#edit_city_status').val() ;
      ajaxCsrf();
      $('.err').html('');
      if(edit_city==''){  
         $('#err_edit_city').html("Please enter city");
      }else if(edit_city_status==''){
        $('#err_edit_city_status').html("Please select status");
	  }else{
        $('.err').html('');
        var formData=new FormData($('#editCityForm')[0]);  
        $.ajax({
            type: "POST",
            url: baseUrl +'/updateCity',
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

                 modalHide_('edit_body'); 
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
        url:baseUrl+'/cityStatus',
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
    document.getElementById("featureSearchForm").reset();
      country();  
     //$('#dataTable').DataTable().ajax.reload();        
  
}



   function searchNFor(){

        var fTitleS=$("#City_Search").val();
        var fStatus_S=$("#fStatus_S").val();
       

     if(fTitleS){
         $('#dataTable').DataTable().column(1).search(fTitleS).draw();
    }

     if(fStatus_S){
              $('#dataTable').DataTable().column(3).search(fStatus_S).draw();
    }
   
  }



</script><?php /**PATH C:\xampp\htdocs\golden\resources\views/admin/master/city/index.blade.php ENDPATH**/ ?>