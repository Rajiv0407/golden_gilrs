<?php $session_data=session()->get('admin_session');
 $user_per_info=user_permission($session_data['userId']);          
 $AddGoodiesManagment=checkAddRole($user_per_info,2);  
 $EditGoodiesManagment=checkEditRole($user_per_info,2);   
 $DeleteGoodiesManagment=checkDeleteRole($user_per_info,2); 
 $StatusGoodiesManagment=checkStatusRole($user_per_info,2); 
 
 ?> 
	<div class="carManagement__wrapper">
                <div class="breadcrumbWrapper d-flex align-items-center justify-content-between"  >
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Admin Users Management</h3>
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#index" onclick="dashboard()" >Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Admin Users Management</li>
                        </ol>
                    </nav>
                      <?php if($AddGoodiesManagment==1){ ?> 
					<div class="rightButton d-flex">
                        <a href="javascript:void(0);" onclick="showModal('add_users')" class="border-btn d-flax" ><i class="bi bi-plus"></i><span>Add Users</span></a>
						 <a style="margin-left:15px;" href="{{URL::to('/')}}/administrator/dashboard#role" onclick="roleManagment();" class="border-btn d-flax" ><i class="bi bi-plus"></i><span>Manage Role</span></a>
                    </div> 
                <?php } ?>
                    					
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
                            <input type="text" class="form-control" id="cus_mobile" placeholder="Mobile Number">  
                        </div>
                       	<div class="form-group">
                            <label for="cust_user_type">User Type</label>
                            <select name="cust_user_type" id="cust_user_type" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($role_type as $role_types){ ?>
								<option value="<?php echo $role_types['title']; ?>"><?php echo $role_types['title']; ?></option>
								<?php } ?> 
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cust_category">Category</label>
                            <select name="cust_category" id="cust_category" class="form-control">
                                <option value="">Select</option>
                                <?php foreach($category_data as $category_datas){ ?>
								<option value="<?php echo $category_datas->name; ?>"><?php echo $category_datas->name; ?></option>
								<?php } ?>
                            </select>
                        </div>					
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="cust_status" id="cust_status" class="form-control">
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
                <div class="table-area sales_history">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col" width="25%">Email</th>
								<th scope="col">Mobile Number</th>
                                <th scope="col">User type</th>
								<th scope="col">Category</th>
								<th scope="col" width="10%">status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
<div class="modal fade right_side" id="add_users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout add_motification_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Users</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
			
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" id="addUserForm" enctype="multipart/form-data">  
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                         <input type="text" name="first_name" id="first_name"  class="form-control" placeholder="First Name">
                         <span id="err_first_name" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                         <input type="text" name="last_name" id="last_name"  class="form-control" placeholder="Last Name">
                         <span id="err_last_name" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="user_role">Role</label>
                        <select name="user_role" id="user_role" class="form-control">
							    <option value="">Select</option>
								<?php foreach($role_type as $role_types){ ?>
								<option value="<?php echo $role_types['id']; ?>"><?php echo $role_types['title']; ?></option>
								<?php } ?>
								
																	
                            </select>
                         <span id="err_user_role" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
							    <option value="">Select Category</option>
								<?php foreach($category_data as $category_datas){ ?>
								<option value="<?php echo $category_datas->name; ?>"><?php echo $category_datas->name; ?></option>
								<?php } ?>      
								</select>
                         <span id="err_category" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="category">Status</label>
                        <select name="user_status" id="user_status" class="form-control">
							    <option value="">Select Status</option>
								<option value="1">Active</option>
								<option value="2">Inactive</option>  
							      
								</select>
                         <span id="err_user_status" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                         <input type="email" name="email1" id="email1"  class="form-control" placeholder="Email">
                         <span id="err_email" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                         <input type="number" name="mobile_number" id="mobile_number"  class="form-control" placeholder="Mobile Number">
                         <span id="err_mobile_number" class="err" style="color:red"></span>
                    </div>
                </div>
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="password">Password</label>
                         <input type="password" name="password" id="password"  class="form-control" placeholder="Password">
                         <span id="err_password" class="err" style="color:red"></span>
                    </div>
                </div>
				
				<div class="form modal-form">
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                         <input type="password" name="confirm_password" id="confirm_password"  class="form-control" placeholder="Confirm Password">
                         <span id="err_confirm_password" class="err" style="color:red"></span>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="javascript:void(0);" id="upload"  onclick="addUsers()" class="search-btn">Submit</a>
                    <a href="javascript:void(0);" id="cancelBType" onclick="cancelFeature()" class="search-btn clear-btn" data-bs-dismiss="modal">Cancel</a>
                </div>

            </form>
            </div>
        </div>
    </div>
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
            <form action="javascript:void(0);" method="post" class="form-control" id="changePassword_"> 
                
                <div class="form modal-form">
                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="hidden" name="changeUserPwd" id="changeUserPwd" value="">
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

