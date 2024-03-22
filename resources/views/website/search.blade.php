      <div class="sell_box" id="Search">
      <div class="head">
        <h3>Pepole</h3>
      </div>
      <div class="Box_details_sect">
        <?php //echo "<pre>";print_r($goodies_listing);die;  ?>
        <?php if(count($user_search)> 0){ ?>
        <div class="post_list">
        <?php foreach($user_search as $user_searchs){ ?>
            <div class="post_card">
              <div class="post_head">
                <h3><?php echo $user_searchs['name']; ?></h3>
              </div>
              <div class="post_l_banner">
                <img class="media" src="<?php echo $user_searchs['image']; ?>" alt="">    
              </div>  

             </div>
                  

        <?php } ?>
        </div>
		<?php }else{ ?>
		<div class="no_record_box">
				<div class="media"><img src="{{URL::to('/public/website')}}/images/no_record/c_norecrd.png" alt=""> </div>
				<h3>No record Found</h3>
				<p>Goodies Not found</p>    

			  </div>
		<?php } ?>
        </div>
      </div>  

