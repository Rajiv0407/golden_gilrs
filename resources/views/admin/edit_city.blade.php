<label for="edit_goodies_city">Goodies City</label>           
<select name="edit_goodies_city" id="edit_goodies_city" class="form-control">
							    <option value="">Select</option>
								<?php foreach($goodies_city as $goodies_citys){ ?>
                                <option value="<?php echo $goodies_citys->id; ?>"><?php echo $goodies_citys->name;  ?></option>
								<?php } ?>								
                   </select>   
				   <span id="err_edit_goodies_city" class="err" style="color:red"></span>