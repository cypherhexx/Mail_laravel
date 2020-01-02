@extends('app.user.layouts.sidenav')

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
    @include('app.user.partials.header')
@endsection

{{-- Sidebar --}}
@section('sidebar')
    @include('app.user.partials.sidebar')
@endsection

{{-- Page Header --}}
@section('page-header')
    @include('app.user.partials.page-header')
@endsection

{{-- Footer --}}
@section('footer')
    @include('app.user.partials.footer')
@endsection



{{-- Scripts --}}
@section('scripts')
@parent
@endsection

@section('overscripts')
@parent
<script type="text/javascript">window.CLOUDMLMSOFTWARE = {"signedIn":@if(Auth::User()) true @else false @endif,"csrfToken":"{{ csrf_token() }}","admin":false,"username":@if(Auth::User()) "{{$user->username}}" @else false @endif,"siteUrl":"{{ URL::to('/') }}","previousUrl":"{{ URL::previous() }}","currentUrl":"{{ URL::current() }}","usernamehash":"{{Crypt::encrypt($user->username)}}","LockUrl":"{!!url('lock/?loggedOut=').Crypt::encrypt($user->username).'&redirect='.URL::current()!!}","presence":{{$presence}},"idleTimeout":true,"idleTimeoutTime":5240000};
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