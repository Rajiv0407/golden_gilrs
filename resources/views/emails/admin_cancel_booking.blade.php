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
                <h3 style="font-family: 'roboto';margin: 0;color: #482809;font-weight: 600;font-size: 24px;">Hi Admin !</h3>
                <p style="font-size: 16px;text-align: left;color: #482809;">Following user has been cancelled event booking. Please find details here:</p>
              </div>
              <div style="border-radius: 3px;background: #fff;border: 1px solid #d8d8d8;padding: 15px;position: relative;    margin: 15px;">
                <h3 style="color: #482809;font-size: 20px; font-weight: 600;margin: 0;text-transform: capitalize;margin-bottom:15px;">Customer details</h3>
                <div>
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%; margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">Customer Name:</span><span> {{$user_name}}</span></p>
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%;margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">Customer Email Id:</span><span> {{$email}}</span></p>
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%;margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);"> Contact Number:</span><span>{{$contact_number}}</span></p>
                </div>

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
                 <div style="display: flex;align-items: start;">
                  <p style="display: inline-block;font-size: 16px; width: 100%;max-width:49%; margin: 0;margin-bottom:20px;color: #482809;"><span style="display: block;margin-bottom:6px;    color: rgb(72, 40, 9, 0.6);">Cancel Reason:</span><span>{{ $cancel_reason }}</span></p>
                

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
          </td>
        </tr>
        <tr>

         
        </tr>
      </tbody>
    </table>
  </div>

</body>

</html>