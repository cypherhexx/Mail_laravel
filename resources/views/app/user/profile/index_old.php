@extends('app.user.layouts.default')

{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}

@section('main')

<div class="row">



    <div id="content" class="">    

            <div class="col-md-16 col-lg-16">

                <div class="panel panel-default panel-block panel-title-block">

                    <div class="panel-heading clearfix">

                        @include('utils.vendor.flash.message')

                         @include('utils.errors.list') 

                        <div class="avatar">

                            <img src="{{asset('public/appfiles/images/profileimages/thumbs/'.$profile_infos->image)}}" alt="">

                            <div class="overlay">

                                <div class="controls clearfix">
                                    <a href="javascript:;"><i class="icon-search"></i></a>
                                    <a href="javascript:;"><i class="icon-undo"></i></a>
                                    <a class="edit-item" href="javascript:;"><i class="icon-pencil"></i></a>
                                    <a class="trash-item" href="javascript:;"><i class="icon-trash"></i></a>
                                </div>
                                <div class="controls confirm-removal clearfix">
                                </div>
                            </div>
                        </div>

                        <h4>{!!$user->username!!}</h4>
                        <small>
                             <b class="text-bold">{{trans('profile.position')}}:</b> {{$GLOBAL_PACAKGE}}
                        </small>
                    </div>

                </div>



                <ul class="nav nav-tabs panel panel-default panel-block">

                    <li class="active"><a href="#user-overview" data-toggle="tab">{{trans('profile.overview')}}</a></li>

                    <li><a href="#user-settings" data-toggle="tab">{{trans('profile.edit_profile')}}</a></li>
                    <li><a href="#panel_currency" data-toggle="tab">{{trans('profile.currency_settings')}}</a></li>
                    <!-- <li><a href="#rs-settings" data-toggle="tab">{{ trans('profile.rs_top_up')}}</a></li> -->
                    <!-- <li><a href="#leg-settings" data-toggle="tab">{{ trans('profile.default_leg_setup')}}</a></li> -->
                    <li><a href="#psw-settings" data-toggle="tab">{{ trans('profile.change_password')}}</a></li>

                </ul>

                <div class="tab-content panel panel-default panel-block"> 
                
                <div style="" class="tab-pane " id="psw-settings">
                     <ul class="list-group">
                            <li class="list-group-item">
                                <h4>{{ trans('profile.change_your_password')}}</h4>
                                <form method="post" action="{{ url('user/getEdit')}}" >
                                    <input type="hidden" name="_token" value="{{csrf_token() }}">
                                    <!--<div class="form-group">
                                       <div class="row">
                                             <label class="form-label col-sm-offset-2 col-sm-3">Old password</label>
                                             <div class="col-sm-6 ">
                                                    <select class="form-control" name="leg" id="leg">
                                                 </select>
                                                </div>        
                                             <label class="form-label col-sm-offset-2 col-sm-3">New password</label>
                                               <div class="col-sm-6 ">
                                                    <select class="form-control" name="leg" id="leg">
                                                 </select>
                                                </div> 
                                             <label class="form-label col-sm-offset-2 col-sm-3">Change password</label>
                                               <div class="col-sm-6 ">
                                                    <select class="form-control" name="leg" id="leg">
                                                 </select>
                                                </div> 
                                                
                                       </div>
                                    </div>-->
        
                    

            <div class="col-md-12"  style="margin-bottom: 15px;">
                <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
                    <label class="col-md-4 control-label" for="newpassword">{{trans('profile.new_password')}}</label>
                    <div class="col-md-8">
                        <input class="form-control" tabindex="5"
                            placeholder="{{trans('profile.new_password')}}"
                            type="password" name="password" id="password" value="" />
                        {!!$errors->first('newpassword', '<label class="control-label"
                            for="password">:message</label>')!!}
                    </div>
                </div>
       
            </div>
            <div class="col-md-12">
                <div class="form-group {{{ $errors->has('change_password') ? 'has-error' : '' }}}">
                    <label class="col-md-4 control-label" for="change_password">{{ trans('profile.change_password')}}</label>
                    <div class="col-md-8">
                        <input class="form-control" type="password" tabindex="6"
                            placeholder="{{ trans('profile.change_password')}}"
                            name="change_password" id="change_password" value="" /><br/>
                        {{$errors->first('change_password', '<label
                            class="control-label" for="change_password">:message</label>')}}
                    </div>
                </div>
            </div>
             
                                    <div class="form-group">
                                       <div class="row">
                                            <div class="col-sm-offset-5" >
                                                <button class="btn btn-primary " type="submit">{{trans('profile.update')}}</button>
                                            </div>
                                       </div>
                                    </div>
                                </form>
                            </li>
                        </ul>

                    </div>
                           
                     <div style="" class="tab-pane " id="leg-settings">
                     <ul class="list-group">
                            <li class="list-group-item">
                                <h4>{{ trans('profile.choose_your_default_leg')}}</h4>
                              <form method="post" action="{{ url('user/leg-setting')}}" >
                                    <input type="hidden" name="_token" value="{{csrf_token() }}">
                                    <div class="form-group">
                                       <div class="row">
                                             <label class="form-label col-sm-offset-2 col-sm-3">{{ trans('profile.choose_leg')}}</label>
                                                <div class="col-sm-6 ">
                                                    <select class="form-control" name="leg" id="leg">
                                                       <option @if(Auth::user()->default_leg == 'yes') selected=""  @endif value="auto"> {{ trans('profile.automatic')}}</option>
                                                       <option @if(Auth::user()->default_leg == 'L') selected=""  @endif value="L">{{ trans('profile.left_leg')}}</option>
                                                       <option @if(Auth::user()->default_leg == 'R') selected=""  @endif value="R"> {{ trans('profile.right_leg')}}</option>
                                                    </select>
                                                </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="row">
                                            <div class="col-sm-offset-5">

                                                 <button class="btn btn-primary " type="submit">{{trans('profile.update')}}</button>
                                            </div>
                                       </div>
                                    </div>
                                </form>
                            </li>
                        </ul>

                    </div>
                    <div style="" class="tab-pane " id="rs-settings">
                         <ul class="list-group">

                            <li class="list-group-item">

                                <h4>{{trans('profile.choose_your_rs_top_up')}} </h4>

                                <form method="post" action="{{url('user/rs-setting') }}" >
                                    <input type="hidden" name="_token" value="{{csrf_token() }}">
                                    <div class="form-group">
                                       <div class="row">
                                             <label class="form-label col-sm-offset-2 col-sm-3">{{trans('profile.choose_rs_type')}}</label>
                                                <div class="col-sm-6 ">
                                                    <select class="form-control" name="auto_rs" id="auto_rs">
                                                       <option @if(Auth::user()->auto_rs =='yes') selected=""  @endif value="yes">{{trans('profile.automatic')}}</option>
                                                       <option  @if(Auth::user()->auto_rs =='no') selected=""  @endif  value="no">{{trans('profile.manual')}}</option>
                                                    </select>
                                                </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="row">
                                            <div class="col-sm-offset-5">
                                                 <button class="btn btn-primary " type="submit">{{trans('profile.update')}}</button>
                                            </div>
                                       </div>
                                    </div>
                                </form>
                            </li>
                        </ul>

                    </div>
                    <div style="" class="tab-pane " id="panel_currency">
                         <ul class="list-group">

                            <li class="list-group-item">

                                <h4>{{trans('profile.choose_your_currency')}}</h4>

                                <form method="post" action="{{ url('user/currency')}}" >
                                    <input type="hidden" name="_token" value="{{csrf_token() }}">
                                    <div class="form-group">
                                       <div class="row">
                                             <label class="form-label col-sm-offset-2 col-sm-3">{{trans('profile.choose_currency')}}</label>
                                                <div class="col-sm-6 ">
                                                    <select class="form-control" name="currency" id="currency">
                                                        @foreach($currencies as $item)
                                                            <option 

                                                             @if(Auth::user()->currency == $item->id ) selected @endif

                                                             value="{{ $item->id}}">{{ $item->currency_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="row">
                                            <div class="col-sm-offset-5">
                                                 <button class="btn btn-primary " type="submit">{{trans('profile.update')}}</button>
                                            </div>
                                       </div>
                                    </div>
                                </form>
                            </li>
                        </ul>

                    </div>
                
                    <div style="" class="tab-pane active" id="user-overview">

                        <ul class="list-group">

                            <li class="list-group-item">

                                <h4>{{trans('profile.about_me')}}</h4>

                               <p>{!!$profile_infos->about!!}</p>
                            </li>

                            <li class="list-group-item">

                                <div class="row">

                                    <div class="col-md-12">

                                        <h4>{{trans('profile.user_status')}}</h4>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 col-sm-6">

                                            <div class="widget widget-stats bg-green">

                                                <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>

                                                <div class="stats-title"> {{trans('profile.member_current_position')}} </div>

                                                <div class="stats-number">{{$GLOBAL_PACAKGE}}</div>

                                                <div class="stats-progress progress">

                                                    <div class="progress-bar" style="width: 70%;"></div>

                                                </div>

                                                <div class="stats-desc"> {{trans('profile.member_current_position')}} </div>

                                            </div>

                                        </div>


                                        <div class="col-md-3 col-sm-6">

                                            <div class="widget widget-stats bg-blue">

                                                <div class="stats-icon stats-icon-lg"><i class="fa fa-tags fa-fw"></i></div>

                                                <div class="stats-title">{{trans('profile.left_group_accumulate_bv')}}</div>

                                                <div class="stats-number"> {{$left_bv}}</div>

                                                <div class="stats-progress progress">

                                                    <div class="progress-bar" style="width: 70%;"></div>

                                                </div>

                                                <div class="stats-desc">{{trans('profile.left_group_accumulate_bv')}}</div>

                                            </div>

                                        </div>              

                                        <div class="col-md-3 col-sm-6">

                                            <div class="widget widget-stats bg-purple">

                                                <div class="stats-icon stats-icon-lg"><i class="fa fa-tags-cart fa-fw"></i></div>

                                                <div class="stats-title">{{trans('profile.right_group_accumulate_bv')}}</div>

                                                <div class="stats-number"> {{$right_bv}} </div>

                                                <div class="stats-progress progress">

                                                    <div class="progress-bar" style="width: 70%;"></div>

                                                </div>

                                                <div class="stats-desc">{{trans('profile.right_group_accumulate_bv')}}</div>

                                            </div>

                                        </div> 

                                       <div class="col-md-3 col-sm-6">

                                            <div class="widget widget-stats bg-black">

                                                <div class="stats-icon stats-icon-lg"><i class="fa fa-google-wallet fa-fw"></i></div>

                                                <div class="stats-title">{{trans('profile.total_income')}} </div>

                                               

                                                <div class="stats-progress progress">

                                                    <div class="progress-bar" style="width: 70%;"></div>

                                                </div>

                                                <div class="stats-desc">{{trans('profile.total_income')}}</div>

                                            </div>

                                        </div> 

                                    </div> 

                            </li>

                            <div class="list-group-item">

                                <div class="form-group">

                                    <h4>{{trans('profile.my_referrals')}}</h4>

                                    <div class="table-responsive">

                                        <table class="table table-condensed">

                                        @if($total_referals>0)

                                            <thead class="">

                                                <tr>

                                                    <th>{{trans('profile.username')}}</th>

                                                    <th>{{trans('profile.e_mail')}}</th>

                                                    <th>{{trans('profile.full_name')}}</th>

                                                    <th>{{trans('profile.position')}}</th>

                                                    <th>{{trans('profile.date_of_join')}}</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            

                                            @foreach ($referals as $refs)

                                                <tr class="text-success text-bold">

                                                    <td>{!!$refs->username!!}</td>

                                                    <td>{!!$refs->email!!}</td>

                                                    <td>{!!$refs->name!!} {!!$refs->lastname!!}</td>

                                                    <td>{{$refs->packagename}}</td>

                                                     <td>{{ date('d M Y',strtotime($refs->created_at))}}</td>


                                                </tr>

                                            @endforeach

                                           

                                            </tbody>

                                             @else

                                             <tr class="text-success text-bold">

                                                    <td>{{trans('profile.no_data_found')}}</td>

                                             </tr>

                                             @endif

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </ul>

                        </div>





                        <div class="tab-pane scrollable list-group" id="user-settings">



                           {!! Form::open(array('url' => 'user/profile/edit/'.$user->id,'enctype'=>'multipart/form-data')) !!}

                            <div class="list-group-item form-horizontal">

                                <h4>

                                   {{trans('profile.basic_information')}}
                                  

                                </h4>



                                <div class="form-group">
                                    {{trans('profile.first_name')}}

                                    {!! Form::label('firstname', '  ',array('class'=>'control-label')) !!} {!! Form::text('firstname',$user->name, array('class'=>'form-control','required'=>'true','placeholder'=>$user->lastname,'value'=>$user->name ,'onkeypress'=>'return alpha(event)')) !!}



                                </div>

                                <div class="form-group">
                                    {{trans('profile.last_name')}}

                                    {!! Form::label('lastname', ' ',array('class'=>'control-label')) !!} {!! Form::text('lastname',$user->lastname, array('class'=>'form-control','required'=>'true', 'onkeypress'=>'return alpha(event)')) !!}



                                </div>

                                <div class="form-group">

                                    <label class="control-label">

                                        {{trans('profile.date_of_birth')}}

                                    </label>

                                    <div class="row">

                                        <div class="col-md-4">

                                            {!! Form::select('dd', $ddArr, $dateofbirth[0],array('class'=>'form-control','required'=>'true')) !!}

                                        </div>

                                        <div class="col-md-4">

                                            {!! Form::selectMonth('mm',$dateofbirth[1],array('class'=>'form-control')) !!}

                                        </div>

                                        <div class="col-md-4">

                                            {!! Form::selectRange('year', 1975, Date('Y')-10,$dateofbirth[2],array('class'=>'form-control')) !!}

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <lablel for="country_id">{{trans('profile.select_country')}}:</lablel>

                                    <select name="country" id="country_id" class="form-control">

                                        @foreach($categories as $country )

                                        <option value="{{ $country->id }}">{{ $country->full_name }}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div id="state_div">

                                </div>

                                   <div class="form-group">

                                    <label class="control-label">

                                        {{trans('profile.gender')}}

                                    </label>

                                    <div>

                                        <label class="radio-inline">

                                            <div class="iradio_minimal-grey" style="position: relative;">

                                              
                                                @if( $profile_infos->gender == 'm') {!! Form::radio('gender','m' ,true,array('class'=>'grey','checked'=>"checked")); !!} @else {!! Form::radio('gender','f' , true,array('class'=>'grey','checked'=>"checked")); !!} @endif


                                                <ins class="iCheck-helper"></ins>

                                            </div>

                                            {{trans('profile.male')}}

                                        </label>

                                        <label class="radio-inline">

                                            <div class="iradio_minimal-grey" style="position: relative;">



                                               @if( $profile_infos->gender == 'f') {!! Form::radio('gender','f' , true,array('class'=>'grey','checked'=>"checked")); !!} @else {!! Form::radio('gender','f' , '',array('class'=>'grey')); !!} @endif





                                                <ins class="iCheck-helper"></ins>

                                            </div>

                                            {{trans('profile.female')}}

                                        </label>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>

                                        {{trans('profile.image_upload')}}

                                    </label>

                                    <div class="fileupload fileupload-new" data-provides="fileupload">

                                        <div class="fileupload-new thumbnail" style="width: 150px; height: 150px;"><img src="{{ url('public/appfiles/images/profileimages/thumbs/'.$profile_infos->image)  }}" alt="">

                                        </div>

                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 20px;"></div>

                                        <div class="user-edit-image-buttons">

                                            <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> {{trans('profile.select_image')}}</span><span class="fileupload-exists"><i class="fa fa-picture"></i> {{trans('profile.change')}}</span>

                                            <input type="file" name="profile_pic">

                                            </span>

                                            <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">

                                                <i class="fa fa-times"></i> {{trans('profile.remove')}}

                                            </a>

                                        </div>

                                    </div>

                                    <label class="col-md-2 control-label" style="visibility: hidden;">{{trans('profile.change_avatar')}}</label>

                                    <div class="col-md-10">

                                        <div class="fileinput fileinput-new" data-provides="fileinput">

                                            <div class="input-group" style="visibility: hidden;">



                                                <a href="#" hidden="true" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">{{trans('profile.remove')}}</a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                

 <h4>

                        {{trans('profile.payment_information')}}

                    </h4>

                    <div class="form-group">

                        <label for="countrycode" class=" control-label">{{trans('profile.account_holder_name')}} </label>

                       
                            <input id="account_holder_name" name="account_holder_name" class="form-control" value="{{$profile_infos->account_holder_name}}">

                    </div>

                     <div class="form-group">

                        <label for="countrycode" class=" control-label">{{trans('profile.bank_ccount_umber')}}</label>

                       
                            <input id="account_number" name="account_number" class="form-control" value="{{$profile_infos->account_number}}">

                    </div>
                     <div class="form-group">

                        <label for="twitter" class=" control-label">{{trans('profile.account_holder_address')}}</label>                       

                            <input id="paypal" name="paypal" class="form-control" value="{{$profile_infos->paypal}}">

                    </div>

                    <div class="form-group">

                        <label for="website" class=" control-label">{{trans('profile.bank_branch_swift_code')}}</label>

                        
                            <input id="swift" name="swift" class="form-control" value="{{$profile_infos->swift}}">

                      

                    </div>

                    <div class="form-group">

                        <label for="fb" class=" control-label">{{trans('profile.bank_company_name')}}</label>

                      
                            <input id="sort_code" name="sort_code" class="form-control" value="{{$profile_infos->sort_code}}">

                      
                    </div>

                    <div class="form-group">

                        <label for="twitter" class=" control-label">{{trans('profile.bank_branch_address')}}</label>

                        

                            <input id="bank_code" name="bank_code" class="form-control" value="{{$profile_infos->bank_code}}">

                        

                    </div>

                    




                                <h4>

{{trans('profile.contact_information')}}

</h4>

                                <div class="form-group">
                                    {{trans('profile.email_address')}}

                                    {!! Form::label('email', ' ',array('class'=>'control-label')) !!} {!! Form::email('email',$user->email, array('class'=>'form-control','required'=>'true', 'onkeypress'=>'return alpha(event)')) !!}



                                </div>

                                <div class="form-group">
                                    {{trans('profile.mobile')}}

                                    {!! Form::label('mobile', ' ',array('class'=>'control-label')) !!} {!! Form::text('mobile',$profile_infos->mobile, array('class'=>'form-control','required'=>'true', 'onkeypress'=>'return alpha(event)')) !!}



                                </div>

                                <div class="form-group">
                                     {{trans('profile.zip')}}

                                    {!! Form::label('zipcode', ' ',array('class'=>'control-label')) !!} {!! Form::text('zipcode',$profile_infos->zip, array('class'=>'form-control','required'=>'true', 'onkeypress'=>'return alpha(event)')) !!}



                                </div>



                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            {{trans('profile.address_1')}}

                                              {!! Form::label('address1', ' ',array('class'=>'control-label')) !!} {!! Form::textarea('address1',$profile_infos->address1, array('class'=>'form-control','required'=>'true', )) !!}

                                        </div>
                                        <div class="col-sm-6">
                                             {{trans('profile.address_2')}}

                                    {!! Form::label('address2', ' ',array('class'=>'control-label')) !!} {!! Form::textarea('address2',$profile_infos->address2, array('class'=>'form-control' )) !!}

                                        </div>
                                    </div>
                                  


                                </div>

                                <div class="form-group">
                                    {{trans('profile.about_me')}}

                                    {!! Form::label('about', ' ',array('class'=>'control-label')) !!} {!! Form::textarea('prof_details',$profile_infos->about, array('class'=>'form-control' )) !!}


                                </div>
                                </br>
                                </br>
                                <div class="row">
                                    <div class="col-md-4 pull-right text-right">
                                       

                                        <button type="submit" class="btn btn-primary">
                                        {{trans('profile.update')}}
                                   </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
  

@endsection

@section('scripts') @parent

<script src="{{asset('assets/user/js/bootstrap-fileupload/bootstrap-fileupload.min.js')}}"></script>
<script src="{{ asset('assets/globals/plugins/Gritter/js/jquery.gritter.js') }}"></script><!-- jQuery gritter-->



<script>

 $(document).ready(function() {

            App.init();

            

       });

var company2 = document.getElementById('country_id');
$('#country_id').change(function()
{

    var country = document.getElementById('country_id').value;

       $.get( 

        'states/'+country,

         { id: country },

         function(response) {

            if (response) {

           document.getElementById('state_div').innerHTML = response;

            } else {

               alert('username taken');

            }

         }  

    );

 

});






function alpha(e) {

    var k;

    document.all ? k = e.keyCode : k = e.which;

    return (((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8  || (k >= 48 && k <= 57))&& k != 32);

}

</script>



@stop

