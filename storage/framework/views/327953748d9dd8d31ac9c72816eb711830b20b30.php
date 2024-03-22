<form id="edit_reply_comment_forms_id" action="javascript:void(0);" enctype="multipart/form-data" method="post">  
					<div class="aef_bx">
					  <input type="hidden" name="edit_reply_commentId" class="form-controll" value="<?php echo $replyInfo->id ; ?>">  
						<div class="form-group">
							<label for="">Comment</label>
							<input type="text" name="usrReplyComment" id="usrComment" class="form-control" value="<?php echo $replyInfo->comment ; ?>">							
							<span id="edit_error_comment_text" class="err"></span>
						</div>
						<div class="button-group">
						<button class="btn" type="button" onclick="updateGoodiesReplyComment('<?php echo $replyInfo->goodies_id ; ?>')">Update</button>
						</div>
				    </div>
						
					
				</form><?php /**PATH C:\xampp\htdocs\golden\resources\views/editGoodiesReplyComment.blade.php ENDPATH**/ ?>