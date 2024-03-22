<form id="edit_reply_comment_forms_id" action="javascript:void(0);" enctype="multipart/form-data" method="post">  
					<div class="aef_bx">
					  <input type="hidden" name="edit_reply_commentId" class="form-controll" value="<?php echo $replyInfo->id ; ?>">  
						<div class="form-group">
							<label for="">Comment</label>
							<input type="text" name="usrReplyComment" id="usrComment" class="form-control" value="<?php echo $replyInfo->reply_comment ; ?>">							
							<span id="edit_error_comment_text" class="err"></span>
						</div>
						<div class="button-group">
						<button class="btn" type="button" onclick="updateReplyComment('<?php echo $replyInfo->post_id ; ?>')">Update</button>
						</div>
				    </div>
						
					
				</form><?php /**PATH C:\xampp\htdocs\golden\resources\views/edit_reply_comment.blade.php ENDPATH**/ ?>