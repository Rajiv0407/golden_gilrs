
<label for="S_goodies_city">City</label>           
<select name="S_goodies_city[]" multiple id="S_goodies_city" >
    <?php foreach($goodies_city as $goodiesCity){  ?>
        <option value="<?php echo $goodiesCity->id ; ?>"  ><?php echo $goodiesCity->name ; ?></option>
    <?php } ?>  

</select> 
<script src="{{ URL('/').'/public/website/group_chat/jquery.min.js' }}"></script>
  <script src="{{ URL('/').'/public/website/group_chat/jquery.multiselect.js' }}"></script>
  <script type="text/javascript">
  	  $('#S_goodies_city').multiselect({
    columns: 1,
    placeholder: 'Select City',
    
    search: true,
   
});
  </script>