 <?php $session_data=session()->get('admin_session');
 $user_per_info=user_permission($session_data['userId']);   
 $EditCustomerManagment=checkEditRole($user_per_info,3); 
 $StatusCustomerManagment=checkStatusRole($user_per_info,3);
 $DeleteCustomerManagment=checkDeleteRole($user_per_info,3);  
  ?> 
  <!-- -- -->
 <div class="carManagement__wrapper">
                <div class="breadcrumbWrapper">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Customer Management</h3>
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customer Management</li>
                        </ol>
                    </nav>
                </div>
                <form class="" id="n_serarchForm" action="javascript:void(0);" > 
                <div class="filterWrapper">
                    <div class="form filterWrapper__l">
                        <div class="form-group">
                            <label for="Manufacture">Name</label>
                            <input type="text" class="form-control" placeholder="Name" id="cust_name">
                        </div>
                        <div class="form-group">
                            <label for="Model">Email</label>
                            <input type="text" class="form-control" id="cus_email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="Model">Mobile Number</label>
                            <input type="text" class="form-control" id="cus_phone" placeholder="Mobile Number">
                        </div>						
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="" id="cust_status" class="form-control">
                                <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">In Active</option>  
                            </select>
                        </div>
                        <div class="d-flex">
                              
                            <a href="javascript:void(0);" class="search-btn" onclick="searchNType()">
                                <i class="bi bi-search"></i><span>Search</span>
                            </a>
                             <a href="javascript:void(0);" class="search-btn clear-btn ml-5px" onclick="resetSearchForm()">
                                <i class="bi bi-eraser-fill"></i><span>Clear</span>
                            </a>
                        </div>
                         
                    </div>
                </div>
            </form>
                <div class="table-area">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col" width="25%">Email</th>
								<th scope="col" width="25%">Mobile Number</th>  
								<th scope="col">Date of Birth</th>
                                <th scope="col" width="10%">status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>


        <div class="modal fade right_side" id="change_pass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout edit_body_typ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" class="" id="changePassword_"> 
                <input type="hidden" name="changeUserPwd" id="changeUserPwd">
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" placeholder="Enter New Password" id="newPassword" name="newPassword" class="form-control">
                        <span class="err" id="err_newPassword"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Enter Confirm Password" class="form-control">
                         <span class="err" id="err_confirmPwd"></span>
                    </div>
                </div>
                 <div class="mt-4">
                <a href="javascript:void(0);" onclick="updateChangePwd()" class="search-btn">Update</a>
                <a href="javascript:void(0);" class="search-btn clear-btn" data-bs-dismiss="modal" onclick="cancelChangePwd()" >Cancel</a>
            </div>
        </form>
            </div>
           
        </div>
    </div>
</div>

