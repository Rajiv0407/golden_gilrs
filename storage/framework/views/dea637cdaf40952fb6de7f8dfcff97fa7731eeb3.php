 <form id="edit_post_forms_id" action="javascript:void(0);" enctype="multipart/form-data" method="post">  
					<div class="aef_bx">
					  <input type="hidden" name="edit_post_id" value="<?php echo $post['id']; ?>">  
						<div class="form-group">
							<label for="">Description</label>
							<textarea name="edit_post_des" id="edit_post_des" cols="30" rows="2" class="form-control" placeholder="Add Description"><?php echo $post['post_text']; ?></textarea>
							<span id="edit_error_post_text" class="err"></span>
						</div>
						<div class="form-group">
							<label for="">Upload Image / Video</label>
							<div class="upload_image">
							<input id="edit_image" class="file-upload" type="file" name="image[]" accept="image/*, video/*" multiple=""/>

                  <label for="edit_image">
					<div id="start">
						<i class="fa fa-download" aria-hidden="true"></i>
						<div id="notimage" class="hidden">Please Select an Image / Video</div>
						<span id="file-upload-btn" class="btn btn-primary">Select a File</span>
					</div>
			</label>

					</div>
					<div class="preview_image_list">
					<?php if(!empty($post['image'])){ ?>
			<?php foreach($post['image'] as $images){ ?>
			<?php if($images->file_type== 'image'){ ?>
			<div class="preview_image upload_file_post" id="image_id_<?php echo $images->image_id; ?>">
				<div class="list_bx">
				<span class="">
					<img src="<?php echo $images->image; ?>">
				</span>
				</div>
				<div class="remove_img_preview" onclick="post_image_delete(<?php echo $images->image_id;  ?>)"></div>
			</div>
			<?php }else{ ?>
			  <div class="preview_image" id="image_id_<?php echo $images->image_id; ?>">
				<span class="">
					<video class="media_video" controls>
							<source src="<?php echo $images->image; ?>" type="video/mp4">
						</video>
				</span>  
				<div class="remove_img_preview" onclick="post_image_delete(<?php echo $images->image_id;  ?>)"></div>
			</div>
			<?php }  ?>
			<?php } ?>
			<?php } ?> 
					</div>
		
			<div class="upload_file_post" id="view_imgvideo1" style="display:none;">
						<div class="list_bx">
							<div id="output_image1"> </div>    
						</div>
					</div>  
				    </div>

						<div class="button-group">
						<button class="btn" type="button" onclick="post_update(<?php echo $post['type'] ; ?>)">Upload</button>
						</div>
					</div>
				</form>
				<script>

$('#edit_image').change(handleFileSelect1);
var filesToUploadPostUpdate = [];
function handleFileSelect1(event) {
	 // $('#view_imgvideo1').hide();
        // $('#output_image1').html('');   
    var input = this;
    if (input.files && input.files.length) {
        var filesAmount = input.files.length;
        for (i = 0; i < filesAmount; i++) {
            const file = input.files[i];
            const fileType = file.type.split('/')[0];

            var reader = new FileReader();
            this.enabled = false;
            reader.onload = (function (e) {
                var span = document.createElement('span');
                if (fileType === 'image') {
                    span.innerHTML = ['<img id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span class="remove_img_preview"></span>'].join('');
                    document.getElementById('output_image1').insertBefore(span, null);
                    $('#view_imgvideo1').show();
                } else if (fileType === 'video') {
                    span.innerHTML = ['<video controls id="test" class="thumb" src="', e.target.result, '" title="', escape(e.name), '"/><span class="remove_img_preview"></span>'].join('');
                    document.getElementById('output_image1').insertBefore(span, null);
                    $('#view_imgvideo1').show();
                }
            });
            reader.readAsDataURL(input.files[i]);
        }
    }

    for (const file of input.files) {
				filesToUploadPostUpdate.push(file);
			}
}

$("#edit_image").change(function () {
    var fileInput = document.getElementById('edit_image');
    var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
    $(".video").attr("src", fileUrl);
});
$('#output_image1').on('click', '.remove_img_preview', function () {
    $(this).parent('span').remove();
    $(this).val("");
});
	
	</script><?php /**PATH C:\xampp\htdocs\golden\resources\views/editPost.blade.php ENDPATH**/ ?>