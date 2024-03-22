
<label for="S_goodies_city">City</label>           
<select name="s_event_city[]" multiple id="s_event_city" >
    <?php foreach($event_city as $evnetCity){  ?>
        <option value="<?php echo $evnetCity->id ; ?>"  ><?php echo $evnetCity->name ; ?></option>
    <?php } ?>  

</select> 
<script src="<?php echo e(URL('/').'/public/website/group_chat/jquery.min.js'); ?>"></script>
  <script src="<?php echo e(URL('/').'/public/website/group_chat/jquery.multiselect.js'); ?>"></script>
  <script type="text/javascript">
  	  $('#s_event_city').multiselect({
    columns: 1,
    placeholder: 'Select City',    
    search: true,
   
});
  </script>

  <?php /**PATH C:\xampp\htdocs\golden\resources\views/website/eventCities.blade.php ENDPATH**/ ?>