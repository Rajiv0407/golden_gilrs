<label for="S_goodies_city">Goodies City</label>           
<select name="goodies_city" id="goodies_city" class="form-control">
							    <option value="">Select</option>
								<?php foreach($goodies_city as $goodies_citys){ ?>
                                <option value="<?php echo $goodies_citys->id; ?>"><?php echo $goodies_citys->name;  ?></option>
								<?php } ?>								
                   </select> 
				   <span id="err_goodies_city" class="err" style="color:red"></span><?php /**PATH C:\xampp\htdocs\golden\resources\views/admin/city.blade.php ENDPATH**/ ?>