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
            <div style="font-family: 'roboto'; background: #fff;overflow: hidden;box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.16);border: 1px solid #E6E6E6;position: relative;">
              <div style="background: #d7792d;padding: 15px;text-align: center;">
                <a href="<?php echo URL('/') ; ?>">
                  <img src="<?php echo URL('/'); ?>/public/website/images/logo_new.png?<?php echo time(); ?>" alt="logo">
                </a>
              </div>
              <div style="text-align: left;padding: 30px 15px 15px;">
                <h3 style="font-family: 'roboto';margin: 0;color: #482809;font-weight: 600;font-size: 24px;">Hi {{$user_name}} !</h3>
                <p style="font-size: 16px;text-align: left;color: #482809;">You have cancelled your event booking. Please find details here:</p>
              </div>
         
              <div style="border-radius: 3px;background: #fff;border: 1px solid #d8d8d8;padding: 15px;position: relative;    margin: 15px;">
                <h3 style="color: #482809;font-size: 20px; font-weight: 600;margin: 0;text-transform: capitalize;margin-bottom:15px;">Event Details</h3>
                <div>
                  <div style="display: flex;align-items: start;">
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%; margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">Event Name:</span><span>{{$booking_name}}</span></p>
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%; margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">Country:</span><span>{{$countryName}}</span></p>
                </div>
                <div style="display: flex;align-items: start;">
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%; margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">City: </span><span>{{$cityName}}</span></p>
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%; margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">Event Address: </span><span>{{$address}}</span></p>
                </div>
                <div style="display: flex;align-items: start;">
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%; margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">Event Date:</span><span>{{$date}}</span></p>
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%; margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">Event Time:</span><span>{{$time}}</span></p>
                  </div>
                  <div style="display: flex;align-items: start;">
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%; margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">Ticket Quantity:</span><span>{{$no_ticket}}</span></p>
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%; margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">Order Id: </span><span> {{$booking_id}}</span></p>
                </div>

                </div>

              </div>
              <div style="padding: 15px;font-weight: 500;font-size: 16px; text-align: left;color: #482809;">
                <p style="margin: 0px 0 6px;">Sincerely,</p>
                <p style="margin: 0;">Golden Girls Team</p>
              </div>
              <div style="background: #d7792d;text-align: center;padding: 30px 0;">
                <p style="font-size: 16px;line-height: 16px;text-align: center;color: #fff;opacity: 0.9;margin: 0px;">For any further assistance or information contact us on <a href="walkofweb@gmail.com" style="color: #fff;text-decoration: none;">goldengirls@gmail.com</a> </p>
              </div>
            </div>



            <!-- 
            <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
              <tbody>
                <tr>
                  <td valign="top" style="font-family:Arial,Sans-serif;font-size:12px">
                    <div style="text-align: center;">

                      <div style="background: #3d3935;padding: 10px 20px;">
                       
                      </div>

                      <table style="font-family:'roboto';width: 100%;     margin-top: 20px;padding: 20px;">
                        <tbody>
                          <tr>
                            <td style="font-size:23px;padding:5px 0;padding-bottom: 40px;"><b>  </b></td>
                          </tr>

                          <tr>
                            <td colspan="2" style="font-size: 19px;font-weight: 500;padding:5px 0;color: #525252;text-align: center;padding-bottom:20px;"> </td>

                          </tr>


                          <tr>
                            <td style="padding:3px 0">
                              <table style="font-family: 'roboto';  background: #f9f9f9; padding: 10px" width="100%">
                                <tbody>
                                  <tr>
                                    <td colspan="3" style="font-size:17px;padding-bottom: 5px;text-align: center;"> <b>You have cancelled your event booking. Please find details here: </b>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                      <b> Customer details </b>:
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                      <b> Customer Name </b>: {{$user_name}}
                                    </td>
                                  </tr>

                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                      <b> Customer Email Id </b>: {{$email}}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                      <b> Contact Number </b>: {{$contact_number}}
                                    </td>
                                  </tr>

                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                      <b> Event Details: </b>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">

                                      <b>Event Name:</b> {{$booking_name}}

                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">

                                      <b>Country:</b> {{$countryName}}


                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">

                                      <b>City:</b> {{$cityName}}


                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">

                                      <b>Event Address:</b> {{$address}}

                                    </td>
                                  </tr>




                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">

                                      <b>Event Date:</b> {{$date}}


                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">

                                      <b>Event Time:</b> {{$time}}


                                    </td>
                                  </tr>

                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                      <b> Ticket Quantity:</b> {{$no_ticket}}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">
                                      <b> Order Id: </b> {{$booking_id}}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" style="font-size:14px;padding-bottom: 5px;    text-align: center;">



                                      <b>Booking Status:</b><span style="color:red">Your booking cancelled</span>

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
            </table> -->
          </td>
        </tr>
        <tr>

          <!-- <td>
            <div style="background: #000;padding: 30px 5%;">



              <p style="font-size: 16px;line-height: 16px;text-align: center;color: #fff;opacity: 0.9;margin: 0px;">For any further assistance or information contact us on <a href="walkofweb@gmail.com" style="color: #fff;text-decoration: none;">goldengirls@gmail.com</a> </p>
            </div>
          </td> -->
        </tr>
      </tbody>
    </table>
  </div>

</body>

</html>