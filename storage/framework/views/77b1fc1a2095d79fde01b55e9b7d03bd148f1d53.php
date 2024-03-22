
<div class="sell_box" id="myevents">
    <div class="head">
        <div class="tabmenu">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button class="nav-link active" id="eventstab" type="button">Events</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="gdiesclk" type="button">Goodies</button>
                </li>
            </ul>
        </div>
    </div>

    <div class="myevntsection">
        <div id="sm_evnt" class="sellbox s_mevnt">
		<?php if(count($order) > 0 ){ ?>
		 <?php foreach($order as $orders){ //echo "<pre>";print_r($orders); ?>
            <div class="card_rptr">
                <div class="media">
                    <img src="<?php echo $orders['image'];  ?>" alt="">
                    <a href="javascript:void(0);" data-fancybox data-src="<?php echo $orders['image'];  ?>" data-caption="<?php echo $orders['event_name'];  ?>"><i class="ri-zoom-in-fill"></i></a>
                </div>
                <div class="crdinfo">
                    <h3><?php echo $orders['event_name'];  ?></h3>
                    <div class="cibx">
                        <div class="form-group">
                            <label for="">Event Address</label>
                            <h4><?php echo $orders['event_address'];  ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="">Order ID</label>
                            <h4>#<?php echo $orders['order_id'];  ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="">Order Date</label>
                            <h4><?php echo $orders['order_date'];  ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="">Order Status</label>
                            <h4><?php echo $orders['order_status'];  ?></h4>  
                        </div>
                        <div class="form-group">
                            <label for="">Ticket Qty</label>
                            <h4><?php echo $orders['no_ticket'];  ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="">Type</label>
                            <h4><?php echo $orders['event_fee_type'];  ?></h4>
                        </div>
                    </div>
                </div>
            </div>
		 <?php } ?>
		 <?php }else{ ?>
		    <div class="no_record_box">
				<div class="media"><img src="<?php echo e(URL::to('/public/website')); ?>/images/no_record/c_norecrd.png" alt=""> </div>
				<h3>No record Found</h3>
				<p>MyEvent Not found</p>  

			  </div>
		 <?php } ?>
            
        </div>

        <div id="sm_gds" class="sellbox s_mgds" style="display: none;">
		<?php if(count($god_order) > 0 ){ ?>
		 <?php foreach($god_order as $god_orders){  ?>
            <div class="card_rptr">
                <div class="media">
                    <img src="<?php echo $god_orders['image'];  ?>" alt="">  
                    <a href="javascript:void(0);" data-fancybox data-src="<?php echo $god_orders['image'];  ?>" data-caption="<?php echo $god_orders['goodies_name'];  ?>"><i class="ri-zoom-in-fill"></i></a>
                </div>
                <div class="crdinfo">
                    <h3><?php echo $god_orders['goodies_name'];  ?></h3>
                    <div class="cibx">
                        <div class="form-group">
                            <label for="">Event Address</label>
                            <h4><?php echo $god_orders['goodies_address'];  ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="">Order ID</label>
                            <h4>#<?php echo $god_orders['order_id'];  ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="">Order Date</label>
                            <h4><?php echo $god_orders['order_date'];  ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="">Order Status</label>
                            <h4><?php echo $god_orders['order_status'];  ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="">Ticket Qty</label>
                            <h4><?php echo $god_orders['no_ticket'];  ?></h4>
                        </div>
                        <div class="form-group">
                            <label for="">Type</label>
                            <h4><?php echo $god_orders['goodies_fee_type'];  ?></h4>
                        </div>
                    </div>
                </div>
            </div>
		 <?php } ?>  
          <?php }else{ ?>
		    <div class="no_record_box">
				<div class="media"><img src="<?php echo e(URL::to('/public/website')); ?>/images/no_record/c_norecrd.png" alt=""> </div>
				<h3>No record Found</h3>
				<p>Goodies Not found</p>    

			  </div>
		 <?php } ?>    
            
        </div>
    </div>
</div>

<script>
$("#eventstab").click(function (){
        $("#sm_evnt").show();
        $("#sm_gds").hide();
        $("#eventstab").addClass('active');
        $("#gdiesclk").removeClass('active');        
    });

    $("#gdiesclk").click(function (){
        $("#sm_evnt").hide();
        $("#sm_gds").show();
        $("#eventstab").removeClass('active');
        $("#gdiesclk").addClass('active');        
    });

</script>
<?php /**PATH C:\xampp\htdocs\golden\resources\views/website/pages/myevent/myevent1.blade.php ENDPATH**/ ?>