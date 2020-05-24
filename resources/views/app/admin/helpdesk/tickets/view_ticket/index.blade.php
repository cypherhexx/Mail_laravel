@extends('app.admin.layouts.default'){{-- Web site Title --}}
@section('title') {{$title}} :: @parent @stop
@section('main')
@include('utils.vendor.flash.message')
@include('utils.errors.list')


<div class="panel-boay">
  
<div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-green">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                        <div class="stats-title">TOTAL TICKETS</div>
                        <div class="stats-number">3</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 66.666666666667%;"></div>
                        </div>
                        <div class="stats-desc">Total members joined</div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-blue">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-tags fa-fw"></i></div>
                        <div class="stats-title">TOTAL MEMBER'S INCOME</div>
                        <div class="stats-number">$ 0</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 0%;"></div>
                        </div>
                        <div class="stats-desc">Total member's income</div>
                    </div>
                </div>             

                 <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-purple">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-shopping-cart fa-fw"></i></div>
                        <div class="stats-title">VOUCHER</div>
                        <div class="stats-number">10</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <div class="stats-desc">Total Voucher Counts</div>
                    </div>
                </div>              

               <div class="col-md-3 col-sm-6">
                    <div class="widget widget-stats bg-black">
                        <div class="stats-icon stats-icon-lg"><i class="fa fa-comments fa-fw"></i></div>
                        <div class="stats-title">MESSAGES</div>
                        <div class="stats-number">0</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 0%;"></div>
                        </div>
                        <div class="stats-desc">Total messages from members</div>
                    </div>
                </div> 
</div>






          <div class="row">

                <div class="col-sm-6">
                <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                
                                
                                
                                
                            </div>
                            <h4 class="panel-title">Morris Donut Chart</h4>
                        </div>
                        <div class="panel-body">
                            <h4 class="text-center">Donut flavours</h4>
                            <div id="morris-donut-chart" class="height-sm"></div>
                        </div>
                    </div>
              </div>
              </div>


  







@endsection              


@section('scripts')@parent

    <script src="http://www.seantheme.com/color-admin-v1.3/assets/plugins/morris/morris.js"></script>
  <script src="http://www.seantheme.com/color-admin-v1.3/assets/js/chart-morris.demo.min.js"></script>




<script type="text/javascript">          
$(document).ready(function() {
  App.init();    
  });
  </script>










@stop