<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\SignupController;
use App\Http\Controllers\website\WebsiteController; 
use App\Http\Controllers\website\MessageController; 
use App\Http\Controllers\website\GroupController;
use App\Http\Controllers\website\GroupMessageController;
use App\Http\Controllers\admin\AdministratorController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\MasterController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\BookingController;
use App\Http\Controllers\admin\GoodiesController;      
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\AdminusersController; 
use App\Http\Controllers\admin\RoleController; 
use App\Http\Middleware\PreventBackHistory; 
use App\Http\Middleware\CheckUserLogin; 
use App\Http\Controllers\website\PrivacyController;

/*/////
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|//
*/
 /* ****************Website Contoller ********************** */

Route::get('/',[WebsiteController::class,'index'])->name('/');  
Route::get('/movePostImage',[PrivacyController::class,'movePostImage']); 
Route::get('/goodiesDetails/{id}',[WebsiteController::class,'goodiesDetails']);



/* S3 storage route*/
Route::get('/moveFileToS3Storage',[PrivacyController::class,'moveImgServerToS3Storage']);
Route::get('/createImageAndVideoThumb',[PrivacyController::class,'createImageAndVideoThumb']);

Route::get('/moveStoryImg',[PrivacyController::class,'moveStoryImgServerToS3Storage']);
Route::get('/moveUserImg',[PrivacyController::class,'moveUserImageServerToS3Storage']);
Route::get('/moveEventImg',[PrivacyController::class,'moveEventImageServerToS3Storage']);
Route::get('/moveGoodiesImg',[PrivacyController::class,'moveGoodiesImageServerToS3Storage']);
Route::get('/moveGroupImg',[PrivacyController::class,'moveGroupImageServerToS3Storage']);

Route::get('/moveGroupChatImg',[PrivacyController::class,'moveGroupChatImageServerToS3Storage']);
Route::get('/moveChatImg',[PrivacyController::class,'moveChatImageServerToS3Storage']);
Route::get('/moveUserIImg',[PrivacyController::class,'moveUserIssueImageServerToS3Storage']);
/* end */


Route::get('/postDetail/{id}',[PrivacyController::class,'postDetail']);
Route::post('/save_comment',[WebsiteController::class,'save_comment']);  
Route::get('resetPassword/{encryption}',[WebsiteController::class,'resetPassword']); 
Route::get('addUserEncryption',[WebsiteController::class,'addUserEncryption']);
Route::post('updateUserPassword',[WebsiteController::class,'updateUserPassword']); 

Route::post('/do_login',[WebsiteController::class,'login']);
Route::post('/forgot_password',[WebsiteController::class,'forgot_password']);  
//::get('/about_us',[WebsiteController::class,'about_us']);
Route::post('/Signup',[WebsiteController::class,'Signup']);
Route::post('/updateCountrySession',[WebsiteController::class,'updateCountrySession']);
//Route::get('/group',[WebsiteController::class,'group']); 
Route::get('/eventDetails/{id}',[WebsiteController::class,'eventDetails']);

