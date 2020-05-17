@extends('app.user.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

{{-- Content --}}
@section('main')

    <div class="page-header">
        <h3>
            {{$title}}
        </h3>
    </div>

            
                
              

<div class="row">

<div>
<!-- <ol class="breadcrumb pull-right">-->
<div class="col-md-16 col-lg-16">
<div class="panel panel-default panel-block panel-title-block">
</div>

<ul class="nav nav-tabs panel panel-default panel-block">
<li class="active"><a href="#user-overview" data-toggle="tab">View My Referals</a></li>
</ul>
<div class="tab-content panel panel-default panel-block">
<div style="" class="tab-pane active" id="user-overview">
<ul class="list-group">

<li class="list-group-item">
<div class="row">
</li>
<div class="list-group-item">
<div class="form-group">
 <div class="table-responsive">
<table class="table table-condensed">
<thead class="">
<tr>
<th>Sl No</th>
<th>Username</th>
<th>Fullname</th>
<th>E-mail</th>
<th>Rank</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php $i = 1; ?>
@foreach ($users as $user)
<tr class="text-success text-bold">
<td>{!!$i++!!}</td>
<td>{!!$user[0]->username!!}</td>
<td>{!!$user[0]->name!!} {!!$user[0]->lastname!!}</td>
<td>{!!$user[0]->email!!}</td>
<td>Natus, quam sapiente molestias dolores vero repellendus repudiandae eius.</td>
<td>@if ($user[0]->confirmed === '1')Active @else Inactive @endif</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</ul>
</div>





</div>
</div>

</div>







                
              </div>
            </div>
         
        
  
@endsection
@section('scripts') @parent


@stop
