<html>
  <head>
    <title>Golden Girls</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  </head>
  <body style="background-color: #f6f6f6; margin: 0;    padding: 60;">
    <div style="max-width: 600px;width: 100%; margin: 0 auto;">
       <table class="main" width="100%" cellpadding="0" cellspacing="0" style="background: #fff;
                  border: 1px solid #e9e9e9; border-radius: 3px; ">
                  <tbody>
                    <tr style="">
                      <td>
                        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                          <tbody>
                            <tr>
                              <td valign="top" style="font-family:Arial,Sans-serif;font-size:12px">
                                <div style="text-align: center;">
                                
                                <div style="background: #3d3935;padding: 10px 20px;">
                                   <a  href="javascript:void(0);">
                                  <img src="https://goldengirls.intigate.co.in/public/admin/images/logo.svg?v=1" alt="logo" style="width:280px;">  
                                 </a>  
                                </div>  
    
                                <table style="font-family:'roboto';width: 100%;     margin-top: 20px;padding: 20px;">
                                  <tbody>
                                    <tr>
                                      <td style="font-size:23px;padding:5px 0;padding-bottom: 40px;"><b> Hi {{$user_name}} ! </b></td>
                                    </tr>
                                 
                                    <tr>
                                     <td colspan="2" style="font-size: 19px;font-weight: 500;padding:5px 0;color: #525252;text-align: center;padding-bottom:20px;"> </td>

                                    </tr>
                                 
                                
                                    <tr>
                                      <td style="padding:3px 0">
                                        <table style="font-family: 'roboto';  background: #f9f9f9; padding: 10px" width="100%">
                                          <tbody>
                                            <tr>
                                              <td colspan="3" style="font-size:17px;padding-bottom: 5px;text-align: center;"> <b>Your Booking Details are: </b> </td>
                                            </tr>
											<tr>
                                            	 <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                            	 <b>	Booking Email id </b>: {{$email}} 
                                            	 </td>
                                            </tr>
                                            <tr>
                                            	 <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                            	 <b>	Order Id: </b> {{$booking_id}}
                                            	 </td>
                                            </tr>
                                                <tr>
                                            	 <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                                <?php if($booking_type == 1){  ?>
                                            	 	<b>Event Name:</b> {{$booking_name}}
                                               <?php } ?>
                                                <?php if($booking_type == 2){  ?>
                                                <b>Goodies Name:</b> {{$booking_name}}
                                               <?php } ?>
                                            	 </td>
                                            </tr>
											 
											<tr>
                                            	 <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                                <?php if($booking_type == 1){  ?>
                                            	 	<b>Event Date:</b> {{$date}}
                                               <?php } ?>
                                               <?php if($booking_type == 2){  ?>
                                                <b> Goodies Date: </b> {{$date}}
                                               <?php } ?>
                                            	 </td>
                                            </tr>
											<tr>
                                            <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                                 <?php if($booking_type == 1){  ?>
                                            	 	 <b>Event Time:</b> {{$time}}
                                                <?php } ?>
                                                <?php if($booking_type == 2){  ?>
                                                 <b>Goodies Time:</b> {{$time}}
                                                <?php } ?>
                                            	 </td>
                                            </tr>
                                            <tr>
                                            <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                                <b> Ticket Quantity:</b> {{$no_ticket}}
                                               </td>
                                            </tr>
											<tr>
                                            	 <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                                <?php if($status== "Approved"){ ?>
                                            	 	<b>Booking Status:</b> <span style="color:green">{{$status}} </span> 
                                               <?php } ?>
                                               <?php if($status== "Cancel"){ ?>
                                                <b>Booking Status:</b><span style="color:red">Your booking cancelled</span> 
                                               <?php } ?>
                                            	 </td>
                                            </tr>
                                             <tr>
                                               <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                                <?php if($countryName!=''){  ?>
                                                <b>Country:</b> {{$countryName}}
                                               <?php } ?>
                                              
                                               </td>
                                            </tr>
                                               <tr>
                                               <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                                <?php if($cityName!=''){  ?>
                                                <b>City:</b> {{$cityName}}
                                               <?php } ?>
                                              
                                               </td>
                                            </tr>
                                            <tr>
                                               <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                                <?php if($booking_type == 1){  ?>
                                                <b>Event Address:</b> {{$address}}
                                               <?php } ?>
                                               <?php if($booking_type == 2){  ?>
                                               <b> Goodies Address:</b> {{$address}}
                                               <?php } ?>
                                               </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="font-size:13px;padding-top: 40px;">
                                        <span style="font-size: 14px;  ">Sincerely,</span><br>
                                        <span style="font-size: 14px; font-weight: 500; color: #000; ">Golden Girls Team</span>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
         
                      <td>
                        <div style="background: #000;padding: 30px 5%;">
         
          
       
                <p style="font-size: 16px;line-height: 16px;text-align: center;color: #fff;opacity: 0.9;margin: 0px;">For any further assistance or information contact us on <a href="walkofweb@gmail.com" style="color: #fff;text-decoration: none;">goldengirls@gmail.com</a> </p>
        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
    </div>
   
  </body>
</html>