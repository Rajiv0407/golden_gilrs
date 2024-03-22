<div class="ammdl">
                    <h3>Who should see this?</h3>                   
                    <form action="javascript:void(0);" id="profilePrivacy">
                    <div class="amsltr">
                        <ul class="amlst">
                            <li>
                                <label class="amctr">
                                    <span class="imicon"><img
                                            src="<?php echo e(URL::to('/public/website')); ?>/images/icon/public.png" alt=""></span>
                                    <input type="radio" name="profileInfo" value="1" <?php if($userPrivacy==1){ ?>checked="checked" <?php } ?> >
                                    <span class="amchr"></span>
                                    Public
                                </label>
                            </li>
                            <li>
                                <label class="amctr">
                                    <span class="imicon"><img
                                            src="<?php echo e(URL::to('/public/website')); ?>/images/icon/friends.png" alt=""></span>
                                    <input type="radio"  name="profileInfo" value="2" <?php if($userPrivacy==2){ ?>checked="checked" <?php } ?>>
                                    <span class="amchr"></span>
                                    Friends
                                </label>
                            </li>
                            <li>
                                <label class="amctr">
                                    <span class="imicon"><img
                                            src="<?php echo e(URL::to('/public/website')); ?>/images/icon/only_me.png" alt=""></span>
                                    <input type="radio"  name="profileInfo" value="3" <?php if($userPrivacy==3){ ?>checked="checked" <?php } ?>>
                                    <span class="amchr"></span>
                                    Only me
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-bs-label="Close">Cancel</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" onclick="saveUserProfilePrivacy('<?php echo $type; ?>')" aria-bs-label="Close">Done</button>
                    </div>
                    </form>
                </div>

             <?php /**PATH C:\xampp\htdocs\golden\resources\views/website/pages/Profile/ajax_profile_privacy.blade.php ENDPATH**/ ?>