Route::group(['middleware'=>['CheckUserLogin','PreventBackChatHistory']],function(){

Route::get('/privacyPolicy',[PrivacyController::class,'privacyPolicy']); 
Route::get('/termCondition',[PrivacyController::class,'termCondition']); 
Route::get('/aboutus',[PrivacyController::class,'aboutus']); 
Route::get('/eventPolicies',[PrivacyController::class,'eventPolicies']);
Route::get('/eventTermsServices',[PrivacyController::class,'eventTermsServices']);
Route::get('/membershipsGuidlines',[PrivacyController::class,'membershipsGuidlines']);
/***/





Route::get('/contactus',[PrivacyController::class,'contactus']);
Route::post('/saveContactus',[PrivacyController::class,'saveContactus']);

Route::get('/message/{userId?}',[MessageController::class,'index']); 
Route::post('/ajax_conversation/{userId}',[MessageController::class,'getMessage']); 
Route::post('/message/{id}',[MessageController::class,'sendMessage']);
Route::post('/loadmore_message/{userId}',[MessageController::class,'loadmore_message']);

Route::get('/group',[GroupController::class,'index']);
Route::post('/createGroup',[GroupController::class,'createGroup']);
Route::post('/updateGroup',[GroupController::class,'updateGroup']);
Route::post('/update_groupImage',[GroupController::class,'update_groupImage']);
Route::post('/groupManageMember/{groupId}',[GroupController::class,'groupManageMember']);
Route::post('/groupManageMemberModal/{groupId}',[GroupController::class,'groupManageMemberModal']);


Route::post('/addGroupMember/{groupId}',[GroupController::class,'addGroupMember']);
Route::post('/updateGroupMember',[GroupController::class,'updateGroupMember']);
Route::post('/group_conversation/{groupId}',[GroupMessageController::class,'getMessag']); 
Route::post('/loadmore_group_message/{groupId}',[GroupMessageController::class,'loadmore_group_message']); 
Route::post('/group_message/{id}',[GroupMessageController::class,'sendMessage']);
Route::post('/removeGroupMember',[GroupController::class,'removeGroupMember']);
Route::post('/blockGroupMember',[GroupController::class,'blockGroupMember']);
Route::post('/leaveGroup',[GroupController::class,'leaveGroup']);


Route::post('/blockFriend',[MessageController::class,'blockFriend']);


Route::get('/home',[WebsiteController::class,'home'])->name('/home');
Route::post('/home_page',[WebsiteController::class,'home_page']);
Route::get('/upcoming_event',[WebsiteController::class,'upcoming_event']);
Route::get('/Post_listing',[WebsiteController::class,'Post_listing']); 
Route::get('/Goodies_listing',[WebsiteController::class,'Goodies_listing']);   
Route::match(['GET', 'POST'],'/life_style',[WebsiteController::class,'life_style']);  
Route::match(['GET', 'POST'],'/goodies',[WebsiteController::class,'goodies']);
Route::match(['GET', 'POST'],'/filterGoodies',[WebsiteController::class,'filterGoodies']);
/* get city -  -*/
Route::post('/getCity',[WebsiteController::class,'getCity']);
Route::post('/getEventCityFront',[WebsiteController::class,'getEventCity']);

Route::get('/logout',[WebsiteController::class,'logout']);
Route::post('/save_post',[WebsiteController::class,'save_post']);
Route::post('/follow',[WebsiteController::class,'follow']);
Route::post('/backfollow',[WebsiteController::class,'backfollow']);
Route::post('/update_profile',[WebsiteController::class,'update_profile']);
Route::post('/post_like/{id}',[WebsiteController::class,'post_like']);  
Route::post('/post_delete/{id}',[WebsiteController::class,'post_delete']);  
Route::match(['GET', 'POST'],'/event_listing',[WebsiteController::class,'event_listing']); 
Route::post('/event_like/{id}',[WebsiteController::class,'event_like']); 
Route::post('/event_delete/{id}',[WebsiteController::class,'event_delete']);
Route::post('/profile_image_upload',[WebsiteController::class,'profile_image_upload']); 
Route::post('/banner_upload',[WebsiteController::class,'banner_upload']);
Route::post('/stories_upload',[WebsiteController::class,'stories_upload']); 
//
Route::post('/ajax_comment',[WebsiteController::class,'ajax_comment']);  
Route::post('/story_comment',[PrivacyController::class,'story_comment']);  
Route::post('/story_like',[PrivacyController::class,'story_like']);  

Route::post('/addPhoto_upload',[WebsiteController::class,'addPhoto_upload']); 

Route::post('/comment_like/{id}',[WebsiteController::class,'comment_like']);
Route::post('/save_reply_comment',[WebsiteController::class,'save_reply_comment']);   
Route::post('/accept_friend_request',[WebsiteController::class,'accept_friend_request']);
Route::post('/cancal_friend_request',[WebsiteController::class,'cancal_friend_request']);
Route::post('/reply_comment_like/{id}',[WebsiteController::class,'reply_comment_like']);
Route::post('/post_comment_delete/{id}',[WebsiteController::class,'post_comment_delete']);

Route::post('/editComment',[WebsiteController::class,'editComment']);
Route::post('/updateComment',[WebsiteController::class,'updateComment']);
Route::post('/editReplyComment',[WebsiteController::class,'editReplyComment']);
Route::post('/updateReplyComment',[WebsiteController::class,'updateReplyComment']);
/* New task 16-Feb-2024 */
Route::post('/editGoodiesComment',[WebsiteController::class,'editGoodiesComment']);
Route::post('/updateGoodiesComment',[WebsiteController::class,'updateGoodiesComment']);
Route::post('/editGoodiesReplyComment',[WebsiteController::class,'editGoodiesReplyComment']);
Route::post('/updateGRComment',[WebsiteController::class,'updateGRComment']);
Route::post('/editEventComment',[WebsiteController::class,'editEventComment']);
Route::post('/updateEventComment',[WebsiteController::class,'updateEventComment']);
Route::post('/editERComment',[WebsiteController::class,'editERComment']);
Route::post('/updateERComment',[WebsiteController::class,'updateERComment']);


/* Profile privacy*/



Route::post('/profilePrivacy',[PrivacyController::class,'userProfilePrivacy']);
Route::post('/saveProfilePrivacy',[PrivacyController::class,'saveProfilePrivacy']);
Route::post('/savePostPrivacy',[PrivacyController::class,'savePostPrivacy']);


/* end privacy */







/**/
Route::post('/reply_comment_delete/{id}',[WebsiteController::class,'reply_comment_delete']);
Route::post('/goodies_save_comment',[WebsiteController::class,'goodies_save_comment']);
Route::post('/save_goodies_reply_comment',[WebsiteController::class,'save_goodies_reply_comment']);
Route::post('/goodies_reply_comment_like/{id}',[WebsiteController::class,'goodies_reply_comment_like']); 
Route::post('/goodies_comment_like/{id}',[WebsiteController::class,'goodies_comment_like']);
Route::post('/goodies_reply_comment_delete/{id}',[WebsiteController::class,'goodies_reply_comment_delete']); 
Route::post('/goodies_comment_delete/{id}',[WebsiteController::class,'goodies_comment_delete']);
Route::get('/profile/{id}',[WebsiteController::class,'profile_info']);
Route::match(['GET', 'POST'],'/marches_info/{id}',[WebsiteController::class,'marches_info']); 

Route::match(['GET', 'POST'],'/network/{id}',[WebsiteController::class,'network_info']); 

Route::match(['GET', 'POST'],'/myevent_info/{id}',[WebsiteController::class,'myevent_info']);   
Route::post('/media_info',[WebsiteController::class,'media_info']); 
Route::post('/myPosts/{id}',[WebsiteController::class,'myPosts']); 
Route::post('/myabout/{id}',[WebsiteController::class,'about']);
Route::post('/myphoto/{id}',[WebsiteController::class,'myphoto']);
Route::post('/ajax_myphoto/{id}',[WebsiteController::class,'ajax_myphoto']);
Route::post('/delete_myphoto',[WebsiteController::class,'delete_myphoto']);
Route::post('/deleteVideo',[WebsiteController::class,'deleteVideo']);

Route::post('/ajax_myvideo/{id}',[WebsiteController::class,'ajax_myvideo']);


Route::post('/myvedio/{id}',[WebsiteController::class,'myvedio']); 
Route::post('/myevent/{id}',[WebsiteController::class,'myevent']); 

Route::post('/ajax_myevent/{id}',[WebsiteController::class,'ajax_myevent']); 
Route::post('/ajax_mygoodies/{id}',[WebsiteController::class,'ajax_mygoodies']); 



Route::post('/cancelEvent',[PrivacyController::class,'cancelEvent']); 

Route::get('/following_page/{id}/{type?}',[WebsiteController::class,'following_page']); 

Route::post('/story_like_model/{id}',[WebsiteController::class,'story_like_model']);


Route::post('/post_like_listing/{id}',[WebsiteController::class,'post_like_listing']);
Route::post('/post_like_model/{id}',[WebsiteController::class,'post_like_model']);
Route::post('/goodies_like_listing/{id}',[WebsiteController::class,'goodies_like_listing']); 
Route::post('/goodies_like_model/{id}',[WebsiteController::class,'goodies_like_model']);
Route::post('/event_like_model/{id}',[WebsiteController::class,'event_like_model']); 
Route::post('/event_like_listing/{id}',[WebsiteController::class,'event_like_listing']);    
////

Route::post('/save_booking',[WebsiteController::class,'save_booking']);
Route::post('/notification_list/{id}',[WebsiteController::class,'notification_list']);
Route::post('/read_notification/{id}',[WebsiteController::class,'read_notification']);  
Route::post('/accept_request/{id}',[WebsiteController::class,'accept_request']);  
Route::get('/send_notification',[WebsiteController::class,'send_notification']);  //
Route::match(['GET', 'POST'],'/postDetails/{id}',[WebsiteController::class,'postDetails']); 
Route::get('/notification/{id}',[WebsiteController::class,'notification']);
Route::post('/updateAddress',[WebsiteController::class,'updateAddress']);
Route::post('/updateAccountInfo',[WebsiteController::class,'updateAccountInfo']); 
Route::post('/updateBasicProfile',[WebsiteController::class,'updateBasicProfile']);  
Route::post('/addCategory',[WebsiteController::class,'addCategory']);
Route::post('/saveMediaUrl',[WebsiteController::class,'saveMediaUrl']);
Route::post('/serach',[WebsiteController::class,'serach']);
Route::post('/editPost/{id}',[WebsiteController::class,'editPost']); 
Route::post('/post_image_delete/{id}',[WebsiteController::class,'post_image_delete']);  
Route::post('/updatePost',[WebsiteController::class,'updatePost']); 
Route::get('/Stories',[WebsiteController::class,'Stories']); 
Route::post('/viewStoryModel/{id}',[WebsiteController::class,'viewStoryModel']);
Route::post('/deleteStoryImage/{id}',[WebsiteController::class,'deleteStoryImage']);
Route::get('/addPhotoModal',[WebsiteController::class,'addPhotoModal']);      
Route::get('/addVideoModal',[WebsiteController::class,'addVideoModal']);              
//event data url
  
Route::post('/event_save_comment',[WebsiteController::class,'event_save_comment']); 
Route::post('/save_event_reply_comment',[WebsiteController::class,'save_event_reply_comment']);
Route::post('/event_comment_like/{id}',[WebsiteController::class,'event_comment_like']);
Route::post('/event_reply_comment_like/{id}',[WebsiteController::class,'event_reply_comment_like']);  
Route::post('/event_comment_delete/{id}',[WebsiteController::class,'event_comment_delete']);
Route::post('/event_reply_comment_delete/{id}',[WebsiteController::class,'event_reply_comment_delete']);  
    
Route::post('/goodies_like/{id}',[WebsiteController::class,'goodies_like']);          

});



  /** ****************Admin Controller  ********************** */
