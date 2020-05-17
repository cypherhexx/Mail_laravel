@extends('app.admin.layouts.default') @section('styles')
<style type="text/css">
}
.chart-detail-list li {
    margin: 10px;
    margin-top: 0px;
    margin-right: 20px;
    margin-bottom: 0px;
    margin-left: 20px;
}
.list-inline>li {
    display: inline-block;
    padding-right: 5px;
    padding-left: 5px
}
.text-center {
    text-align: center;
}
.card-box {
    border-radius: 3px;
    border-top-left-radius: 6px;
    border-top-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-bottom-left-radius: 3px;
    background-clip: padding-box;
    margin-bottom: 30px;
    background-color: #fff;
}
.widget-box-three .bg-icon {
    height: 60px;
    width: 60px;
    text-align: center;
    border-radius: 50%;
    border-top-left-radius: 50%;
    border-top-right-radius: 50%;
    border-bottom-left-radius: 50%;
    border-bottom-left-radius: 50%;
    background-clip: padding-box;
    border: 1px dashed #c0c0c0;
    border-top-color: rgb(192, 192, 192);
    border-top-style: dashed;
    border-top-width: 1px;
    border-right-color: rgb(192, 192, 192);
    border-bottom-style: dashed;
    border-bottom-width: 1px;
    border-left-color: rgb(192, 192, 192);
    border-left-style: dashed;
    border-left-width: 1px;
    border-image-source: initial;
    border-image-slice: initial;
    border-image-width: initial;
    border-image-outset: initial;
    border-image-repeat: initial;
    background-color: rgba(243, 243, 243, 0.9);
    margin-right: 20px;
}
.row {
    margin-right: -10px;
    margin-left: -10px;
}

.page-title-box {
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
    margin: 0 -20px 30px;
    background-color: #fff;
}
.page-title {
    font-size: 20px;
    margin-bottom: 0;
    margin-top: 0;
    font-weight: 600;
}
.breadcrumb {
    background-color: transparent;
    margin-bottom: 15px;
    padding-top: 10px;
    padding-left: 0;
    float: right;
}
.m-0 {
    margin: 0!important;
}
.p-0 {
    padding: 0!important;
}



.page-title-box .page-title {
    margin-bottom: 0;
    float: left;
}
div {
    display: block;
}
.container {
    width: auto;
}
.header-title {
    font-size: 17px;
    line-height: 17px;
    margin-bottom: 8px;
    font-weight: 600;
}
.m-b-30 {
    margin-bottom: 30px!important;
}
.m-t-0 {
    margin-top: 0!important;
}
.card-box,
.wrapper-md {
    padding: 50px;
    padding-top: 20px;
    padding-right: 20px;
    padding-bottom: 20px;
    padding-left: 20px;
}

.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}

.table {
    background-color: transparent;
}
.table {
    border-spacing: 0;
    border-collapse: collapse;
}
.table-colored.table-inverse thead th {
    background-color: #3b3e47;
}
.tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
    border-top-color: inherit;
    border-right-color: inherit;
    border-bottom-color: inherit;
    border-left-color: inherit;
}

.table-centered td {
    vertical-align: middle !important;
}
.table>tbody>tr>td {
    color: grey;
}
</style>
@endsection @section('main')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="#">Zircos</a>
                    </li>
                    <li>
                        <a href="#">Blogs </a>
                    </li>
                    <li class="active">
                        Dashboard
                    </li>
                </ol>
                <div class="clearfix">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-2">
                <div class="card-box widget-box-three">
                    <i class="mdi mdi-access-point"></i>
                    <div class="bg-icon pull-left">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-muted m-t-5 text-uppercase font-600 ">total tickets</p>
                        <h2 class="m-b-10"><span data-plugin="counterup">{{$total}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card-box widget-box-three">
                    <i class="mdi mdi-access-point"></i>
                    <div class="bg-icon pull-left">
                        <i class="fa fa-user fa-5x"></i>
                        <!-- <i class="ti-agenda"></i>-->
                    </div>
                    <div class="text-right">
                        <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Category</p>
                        <h2 class="m-b-10"><span data-plugin="counterup">{{$category}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card-box widget-box-three">
                    <div class="bg-icon pull-left">
                        <i class="fa fa-envelope fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Tags</p>
                        <h2 class="m-b-10"><span data-plugin="counterup">{{$tag}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card-box widget-box-three">
                    <div class="bg-icon pull-left">
                        <i class="fa fa-envelope fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-muted m-t-5 text-uppercase font-600 font-secondary">Status</p>
                        <h2 class="m-b-10"><span data-plugin="counterup">{{$status}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Total Views</h4>
                        <div class="text-center">
                            <ul class="list-inline chart-detail-list">
                                <li class="list-inline-item">
                                    <h5 class="text-teal"><i class="mdi mdi-crop-square m-r-5"></i>Page Views</h5>
                                </li>
                                <li class="list-inline-item">
                                    <h5><i class="mdi mdi-details m-r-5"></i>Visitors</h5>
                                </li>
                            </ul>
                        </div>
                        <div id="bar-example"> </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="m-t-0 m-b-30 header-title">Tickets</h4>
                        <div class="text-center">
                            <ul class="list-inline chart-detail-list">
                                <li class="list-inline-item">
                                    <h5 class="text-teal"><i class="mdi mdi-crop-square m-r-5"></i>Categories</h5>
                                </li>
                                <li class="list-inline-item">
                                    <h5><i class="mdi mdi-details m-r-5"></i>Tickets</h5>
                                </li>
                            </ul>
                        </div>
                        <div id="donut-example"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <h4 class="m-t-0 m-b-30 header-title">Latest tickets</h4>
                        <div class="table-responsive">
                            <table class="table table-colored table-centered table-inverse m-0">
                                <thead>
                                    <tr>
                                        <th>Ticket_no</th>
                                        <th>subject</th>
                                        <th>status</th>
                                        <th>priority</th>
                                        <th>category</th>
                                    </tr>
                                </thead>
                                @foreach($ticket_join as $tickets)
                                <tbody>
                                    <tr>
                                        <td>{{$tickets->ticket_no}}</td>
                                        <td>{{$tickets->subject}}</td>
                                        <td>{{$tickets->status}}</td>
                                        <td>{{$tickets->priority}}</td>
                                        <td>{{$tickets->category}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endsection @section('scripts')
            <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>
            <script type="text/javascript">
            App.init();
            Morris.Bar({
                element: 'bar-example',
                data: [
                    { y: '2006', a: 100, b: 90 },
                    { y: '2007', a: 75, b: 65 },
                    { y: '2008', a: 50, b: 40 },
                    { y: '2009', a: 75, b: 65 },
                    { y: '2010', a: 50, b: 40 },
                    { y: '2011', a: 75, b: 65 },
                    { y: '2012', a: 100, b: 90 }
                ],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Series A', 'Series B']
            });
            </script>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>
            <script type="text/javascript">
            Morris.Donut({
                element: 'donut-example',
                data: {!!$category_count!! }
            });
            </script>
            @endsection