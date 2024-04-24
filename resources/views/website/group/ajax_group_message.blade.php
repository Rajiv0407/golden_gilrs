 <?php if(!empty($messages)){ ?>
 @foreach($messages as $message)
                <?php //echo "<pre>";print_r($message->image);die; 
                ?>

                <?php if($message->message_type==1){ ?>

                <div class="{{ ($message->from == Auth::id()) ? 'chat-mss rply-mss' : 'chat-mss' }}">
                    <ul>
                        <li>
                            <?php if(($message->from != Auth::id())){ ?>
                                
                                <span><img src="{{$message->groupImg}}" alt=""></span>
                                <!-- http://192.168.1.31:8080/golden/storage/app/public/user_image/user_holder.svg -->
                                

                            <?php } ?>
                        

                            <div class="replay-mss">
                                <div class="cont_bx">
                                    <?php if (!empty($message->message)) { ?>
                                        <p>{{ $message->message }}</p>
                                    <?php } 
                                       if(!empty($message->image) && count($message->image)==1){
                                    $class="singaleImg" ;
                                }else if(!empty($message->image) && count($message->image)==2){
                                    $class="twoImg" ;
                                }else if(!empty($message->image) && count($message->image)==3){
                                     $class="threeImg" ;
                                }else{
                                    $class="moreImg" ;
                                }

                                    ?>
                                    <?php if (isset($message->image) && !empty($message->image)) {  ?>
                                        <div class="list_media <?php echo $class ; ?>">
                                        <?php foreach ($message->image as $image_data) {   ?>
                                            <?php if ($image_data->file_type == "image") { ?>
                                                <div class="media_img">
                                                 <a href="<?php echo $image_data->image ;  ?>" data-fancybox="gallery" data-caption="">   
                                                <img src="<?php echo $image_data->image ;  ?>" class="img_thmb" alt="">
                                            </a>
                                                </div>
                                            <?php } ?>

                                            <?php if ($image_data->file_type == "application") { ?>
                                                <div class="media_pdf">
                                                <embed src="<?php echo $image_data->image;  ?>" type="application/pdf" height="300px" width="100%">
                                                </div>
                                            <?php } ?>

                                            <?php if ($image_data->file_type == "video") { ?>
                                                <div class="media_video">
                                               <a data-fancybox="group-1" href="<?php echo $image_data->image;  ?>">     
                                                <video width="320" height="240" controls>
                                                    <source src="<?php echo $image_data->image;  ?>">
                                                </video>
                                            </a>
                                                </div>
                                            <?php } ?>
                                        <?php }  ?>
                                        </div>
                                    <?php }  ?>
                                    <div class="date">
                                        <?php if($message->from == Auth::id()){ ?> 
                                    <svg viewBox="0 0 18 18" height="18" width="18" preserveAspectRatio="xMidYMid meet" class="" version="1.1" x="0px" y="0px" enable-background="new 0 0 18 18">
                                            <title>status-dblcheck</title>
                                            <path fill="currentColor" d="M17.394,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-0.427-0.388c-0.171-0.167-0.431-0.15-0.578,0.038L7.792,13.13 c-0.147,0.188-0.128,0.478,0.043,0.645l1.575,1.51c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C17.616,5.456,17.582,5.182,17.394,5.035z M12.502,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-2.614-2.556c-0.171-0.167-0.447-0.164-0.614,0.007l-0.505,0.516 c-0.167,0.171-0.164,0.447,0.007,0.614l3.887,3.8c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C12.724,5.456,12.69,5.182,12.502,5.035z"></path>
                                        </svg> 
                                        <?php } ?>
                                        {{$message->createdOn}}
                                    </div>

                                    <!-- {{ date('d M y, h:i a', strtotime($message->created_at)) }} -->
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php } else{ ?> 
                <div class="message-notif">
                    
                    <p> <?php echo $message->message ; ?></p>
                </div>
                <?php } ?>
                @endforeach
                <?php } ?>
<input type="hidden" name="page_" id="page_" value="<?php echo $data['page'] ; ?>">
<input type="hidden" name="isShowmore" id="isShowmore" value="<?php echo $data['isShowMore'] ; ?>">