Route::get('/administrator',[AdministratorController::class,'login']);
Route::post('/administrator/home',[AdministratorController::class,'home']);
Route::post('/administrator/do_login',[AdministratorController::class,'do_login']);
Route::get('/administrator/logout',[AdministratorController::class,'logout']);

Route::get('/administrator/dashboard',[DashboardController::class,'index']);
Route::post('/dashboard',[DashboardController::class,'admin_dashboard']);
Route::post('/bookingYearlyChart',[DashboardController::class,'bookingYearlyChart']);
Route::post('/bookingGoodiesChart',[DashboardController::class,'bookingGoodiesChart']);

// 	/* Customer management */
Route::post('/customerManagement',[CustomerController::class,'index']);
Route::get('customer_datatable',[CustomerController::class,'customerlist']);
Route::post('userManagement/changeStatus',[CustomerController::class,'changeStatus']);
Route::post('/userDetailData',[CustomerController::class,'userDetailData']);
Route::get('/userFollower_datatable/{userId}/{type}',[CustomerController::class,'userFollower_datatable']);
Route::get('/userFollows_datatable/{userId}/{type}',[CustomerController::class,'userFollows_datatable']);


Route::post('/deleteAdmin_myphoto',[CustomerController::class,'delete_myphoto']);
Route::post('/deleteAdminVideo',[CustomerController::class,'deleteVideo']);

