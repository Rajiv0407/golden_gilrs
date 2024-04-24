 <?php $session_data=session()->get('admin_session');
 $user_per_info=user_permission($session_data['userId']);   

 $DeleteCustomerManagment=checkDeleteRole($user_per_info,3);  
  ?> 
 

<?php if((count($image)) > 0 ) {  ?>
<div class="img_bx_list">
<?php foreach($image as $images){ ?>

<div class="img_bx_wrap" id="delete_img_<?php echo $images->id ?>">
	<?php if($images->file_type=='video'){ ?> 
		<a href="<?php echo $images->image ; ?>" class="fancybox" data-fancybox="">
          <video width="100%" height="180" controls="" poster="<?php echo $images->image.'#t=0.1' ; ?>">
            <source src="<?php echo $images->image.'#t=0.1' ; ?>" type="video/mp4">
          </video>
          </a>
          <?php if($DeleteCustomerManagment==1){ ?> 
          <div class="photo_del" onclick="deleteVideo(<?php echo $images->id ?>)">
                <i class="ri-delete-bin-line"></i>
              </div>
              <?php } ?>
          

	<?php }else{ ?> 
		  <a href="<?php echo $images->image ; ?>"   data-fancybox="gallery" data-caption="">
                <img src="<?php echo $images->image ; ?>" alt="">
                </a>
                <?php if($DeleteCustomerManagment==1){ ?> 
                <div class="photo_del" onclick="deletePhoto(<?php echo $images->id ?>)">
                <i class="ri-delete-bin-line"></i>
              </div>
            <?php } ?>
              
		
	<?php } ?>

</div>



<?php } ?>
</div>
<?php }else{ ?>
  not found
<?php }  ?>

 
 <script type="text/javascript">
   
  //  $(document).ready(function() {
  //   $(".fancybox").fancybox({
    
  //     type: 'iframe', 
  //     iframe: {
  //       css: {
  //         width : '800px', 
  //         height : '450px' 
  //       }
  //     }
  //   });
  // });

      function deletePhoto(id){
      //1 for video
    var check = confirm("Are you sure want to delete this image ?");
    if (check) {
        $('#loadmorebtn_loader').show();
        ajaxCsrf();
        $.ajax({
            type: "post",    
            url: baseUrl + '/deleteAdmin_myphoto',
            data:{"id":id,"deleteType":1},
            dataType: 'html',
            beforeSend: function () {
                      //$('#loader_spineer').show();
                    },
            success: function (html) {  
               $('#loadmorebtn_loader').hide();
               $('#delete_img_'+id).remove();
               $('#Advertisement-tab').click();
            }
        });    
    }
}

function deleteVideo(id){
      
    var check = confirm("Are you sure want to delete this video ?");
    if (check) {
        $('#loadmorebtn_loader').show();
        ajaxCsrf();
        $.ajax({
            type: "post",    
            url: baseUrl + '/deleteAdminVideo',
            data:{"id":id},
            dataType: 'html',
            beforeSend: function () {
               ajax_before();
                      //$('#loader_spineer').show();
                    },
            success: function (html) {  
               ajax_success() ;
              
               $('#delete_img_'+id).remove();
               $('#Advertisement-tab').click();
            }
        });    
    }
}
 </script>