<script type="text/javascript">

     $(document).ready(function($k){
       var status_customer_managment_per = '<?php echo $StatusCustomerManagment; ?>';
	   var edit_customer_mamagment_per ='<?php echo $EditCustomerManagment; ?>';
	   var delete_customer_mamagment_per ='<?php echo $DeleteCustomerManagment; ?>';
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
						return '<td class="text-center"><a href="'+baseUrl+'/administrator/dashboard#customer_detail/'+full['id']+'" onclick="customer_detail('+full['id']+')"><i class="bi bi-chevron-right"></i></a></td>';  
					}
               },

               {
                    "aTargets": [1],
                    "mRender": function(data, type, full){
                        var response ='' ;
                         
                        if(full['image']!='' || full['image']==undefined ){
                         response='<img src="'+full['image']+'" width="50px" height="50px" /> '+full['name'];
                        }else{
                          response=full['name'];   
                        }
                        return response ;
                    }
                },			   
			   
			   {
                            "aTargets": [5],
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
					
                    "aTargets": [5],
                     "mRender": function(data, type, full){
                        var response ='<td><div class="align-items-center d-flex"><div> <label class="switch">' ;
                        if(status_customer_managment_per==1){
                        if(full['status']=='1'){
                             response +='<input type="checkbox" onclick="changeUsrStatus('+full['id']+')" checked>' ;
                         
                        }else{
                             response +='<input type="checkbox" onclick="changeUsrStatus('+full['id']+')" >' ;
                           
                        }
                        response+='<span class="slider"></span> </label> </div> </div> </td>'  ;
						}  
                        return response ;
                    }
					
                },   
			    
				{
                    "aTargets": [6],
                     "mRender": function(data, type, full){
                      var response='' ;
						 if(edit_customer_mamagment_per){
                        var response ='<td><div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">  <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#change_pass" onclick="changePassword('+full["id"]+')">Change Password</a></li> </ul> </div> ' ;
                        response+=' </td>'  ;
                        // == 1 && delete_customer_mamagment_per==1 
                        // <li><a class="dropdown-item" href="javascript:void(0);" onclick="ConfirmDelete('+full['id']+')">Delete</a></li>
						} else{
              response+='';
            }

						// else if(edit_customer_mamagment_per == 1){
						// 	var response='<td> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#change_pass" onclick="changePassword('+full["id"]+')">Change Password</a></li> </ul> </div> ' ;
      //                   response+='   </td>'
						// }
						//else if(delete_customer_mamagment_per==1){
							// var response ='<td> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <li><a class="dropdown-item" href="javascript:void(0);" onclick="ConfirmDelete('+full['id']+')">Delete</a></li></ul> </div> ' ;
       //                  response+=' </div> </td>'  ;
						//}
           
						 response+='<td><div> <label class="switch">' ;
             
                        if(status_customer_managment_per==1){
                        if(full['status']=='1'){
                             response +='<input type="checkbox" onclick="changeUsrStatus('+full['id']+')" checked>' ;
                         
                        }else{
                             response +='<input type="checkbox" onclick="changeUsrStatus('+full['id']+')" >' ;
                           
                        }
                        response+='<span class="slider"></span> </label> </div></td>'  ;
						}
						
						
                        return response ;
						
						
                    }
                }
                ],

            ajax: {
                      url: '{!! URL::asset('customer_datatable') !!}',
                    },
             columns : [
             
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'email'},
						{ data: 'phone'},
                        { data: 'dob'},
						{ data:'status_' } ,
                        { data: 'status'},
						
          ],

        });

      $k('.input-group-addon').click(function() {
        $k(this).prev('input').focus();
    });
});
function changeUsrStatus(id){
    ajaxCsrf();

    $.ajax({
        type:"POST",
        url:baseUrl+'/userManagement/changeStatus',
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
     statusMesage('changed status successfully','success');
    }else{
     statusMesage('something went wrong','success');
    }
    }

    });
}

function resetSearchForm(){

    var table = $('#dataTable').DataTable();
    document.getElementById("n_serarchForm").reset();
  customerManagement();
     //$('#dataTable').DataTable().ajax.reload();        
  
}



  function searchNType(){
      
        var status=$("#cust_status").val();
        var email=$("#cus_email").val();
        var cName=$("#cust_name").val();
		var cPhone=$("#cus_phone").val();
   
   
     if(status){
    
          $('#dataTable').DataTable().column(6).search(status).draw();
    }
   
     if(email){
   
          $('#dataTable').DataTable().column(2).search(email).draw();
    }
	if(cPhone){
   
          $('#dataTable').DataTable().column(3).search(cPhone).draw();
    }

    if(cName){
   
          $('#dataTable').DataTable().column(1).search(cName).draw();
    }

   
}
   
function ConfirmDelete(id) {
    
    if(confirm("Are you sure ?")) {
        delete_customer(id);
    }
}

    function delete_customer(id){
             ajaxCsrf();
        $.ajax({type:"POST",
        url:baseUrl+'/delete_customer',
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
        //carManagement();
          $('#dataTable').DataTable().ajax.reload();                
          statusMesage('Deleted successfully','success');
        }else{
           statusMesage('Something went wrong','error');
        }
        }

        });

    }

 function updateChangePwd(){
    
        var newPwd = $('#newPassword').val();
        var confirmPwd = $('#confirmPassword').val();

        $('.err').html('');
        if(newPwd==''){
            $('#err_newPassword').html('Please enter new password') ;
        }else if(confirmPwd==''){
            $('#err_confirmPwd').html('Please enter confirm password') ;
        }else if(newPwd!=confirmPwd){
            $('#err_confirmPwd').html('both password must be matched') ;
        }else{

               var formData = $('#changePassword_').serialize() ;

                 ajaxCsrf();

        $.ajax({
            type:"POST",
            url:baseUrl+'/changePassword',
            data:formData,
            dataType:'json',
            beforeSend:function()
            {
                 ajax_before();
            },
            success:function(res)
            {

                 ajax_success() ;

            if(res.status==1){
           $('.modal-backdrop').hide();      
           $('#changePassword_')[0].reset();
            $('#change_pass').modal('hide');
           $('#dataTable').DataTable().ajax.reload();                
              statusMesage('password updated successfully','success');
            }else{
               statusMesage('something went wrong','error');
            }
            }

            });
    }
 }

function changePassword(userId){
    $('#changeUserPwd').val(userId);
}
 function cancelChangePwd(){

    $('#changePassword_')[0].reset();


 }
 
</script>