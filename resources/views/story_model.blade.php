<form id="add_stroy_form_id" method="post">
					<div class="aef_bx">
						<!--<div class="form-group">
							<label for="">Description</label>
							<textarea name="story_des" id="story_des" cols="30" rows="2" class="form-control" placeholder="Add Description"></textarea>
							<span id="error_story_des" class="err"></span>
						 </div> -->  
						<div class="form-group">
							<label for="">Upload Image / Video</label>
							<div class="upload_image">
							<input id="file-upload" name="story_upload[]" type="file"  accept="image/*,video/*" multiple>

                  <label for="file-upload">
					<div id="start">
						<i class="fa fa-download" aria-hidden="true"></i>
						<div id="notimage" class="hidden">Please Select an Image / Video</div>
						<span id="file-upload-btn" class="btn btn-primary">Select a File</span>
					</div>
			       </label>

					</div>
					<span id="error_story_file" class="err"></span>
					<div class="upload_file_post" id="view_imgvideo2" style="display:none;">
						<div class="list_bx">
							<div id="output_image2"> </div>    
						</div>
					</div>
						</div>
						<div class="button-group">
						<button class="btn" type="button" onclick="add_story();">
							<div id="updateStory_loadingGife" style="display: none;" class="loader_wrap"><span class="loader"></span></div>Upload</button>
						</div>
					</div>
				</form>
				<!--  -->
	<script>
	
	
	
$('#file-upload').change(handleFileSelect2);
var filesToUpload = [];
function handleFileSelect2(event) {
	$('.err').html('');
    var input = this;
	var j=0; 
    
    if (input.files && input.files.length) {	
        var filesAmount = input.files.length;
		
        for (i = 0; i < filesAmount; i++) {
			 
            const file = input.files[i];
            const fileType = file.type.split('/')[0];
            const fileType_ = file.type.split('/')[1];    
            var reader = new FileReader();
            this.enabled = false;
            reader.onload = (function (e) {
                var span = document.createElement('span');
                 if(fileType_=='quicktime'){
            var d=e.target.result;
            var t=d.split(";");
            var t1='data:video/mp4;'+t[1] ;
            
           }else{
            var t1=e.target.result;
           
           }

                if (fileType === 'image') {
			span.innerHTML = ['<img id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span id='+j+'  class="remove_img_preview"></span>'].join('');
                    document.getElementById('output_image2').insertBefore(span, null);
                    $('#view_imgvideo2').show();
                    // controls
                } else if (fileType === 'video') {
                    span.innerHTML = ['<video  id="test" class="thumb" src="', t1, '" title="', escape(e.name), '"></video><span class="remove_img_preview"></span>'].join('');
                    document.getElementById('output_image2').insertBefore(span, null);
                    $('#view_imgvideo2').show();
                }
				
					  filesToUpload.push({
					  id: j,
					  file: file
				  });
				j++;
            });
            reader.readAsDataURL(input.files[i]);
			
        }

         for (const file of input.files) {
				filesToUpload.push(file);
			}
    }


}

$("#file-upload").change(function () {
    var fileInput = document.getElementById('file-upload');
    var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
    $(".video").attr("src", fileUrl);
});
 $('#output_image2').on('click', '.remove_img_preview', function () {
	      var id = $(this).attr('id');
	      const dt = new DataTransfer();
		  const input = document.getElementById('file-upload');
		  const { files } = input;
		  
		  for (let i = 0; i < files.length; i++) {
			const file = files[i];
			if (id != i){				
			 dt.items.add(file) // here you exclude the file. thus removing it.
			input.files = dt.files
			}else{
				filesToUpload.splice(i, 1);
			}
			if(files.length == 1){
			$("#file-upload").val("");
			}
		  }
    $(this).parent('span').remove();
    $(this).val(""); 
	
}); 

 function add_story(){
        
        var story_des = $('#story_des').val();
        var story_file = $('#file-upload').val();
        var fileUploadSize = $('#file-upload')[0].files[0] ;
        var fileSize = 25 * 1000000 ;
      
        $('.err').html('');
        if(story_des==''){
            $('#error_story_des').html('Please enter descrption') ;
        }else if(fileUploadSize==undefined){
           $('#error_story_file').html('Please select file') ;
        }else if(fileUploadSize.size > fileSize){
            alert('Please upload file less then 25 MB');
            return false ;       
        }else{
      
             $('#updateStory_loadingGife').css('display','block');
          var formData=new FormData($('#add_stroy_form_id')[0]);
          formData.delete('story_upload[]');

          for (const file of filesToUpload) {
                formData.append('story_upload[]', file);
            }
            
          ajaxCsrf();
          //$('#loader_spineer').show();
            $.ajax({
                type:"post",
                url:baseUrl+'/stories_upload',
                data:formData,
                contentType:false,
                processData:false,
                async:true,
                dataType:'json',
                beforeSend: function () {
                    
                },
                success:function(res)
                {
                    //$('#loader_spineer').hide();
                     $('#updateStory_loadingGife').css('display','none');
                if(res == 1){
                    $("#add_stroy_form_id")[0].reset();
                    $('.add_story_modal').modal('hide');
                    //$(".up_story_id").load(location.href + " .up_story_id");
                    /* $(".item").append("<div class='gallary_img' id='story_uploaded_ids_'"+res.id+"'><img src='"+res.file+"' alt=''><div class='cont_stories'>"+res.name+"</div>  <a class='btn' data-fancybox data-src='"+res.file+"' data-caption='"+res.name+"' href='javascript:void();'></a></div>");
                      */
                     $("#story_upload_succ").show();
                     setTimeout(function() {
                           $("#story_upload_succ").hide();
                        }, 2000);
                     location.reload();

                }else{
                   statusMesage('something went wrong','error');
                }
                }

                });
              }
        }

</script>