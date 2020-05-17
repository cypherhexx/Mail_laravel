<!DOCTYPE html>
<html>
    <head>
        <title>Updating the program! Be right back.</title>

        <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .row {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
                background: #E3E003 ;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                    font-size: 30px;
                    margin-bottom: 20px;
                    font-weight: 700;
                    color: #666663  ;
            }

             .title1 {
                    font-size: 50px;
                    margin-bottom: 40px;
                    font-weight: 1000;
                    color: black;

            }
 .button {
  background-color: #4B4A01; /* Green */
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  padding: 10px;
  color:#fffff0 ;
}

.button1 {
    border-radius: 12px;
}
        </style>
    </head>
    <body>
        <div class="row">

         

        <div class="title">WEB SITE  CURRENTLY </div>
      <div class="title1">  UNDER MAINTENANCE.</div>

       <a href="{{ URL::to('/logout') }}" type="button" class="button button1"> Go Home</a>

 





           
        </div>
    </body>

     
        
</html>
