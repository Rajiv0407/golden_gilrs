 <form action="javascript:void(0);" method="post" class="form-control" id="changePassword_"> 
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