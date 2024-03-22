<?php
$data = session()->get('user_session');
?>
<?php $noti_count = notification_count($data['userId']); ?>
<?php $noti_data = notification_list($data['userId']);  ?>
<?php //echo "<pre>";print_r($noti_data);exit;   
?>

<?php  $mobileDeduct=isMobileDev();          
         $usrId = Session::get('user_session');
         $usrId_ = isset($usrId['userId'])?$usrId['userId']:0 ;



?>

<div class="container-custom header">
  <nav class="navbar navbar-expand-lg ">

    <div class="logoMenu">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="ri-menu-line"></i>
      </button>
      <a class="navbar-brand" href="<?php echo URL('/home/') ; ?>"><img src="{{URL::to('/public/website')}}/images/logo.svg?v=<?php echo time(); ?>" alt="">
        <?php 

        if(session()->has('defaultCountry')){ 
                $defaultCountryData = session()->get('defaultCountry');
                $defaultCountry = $defaultCountryData['name'] ;
         }else{
              $defaultCountry = 'London' ;
         } 
         
         ?>
      <p class="sel_country" id="ggCountrId"><?php echo $defaultCountry ; ?></p>
      </a>
    </div>

    <div class="navmenu collapse navbar-collapse nav_menu" id="navbarSupportedContent">

      <div class="mobile-header">
        <div class="m_logo"><img src="{{URL::to('/public/website')}}/images/logo.svg" alt=""></div>
        <div class="m_close_btn">
          <button type="button" type="button" data-bs-toggle="collapse" id="responsiveButton"  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler menu-link collapsed">
            <span class="menu-icon">
              <span class="menu-line menu-line-1"></span>
              <span class="menu-line menu-line-2"></span>
              <span class="menu-line menu-line-3"></span>
            </span>
          </button>
        </div>
      </div>


      <?php //print_r(request()->segment(1));  
      ?>
      <input type="hidden" name="user_ids" id="user_ids" value="<?php echo !empty(request()->segment(2)) ? request()->segment(2) : $data['userId']; ?>">

      <div>

        <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="golden_header_bar">
          <li class="nav-item">
            <a class="nav-link <?php if (request()->segment(1) == 'home') {
                                  echo 'active';
                                } ?>" aria-current="page" href="{{URL::to('/')}}/home">Home</a>
          </li>
          <li class="nav-item">
            <a id="goodies_style_id" class="nav-link <?php if (request()->segment(1) == 'goodies') {
                                                        echo 'active';
                                                      } ?>" href="{{URL::to('/')}}/goodies">Goodies</a>

          </li>
          <li class="nav-item">
            <a id="life_style_id" class="nav-link <?php if (request()->segment(1) == 'life_style') {
                                                    echo 'active';
                                                  } ?>" href="{{URL::to('/')}}/life_style">Lifestyle</a>

          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (request()->segment(1) == 'group') {
                                  echo 'active';
                                } ?>" href="{{URL::to('/')}}/group">Groups</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if (request()->segment(1) == 'message') {
                                  echo 'active';
                                } ?>" href="{{URL::to('/')}}/message">Message</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mobile_view"  href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#aboutdetails" >About Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mobile_view"  href="{{URL::to('/')}}/network/<?php echo $data['userId'];  ?>">Who to Follow</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mobile_view"  href="{{URL::to('/')}}/profile/<?php echo $data['userId'];  ?>">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mobile_view"  href="{{URL::to('/')}}/marches_info/<?php echo $data['userId'];  ?>" >Matches</a>
          </li>
         <!-- onclick="marches_tab('<?php //echo $usrId_ ; ?>')" -->
          <li class="nav-item">
            <a class="nav-link mobile_view"  href="{{URL::to('/')}}/network/<?php echo $data['userId'];  ?>">Network</a>
          </li>
          <!-- onclick="my_event_tab('<?php //echo $usrId_ ; ?>')" -->
          <li class="nav-item">
            <a class="nav-link mobile_view"  href="{{URL::to('/')}}/myevent_info/<?php echo $data['userId'];  ?>" > My Event </a>
          </li>

          <li class="nav-item">
            <a class="nav-link mobile_view"  href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#Serach_post">Search</a>
          </li>
        </ul>
      </div>

    </div>

    <div class="profilemenu">
    <div class="frm_grp frm-country  parent">
 <?php 
            $defaultCountry=session()->get('defaultCountry');
            $country=getCountry(); 

          ?>