<div class="modal fade right_side" id="edit_users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideout add_motification_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
                <div class="cross-btn">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            
            <div class="modal-body" id="editAdminUser">
                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     $(document).ready(function($k){
        datatablePagination($k); 

        var isEdit='<?php echo $EditGoodiesManagment ; ?>' ;
        var isDelete='<?php echo $DeleteGoodiesManagment ; ?>' ;
        var isStatus='<?php echo $StatusGoodiesManagment ; ?>' ;

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
						return '<td class="text-center"><a href="'+baseUrl+'/administrator/dashboard#user_detail/'+full['id']+'" onclick="user_detail('+full['id']+')"><i class="bi bi-chevron-right"></i></a></td>';  
					}
                },
				
				{
                            "aTargets": [6],
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
                    "aTargets": [7],
                     "mRender": function(data, type, full){
                        var response ='<td>';
                        if(isEdit || isDelete){
                            response +='<div class="align-items-center d-flex"> <div class="more_n"> <i class="bi bi-three-dots-vertical" type="button" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"></i> <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">' ;
                        }
                        
                        if(isEdit==1){
                            response +='<li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#change_pass" onclick="changePassword('+full["id"]+')">Change Password</a></li><li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit_users" onclick="editAdminUser('+full["id"]+')">Edit</a></li>' ;
                        }

                        if(isDelete==1){
                            response +='<li><a class="dropdown-item" href="javascript:void(0);" onclick="ConfirmDelete('+full['id']+')">Delete</a></li>' ;
                        }

                       response+='</ul> </div> ' ;

						response+='<td>'  ;

                        if(isStatus==1){
                            response +='<div style="text-align: right;"><label class="switch">' ;
                            if(full['status']=='1'){  
                             response +='<input type="checkbox" onclick="changeUsrStatus('+full['id']+')" checked>' ;
                         
                            }else{
                                 response +='<input type="checkbox" onclick="changeUsrStatus('+full['id']+')" >' ;
                                 
                            }
                             response +='<span class="slider"></span> </label> </div>' ;
                        }
						
                        response+='</td>'  ;

                        return response ;
                    }
                }
                ],

            ajax: {
                      url: '{!! URL::asset('admin_users_datatable') !!}',
                    },
             columns : [
             
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'email'},
                        { data: 'phone'},
						{ data: 'user_type'},
						{ data: 'category'},
                        { data: 'status'},
						{ data: 'status_'}
          ],

        });

      $k('.input-group-addon').click(function() {
        $k(this).prev('input').focus();
    });
});
</script>
<script type="text/javascript">

 function editAdminUser(id){

	 $('#edit_users').modal('show');
                  ajaxCsrf();
        $.ajax({
        type:"POST",
        url:baseUrl+'/edit_admin_user',
        data:{"id":id},        
        beforeSend:function()
        {
             ajax_before();
        },
        success:function(res)
        {

             ajax_success() ;
             $('#editAdminUser').html(res);

        }

        });

 }


 function addUsers(){
         ajaxCsrf();
        var user_role=$('#user_role').val();
		var category=$('#category').val();
		var first_name=$('#first_name').val();
		var last_name=$('#last_name').val();
		var email=$('#email1').val();
		var user_status=$('#user_status').val();
		var mobile_number=$('#mobile_number').val();
		var password=$('#password').val();
		var confirm_password=$('#confirm_password').val();
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        $('.err').html('');
		/* if(!regex.test(email)){  
		 $('#err_email').html('Please enter valid email');	
		}  */ 
        if(first_name==''){
			$('#err_first_name').html('Please enter first name');
		}else if(last_name==''){
			$('#err_last_name').html('Please enter last name');
		}else if(user_role==''){
          $('#err_user_role').html('Please select role.');
        }else if(category==''){
          $('#err_category').html('Please select category.');
        }else if(email==''){
			$('#err_email').html('Please enter email');
		}else if(!regex.test(email)){  
			$('#err_email').html('Please enter valid email');
		}else if(user_status==''){
			$('#err_user_status').html('Please select status');  
		}else if(mobile_number==''){
			$('#err_mobile_number').html('Please enter mobile number');
		}else if(password==''){
			$('#err_password').html('Please enter password');
		}else if(confirm_password==''){
			$('#err_confirm_password').html('Please enter confirm password');
		}else if(password != confirm_password){
			$('#err_confirm_password').html('Please does not match');
		}else {
		
            var formData=new FormData($('#addUserForm')[0]);
              $.ajax({
                type: "POST",
                url: baseUrl + '/saveUser',  
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
                        $('#addUserForm')[0].reset();  
                        $('#add_users').modal('hide'); 
                        $('.modal-backdrop').remove();    
                         removeModelOpen();
                        $('#dataTable').DataTable().ajax.reload();
                          statusMesage('Save successfully','success');
                      }else if(html.status==2){
				 	
							$('#err_email').html('Email id already Registered') ;
						}else{
                          statusMesage(html.message,'error');
                      }
                
                        }
                    });   

        }
    }