// Route::post('/customerDetail',[CustomerController::class,'detail']);
Route::post('/delete_customer',[CustomerController::class,'delete_customer']);
Route::post('/changePassword',[CustomerController::class,'changePassword']);
Route::post('/changeAdminPassword',[CustomerController::class,'changeAdminPassword']);
Route::post('/changeAdminUserPassword',[CustomerController::class,'changeAdminUserPassword']);

Route::post('/forgot_password12',[CustomerController::class,'forgot_password12']);
Route::post('/otp_verify',[CustomerController::class,'verifyOTP']);
Route::post('/customer_detail',[CustomerController::class,'customer_detail']);


// 	/* Admin Users management */
Route::post('/adminusersManagement',[AdminusersController::class,'index']);
Route::get('/admin_users_datatable',[AdminusersController::class,'customerlist']);
Route::post('/saveUser',[AdminusersController::class,'saveUser']);
Route::post('/user_detail',[AdminusersController::class,'user_detail']);
Route::post('/delete_admin_user',[AdminusersController::class,'delete_admin_user']);
Route::post('/changeadminUsrStatus',[AdminusersController::class,'changeadminUsrStatus']); 
Route::post('/edit_admin_user',[AdminusersController::class,'edit_admin_user']);
Route::post('/update_admin_user',[AdminusersController::class,'update_admin_user']); 


