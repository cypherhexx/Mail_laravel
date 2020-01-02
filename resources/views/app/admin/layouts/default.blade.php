@extends('app.admin.layouts.sidenav')

{{-- Web site Title --}}
@section('title')
    Administration :: @parent
@endsection

{{-- Styles --}}
@section('styles')
    @parent
@endsection

{{-- Header --}}
@section('header')
    @include('app.admin.partials.header')
@endsection

{{-- Sidebar --}}
@section('sidebar')
    @include('app.admin.partials.sidebar')
@endsection

{{-- Page Header --}}
@section('page-header')
    @include('app.admin.partials.page-header')
@endsection

{{-- Footer --}}
@section('footer')
    @include('app.admin.partials.footer')
@endsection



{{-- Scripts --}}
@section('scripts')
@parent
@endsection

@section('overscripts')
@parent
<script type="text/javascript">window.CLOUDMLMSOFTWARE = {"signedIn":@if(Auth::User()) true @else false @endif,"csrfToken":"{{ csrf_token() }}","admin":true,"username":@if(Auth::User()) "{{$user->username}}" @else false @endif,"siteUrl":"{{ URL::to('/') }}","previousUrl":"{{ URL::previous() }}","currentUrl":"{{ URL::current() }}","usernamehash":"{{Crypt::encrypt($user->username)}}","LockUrl":"{!!url('lock/?loggedOut=').Crypt::encrypt($user->username).'&redirect='.URL::current()!!}","presence":{{$presence}},"idleTimeout":true,"idleTimeoutTime":900000}; /*15 minute is 900000 - 1 minute 60000*/ 

</script>
@endsection

@section('scripts')
@parent
<script type="text/javascript">
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CLOUDMLMSOFTWARE.csrfToken
        }
    });
</script>
@endsection