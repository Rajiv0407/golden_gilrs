<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Golden Girls</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/website/chat/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/website/chat/css/intlTelInput.css')}}">
    <link rel="stylesheet" href="{{asset('public/website/css/style.css?v='.time())}}">
    <link rel="icon" href="{{URL::to('/public/admin')}}/images/fav.png?v={{ time() }}">
    <link href="{{ URL('/').'/public/website/css/responsive.css?v='.time() }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
</head>
<!---  -->

<body>
    <?php $mobileDeduct = isMobileDev();  ?>
    <div class="grid-container" id="web_container">
        <?php if (!$mobileDeduct) { ?>
            <header class="navbar_menu">
                @include('includes.website.header')
            </header>
        <?php } ?>



        <div class="main_cont">
            <div class="user_prof chtmssgbx">
                <div class="menu_section">
                    <?php if (!$mobileDeduct) { ?>
                        <div class="head ">
                            <h3>Message</h3>
                        </div>
                    <?php } else { ?>
                        <div class="chat_head">
                        <div class="head_mobile ">
                           <button type="button" onclick="redirectHomepage()"><i class="ri-arrow-left-s-line"></i></button>
                            <h3>Message</h3>
                        </div>
                        </div>
                    <?php } ?>
                    <div class="memu_inner">

                        <div class="menu_inner_list user_profile_menu chattab">
                           
                            <?php if (!empty($users_) && count($users_) > 0) { ?>

                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach($users_ as $user)
                                    <li class="nav-item " id="userList_{{ $user->id }}" role="presentation">

                                        <button class="nav-link usrlist" id="{{ $user->id }}" data-bs-toggle="tab" data-bs-target="#Profile-menu" onclick="chatMessage('{{ $user->id }}')" type="button" role="tab" aria-selected="true">
                                            <span class="nk-menu-img">
                                                <img src="{{ $user->image }}" alt="">
                                            </span>
                                            <span class="nk-menu-text">
                                                <h3 id="add_notfi_no_{{ $user->id }}">{{ $user->name }}
                                                    @if($user->isOnline)
                                                    <span></span>
                                                    @else
                                                    <span class="offline"></span>
                                                    @endif

                                                    @if($user->unread)
                                                    <span class="notfi_no">{{ $user->unread }}</span>

                                                    @endif
                                                </h3>
                                            </span>
                                        </button>
                                    </li>
                                    @endforeach
                                </ul>
                            <?php } else { ?>
                                <div class="sell_box">
                                    <div class="ofl_notfound">
                                        <div class="media"><img src="<?php echo URL('/'); ?>/public/website/images/no_record/l_norecrd.png" alt=""> </div>
                                        <h3>No record Found</h3>
                                        <p>Friends not yet</p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="section_right">
                    <div class="dash_sell_box ">
                        <div class="head">
                            <h3>Profile</h3>
                        </div>
                    </div>

                    <div class="chat_dshbrd">

                        <div id="Profile-menu">
                            <div class="dash_not_data">
                                <h3>Dashboard </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php if (!$mobileDeduct) { ?>
            <footer class="footer_copy">
                @include('includes.website.footer')
            </footer>
        <?php } else { ?> 

            <div id="loader_spineer" style="display:none;">
            <div class="loader_bx">
            <span class="loader_inner"> </span>
            </div>
            </div>

        <?php } ?>



    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <script src="{{asset('public/website/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/website/js/intlTelInput.min.js')}}"></script>
    <script src="{{asset('public/website/js/utils.js')}}"></script>
    <script src="{{asset('public/website/js/custom.js?v=123')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

    <?php if ($userId > 0) {  ?>
        <script type="text/javascript">
            $(document).ready(function() {
                var userId = '<?php echo $userId; ?>';
                var loginUserId = '<?php echo $loginUserId; ?>';
                if (userId != loginUserId) {
                    chatMessage(userId);
                }
                //
                $('#' + userId).click();
                $('#userList_' + userId).prependTo(".nav-tabs");
            });
        </script>

    <?php } ?>
    <script>
        function getTime() {
            var dt = new Date();
            var time = dt.getHours() + ":" + (dt.getMinutes() < 10 ? '0' : '') + dt.getMinutes();
            return time;
        }

        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            var appKey='<?php echo $APP_KEY ; ?>' ;
            var pusher = new Pusher(appKey, {
                cluster: 'ap2'
            });
            var channel = pusher.subscribe('my-channel');

            //+ ":" + dt.getSeconds()
            channel.bind('App\\Events\\MyEvent', function(data) {
                //alert(data);
                //alert(JSON.stringify(data));    
                // <a href=' + image_data.file + ' data-fancybox="gallery" data-caption=""></a>
                // debugger ;
                var image_d = '';
                var message = '';
                if (data.message.image.length > 0) {
                    $.each(data.message.image, function(key, image_data) {
                        if (image_data.file_type == 'image') {
                            image_d += '<div class="media_img"><a href=' + image_data.file + ' data-fancybox="gallery" data-caption=""><img src=' + image_data.file + ' alt="" class="img_thmb"></a></div>';
                        } else if (image_data.file_type == 'video') {
                            image_d += '<div class="media_video"><a data-fancybox="group-1" href=' + image_data.file + '><video width="300" height="200" class="vdo_thmb" controls><source  src=' + image_data.file + '></video></a></div>';
                        } else if (image_data.file_type == 'application') {
                            image_d += '<div class="media_pdf"><embed src=' + image_data.file + '  alt=""></div>';
                        }
                    });
                } else {
                    var image_d = '';
                }
                if (data.message.message != '') {

                    var message = data.message.message;
                } else {
                    var message = '';
                }

                if (data.type == 1) {
                    //alert(data.loginUserId);
                    $('#add_notfi_no_' + data.loginUserId).append('<span></span>')
                }

                if (my_id == data.from) {
                    $('#history').append('<div class="chat-mss rply-mss"><ul><li><div class="replay-mss"><div class="cont_bx"><p>' + message + '</p><div class="list_media">' + image_d + '</div><div class="date"><svg viewBox="0 0 18 18" height="18" width="18" preserveAspectRatio="xMidYMid meet" class="" version="1.1" x="0px" y="0px" enable-background="new 0 0 18 18"><title>status-dblcheck</title><path fill="currentColor" d="M17.394,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-0.427-0.388c-0.171-0.167-0.431-0.15-0.578,0.038L7.792,13.13 c-0.147,0.188-0.128,0.478,0.043,0.645l1.575,1.51c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C17.616,5.456,17.582,5.182,17.394,5.035z M12.502,5.035l-0.57-0.444c-0.188-0.147-0.462-0.113-0.609,0.076l-6.39,8.198 c-0.147,0.188-0.406,0.206-0.577,0.039l-2.614-2.556c-0.171-0.167-0.447-0.164-0.614,0.007l-0.505,0.516 c-0.167,0.171-0.164,0.447,0.007,0.614l3.887,3.8c0.171,0.167,0.43,0.149,0.577-0.039l7.483-9.602 C12.724,5.456,12.69,5.182,12.502,5.035z"></path></svg>' + getTime() + '</div></div></div></li></ul></div>');
                    scrollToBottomFunc();
                } else if (my_id == data.to) {

                    if ($('.usrlist').hasClass('active')) {
                        var activeUsrId = $(".usrlist").filter(".active").attr("id");

                        if (receiver_id == data.from && activeUsrId == data.from) {
                            $("#userList_" + data.from).prependTo(".nav-tabs");

                            $('#history').append('<div class="chat-mss"><ul><li><span><img src="' + data.message.fromImg + '" alt=""></span><div class="replay-mss"><div class="cont_bx"><p>' + message + '</p><div class="list_media">' + image_d + '</div><div class="date">' + getTime() + '</div></div></div></li></ul></div>');
                            scrollToBottomFunc();
                        } else {
                            addNotification(data.from);
                        }


                    } else {
                        addNotification(data.from);
                    }
                }

                //alert(JSON.stringify(data));


                //$("#userList_59").prependTo(".nav-tabs");

            });


            function addNotification(usrId) {
                $("#userList_" + usrId).prependTo(".nav-tabs");
                var existNotification = parseInt($('#add_notfi_no_' + usrId).find('.notfi_no').html());
                if (existNotification) {
                    $('#add_notfi_no_' + usrId).find('.notfi_no').html(existNotification + 1);
                } else {
                    $('#add_notfi_no_' + usrId).append('<span class="notfi_no">1</span>');
                }
            }


            $(document).on('keyup', '#message', function(e) {

                var message = $(this).val();
                // check if enter key is pressed and message is not null also receiver is selected

                if (e.keyCode == 13 && message != '') {
                    chat_message_fn(receiver_id);
                    $(this).val(''); // while pressed enter text box will be empty
                    //alert(message);
                    // var datastr = "&message=" + message;
                    // $.ajax({
                    //     type: "post",
                    //     url:  baseUrl +"/message/"+receiver_id, // need to create this post route
                    //     data: datastr,
                    //     cache: false,
                    //     success: function (data) {

                    //     },
                    //     error: function (jqXHR, status, err) {
                    //     },
                    //     complete: function () {
                    //         scrollToBottomFunc();
                    //     }  
                    // })
                }
            });


        });
        $('.search_btn').click(function() {
            $('.search_list').addClass('d-block');
        });

        $(document).mouseup(function(e) {
            if ($(e.target).closest(".search_li").length ===
                0) {
                $('.search_list').removeClass('d-block');
            }
        });

        function ajaxCsrf() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        var baseUrl = "{{ url('/') }}";

        function chatMessage(userId) {

            if (screen.width < 990) {
                $('.menu_inner_list .nav-tabs .nav-item').click(function() {
                    $(".user_prof.chtmssgbx .section_right").addClass("active");
                });

                $('.back_btn button').click(function() {
                    $(".user_prof.chtmssgbx .section_right").removeClass("active");
                });

            }


            //$('.user').removeClass('active');
            //$(this).addClass('active');
            //$('.user').removeClass('active');
            //$(this).addClass('active');
            // $(this).find('.pending').remove();

            receiver_id = userId;

            $('#add_notfi_no_' + receiver_id + ' > span').remove();
            //alert(receiver_id);
            ajaxCsrf();
            $.ajax({
                type: "post",
                url: baseUrl + '/ajax_conversation/' + userId,
                dataType: 'html',
                success: function(res) {
                    $('#Profile-menu').html(res);
                    scrollToBottomFunc();
                }
            });
        }

        function redirectHomepage(){
           window.location.href =baseUrl;
        }

        function scrollToBottomFunc() {

            $('.chat-inner').animate({
                scrollTop: $('.chat-inner').get(0).scrollHeight
            }, 1);
            ///scrollToBottomFunc:$('.chat-inner').get(0).scrollHeight;
        }
    </script>
</body>

</html>