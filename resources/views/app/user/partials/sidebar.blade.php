@if(Auth::check())
<!-- User menu -->

	<!-- Main sidebar -->
			<div class="sidebar sidebar-main ">
				<div class="sidebar-content">


					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left">

                 {{ Html::image(route('imagecache', ['template' => 'profile', 'filename' => $image]), 'User', array('class' => 'img-circle img-sm')) }}

               

                </a>
								<div class="media-body">
									<span class="media-heading text-semibold">  {{ Auth::user()->name }}</span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> {{$GLOBAL_PACAKGE}}
									</div>
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<!-- <a href="#"><i class="icon-cog3"></i></a> -->
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>


                                @if($current_pack > 1)								
								<li class="{{set_active('user/dashboard')}}">
                        <a href="{{url('user/dashboard')}}">                           
                            <i class="icon-home4"></i>
                            <span class="text" >{{trans('menu.dashboard')}}</span>
                        </a>
                       
                    </li>

                      <li class="{{set_active('user/profile')}}">
                        <a href="{{url('user/profile')}}">
                            <i class="glyphicon glyphicon-user"></i>
                            <span class="text"> {{trans('menu.profile')}}</span>
                        </a>
                    </li>  
                
                    <li class="navigation-header"><span>Users</span> <i class="icon-menu" title="Users"></i></li>


                    <li class="has-sub {{set_active('user/genealogy')}}{{set_active('user/sponsortree')}}{{set_active('user/tree')}}">
                        <a href="javascript:;">                           
                            <span class="badge pull-right"></span>
                            <i class="icon-tree7"></i> 
                            <span>{{trans('menu.genealogy')}}</span>
                        </a>
                         <ul class="sub-menu">
                            <li class="{{set_active('user/genealogy')}}"><a href="{{url('user/genealogy')}}">{{trans('menu.binary-genealogy')}}</a></li>
                            <li class="{{set_active('user/sponsortree')}}"><a href="{{url('user/sponsortree')}}">{{trans('menu.sponsor-genealogy')}}</a></li>
                            <li class="{{set_active('user/tree')}}"><a href="{{url('user/tree')}}">{{trans('menu.tree-genealogy')}}</a></li>
                           
                        </ul>
                    </li>
                   <!--   <li class="{{set_active('user/register')}}">
                            <a href="{{url('user/register')}}">
                                <i class="icon-add"></i>
                                <span class="text">{{trans('menu.register')}}  </span>
                            </a>
                    </li> --> 
                    <li class="{{set_active('user/incomereport')}}">
                        <a href="{{url('user/incomereport')}}">
                            <i class="fa fa-sticky-note"></i>
                            <span class="text"> {{trans('menu.income_report')}} </span>
                        </a>
                    </li>


                    <li class="has-sub  {{set_active('user/purchase-plan')}}  {{set_active('user/purchase-history')}} ">
                        <a href="javascript:;">
                            
                            <span class="badge pull-right"></span>
                            <i class="fa fa-shopping-cart"></i> 
                            <span> {{ trans('menu.plan_purchase')}} </span>
                        </a>
                        <ul class="sub-menu">
                            <li class="{{set_active('user/purchase-plan')}}"><a href="{{url('user/purchase-plan')}}"> {{ trans('menu.plan_purchase')}} </a></li>
                            <li class="{{set_active('user/purchase-history')}}"><a href="{{url('user/purchase-history')}}"> {{ trans('menu.purchase_history')}} </a></li>
                        </ul>
                    </li>



                     <li class="{{set_active('user/ewallet')}}">
                        <a href="{{url('user/ewallet')}}">
                            <i class="fa fa-credit-card"></i>
                            <span class="text"> {{ trans('menu.my_ewallet')}}</span>
                        </a>
                    </li> 


                    <li class="has-sub {{set_active('user/fund-transfer')}}{{set_active('user/my-transfer')}}">
                        <a href="javascript:;">
                            
                            <span class="badge pull-right"></span>
                            <i class="fa fa-credit-card"></i> 
                            <span>{{ trans('menu.fund_transfer')}}</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="{{set_active('user/fund-transfer')}}"><a href="{{url('user/fund-transfer')}}">{{ trans('menu.fund_transfer')}}</a></li>
                            <li class="{{set_active('user/my-transfer')}}"><a href="{{url('user/my-transfer')}}">{{ trans('menu.my_transfer')}}</a></li>
                           
                        </ul>
                    </li>



          <!--            <li class="has-sub {{set_active('user/requestvoucher')}} {{set_active('user/myvoucher')}} ">
                        <a href="javascript:;">
                            
                            <span class="badge pull-right"></span>
                            <i class="fa fa-ticket"></i> 
                            <span>{{ trans('menu.Voucher')}}</span>
                        </a>
                        <ul class="sub-menu">
                         <li class="{{set_active('user/requestvoucher')}}"><a href="{{url('user/myvoucher')}}">{{ trans('menu.my_voucher')}}</a></li> 
                            <li class="{{set_active('user/requestvoucher')}}"><a href="{{url('user/requestvoucher')}}">{{ trans('menu.request_voucher')}}</a></li>
                           
                           
                        </ul>

                    </li> -->

                        @endif

                        @if($current_pack == 1)  

                         <li class="{{set_active('user/purchasedashboard')}}">
                        <a href="{{url('user/purchasedashboard')}}">
                            <i class="icon-home4"></i>
                            <span class="text"> Dashboard</span>
                        </a>
                    </li> 

                      <li class="{{set_active('user/profile')}}">
                        <a href="{{url('user/profile')}}">
                            <i class="glyphicon glyphicon-user"></i>
                            <span class="text"> {{trans('menu.profile')}}</span>
                        </a>
                    </li>   
                    @endif


		    <li class="{{set_active('user/runsoftware')}}">
                        <a href="{{url('user/runsoftware')}}">
                            <i class="icon-pushpin"></i>
                            <span class="text"> Run Software</span>
                        </a>
                    </li>  

                  

                            

                   <!--     <li class="{{set_active('user/compose')}}">
                        <a href="{{url('user/compose')}}">
                            <i class="fa fa-envelope"></i>
                            <span class="text"> Support</span>
                        </a>
                    </li>  -->

                  
                       <li class="{{set_active('user/news_read')}}">
                            <a href="{{url('user/news_read')}}">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="text">News</span>
                            </a>
                    </li> 
                    

                      @if($current_pack > 1)        

                     <li class="{{set_active('user/helpdesk/tickets-dashboard')}}">
                        <a href="{{url('user/helpdesk/tickets-dashboard')}}">
                            <i class="fa fa-envelope"></i>
                            <span class="text"> {{trans('menu.ticket_center')}}</span>
                        </a>
                    </li> 
                    
                   
                   
                    <li class="has-sub  {{set_active('user/payoutrequest')}} {{set_active('user/allpayoutrequest')}}">
                        <a href="javascript:;">
                            
                            <i class="fa fa-money"></i>
                            <span class="text">E payment</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="{{set_active('user/payoutrequest')}}" ><a href="{{url('user/payoutrequest')}}">Request</a></li>
                            <li class="{{set_active('user/allpayoutrequest')}}"><a href="{{url('user/allpayoutrequest')}}">View Payment</a></li>
                        </ul>
                    </li>

                      @endif        
                    <li class="has-sub {{set_active('user/documentdownload')}}{{set_active('user/allvideos')}}">
                        <a  href="javascript:;" >
                            
                            <i class="fa fa-wrench"></i>
                            <span class="text">Guides</span>
                        </a>
                        <ul class="sub-menu">
                            
                              <li class="{{set_active('user/documentdownload')}}"><a href="{{url('user/documentdownload')}}">Documents</a></li>

                              <li class="{{set_active('user/allvideos')}}"><a href="{{url('user/allvideos')}}">Videos</a></li>
                            
                            
                      
                        </ul>
                        
                    </li>
                  <!--    <li class="{{set_active('user/lead')}}">
                        <a href="{{url('user/lead')}}">
                            <i class="glyphicon glyphicon-user"></i>
                            <span class="text">{{ trans('menu.lead')}}</span>
                        </a>
                    </li> 
                     -->
                    


                    <li><a href="{{ url('/logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> Logout</a></li>
                    
								</ul>
						</div>
					</div>
					<!-- /main navigation -->
				</div>
			</div>
			<!-- /main sidebar -->

       
@endif


