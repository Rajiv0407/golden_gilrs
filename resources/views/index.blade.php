<?php 
// echo "<pre>" ;
//
//  print_r($post_info);
//   exit ;
 ?>
@extends('includes.website.ajax_template')
@section('content')
<!-- GGGG -->
<div id="golden_home_page">
<div class="sell_box">
        <div class="head">
            <h3></h3>
        </div>
</div>	
<div class="post_message card--skeleton">
            <div class="frm_post_sect">
                <div class="frm_post">
                    <div class="textarea_inpt">
                    </div>
                </div>
            </div>
            <div class="attachment_sect">
                <div class="attachment-file">
                    <ul>
                        <li><label class="ttL_pstnm" for="image"><span>Photo/Video</span></label>
                        <li>
                        <li>
                            <div class="ttL_pstnm first-btn">Feeling/Activity</div>
                        </li>
                    </ul>
                </div>

                <div class="btn_grp">
                    <button class="Publish_btn">Publish</button>
                </div>

            </div>
        </div>
<div class="post_list">
    <?php for ($i=0; $i < 2; $i++) { ?>
        <div class="post_card card--skeleton">
                        <div class="post_hd">
                            <div class="post_user">
                                <div class="user_avtar">
                                    <div class="img_bx"></div>
                                    <div class="user_details">
                                        <div>
                                            <h3>Reema Roy</h3>
                                            <p>6 hour ago</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="nav-item dropdown"></div>
                        </div>
                        <div class="description_post"></div>
                        <div class="post_box"></div>
                        <div class="post_likeshare">
                            <ul class="likeshare_ul coman_post">
                                <li>
                                    <button type="button" class="btn_line">
                                        <span><i class="ri-thumb-up-line"></i></span>
                                        <span>Like</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn_line">
                                        <span><i class="ri-message-2-line"></i></span>
                                        <span>Comment</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="btn_line">
                                        <span><i class="ri-share-fill"></i></span>
                                        <span>Share</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
    <?php } ?>
    
</div>
</div>
<script type="text/javascript">
// 	function home_page() {   
// 	$('#loader_spineer').show(); 
//     ajaxCsrf();
//     $.ajax({
//         type: "post",    
//         url: baseUrl + '/home_page',
//         dataType: 'html',
//         beforeSend: function () {
//                   //$('#loader_spineer').show();
//                 },
//         success: function (html) {
//             $('#loader_spineer').hide();
//             if (html) {
//                 $("#golden_home_page").html(html);
//             } else {
//                 statusMesage('something went wrong', 'error');
//             }
//         }
//     });
// }
 
 $(document).ready(function(){
 		home_page();
 });


</script>


@stop