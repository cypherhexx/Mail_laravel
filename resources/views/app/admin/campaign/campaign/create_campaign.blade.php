@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

@section('page_class', 'sidebar-main-hidden ') 

@section('styles')
@parent
@endsection

@section('sidebar')
@parent

@include('app.admin.campaign.sidebar')
<!-- /secondary sidebar -->
@endsection




{{-- Content --}}
@section('main')
<!-- Single line -->

		

<div id="campaigns-page">

	<form class="form-horizontal" action="{{ url('admin/campaign/save')}}" method="POST">
		{!!  csrf_field() !!}
		  
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h5 class="panel-title">Create Campaign<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
								<div class="heading-elements">
									<ul class="icons-list">
				                		<li><a data-action="collapse"></a></li>
				                		<li><a data-action="reload"></a></li>
				                		<li><a data-action="close"></a></li>
				                	</ul>
			                	</div>
							</div>

							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<fieldset>
											<legend class="text-semibold"><i class="icon-git-branch position-left"></i> Campaign details</legend>

											<div class="form-group">
												<label class="col-lg-3 control-label">Campaign name:</label>
												<div class="col-lg-9">
													<input type="text" name="name" class="form-control" placeholder="Cloud MLM email campaign" value="{{isset($emailcampaign->name)? $emailcampaign->name :'Cloud MLM email campaign'}}">
												</div>
											</div> 	
											<div class="form-group">
												<label class="col-lg-3 control-label">customer group:</label>
												<div class="col-lg-9">
													<select name="customer_group" class="form-control">
														<option>all</option>
													</select>
												</div>
											</div> 											 
										</fieldset>
									</div>

									<div class="col-md-6">
										<fieldset>
						                	<legend class="text-semibold"><i class="far fa-clock position-left"></i> Email details</legend>

											<div class="form-group">
												<label class="col-lg-3 control-label">From name:</label>
												<div class="col-lg-9">
													<div class="row">
														<div class="col-md-6">
															<input type="text" name="first_name" placeholder="From name" value="{{isset($emailcampaign->first_name)? $emailcampaign->first_name :'CloudMLM'}}" class="form-control">
														</div>

														<div class="col-md-6">
															<input type="text" name="last_name" placeholder="Last name" value="{{isset($emailcampaign->last_name)? $emailcampaign->last_name :'Software'}}" class="form-control">
														</div>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-lg-3 control-label">From Email:</label>
												<div class="col-lg-9">
													<input type="text" placeholder="campaign@cloudmlm.com" value="{{isset($emailcampaign->from_email)? $emailcampaign->from_email :'campaign@cloudmlm.com'}}" name="from_email" class="form-control">
												</div>
											</div>

											<div class="form-group">
												<label class="col-lg-3 control-label">Subject:</label>
												<div class="col-lg-9">
													<input type="text" placeholder="CloudMLM Registration Event " value="{{isset($emailcampaign->subject)? $emailcampaign->subject :'CloudMLM Registration Event'}} " name="subject" class="form-control">
												</div>
											</div>
											<legend class="text-semibold"><i class="icon-time position-left"></i> Set up your schedule</legend>

											<div class="form-group">
												<label class="col-lg-3 control-label">Send at a specific date:</label>
												<div class="col-lg-9">
													<input type="text" name="datetime" id="campaign-date-time" placeholder="date time" value="{{isset($emailcampaign->datetime)? $emailcampaign->datetime :''}}" class="form-control">
												</div>
											</div> 
											 
										</fieldset>
									</div>
								</div>

								<div class="row">

									<div class="col-md-12">
										<fieldset>
											<legend class="text-semibold"><i class=" position-left"></i> Email body</legend>

											<div class="form-group">
												<div class="col-lg-12">
													<textarea  name="campaignemail" id="campaign-email" class="form-control">
														@if(isset($emailcampaign->campaignemail))
														{{$emailcampaign->campaignemail}}
														@else
															@include('app.admin.campaign.campaign.campaigns-default-email')
														@endif
													</textarea>


													 
												</div>
											</div> 											 
										</fieldset>
									</div>

								</div>

								<div class="text-right">
									<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
								</div>
							</div>
						</div>
					</form>

   
</div>
<!-- /single line -->
@stop

{{-- Scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
</script>
@stop