<select class="f-control f-dropdown select" id="gg_country" name="gg_country" onchange="ggCountry()" placeholder="Select Country">
   <?php 

              if(!empty($country)){
                foreach ($country as $key => $value) {  ?>
                <option value="<?php echo $value->id ; ?>"  data-country="<?php echo $value->name ; ?>" data-thumbnail="{{URL::to('/public/website')}}/logo/<?php echo $value->logo ; ?>"  ><?php echo $value->name ; ?></option>
              <?php  }
              } ?>
</select>
<div class="lang-select">
  <button class="btn-select" value=""></button>
  <div class="b">
    <ul id="a"></ul>
  </div>
</div>
</div>

      <?php if(!$mobileDeduct){ ?>
      <form id="search_data" action="javascript:void(0);" method="post" class="web_view">
        <div class="search_li">
          <a href="javascript:void(0)" class="search_btn"> <i class="ri-search-line"></i></a>
          <div class="form-group form-control-wrap search_list ">
            <div class="form-icon form-icon-right">
              <i class="ri-search-line"></i>
            </div>
            <input type="text" name="search_user" id="search_user" class="form-control" placeholder="Search">
            <span id="err_search" class="err" style="color:red"></span>
            <div class="search_tags">
              <div class="">
                <div class="invit_inner" id="user_search_inner">
                </div>
              </div>
            </div>
          </div>
        </div>
      </form> 
    <?php } ?>
      <div class="bell_drpdwn">
        <a class="btn dropdown-toggle <?php if ($noti_count > 0) {
                                        echo 'isactive';
                                      } ?>" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
          <div class="bell">
            <div class="bell-border"></div>

            <i class="fa fa-bell btn-bell" aria-hidden="true"></i>
            <?php if ($noti_count > 0) { ?>
              <span class="nt_icon_n">
                <?php echo !empty($noti_count) ? $noti_count : ""; ?>
              </span>
            <?php } else { ?>
              <span class=""></span>
            <?php } ?>
          </div>
        </a>
        <div class="dropdown-menu notify_bx" aria-labelledby="dropdownMenuClickableInside">
          <div class="notify_heading">
            <h3>Notification</h3>
          </div>
          <?php if (count($noti_data['notification']) > 0) { ?>
            <div class="notify_list_wrap">
              <?php if (count($noti_data['notification']) > 0) { ?>
                <div class="notify_head">
                  <h4>New</h4>
                  <a href="{{URL::to('/')}}/notification/<?php echo $data['userId'];  ?>">See all</a>
                </div>
                <div class="notify_list">
                  <?php foreach ($noti_data['notification'] as $notifications) {  
                    
                      $activeClass = ($notifications['is_read']==1)?'active':'' ;
                      if($notifications['type']==7){
                        $url=URL::to('/').'/network/'.$data['userId'] ;
                      }else{
                        $url="javascript:void(0);" ;
                      }
                   
                    ?>
                    <a id="remove_notification_<?php echo $notifications['id'];  ?>" href="<?php echo $url ; ?>" class="seen <?php echo $activeClass ; ?>" onclick="read_notification(<?php echo $notifications['id'] ?>,<?php echo $data['userId']; ?>)">
                      <div class="notify_img">
                        <img src="<?php echo $notifications['image']; ?>" alt="">
                        <div class="bell_i">
                          <i class="fa fa-bell" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="notify_details">
                        <h5><?php echo $notifications['message']; ?></h5>
                        <p><?php echo $notifications['time']; ?></p>
                      </div>
                    </a>
                  <?php } ?>
                </div>
              <?php } ?>
            </div><!--  -->
            <?php /* ?>
              <div class="notify_list_wrap">
              <?php if(count($noti_data['friend_request']) > 0) { ?>
                <div class="notify_head">
                  <h4>Friend Requests</h4>
                  <a href="{{URL::to('/')}}/network/<?php echo $data['userId'];  ?>">See all</a>
                </div>
                <?php foreach ($noti_data['friend_request'] as $friend_requests) {   ?>
                  <div class="notify_list frnd_rqst" id="friend_request_id_<?php echo $friend_requests['id']; ?>">
                    <a href="javascript:void(0);">
                      <div class="notify_img">
                        <img src="<?php echo $friend_requests['image']; ?>" alt="">
                        <div class="bell_i">
                          <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                      </div>
                      <div class="notify_details">
                        <h5><?php echo $friend_requests['message']; ?></h5>
                        <p><?php echo $friend_requests['time']; ?></p>
                        <div class="friend_rqst_btn">
                          <button class="btn confirm_btn" id="<?php echo $friend_requests['id'] ?>" onclick="accept_request(<?php echo $friend_requests['id'] ?>)">Confirm</button>
                          <button class="btn decline_btn">Decline</button>
                        </div>
                      </div>
                    </a>

                  </div>
                <?php } ?>
              <?php } ?>
            </div>
            <?php */ ?>
          <?php } else { ?>
            <div class="no_record_box">
              <div class="media"><img src="{{URL::to('/public/website')}}/images/no_record/c_norecrd.png" alt=""> </div>
              <p>Notification Not found</p>

            </div>
          <?php } ?>

        </div>
      </div>


      <div class="userbtn dropdown">
        <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="s_mda" id="pro_image">
            <img id="heder_profile_pic" src="<?php echo $data['image']; ?>" alt="">
          </div>
        </a>

        <div class="dm_bx dropdown-menu" aria-labelledby="dropdownMenuLink">

          <div class="user_name">
		  <a href="{{URL::to('/')}}/profile/<?php echo $data['userId'] ?>">
            <div class="small_media">
              <img src="<?php echo $data['image'] ?>" alt="">
            </div>
            <div class="uns_d">
              
                <h3>
                  <?php echo $data['userFirstName'] . ' ' . $data['userLastName'];  ?>
                </h3>
                <p>
                  <?php echo $data['userEmail']; ?>
                </p>
              </a>
            </div>

          </div>

          <ul class="drp_menu">
              <li><a href="{{URL::to('/')}}/profile/<?php echo $data['userId'] ?>"><i class="ri-profile-line"></i> Profile</a></li>
              <!-- <li><a href="{{URL::to('/')}}/logout"><i class="ri-logout-box-r-line"></i> Logout</a></li>     -->          
            </ul>

          <div class="logout">
            <a href="{{URL::to('/')}}/logout"><i class="ri-logout-box-r-line"></i> Logout</a>
          </div>

        </div>

      </div>
    </div>

  </nav>


