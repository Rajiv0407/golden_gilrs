<label for="event_city">Event City</label>           
<select name="event_city" id="event_city" class="form-control">
							    <option value="">Select</option>
								<?php foreach($event_city as $event_citys){ ?>
                                <option value="<?php echo $event_citys->id; ?>"><?php echo $event_citys->name;  ?></option>
								<?php } ?>								
                   </select> 
				   <span id="err_event_city" class="err" style="color:red"></span>