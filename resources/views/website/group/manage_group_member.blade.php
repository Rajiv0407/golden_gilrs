          

<?php if(!empty($groupParticipant)){ 
      foreach ($groupParticipant as $key => $value) { ?> 
                                
    <div class="member_item">
        
         <div class="avtar_grp">
    <div class="mg_user_img">
        <img src="<?php echo isset($value->image)?$value->image:'' ; ?>" alt="">
    </div>
     <div class="email_mber">
    <div class="cont_mg">
        <h3><?php echo isset($value->name)?$value->name:'' ; ?></h3>
        <p class="mob_show"><?php echo isset($value->email)?$value->email:'' ; ?></p>
    </div>
</div>
    
    </div>
    <div class="web_show"><p><?php echo isset($value->email)?$value->email:'' ; ?></p></div>



 <div class="CopyLink_btn">
        <?php if($groupInfo->admin_id==Auth::id() && $value->id!=Auth::id()){ ?>
    <a class="btn dropdown-toggle" href="#" role="button" id="CopyLink" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ri-more-2-fill"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="CopyLink">
        <!-- <li>
            <a class="dropdown-item">
                <span>
                <svg width="24px" height="24px" viewBox="0 0 24 24" class="GfYBMd">
                        <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H4V4h16v12zM6 12h8v2H6zm0-3h12v2H6zm0-3h12v2H6z"></path>
                        <path fill="none" d="M0 0h24v24H0V0z"></path>
                    </svg>
                </span>
                <span>Message</span>
            </a>
        </li> -->
        <li>
            <a href="javascript:void(0);" class="dropdown-item" onclick="blockMember(<?php echo $value->id ?>,<?php echo $value->group_id ?>,<?php echo $value->isBlock ; ?>)">
                <span>
                    <svg class="GfYBMd PmnIPc" width="20px" height="20px" viewBox="0 0 48 48" fill="#000000">
                        <path d="M0 0h48v48H0z" fill="none"></path>
                        <path d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zM8 24c0-8.84 7.16-16 16-16 3.7 0 7.09 1.27 9.8 3.37L11.37 33.8C9.27 31.09 8 27.7 8 24zm16 16c-3.7 0-7.09-1.27-9.8-3.37L36.63 14.2C38.73 16.91 40 20.3 40 24c0 8.84-7.16 16-16 16z"></path>
                    </svg>
                </span>
                <?php if($value->isBlock==0){ ?>
                <span>Block</span>
            <?php } else{ ?> 
                     <span>Unblock</span>
            <?php } ?>
            </a>
        </li>
    <li>
    <a href="javascript:void(0);" class="dropdown-item" onclick="removeMember(<?php echo $value->id ?>,<?php echo $value->group_id ?>)">
    <span>
    <svg viewBox="0 0 24 24" class="GfYBMd"><path d="M0 0h24v24H0z" fill="none"></path><path d="M7 11v2h10v-2H7zm5-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path></svg></span><span>Remove from space</span>
    </a>
    </li>
    </ul>
<?php } ?>
    </div>

    </div>
   
    </div>
<?php } } else { ?> 
    <div class="member_item">
       
       Not Found
       
    </div>

<?php } ?>                              
    


                         

                 

           