function changeUsrStatus(id){
    ajaxCsrf();

    $.ajax({
        type:"POST",
        url:baseUrl+'/changeadminUsrStatus',
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
  adminUserManagement();
     //$('#dataTable').DataTable().ajax.reload();        
  
}



  function searchNType(){
      
        var status=$("#cust_status").val();
        var email=$("#cus_email").val();
        var cName=$("#cust_name").val();
        var cmobile=$("#cus_mobile").val();
		var cuser_type=$("#cust_user_type").val();
		var ccategory=$("#cust_category").val();

	 if(cName){
          $('#dataTable').DataTable().column(1).search(cName).draw();
    }
    if(email){
      $('#dataTable').DataTable().column(2).search(email).draw();
    }
	if(cmobile){
      $('#dataTable').DataTable().column(3).search(cmobile).draw();
    }
	if(cuser_type){
      $('#dataTable').DataTable().column(4).search(cuser_type).draw();
    }
	if(ccategory){
      $('#dataTable').DataTable().column(5).search(ccategory).draw();
    }
    
	if(status){
      $('#dataTable').DataTable().column(6).search(status).draw();
    }

   
}
   
function ConfirmDelete(id) {
    
    if(confirm("Are you sure ?")) {
        delete_customer(id);
    }
}

    function delete_customer(id){
             ajaxCsrf();
        $.ajax({
	    type:"POST",
        url:baseUrl+'/delete_admin_user',
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

             
                 var formData=$('#changePassword_').serialize();
 
                 ajaxCsrf();

        $.ajax({
            type:"POST",
            url:baseUrl+'/changeAdminPassword',
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
           // $('.modal-backdrop').hide();      
            $('#changePassword_')[0].reset();
            $('#change_pass').modal('hide');
           // $('#dataTable').DataTable().ajax.reload();                
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


  function cancelUpdateUser(){    
     $('#edit_users').modal('hide');
 }

 function updateUsers(){

         ajaxCsrf();
        var user_role=$('#edit_user_role').val();
        var category=$('#edit_category').val();
        var first_name=$('#edit_name').val();
        var last_name=$('#edit_last_name').val();
        // var email=$('#email1').val();
        var user_status=$('#edit_status').val();
        var mobile_number=$('#edit_mobile_number').val();
       
        // var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        $('.err').html('');
        /* if(!regex.test(email)){  
         $('#err_email').html('Please enter valid email');  
        }  */ 
        if(first_name==''){
            $('#err_edit_name').html('Please enter first name');
        }else if(last_name==''){
            $('#err_edit_last_name').html('Please enter last name');
        }else if(user_role==''){
          $('#err_edit_user_role').html('Please select role.');
        }else if(category==''){
          $('#err_edit_category').html('Please select category.');
        }else if(user_status==''){
            $('#err_edit_user_status').html('Please select status');  
        }else if(mobile_number==''){
            $('#err_edit_mobile_number').html('Please enter mobile number');
        }else {
        
            var formData=new FormData($('#editUserForm')[0]);
              $.ajax({
                type: "POST",
                url: baseUrl + '/update_admin_user',  
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
                       $('#edit_users').modal('hide');
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

 </script>  
