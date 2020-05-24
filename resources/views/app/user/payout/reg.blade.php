
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Color Admin | Wizards + Validation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="assets/globals/reg/jquery-ui.min.css" rel="stylesheet" />
    <link href="assets/globals/reg/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/globals/reg/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/globals/reg/animate.min.css" rel="stylesheet" />
    <link href="assets/globals/reg/style.min.css" rel="stylesheet" />
    <link href="assets/globals/reg/style-responsive.min.css" rel="stylesheet" />
    <link href="assets/globals/reg/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="assets/globals/reg/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
    <link href="assets/globals/reg/parsley.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
</head>
<body>

        <div class="sidebar-bg"></div>
        <!-- end #sidebar -->
        
        <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li><a href="javascript:;">{{trans('payout.date')}}Home</a></li>
                <li><a href="javascript:;">{{trans('payout.date')}}Form Stuff</a></li>
                <li class="active">{{trans('payout.date')}}Wizards + Validation</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Wizards + Validation <small>{{trans('payout.date')}}header small text goes here...</small></h1>
            <!-- end page-header -->
            
            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                
                                
                                
                                
                            </div>
                            <h4 class="panel-title">{{trans('payout.date')}}Form Wizards</h4>
                        </div>
                        <div class="panel-body">
                            <form action="/" method="POST" data-parsley-validate="true" name="form-wizard">
                                <div id="wizard">
                                    <ol>
                                        <li>
                                            {{trans('payout.date')}}Identification 
                                            <small>{{trans('payout.date')}}Lorem ipsum dolor sit amet, consectetur adipiscing elit.</small>
                                        </li>
                                        <li>
                                            {{trans('payout.date')}}Contact Information
                                            <small>{{trans('payout.date')}}Aliquam bibendum felis id purus ullamcorper, quis luctus leo sollicitudin.</small>
                                        </li>
                                        <li>
                                            {{trans('payout.date')}}Login
                                            <small>{{trans('payout.date')}}Phasellus lacinia placerat neque pretium condimentum.</small>
                                        </li>
                                        <li>
                                            {{trans('payout.date')}}Completed
                                            <small>{{trans('payout.date')}}Sed nunc neque, dapibus non leo sed, rhoncus dignissim elit.</small>
                                        </li>
                                    </ol>
                                    <!-- begin wizard step-1 -->
                                    <div class="wizard-step-1">
                                        <fieldset>
                                            <legend class="pull-left width-full">{{trans('payout.date')}}Identification</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group block1">
                                                        <label>{{trans('payout.date')}}First Name</label>
                                                        <input type="text" name="firstname" placeholder="John" class="form-control" data-parsley-group="wizard-step-1" required />
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{trans('payout.date')}}Middle Initial</label>
                                                        <input type="text" name="middle" placeholder="A" class="form-control" data-parsley-group="wizard-step-1" required />
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{trans('payout.date')}}Last Name</label>
                                                        <input type="text" name="lastname" placeholder="Smith" class="form-control" data-parsley-group="wizard-step-1" required />
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                            </div>
                                            <!-- end row -->
                                        </fieldset>
                                    </div>
                                    <!-- end wizard step-1 -->
                                    <!-- begin wizard step-2 -->
                                    <div class="wizard-step-2">
                                        <fieldset>
                                            <legend class="pull-left width-full">Contact Information</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('payout.date')}}Phone Number</label>
                                                        <input type="text" name="phone" placeholder="1234567890" class="form-control" data-parsley-group="wizard-step-2" data-parsley-type="number" required />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                                <!-- begin col-6 -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('payout.date')}}Email Address</label>
                                                        <input type="email" name="email" placeholder="someone@example.com" class="form-control" data-parsley-group="wizard-step-2" data-parsley-type="email" required />
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->
                                        </fieldset>
                                    </div>
                                    <!-- end wizard step-2 -->
                                    <!-- begin wizard step-3 -->
                                    <div class="wizard-step-3">
                                        <fieldset>
                                            <legend class="pull-left width-full">Login</legend>
                                            <!-- begin row -->
                                            <div class="row">
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{trans('payout.date')}}Username</label>
                                                        <div class="controls">
                                                            <input type="text" name="username" placeholder="johnsmithy" class="form-control" data-parsley-group="wizard-step-3" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{trans('payout.date')}}Pasword</label>
                                                        <div class="controls">
                                                            <input type="password" name="password" placeholder="Your password" class="form-control" data-parsley-group="wizard-step-3" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-4 -->
                                                <!-- begin col-4 -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{trans('payout.date')}}Confirm Pasword</label>
                                                        <div class="controls">
                                                            <input type="password" name="password2" placeholder="Confirmed password" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col-6 -->
                                            </div>
                                            <!-- end row -->
                                        </fieldset>
                                    </div>
                                    <!-- end wizard step-3 -->
                                    <!-- begin wizard step-4 -->
                                    <div>
                                        <div class="jumbotron m-b-0">
                                            <h1>{{trans('payout.date')}}Login Successfully</h1>
                                            <p>{{trans('payout.date')}}Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat commodo porttitor. Vivamus eleifend, arcu in tincidunt semper, lorem odio molestie lacus, sed malesuada est lacus ac ligula. Aliquam bibendum felis id purus ullamcorper, quis luctus leo sollicitudin. </p>
                                            <p><a class="btn btn-success btn-lg" role="button">Proceed to User Profile</a></p>
                                        </div>
                                    </div>
                                    <!-- end wizard step-4 -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end #content -->
        
        <!-- begin theme-panel -->
        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <h5 class="m-t-0">{{trans('payout.date')}}Color Theme</h5>
                <ul class="theme-list clearfix">
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
                </ul>
                <div class="divider"></div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">{{trans('payout.date')}}Header Styling</div>
                    <div class="col-md-7">
                        <select name="header-styling" class="form-control input-sm">
                            <option value="1">{{trans('payout.date')}}default</option>
                            <option value="2">{{trans('payout.date')}}inverse</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">{{trans('payout.date')}}Header</div>
                    <div class="col-md-7">
                        <select name="header-fixed" class="form-control input-sm">
                            <option value="1">{{trans('payout.date')}}fixed</option>
                            <option value="2">{{trans('payout.date')}}default</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label double-line">{{trans('payout.date')}}Sidebar Styling</div>
                    <div class="col-md-7">
                        <select name="sidebar-styling" class="form-control input-sm">
                            <option value="1">{{trans('payout.date')}}default</option>
                            <option value="2">{{trans('payout.date')}}grid</option>
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-md-5 control-label">{{trans('payout.date')}}Sidebar</div>
                    <div class="col-md-7">
                        <select name="sidebar-fixed" class="form-control input-sm">
                            <option value="1">{{trans('payout.date')}}fixed</option>
                            <option value="2">{{trans('payout.date')}}default</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- end theme-panel -->
        
        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="assets/globals/reg/jquery-1.8.2.min.js"></script>
    <script src="assets/globals/reg/jquery-ui.min.js"></script>
    <script src="assets/globals/reg/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <script src="assets/globals/reg/jquery.slimscroll.min.js"></script>
    <script src="assets/globals/reg/jquery.cookie.js"></script>
    <!-- ================== END BASE JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="assets/globals/reg/parsley.js"></script>
    <script src="assets/globals/reg/bwizard.js"></script>
    <script src="assets/globals/reg/form-wizards-validation.demo.min.js"></script>
    <script src="assets/globals/reg/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
        $(document).ready(function() {
            App.init();
            FormWizardValidation.init();
        });
    </script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-53034621-1', 'auto');
      ga('send', 'pageview');
    
    </script>
</body>
</html>

