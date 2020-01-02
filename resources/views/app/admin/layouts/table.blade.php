
<div class="col-md-8 col-sm-12">
  <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
            <li class="nav-item active"><a href="#steps-newregisterd-tab1" class="nav-link  steps-leadership active  " data-toggle="tab" data-payment='newregiserd'>{{trans('adminuser.new_registered_users')}}</a>
            </li>
            <li class="nav-item"><a href="#steps-recruters-tab2" class="nav-link steps-plan-payment" data-toggle="tab" data-payment='BinaryMatchBonus'>{{trans('adminuser.top_recruiters')}}</a></li>
             <li class="nav-item"><a href="#steps-earners-tab3" class="nav-link steps-plan-payment" data-toggle="tab" data-payment='Top_earners'>{{trans('adminuser.top_earners')}}</a></li>
             <li class="nav-item"><a href="#steps-recent-tab4" class="nav-link steps-plan-payment" data-toggle="tab" data-payment='Top_earners'>{{trans('adminuser.recent_plan_topup')}}</a></li>
        </ul>
     <div class="panel">
        <div class="tab-content">
         <div class="tab-pane active  " id="steps-newregisterd-tab1"> 
           <div class="panel-body"> 
                 <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th></th>              
                                <th> Users </th>
                                <th> {{ trans('all.email') }} </th>
                                <!-- <th> Join date </th> -->
                            </tr>
                        </thead>
                        <tbody>
                       
                            @foreach($new_users as $user)
                            <tr>
                                <td>
                                    <div class="media-left media-middle">
                                        {{ Html::image(route('imagecache', ['template' => 'original', 'filename' => $user->profile]), 'Admin', array('class' => 'img-circle img-xs')) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <a href="{{url('admin/userprofiles/')}}/{{$user->username}}" target="_blank" class="letter-icon-title">{{$user->username}}</a>
                                        </div>
                                        <div class="text-muted text-size-small"><i class="icon-user-tie text-size-mini position-left"></i>{{$user->name}}</div>
                                         <div class="media-right media-middle text-nowrap">
                                    <span class="text-muted">
                                        <i class="icon-pin-alt text-size-base"></i>
                                        &nbsp;{!! $user->country !!}
                                    </span>
                                </div>
                                    </div> 
                                </td>
                              
                                <td>   
                                     <div class="media-body">
                                        <div class="media-heading">
                                           {{$user->email}}
                                        </div>
                                    </div>
                                </td>
                              <!--   <td>   
                                     <div class="media-body">
                                        <div class="media-heading">

                                            {{date('d-M-Y ',strtotime($user->created_at))}}
                                        
                                        </div>
                                    </div>
                                </td> -->
                                   <td>   
                                    <a href="{{url('/admin/genealogy?st='.$user->username)}}" target="_blank" class="button btn bg-blue btn-xs"><i class="icon-tree5 position-left"></i></a>
                                    <a href="{{url('/admin/userprofiles',$user->username )}}" target="_blank" class="button btn bg-blue btn-xs"><i class="icon-user position-left"></i></a>
                                </td>
                             </tr>
                            @endforeach
                         </tbody>
                          </table>
                 </div>                                                                             
                </div>       
        </div>
           
          
          <div class="tab-pane   " id="steps-recruters-tab2">
               <div class="panel-body">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th></th>
                              <th> Users</th>
                                <th> {{ trans('all.count') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_recruiters as $user)
                            <tr>
                                <td>
                                    <div class="media-left media-middle">
                                        {{ Html::image(route('imagecache', ['template' => 'original', 'filename' => $user->profile]), 'Admin', array('class' => 'img-circle img-xs')) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <a href="{{url('admin/userprofiles/')}}/{{$user->username}}" target="_blank" class="letter-icon-title">{{$user->username}}</a>
                                        </div> <div class="text-muted text-size-small"><i class="icon-user-tie text-size-mini position-left"></i>{{$user->name}}</div>
                                    </div>
                                 </td>
                                  
                                      <td>
                                        <div class="media-body">
                                        <div class="media-heading">

                                             <span class="label label-flat border-primary text-primary-600 label-icon">
                                        {{$user->count}}
                                    </span>
                                           
                                        </div></div>
                                    </td>
                                     <td>
                                         <a href="{{url('/admin/genealogy?st='.$user->username)}}" target="_blank" class="button btn bg-blue btn-xs"><i class="icon-tree5 position-left"></i></a>
                                    <a href="{{url('/admin/userprofiles',$user->username )}}" target="_blank" class="button btn bg-blue btn-xs"><i class="icon-user position-left"></i></a>
                                    </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
             
           
         
           <div class="tab-pane " id="steps-earners-tab3">
               <div class="panel-body">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th> Users </th>
                                <th> {{ trans('all.balance') }}</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_earners as $user)
                            <tr>
                                <td>
                                    <div class="media-left media-middle">
                                        {{ Html::image(route('imagecache', ['template' => 'original', 'filename' => $user->profile]), 'Admin', array('class' => 'img-circle img-xs')) }}
                                    </div></td>
                                   <td>
                                      <div class="media-body">
                                        <div class="media-heading">
                                            <a href="{{url('admin/userprofiles/')}}/{{$user->username}}" target="_blank" class="letter-icon-title">{{$user->username}}</a>
                                        </div>
                                    <div class="text-muted text-size-small"><i class="icon-user-tie text-size-mini position-left"></i>{{$user->name}}</div></div></td>
                              
                                      <td>  <div class="media-body">
                                        <div class="media-heading">

                                               <span class="label label-flat border-primary text-primary-600 label-icon">
                                          {{$currency_sy}} {{$user->balance}}
                                    </span>
                                       
                                        </div></div>
                                    </td>
                                    <td>
                                         <a href="{{url('/admin/genealogy?st='.$user->username)}}" target="_blank" class="button btn bg-blue btn-xs"><i class="icon-tree5 position-left"></i></a>
                                    <a href="{{url('/admin/userprofiles',$user->username )}}" target="_blank" class="button btn bg-blue btn-xs"><i class="icon-user position-left"></i></a>
                                    </td>
                                  
                              
                               
                             
                            </tr>
                            @endforeach
                        </tbody>
                         </table>
                  </div>
                   
                </div>
            </div>
                 <div class="tab-pane " id="steps-recent-tab4">
               <div class="panel-body">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th></th>
                          <th> Users </th>
                                <th>{{ trans('all.amount') }}</th>
                                <!-- <th>Date</th> -->
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent as $user)
                            <tr>
                                <td>

                                    <div class="media-left media-middle">
                                        {{ Html::image(route('imagecache', ['template' => 'original', 'filename' => $user->profile]), 'Admin', array('class' => 'img-circle img-xs')) }}
                                    </div></td>
                                   <td>
                                      <div class="media-body">
                                        <div class="media-heading">
                                            <a href="{{url('admin/userprofiles/')}}/{{$user->username}}" target="_blank" class="letter-icon-title">{{$user->username}}</a>
                                        </div><div class="text-muted text-size-small"><i class="icon-user-tie text-size-mini position-left"></i>{{$user->name}}</div></div></td>
                            
                                      <td>  <div class="media-body">
                                        <div class="media-heading">
                                              <span class="label label-flat border-primary text-primary-600 label-icon">
                                         {{$currency_sy}} {{$user->total_amount}}
                                    </span>
                                        
                                        </div></div>
                                    </td>
                                      <!--  <td>   
                                     <div class="media-body">
                                        <div class="media-heading">
                                           {{$user->created_at}}
                                        </div>
                                    </div>
                                </td> -->
                                  <td>
                                       <a href="{{url('/admin/genealogy?st='.$user->username)}}" target="_blank" class="button btn bg-blue btn-xs"><i class="icon-tree5 position-left"></i></a>
                                    <a href="{{url('/admin/userprofiles',$user->username )}}" target="_blank" class="button btn bg-blue btn-xs"><i class="icon-user position-left"></i></a>
                                  </td>
                              
                               
                             
                            </tr>
                            @endforeach
                        </tbody>
                         </table>
                  </div>
                   
                </div>
            </div>
           
          </div>
        </div>
        </div>
    </div>
