<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
<title>@section('title') Cloud MLM software @show</title>
@section('meta_keywords')
<meta name="keywords" content="Cloud, MLM Software, Business, Software"/>
@show @section('meta_author')
<meta name="author" content="Jon Doe"/>

@show @section('meta_description')
<meta name="description"
	content="Cloud MLM Software for managing online business needs"/>
@show

<link href="{{ asset('assets/globals/plugins/bootstrap-3.3.5/css/bootstrap.min.css') }}" rel="stylesheet" />

<link href="{{ asset('assets/globals/plugins/font-awesome-4.4.0/css/font-awesome.min.css') }}"rel="stylesheet" />

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>


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
				font-family: 'Open Sans',"Helvetica Neue",Helvetica,Arial,sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
			
			form.form {
				text-align: left;
				padding: 10px;
				background: #EFEFEF;
				color: #333;
				font-size: 15px;
				box-shadow: 5px 5px 0px 2px #337AB7;
				font-family: OPen Sans;
			}
			
			label {
				font-size: 12px;
			}

        </style>
		
</head>
    <body>
        <div class="container">
            <div class="content">
                  @yield('content')        
            </div>
        </div>

    <script src="{{ asset('assets/globals/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('assets/globals/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/globals/plugins/jquery-ui-1.11.4.custom/jquery-ui.min.js') }}"></script>
</body>
</html>

