<form action="javascript:void(0);" method="post" id="addGroupMemberForm" enctype="multipart/form-data" >
          <div class="creatgrou_modal">

            <?php //echo "<pre>"; print_r($groupInfo); ?>
      <h3>Add people to '<?php echo isset($groupInfo->group_name)?$groupInfo->group_name:''; ?>' </h3>
      <input type="hidden" name="groupId" value="<?php echo isset($groupInfo->id)?$groupInfo->id:0 ; ?>">
      <div class="frm_title">      
      <!--  -->
              </div>    
            <select name="addGroupUser[]" multiple id="addGroupUser">
                <?php foreach($user_list as $user_lists){  ?>
                    <option value="<?php echo $user_lists->id ; ?>" data-content="<img class='email' src='https://thdoan.github.io/bootstrap-select/images/icon-chrome.png'/>" ><?php echo $user_lists->name ; ?></option>
                <?php } ?>  

            </select>  
             <span id="error_group_user" class="err"></span>
             <div class="button-group"> 
                 <button class="btn " id="addGroupMember_btn" name="addGroupMember_btn" onclick="updateGroupMember();">Add</button>
              <button class="btn " id="cancel_group" onclick="cancelAddMember();" name="cancel">Cancel</button>                
             
               
            </div>

      </div>
      </form>

<script type="text/javascript">
  $(document).ready(function(){
    $('#addGroupUser').multiselect({
    columns: 1,
    placeholder: 'Select User',
    search: true,
   
});
  });


</script>