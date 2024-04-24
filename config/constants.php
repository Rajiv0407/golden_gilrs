<?php 

 return [
      'user_image' => env('USER_IMAGE', 'https://ggbucketaws1.s3.eu-west-2.amazonaws.com/local/profile_image/'),
	  'user_default' => env('USER_IMAGE', 'http://192.168.1.30/golden/storage/app/public/user_image/user_holder.svg'),
	  'post_image' => env('POST_IMAGE', 'https://ggbucketaws1.s3.eu-west-2.amazonaws.com/local/post_image/'),
	  'isSendMail' => env('isSendMail', 0),	 
	  's3_baseURL' => env('s3_baseURL','https://ggbucketaws1.s3.eu-west-2.amazonaws.com/'),
	  'user_profile_img_s3' => env('user_profile_img_s3', 'local/profile_image/'),
	  'user_post_s3' => env('user_post_s3', 'local/post_image/'),
	  'user_stories_s3' => env('user_post_s3', 'local/user_stories/'),
	  'contactus_email' => env('contactus_email', 'amit.shukla@intigate.in'),
	  'goodies_image' => env('goodies_image', 'local/goodies_image/'),
	  'event_image' => env('event_image', 'local/event_image/'),
	  'chat_image' => env('event_image', 'local/chat_image/'),
	  'group_icon' => env('event_image', 'local/group_icon/'),
	  'group_image' => env('event_image', 'local/group_image/'),
	   'PUSHER_APP_ID'=>env('PUSHER_APP_ID', '1716502') ,
	   'PUSHER_APP_KEY'=> env('PUSHER_APP_KEY', 'e9c75b86e285c511da57'),
	   'PUSHER_APP_SECRET'=>env('PUSHER_APP_SECRET', '56c0c0dd6d90996be5b9') ,
	  
     ];










 ?>