<label for="edit_event_city">Event City</label>           
<select name="edit_event_city" id="edit_event_city" class="form-control">
							    <option value="">Select</option>
								<?php foreach($event_city as $event_citys){ ?>
                                <option value="<?php echo $event_citys->id; ?>"><?php echo $event_citys->name;  ?></option>
								<?php } ?>								
                   </select>    
				   <span id="err_edit_event_city" class="err" style="color:red"></span>