/* Role Managment    */ 
Route::post('/roleManagment',[RoleController::class,'index']);
Route::post('/brand_permission/{id}',[RoleController::class,'brand_permission']);
Route::post('/admin_permission',[RoleController::class,'admin_permission']);
Route::post('/hospitality_permission',[RoleController::class,'hospitality_permission']);
Route::post('/saveMasterRolePermissions',[RoleController::class,'save_master_role_permissions']);
Route::post('/saveUserRolePermissions',[RoleController::class,'save_user_role_permissions']);
Route::post('/saveUserAllRolePermissions',[RoleController::class,'save_user_all_role_permissions']);
Route::post('/deleteUserAllRolePermissions',[RoleController::class,'delete_user_all_role_permissions']);
Route::post('/editRole/{id}',[RoleController::class,'edit_role']); 
Route::post('/updateRole',[RoleController::class,'update_role']); 
Route::post('/addRole',[RoleController::class,'add_role']);      

/*- Event  Controller */
Route::post('/event_list',[EventController::class,'event_list']);
Route::get('/event_datatable',[EventController::class,'event_datatable']);
Route::post('/editEvent',[EventController::class,'editEvent']); 
Route::post('/eventStatus',[EventController::class,'eventStatus']);
Route::post('/saveEvent',[EventController::class,'saveEvent']); 
Route::post('/updateEvent',[EventController::class,'updateEvent']);
Route::post('/getEventCity',[EventController::class,'getEventCity']);
Route::post('/getEditEventCity',[EventController::class,'getEditEventCity']);

/* Goodies  Controller */     
Route::post('/goodies_list',[GoodiesController::class,'goodies_list']);   
Route::get('/goodies_datatable',[GoodiesController::class,'goodies_datatable']);
Route::post('/saveGoodies',[GoodiesController::class,'saveGoodies']);
Route::post('/goodiesStatus',[GoodiesController::class,'goodiesStatus']);
Route::post('/deleteGoodies',[GoodiesController::class,'deleteGoodies']);
Route::post('/editGoodies',[GoodiesController::class,'editGoodies']); 
Route::post('/updateGoodies',[GoodiesController::class,'updateGoodies']);
Route::post('/getGoodiesCity',[GoodiesController::class,'getGoodiesCity']);
Route::post('/getEditGoodiesCity',[GoodiesController::class,'getEditGoodiesCity']);             
//coupon Management
Route::post('/coupon_list',[EventController::class,'coupon_list']);
Route::post('/saveCoupon',[EventController::class,'saveCoupon']); 
Route::get('/coupon_datatable',[EventController::class,'coupon_datatable']);
Route::post('/couponStatus',[EventController::class,'couponStatus']);
Route::post('/editCoupon',[EventController::class,'editCoupon']);   
Route::post('/updateCoupon',[EventController::class,'updateCoupon']);

