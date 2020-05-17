@extends('app.user.layouts.default')



{{-- Web site Title --}}

@section('title') {{{ $title }}} :: @parent @stop

@section('styles')



@endsection

{{-- Content --}}

@section('main')



      @include('utils.errors.list')



<div class="panel panel-success" >

	<div class="panel-heading">

    	<div class="panel-heading-btn">

			

            

            

            

        </div>

        <h4 class="panel-title">{{trans('report.group_sales_report')}}</h4>

     </div>

     <div class="panel-body"> 

     <form action="{{URL::to('user/groupsalesbonus')}}" method="post">

     	<input type="hidden" name="_token"  value="{{csrf_token()}}">

     	
        <div class="row">

     		<div class="form-group col-sm-6">

	     		<label class="form-label col-sm-3">{{trans('report.pick_start_date')}}</label>

	     		<div class="col-sm-6">

	     			<div class="input-group"> 

	     				<input type="text" autocomplete="off" class="form-control datetimepicker" name="start" id="start"  required="true">

	     			<label for="start" class="input-group-addon"> <i class="fa fa-calendar open-datetimepicker" style=" color: #5B5B5B;"></i></label>

	     			</div>

	     		</div>

	     	</div>

	     	<div class="form-group col-sm-6">

	     		<label class="form-label col-sm-3">{{trans('report.pick_end_date')}}</label>

	     		<div class="col-sm-6">

	     			<div class="input-group"> 

	     				<input type="text" autocomplete="off" class="form-control datetimepicker" name="end" id="end"  required="true">

	     				<label for="end" class="input-group-addon"> <i class="fa fa-calendar open-datetimepicker" style=" color: #5B5B5B;"></i></label>

	     			</div>

	     		</div>

	     	</div>

     	</div>







<div class="row">

            <div class="form-group col-sm-4">

                <label class="form-label col-sm-4">{{trans('report.filter_group')}}</label>

                <div class="col-sm-8">
                    <select class="form-control" name="package" id="package" >
                        <option value="">none</option>
                        @foreach($packages as $item)
                            <option value="{{$item->id}}">{{$item->package }}</option>
                        @endforeach
                    </select>   
                       
                </div>

            </div>

              <div class="form-group col-sm-4">

                <label class="form-label col-sm-6">{{trans('report.filter_sponsor')}}</label>

                <div class="col-sm-6">
                     <select class="form-control" name="sponsor" id="sponsor" >
                        <option value="">none </option>
                          @if(Auth::user()->package == 4) 
                            <option value="{{Auth::user()->id}}">{{Auth::user()->username}} </option>
                         @endif
                        @foreach($sponsor as $item)
                            <option value="{{$item['id']}}">{{$item['username'] }}</option>
                        @endforeach
                    </select> 
                </div>

            </div>

              <div class="form-group col-sm-4">

                <label class="form-label col-sm-6">{{trans('report.filter_by_username')}}</label>

                <div class="col-sm-6">

                    <select class="form-control" name="username" id="username" >
                         <option value="">none </option>
                         @if(Auth::user()->package == 4) 
                            <option value="{{Auth::user()->id}}">{{Auth::user()->username}} </option>
                         @endif
                         
                        @foreach($sponsor as $item)
                            <option value="{{$item['id']}}">{{$item['username'] }}</option>
                        @endforeach
                    </select> 
                 
                </div>

            </div>

           

        </div>







     	

     	<div class="form-group col-sm-offset-6" >

     		<button type="submit" class="btn btn-primary">{{trans('report.filter_groupget_report')}}</button>

     	</div>



     	

     </form>  



                     

	</div>

</div>

                  



            

@endsection







@section('scripts') @parent

    <script>

        $(document).ready(function() {

            App.init(); 

            $(".datetimepicker").datepicker()          

        });

        $('#username').change(function() {
            $('select#sponsor option').removeAttr("selected");
            $('select#package option').removeAttr("selected");
        });
        $('#sponsor').change(function() {
            $('select#username option').removeAttr("selected");
            $('select#package option').removeAttr("selected");
        });
        $('#package').change(function() {
            $('select#username option').removeAttr("selected");
            $('select#sponsor option').removeAttr("selected");
        });







       



        

    </script>

    @endsection