<?php if (count($order) > 0) { ?>
    <?php foreach ($order as $orders) { ///echo "<pre>";print_r($orders); 
    ?>

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
                <div class="btn_grp">
                <?php if ($orders['order_status'] == 'Cancelled') { ?>
                    <button type="button" class="adnebtn" style="color:gray;">
                        Cancelled
                    </button>
                <?php } else { ?>
                    <button type="button" class="adnebtn" id="cancelledEventBooking_<?php echo $orders['order_id']; ?>" data-bs-toggle="modal" data-bs-target="#cancel_booking" onclick="cancelModal('<?php echo $orders['order_id']; ?>')">
                        Cancel Booking
                    </button>
                    <button type="button" class="adnebtn" id="cancelledEvent_<?php echo $orders['order_id']; ?>" style="display:none;">
                        Cancelled
                    </button>
                <?php } ?>
                </div>
            </div>
        </div>
    <?php }
    if ($data['isShowMore']) {
        $page = $data['page'];
    ?>
        <div class="loadmorebtn">
            <button id="homeLoadmore" class="btn" onclick="ajax_myevent('<?php echo $requestId; ?>','<?php echo $page; ?>')">
                <div class="spinner-border" id="loadmorebtn_loader" style="display:none;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="text"> Load More</div>
            </button>
        </div>
        <!--  -->
    <?php }
} else { ?>

    <div class="no_record_box">
        <div class="media"><img src="{{URL::to('/public/website')}}/images/no_record/c_norecrd.png" alt=""> </div>
        <h3>No record Found</h3>
        <p>MyEvent Not found</p>

    </div>
<?php } ?>