//Booking  Mamangement
Route::post('/event_booking_list',[BookingController::class,'event_booking_list']);
Route::post('/goodies_booking_list',[BookingController::class,'goodies_booking_list']);
Route::get('/event_booking_datatable',[BookingController::class,'event_booking_datatable']);
Route::get('/goodies_booking_datatable',[BookingController::class,'goodies_booking_datatable']);
Route::post('/event_booking_detail',[BookingController::class,'event_booking_detail']);
Route::post('/goodies_booking_detail',[BookingController::class,'goodies_booking_detail']);   
Route::post('/bookingStatus',[BookingController::class,'bookingStatus']);
Route::post('/cancalBooking',[BookingController::class,'cancalBooking']);         
//Event type
Route::post('/event_type_list',[MasterController::class,'event_type_list']);
Route::get('/event_type_datatable',[MasterController::class,'event_type_datatable']);
Route::post('/eventTypeStatus',[MasterController::class,'eventTypeStatus']);
Route::post('/saveEventType',[MasterController::class,'saveEventType']);
Route::post('/deleteEventType',[MasterController::class,'deleteEventType']);
Route::post('/editEventType',[MasterController::class,'editEventType']);
Route::post('/updateEventType',[MasterController::class,'updateEventType']);

//Fee 
Route::post('/event_fee_type_list',[MasterController::class,'event_fee_type_list']);
Route::get('/event_fee_type_datatable',[MasterController::class,'event_fee_type_datatable']);
Route::post('/saveEventFeeType',[MasterController::class,'saveEventFeeType']);
Route::post('/editEventFeeType',[MasterController::class,'editEventFeeType']);
Route::post('/updateEventFeeType',[MasterController::class,'updateEventFeeType']);  
Route::post('/deleteEventFeeType',[MasterController::class,'deleteEventFeeType']);
Route::post('/eventFeeTypeStatus',[MasterController::class,'eventFeeTypeStatus']);  
Route::post('/termCondition',[MasterController::class,'termCondition']); 
Route::post('/privacyPolicy',[MasterController::class,'privacyPolicy']);
Route::post('/saveTermCondition',[MasterController::class,'saveTermCondition']);
Route::post('/savePrivacyPolicy',[MasterController::class,'savePrivacyPolicy']); 


//Country
 Route::post('/country',[MasterController::class,'country_list']);      
 Route::post('/countryStatus',[MasterController::class,'countryStatus']); 
 Route::post('/saveCountry',[MasterController::class,'saveCountry']); 
 Route::post('/deleteCountry',[MasterController::class,'deleteCountry']);
 Route::post('/editCountry',[MasterController::class,'editCountry']);
 Route::post('/updateCountry',[MasterController::class,'updateCountry']);  
Route::get('/country_datatable',[MasterController::class,'country_datatable']);


//City
 Route::post('/city',[MasterController::class,'city_list']);      
 Route::post('/cityStatus',[MasterController::class,'cityStatus']); 
 Route::post('/saveCity',[MasterController::class,'saveCity']); 
 Route::post('/deleteCity',[MasterController::class,'deleteCity']);
 Route::post('/editCity',[MasterController::class,'editCity']);
 Route::post('/updateCity',[MasterController::class,'updateCity']);  
Route::get('/city_datatable',[MasterController::class,'city_datatable']); 
/* ****************end Admin  ********************** */  




Route::group(['middleware'=>'PreventBackHistory'],function(){
Route::get('/administrator/dashboard',[DashboardController::class,'index']);
Auth::routes();  
}); 
/* User Controller***********      */
Route::post('/Signup12',[SignupController::class,'Signup']);   
Route::get('/user/index',[SignupController::class,'index']); 
//Route::get('/logout',[SignupController::class,'logout']);  
Route::post('/profile12',[SignupController::class,'profileData']); 
Route::post('/edit_profile',[SignupController::class,'edit_profile']);
Route::post('/update_descrption',[SignupController::class,'update_descrption']);
     


//Route::post('/update_profile',[SignupController::class,'update_profile']);
//Route::post('/event',[SignupController::class,'event_listing']); 
Route::post('/change_password',[SignupController::class,'change_password']); 
Route::post('/update_password',[SignupController::class,'update_password']);
Route::post('/add_event',[SignupController::class,'add_event']);
Route::get('/get_lat_long',[SignupController::class,'get_lat_long']);   
  
//One to one chat
Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

Route::fallback(function () {
      return redirect()->route('/');  
});




 
