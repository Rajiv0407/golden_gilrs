<form id="edit_comment_forms_id" action="javascript:void(0);" enctype="multipart/form-data" method="post">  
					<div class="aef_bx">
					  <input type="hidden" name="edit_commentId" class="form-controll" value="<?php echo $commentInfo->id ; ?>">  
						<div class="form-group">
							<label for="">Comment</label>
							<input type="text" name="usrComment" class="form-control"  id="usrComment" value="<?php echo $commentInfo->comment ; ?>">							
							<span id="edit_error_comment_text" class="err"></span>
						</div>
						<div class="button-group">
						<button class="btn" type="button" onclick="updateEventComment('<?php echo $commentInfo->event_id ; ?>')">Update</button>
						</div>
				    </div>
						
					
				</form>

				<?php /**PATH C:\xampp\htdocs\golden\resources\views/editEventComment.blade.php ENDPATH**/ ?>