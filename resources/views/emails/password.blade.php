<html lang="en"><head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>{{$company_name}} - </title>

    </head>

    <body>

         <table width="600" bgcolor="#f9f9f9" style="font-family: MyriadPro-Regular, 'Myriad Pro Regular', MyriadPro, 'Myriad Pro', Helvetica, Arial, sans-serif;">    <tbody><tr>

        <td align="center" style="padding: 5px 15px 0px 15px;" class="section-padding">

            <table border="0" cellpadding="0" align="center" cellspacing="0" class="responsive-table">

            <tbody><tr><td align="left" valign="top" style="padding:10px;font:9px/15px Arial;text-align:justify;color:#a6a6a6">You are receiving this mail as a registered member of {{$company_name}} Please add <a href="mailto:info@bharatmatrimony.com" style="text-decoration:underline;color:#a6a6a6" target="_blank">{{$email->from_email}}</a> to your address book to ensure delivery into your inbox.</td></tr>

            </tbody></table>

        </td>

    </tr>

</tbody></table>

        <table width="600" bgcolor="#f9f9f9" style="font-family: MyriadPro-Regular, 'Myriad Pro Regular', MyriadPro, 'Myriad Pro', Helvetica, Arial, sans-serif;">

            <thead>

                <tr>

                    <td style="padding:22px 30px 18px 30px; border-bottom:2px solid #1e2064"><img src="http://beta.locatlist.club/public/assets/images/logo-connect.png" height="60" alt="Sneha Matrimony"></td>

                </tr>

            </thead> 
            

            <tbody>

                <tr>

                    <td style="padding:30px 30px 10px 30px"><h2 style="color:#000;">Your password reset link  for {{$company_name}}</h2></td>

                </tr>

                <tr>

                    <td style="padding:0px 30px 20px 30px;"><p style="font-size:14px; color:#666666;">


                        <p>You have requested to reset your password on {{$company_name}}. To proceed, click on the button below & follow the instructions on the screen. </p>

                        <p>  <a style=" display: inline-block;    padding: 6px 12px;    margin-bottom: 0;    font-size: 14px;    font-weight: 400;    line-height: 1.42857143;    text-align: center;    white-space: nowrap;    vertical-align: middle;    -ms-touch-action: manipulation;       -moz-user-select: none;    -ms-user-select: none;    user-select: none;    background-image: none;    border: 1px solid transparent;    border-radius: 4px;    background: #03A9F4;    color: #fff;    text-decoration: none;"  target="blank" href="{{ url('password/reset',[$token]) }}">Reset Password</a></p>

                        <p>This link will expire in {{config('auth.reminder.expire', 60) }} minutes.</p>

                        <p>We are waiting to see you back on <a href="{{url('auth/login')}}">{{$company_name}}</a></p>




                

                    </td>

                </tr>

               
            </tbody>

            <tfoot bgcolor="#c1c1c1">

                <tr>

                    <td style="padding:20px 30px"><p style="font-size:12px; color:#000000;">Copyright © {{Date('Y')}} {{$company_name}}. All Rights Reserved</p></td>

                </tr>

            </tfoot>

        </table>

    

</body>
  </html>