</div>
  

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
  var searchRequest = null;
  $(document).ready(function() {
    $('.search_btn').click(function() {
      $('.search_list').addClass('d-block');
    });

    $(document).mouseup(function(e) {
      if ($(e.target).closest(".search_li").length ===
        0) {
        $('.search_list').removeClass('d-block');
      }
    });
    if ($('.form-control-wrap .form-control').length) {
      $(".form-control-wrap .form-control").on('click', function() {
        $(".search_tags").fadeToggle();
        $('.search_box').addClass('show');
      });
      $('body').on('click', function(event) {
        if (!$(event.target).closest('.form-control-wrap .form-control').length && !$(event.target).closest('.search_tags').length) {
          $('.search_tags').fadeOut('fast');
          $('.search_box').removeClass('show');
        }
      });
    }


    var minlength = 3;

    $("#search_user").keyup(function() {

      value = $(this).val();
      if(value==''){
        $('#user_search_inner').html('<div class="notify_bx"><div class="no_record_box"><div class="media"><img src="{{URL::to("/public/website")}}/images/no_record/c_norecrd.png" alt=""> </div><p>User Not found</p></div></div>');
      }

      if (value.length >= minlength) {
        if (searchRequest != null)
          searchRequest.abort();
        searchRequest = $.ajax({
          type: "POST",
          url: baseUrl + '/serach',
          data: "search=" + value,
          async:false,
          success: function(res) {

            if (res.length > 0) {
              $('#user_search_inner').html("");

              $.each(res, function(key, item) {
                var req_but = "Add Request";
                if (item.mutual_friend > 0) {
                  var fri = '<p>' + item.mutual_friend + ' mutual network</p>';
                } else {
                  var fri = "";
                }
               
               if (item.is_follow==1) {
                  var request_button = '<div class="btn_grp"><button style="display:none" id=' + item.id + '_send_request class="btn" onClick="send_request(' + item.id + ',`Follow`);">Follow</button><button  id=' + item.id + '_cancel_request class="btn" onClick="send_request(' + item.id + ',`cancel_request`);">Cancel</button></div>';

                }else if (item.is_follow==2) {
                  var request_button = '<div class="btn_grp"><button  id=' + item.id + '_send_request class="btn" ><a style="text-decoration: none !important;" href="{{URL::to('/')}}/message/' + item.id + '">Send Message</a></button></div>';
                }else{
                  var request_button = '<div class="btn_grp"><button id=' + item.id + '_send_request class="btn" onClick="send_request(' + item.id + ',`Follow`);">Follow</button><button style="display:none" id=' + item.id + '_cancel_request class="btn" onClick="send_request(' + item.id + ',`cancel_request`);">Cancel</button></div>';
                }

                if (item.city!=null || item.country!=null) {
                  var loc = '<div class="prof_location"><img src="{{URL::to("/public")}}/user_image/map-marker-alt.svg" alt=""><ul><li>' + item.city + '</li> <li>' + item.country + '</li></ul></div>'
                } else {
                  var loc = "";
                }
                $('#user_search_inner').append('<div class="crd_bx"><div class="user_avtar"><a style="text-decoration: none !important;" href="{{URL::to('/')}}/profile/' + item.id + '"><div class="img_bx"><img src="' + item.image + '" alt=""></div><div class="user_details"><h3>' + item.name + '</h3></a>' + loc + '' + fri + '</div></div>' + request_button + '</div>')
                //$('#user_search_inner').show();
              })
            } else {
              $('#user_search_inner').html('<div class="notify_bx"><div class="no_record_box"><div class="media"><img src="{{URL::to("/public/website")}}/images/no_record/c_norecrd.png" alt=""> </div><p>User Not found</p></div></div>');

            }
          }
        });
      }
    });

        
  });

  function send_request(id, status) {
    
    ajaxCsrf();
    $.ajax({
      type: "post",
      url: baseUrl + '/follow',
      data: {
        id: id,
        status: status
      },
      beforeSend: function() {
        //$('#loadingGife').show();
        //ajax_before();
      },
      success: function(res) {
        // ajax_success() ;
        if (res == 1 && status=='Follow') {
          $('#' + id + '_send_request').hide();
          $('#' + id + '_cancel_request').show();
        }else if(res == 1 && status=='cancel_request'){
          $('#' + id + '_send_request').show();
          $('#' + id + '_cancel_request').hide();
        }

      }

    });

  }

  /* function serach() {
    ajaxCsrf();
    var search = $('#search_user').val();
    var user_id = '<?php echo $data['userId']; ?>';
    //alert(user_id);
    $('.err').html('');
    if (search == '') {
      $('#err_search').html('Please some text');
    } else {
      //var formData = new FormData($('#search_data')[0]);
      $.ajax({
        type: "POST",
        url: baseUrl +'/serach',
        data: "search="+search,
        beforeSend: function () {
          //ajax_before();
        },
        success: function (res) {
          if (res) {   
             $.each(res, function (key,item) {
                  $('#user_search_inner').append('<div class="crd_bx"><div class="user_avtar"><div class="img_bx">'+item.image+'</div><div class="user_details"><h3>'+item.name+'</h3><div class="prof_location"><img src="assets/images/map-marker-alt.svg" alt=""><ul><li>Tokyo</li> <li>Japan</li></ul></div><p>2 mutual network</p></div></div><div class="btn_grp"><button class="btn">Add Request</button></div></div>')
				  //$('#user_search_inner').show();
                })
          } else {
            $('#user_search_inner').html('');
          } 
        }
      });

    }
  } */
</script>



