@extends('app.admin.layouts.default')
@section('page_class', 'sidebar-main-hidden ') 
{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop
@section('styles')
@parent
@endsection

@section('sidebar')
@parent
<!-- Secondary sidebar -->
<div class="sidebar sidebar-secondary sidebar-default">
    <div class="sidebar-content">
        <!-- Actions -->
        <div class="sidebar-category">
            <div class="category-title">
                <span>
                    {{trans('mail.actions')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="category-content">
                <a class="btn bg-indigo-400 btn-block" href="#" id="composeMailbtn">
                   {{trans('mail.compose_mail')}}
                </a>
            </div>
        </div>
        <!-- /actions -->
        <!-- Sub navigation -->
        <div class="sidebar-category">
            <div class="category-title">
                <span>
                    {{trans('mail.navigation')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="category-content no-padding">
                <ul class="navigation navigation-alt navigation-accordion no-padding-bottom">
                    <li class="navigation-header">
                        {{trans('mail.folders')}}
                    </li>
                    <li class="">
                        <a href="#" id="showInBox">
                            <i class="icon-drawer-in">
                            </i>
                           {{trans('mail.inbox')}}
                            <span class="badge badge-success">
                                {{$unread_count}}
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="#" id="showOutBox">
                            <i class="icon-drawer-out">
                            </i>
                            {{trans('mail.send_mail')}}
                        </a>
                    </li>

                    <li class="navigation-divider">
                    </li>


                </ul>
            </div>
        </div>
        <!-- /sub navigation -->

        <!-- Latest messages -->
        <div class="sidebar-category">
            <div class="category-title">
                <span>
                   {{trans('mail.latest_messages')}}
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>

            <div class="category-content no-padding">
                <ul class="media-list media-list-linked left-mail-links">

                    @if($limit_out_mail>0)

                    {{--//$filtered = $all_mail->whereNotIn('username', 'admin');
                    //$filteredunread = $filtered->whereNotIn('read', 'yes');--}}
                    @php
                    $filtered = $all_mail;
                    @endphp

                    @foreach ($filtered as $mail)

                    @php



                    if(!isset($mail->profile) || $mail->profile === '600'){
                        $profilepic = 'avatar-big.png';
                    }else{
                        $profilepic = $mail->profile;
                    }
                    $subject = preg_replace('/(\>)\s*(\<)/m', '$1$2', $mail->message_subject);
                    $message = preg_replace('/(\>)\s*(\<)/m', '$1$2', $mail->message);
                    @endphp

                    <li class="media">
                        <a href="#" class="media-link left-mail-link" data-mailid="{{Crypt::encrypt($mail->id)}}" data-emailid="{{$mail->email}}"  data-subject="{{$subject}}" data-message="{{$message}}" data-username="{{$mail->username}}" data-datetime="{{$mail->created_at}}" data-profilepic="{{$profilepic}}" data-totalmailfromuser="{{$mail->id}}">
                            <div class="media-left">
                                <img alt="" class="img-circle img-md" src="{{url('img/cache/profile/')}}/{{$profilepic}}"/>
                            </div>
                            <div class="media-body">
                                <span class="media-heading text-semibold">
                                   {{$mail->username}}
                                </span>
                                <span class="text-muted">
                                   {{ str_limit(strip_tags($subject), $limit = 40, $end = '...') }}
                                </span>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <!-- /latest messages -->
    </div>
</div>
<!-- /secondary sidebar -->
@endsection
        {{-- Content --}}
        @section('main')
<!-- Single line -->
<div id="email-page">

                        <!-- Single mail -->
                            <div class="panel panel-white" id="single-compose" style="display: none;">
                                <form class="mailcomposeform" action="{{url('admin/register')}}" method="POST" name="parsley-mail">
                                <!-- Mail toolbar -->
                                <div class="panel-toolbar panel-toolbar-inbox">
                                    <div class="navbar navbar-default">
                                        <ul class="nav navbar-nav visible-xs-block no-border">
                                            <li>
                                                <a class="text-center collapsed" data-toggle="collapse" data-target="#inbox-toolbar-toggle-single">
                                                    <i class="icon-circle-down2"></i>
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single">
                                            <div class="btn-group navbar-btn">
                                                <button type="submit" class="submitmail btn bg-blue"><i class="icon-checkmark3 position-left"></i> {{trans('mail.send_mail')}}</button>
                                            </div>

                                            <div class="btn-group navbar-btn">

                                                <button type="button" class="btn btn-default button-email-compose-cancel"><i class="icon-cross2"></i> <span class="hidden-xs position-right">{{trans('mail.cancel')}}</span></button>


                                            </div>

                                            <div class="pull-right-lg">
                                                <div class="btn-group navbar-btn">


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /mail toolbar -->


                                <!-- Mail details -->
                                <div class="mail-details-write">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td style="width: 150px">To:</td>
                                                <td class="no-padding">
                                                    <input type="text" name="to" id="to" class="tagsinput-typeahead form-control autocompleteusersforemail" required="required" data-parsley-required-message = "{{trans("all.at_least_one_reciepient_required")}}" placeholder="Add recipients" data-role="tagsinput" />
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>{{trans('mail.subject')}}:</td>
                                                <td class="no-padding"><input type="text" name="subject" class="form-control" required="required" placeholder="Add subject" data-parsley-required-message = "{{trans("all.specify_email_subject")}}"></td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /mail details -->


                                <!-- Mail container -->
                                <div class="mail-container-write">
                                    <div class="mailcomposer"></div>
                                </div>
                                <!-- /mail container -->



                            </form>
                            </div>
                            <!-- /single mail -->



<div class="panel panel-white" style="display: none;" id="singletab">
    <!-- Mail toolbar -->
    <div class="panel-toolbar panel-toolbar-inbox">
        <div class="navbar navbar-default">
            <ul class="nav navbar-nav visible-xs-block no-border">
                <li>
                    <a class="text-center collapsed" data-target="#inbox-toolbar-toggle-single" data-toggle="collapse">
                        <i class="icon-circle-down2">
                        </i>
                    </a>
                </li>
            </ul>
            <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single">
                <div class="btn-group navbar-btn">
                    <button id="back-to-mail-list" class="btn btn-default" >
                        <i class="icon-arrow-left13">
                        </i>
                        <span class="hidden-xs position-right">
                            {{trans('mail.back')}}
                        </span>
                    </button>
                    <a class="btn btn-default btn-mail-reply-single" data-mailid="" data-to="" href="#">
                        <i class="icon-reply">
                        </i>
                        <span class="hidden-xs position-right">
                            {{trans('mail.reply')}}
                        </span>
                    </a>
                    <a class="btn btn-default btn-mail-forward-single" data-mailid="" href="#">
                        <i class="icon-forward">
                        </i>
                        <span class="hidden-xs position-right">
                            {{trans('mail.forward')}}
                        </span>
                    </a>
                    <a class="btn btn-default btn-mail-delete-single" data-mailid="" href="#">
                        <i class="icon-bin">
                        </i>
                        <span class="hidden-xs position-right">
                            {{trans('mail.delete')}}
                        </span>
                    </a>

                </div>
                <div class="pull-right">
                    <p class="navbar-text">
                        <span id="datetimeplaceholder"></span>
                    </p>
                    <div class="btn-group navbar-btn">
                        <a class="btn btn-default" href="#" id="printThisEmail">
                            <i class="icon-printer">
                            </i>
                            <span class="hidden-xs position-right">
                                {{trans('mail.print')}}
                            </span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /mail toolbar -->
    <!-- Mail details -->
    <div class="media stack-media-on-mobile mail-details-read">
        <a class="media-left" href="#">
           <div id="profipicplaceholder"></div>
        </a>
        <div class="media-body">
            <h6 class="media-heading">
               <div id="subjectplaceholder"></div>
            </h6>
            <div class="letter-icon-title text-semibold">
                <div id="usernameplaceholder"></div>
                <a href="#">
                    &lt;<span id="emailplaceholder"></span>&gt;
                </a>
            </div>
        </div>
        <div class="media-right media-middle text-nowrap">
            <ul class="list-inline list-inline-condensed no-margin">
                <li>
                    <span class="btn bg-teal-400 btn-xs">
                        <div id="totalmailfromuserplaceholder"></div>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <!-- /mail details -->
    <!-- Mail container -->
    <div class="mail-container-read">
        <div id="messageplaceholder"></div>
    </div>
    <!-- /mail container -->
</div>
<div class="panel panel-white" id="maillist" style="display: none;">
    <div class="panel-heading">
        <h6 class="panel-title">
            {{trans('mail.my_inbox')}}
        </h6>
        <div class="heading-elements not-collapsible">
            <span class="label bg-blue heading-text">
                {{$unread_count}} {{trans('mail.unread_items')}}
            </span>
        </div>
    </div>
    <div class="panel-toolbar panel-toolbar-inbox">
        <div class="navbar navbar-default">
            <ul class="nav navbar-nav visible-xs-block no-border">
                <li>
                    <a class="text-center collapsed" data-target="#inbox-toolbar-toggle-single" data-toggle="collapse">
                        <i class="icon-circle-down2">
                        </i>
                    </a>
                </li>
            </ul>
            <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single">
                <div class="btn-group navbar-btn">
                    <button class="btn btn-default btn-icon btn-checkbox-all" type="button">
                        <input class="styled" type="checkbox"/>
                    </button>
                </div>
                <div class="btn-group navbar-btn">
                    <button class="btn btn-default button-email-compose" type="button">
                        <i class="icon-pencil7">
                        </i>
                        <span class="hidden-xs position-right">
                            {{trans('mail.compose')}}
                        </span>
                    </button>
                    <button class="btn btn-default deleteAllCheckedMails" disabled="true" type="button">
                        <i class="icon-bin">
                        </i>
                        <span class="hidden-xs position-right">
                            {{trans('mail.delete')}}
                        </span>
                    </button>

                </div>
                <div class="navbar-right">
                    <p class="navbar-text">
                        <span class="text-semibold">
                           {{trans('mail.page')}} {{$all_mail->currentPage()}}
                        </span>
                        {{trans('mail.with')}}
                        <span class="text-semibold">
                            {{$all_mail->perPage()}} {{trans('mail.items')}}
                        </span>
                    </p>
                    <div class="btn-group navbar-left navbar-btn">

                        {{ $all_mail->links() }}


                    </div>
                    <div class="btn-group navbar-btn">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
                            <i class="icon-cog3">
                            </i>
                            <span class="caret">
                            </span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-inbox">
            <tbody class="rowlink" data-link="row">
                @if($limit_mail>0)
                                    @foreach ($all_mail as $mail)

                                    @php
                                    if($mail->read === 'no'){
                                        $readClass = 'unread';
                                    }else{
                                        $readClass = 'read';
                                    }

                                    if(!isset($mail->profile) || $mail->profile === '600'){
                                        $profilepic = 'avatar-big.png';
                                    }else{
                                        $profilepic = $mail->profile;
                                    }

                                    $subject = preg_replace('/(\>)\s*(\<)/m', '$1$2', $mail->message_subject);
                                    $message = preg_replace('/(\>)\s*(\<)/m', '$1$2', $mail->message);

                                    @endphp
                <tr class="mail-link {{$readClass}}" data-mailid="{{Crypt::encrypt($mail->id)}}" data-emailid="{{$mail->email}}"  data-subject="{{$subject}}" data-message="{{$message}}" data-username="{{$mail->username}}" data-datetime="{{$mail->created_at}}" data-profilepic="{{$profilepic}}" data-totalmailfromuser="{{$mail->id}}">



                    <td class="table-inbox-checkbox rowlink-skip">
                        <input class="styled" type="checkbox"/>

                    </td>
                    <td class="table-inbox-star rowlink-skip">
                        <i class="icon-star-empty3 text-muted">
                        </i>
                    </td>
                    <td class="table-inbox-image">
                        <img alt="" class="img-circle img-xs" src="{{url('img/cache/profile/')}}/{{$profilepic}}"/>

                    </td>
                    <td class="table-inbox-name">
                        <div class="letter-icon-title text-default">
                            {{$mail->username}}
                        </div>
                    </td>
                    <td class="table-inbox-message">
                        <span class="table-inbox-subject">
                            {{ str_limit(strip_tags($subject), $limit = 40, $end = '...') }}
                                              -
                        </span>
                        <span class="table-inbox-preview">
                            {!! preg_replace('/\s+/', ' ',strip_tags($message)) !!}
                        </span>
                    </td>
                    <td class="table-inbox-attachment">
                        <!-- <i class="icon-attachment text-muted"></i> -->
                    </td>
                    <td class="table-inbox-time">
                        {{ Date('h:i A',strtotime($mail->created_at))}}
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="unread">
                    <td class="text-center">
                        {{ trans('mail.you_have_no_messages') }}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- <input type="text" value="Washington,Alaska" data-role="tagsinput" class="tagsinput-typeahead"> -->
    </div>
</div>




<div class="panel panel-white" id="outlist" style="display: none;">
    <div class="panel-heading">
        <h6 class="panel-title">
            {{trans('mail.outbox')}}
        </h6>
        <div class="heading-elements not-collapsible">
            <span class="label bg-blue heading-text">

            </span>
        </div>
    </div>
    <div class="panel-toolbar panel-toolbar-inbox">
        <div class="navbar navbar-default">
            <ul class="nav navbar-nav visible-xs-block no-border">
                <li>
                    <a class="text-center collapsed" data-target="#inbox-toolbar-toggle-single" data-toggle="collapse">
                        <i class="icon-circle-down2">
                        </i>
                    </a>
                </li>
            </ul>
            <div class="navbar-collapse collapse" id="inbox-toolbar-toggle-single">
                <div class="btn-group navbar-btn">
                    <button class="btn btn-default btn-icon btn-checkbox-all" type="button">
                        <input class="styled" type="checkbox"/>
                    </button>
                </div>
                <div class="btn-group navbar-btn">
                    <button class="btn btn-default button-email-compose" type="button">
                        <i class="icon-pencil7">
                        </i>
                        <span class="hidden-xs position-right">
                           {{trans('mail.compose')}}
                        </span>
                    </button>
                    <button class="btn btn-default deleteAllCheckedMails" disabled="true" type="button">
                        <i class="icon-bin">
                        </i>
                        <span class="hidden-xs position-right">
                            {{trans('mail.delete')}}
                        </span>
                    </button>

                </div>


                <div class="navbar-right">
                    <p class="navbar-text">
                        <span class="text-semibold">
                           {{trans('mail.page')}} {{$all_out_mail->currentPage()}}
                        </span>
                        {{trans('mail.with')}}
                        <span class="text-semibold">
                            {{$all_out_mail->perPage()}} {{trans('mail.items')}}
                        </span>
                    </p>
                    <div class="btn-group navbar-left navbar-btn">

                        {{ $all_out_mail->links() }}


                    </div>
                    <div class="btn-group navbar-btn">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
                            <i class="icon-cog3">
                            </i>
                            <span class="caret">
                            </span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-inbox">
            <tbody class="rowlink" data-link="row">
                @if($limit_out_mail>0)
                                    @foreach ($all_out_mail as $mail)

                                    @php
                                    if($mail->read === 'no'){
                                        $readClass = 'unread';
                                    }else{
                                        $readClass = 'read';
                                    }

                                    if(!isset($mail->profile) || $mail->profile === '600'){
                                        $profilepic = 'avatar-big.png';
                                    }else{
                                        $profilepic = $mail->profile;
                                    }

                                    $subject = preg_replace('/(\>)\s*(\<)/m', '$1$2', $mail->message_subject);
                                    $message = preg_replace('/(\>)\s*(\<)/m', '$1$2', $mail->message);

                                    @endphp
                <tr class="mail-link {{$readClass}}" data-mailid="{{Crypt::encrypt($mail->id)}}" data-emailid="{{$mail->email}}"  data-subject="{{$subject}}" data-message="{{$message}}" data-username="{{$mail->username}}" data-datetime="{{$mail->created_at}}" data-profilepic="{{$profilepic}}" data-totalmailfromuser="{{$mail->id}}">



                    <td class="table-inbox-checkbox rowlink-skip">
                        <input class="styled" type="checkbox"/>

                    </td>
                    <td class="table-inbox-star rowlink-skip">
                        <i class="icon-star-empty3 text-muted">
                        </i>
                    </td>
                    <td class="table-inbox-image">
                        <img alt="" class="img-circle img-xs" src="{{url('img/cache/profile/')}}/{{$profilepic}}"/>

                    </td>
                    <td class="table-inbox-name">
                        <div class="letter-icon-title text-default">
                            {{$mail->username}}
                        </div>
                    </td>
                    <td class="table-inbox-message">
                        <span class="table-inbox-subject">
                            {{ str_limit(strip_tags($subject), $limit = 40, $end = '...') }}
                                              -
                        </span>
                        <span class="table-inbox-preview">
                            {!! preg_replace('/\s+/', ' ',strip_tags($message)) !!}
                        </span>
                    </td>
                    <td class="table-inbox-attachment">
                        <!-- <i class="icon-attachment text-muted"></i> -->
                    </td>
                    <td class="table-inbox-time">
                        {{ Date('h:i A',strtotime($mail->created_at))}}
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="unread">
                    <td class="text-center">
                        {{ trans('mail.you_have_no_messages') }}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- <input type="text" value="Washington,Alaska" data-role="tagsinput" class="tagsinput-typeahead"> -->
    </div>
</div>


</div>

<!-- /single line -->
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
<script type="text/javascript">
$('document').ready(function(){

 

var hash_inbox = "/u/mail/inbox";
var hash_read = "/u/mail/read";
var hash_reply = "/u/mail/reply";
var hash_forward = "/u/mail/forward";
var hash_delete = "/u/mail/delete";
var hash_compose = "/u/mail/compose";
var hash_outbox = "/u/mail/outbox";



if(window.location.hash) {
    /* alert(window.location.hash);*/
    var current_hash = window.location.hash;
    var current_href = window.location.href;
    if(current_href.indexOf(hash_inbox) > -1){
        showMailList();
    }
    if(current_href.indexOf(hash_outbox) > -1){
        showOutBox();
    }
    if(current_href.indexOf(hash_compose) > -1){
        showMailCompose();
    }


}else{
 showMailList();
 parent.location.hash = hash_inbox;
}


 $('.table-inbox').on('click', '.mail-link td:not(".table-inbox-checkbox,.table-inbox-star")', function(e) {
    e.preventDefault();

    $('html, body').animate({
        scrollTop: $("body").offset().top
    }, 500);
    var this_context = $(this).parent('tr');
    var mail_id = this_context.data('mailid');
    var emailid = this_context.data('emailid');
    var mail_subject = this_context.data('subject');
    var mail_message = this_context.data('message');
    var mail_username = this_context.data('username');
    var mail_datetime = this_context.data('datetime');
    var mail_profilepic = this_context.data('profilepic');
    var total_mail_from_user = this_context.data('totalmailfromuser');


    $('#singletab #profipicplaceholder').html('<img alt="" class="img-circle img-xs" src='+CLOUDMLMSOFTWARE.siteUrl+'/img/cache/profile/'+mail_profilepic+'/>');

    $('#singletab #subjectplaceholder').html(mail_subject);
    $('#singletab #usernameplaceholder').html(mail_username);
    $('#singletab #emailplaceholder').html(emailid);
    $('#singletab #totalmailfromuserplaceholder').html(total_mail_from_user);
    $('#singletab #datetimeplaceholder').html(mail_datetime);
    $('#singletab #messageplaceholder').html(mail_message);

    $('#singletab .btn-mail-delete-single').attr('data-mailid','');
    $('#singletab .btn-mail-reply-single').attr('data-mailid','');
    $('#singletab .btn-mail-reply-single').attr('data-mail_username','');
    $('#singletab .btn-mail-forward-single').attr('data-mailid','');
    $('#singletab .btn-mail-forward-single').attr('data-mail_subject','');
    $('#singletab .btn-mail-forward-single').attr('data-mail_message','');

    $('#singletab .btn-mail-delete-single').attr('data-mailid',mail_id);
    $('#singletab .btn-mail-reply-single').attr('data-mailid',mail_id);
    $('#singletab .btn-mail-reply-single').attr('data-mail_username',mail_username);
    $('#singletab .btn-mail-forward-single').attr('data-mailid',mail_id);
    $('#singletab .btn-mail-forward-single').attr('data-mail_subject',mail_subject);
    $('#singletab .btn-mail-forward-single').attr('data-mail_message',mail_message);

    parent.location.hash = hash_read +'/'+mail_id;
    $.get(
    'mark-as-read/'+mail_id,
        { msg_id: mail_id },
        function(response) {
            this_context.removeClass('unread');
        });
    showMailSingle();


 });



 $('.left-mail-links').on('click', '.left-mail-link', function(e) {
    e.preventDefault();

    $('html, body').animate({
        scrollTop: $("body").offset().top
    }, 500);
    var this_context = $(this);
    var mail_id = this_context.data('mailid');
    var emailid = this_context.data('emailid');
    var mail_subject = this_context.data('subject');
    var mail_message = this_context.data('message');
    var mail_username = this_context.data('username');
    var mail_datetime = this_context.data('datetime');
    var mail_profilepic = this_context.data('profilepic');
    var total_mail_from_user = this_context.data('totalmailfromuser');


    $('#singletab #profipicplaceholder').html('<img alt="" class="img-circle img-xs" src='+CLOUDMLMSOFTWARE.siteUrl+'/img/cache/profile/'+mail_profilepic+'/>');

    $('#singletab #subjectplaceholder').html(mail_subject);
    $('#singletab #usernameplaceholder').html(mail_username);
    $('#singletab #emailplaceholder').html(emailid);
    $('#singletab #totalmailfromuserplaceholder').html(total_mail_from_user);
    $('#singletab #datetimeplaceholder').html(mail_datetime);
    $('#singletab #messageplaceholder').html(mail_message);

    $('#singletab .btn-mail-delete-single').attr('data-mailid','');
    $('#singletab .btn-mail-reply-single').attr('data-mailid','');
    $('#singletab .btn-mail-reply-single').attr('data-mail_username','');
    $('#singletab .btn-mail-forward-single').attr('data-mailid','');
    $('#singletab .btn-mail-forward-single').attr('data-mail_subject','');
    $('#singletab .btn-mail-forward-single').attr('data-mail_message','');

    $('#singletab .btn-mail-delete-single').attr('data-mailid',mail_id);
    $('#singletab .btn-mail-reply-single').attr('data-mailid',mail_id);
    $('#singletab .btn-mail-reply-single').attr('data-mail_username',mail_username);
    $('#singletab .btn-mail-forward-single').attr('data-mailid',mail_id);
    $('#singletab .btn-mail-forward-single').attr('data-mail_subject',mail_subject);
    $('#singletab .btn-mail-forward-single').attr('data-mail_message',mail_message);

    parent.location.hash = hash_read +'/'+mail_id;
    $.get(
    'mark-as-read/'+mail_id,
        { msg_id: mail_id },
        function(response) {
            this_context.removeClass('unread');
        });
    showMailSingle();


 });


$('#email-page').on('click', '.btn-mail-delete-single', function(e) {
    deleteMail($(this).data('mailid'));
    showMailList();
});

$('#email-page').on('click', '.btn-mail-reply-single', function(e) {

    $('#to').attr('value',$(this).data('mail_username'));
    $('#to').tagsinput('add', $(this).data('mail_username'));
    $('#to').tagsinput('refresh');
    showMailCompose();

});

$('#email-page').on('click', '.btn-mail-forward-single', function(e) {


    var subject = $(this).attr('data-mail_subject');
    var message = $(this).attr('data-mail_message');

    showMailCompose();
    $("input[name=subject]").val(subject);
    $(".mailcomposer").summernote('code',message);



});

$('#email-page').on('click', '#back-to-mail-list', function(e) {
    showMailList();
});

$('#email-page').on('click', '.button-email-compose', function(e) {
    showMailCompose();
});

$('#email-page').on('click', '.button-email-compose-cancel', function(e) {

    $('#to').attr('value','');
    $('#to').tagsinput('removeAll');
    $('#to').tagsinput('refresh');

    $("input[name=subject]").val('');
    $(".mailcomposer").summernote('code','');


    showMailList();
});

$('#email-page').on('click', '.submitmail', function(e) {
    e.preventDefault();
    $('.mailcomposeform').submit();
});



$('body').on('click', '#showOutBox', function(e) {
    e.preventDefault();
    showOutBox();
});


$('body').on('click', '#showInBox', function(e) {
    e.preventDefault();
    showMailList();
});


$('body').on('click', '#composeMailbtn', function(e) {
    e.preventDefault();
    showMailCompose();
});



function showMailSingle(){
    $('#singletab').show();
    $('#maillist').hide();
    $('#single-compose').hide();
    $('#outlist').hide();
}

function showMailList(){
    parent.location.hash = hash_inbox;
    $('#singletab').hide();
    $('#single-compose').hide();
    $('#maillist').show();
    $('#outlist').hide();
    $('#singletab #profipicplaceholder').html('');
    $('#singletab #subjectplaceholder').html('');
    $('#singletab #usernameplaceholder').html('');
    $('#singletab #emailplaceholder').html('');
    $('#singletab #totalmailfromuserplaceholder').html('');
    $('#singletab #messageplaceholder').html('');
}

function showOutBox(){
    parent.location.hash = hash_outbox;
    $('#singletab').hide();
    $('#single-compose').hide();
    $('#maillist').hide();
    $('#outlist').show();
    $('#singletab #profipicplaceholder').html('');
    $('#singletab #subjectplaceholder').html('');
    $('#singletab #usernameplaceholder').html('');
    $('#singletab #emailplaceholder').html('');
    $('#singletab #totalmailfromuserplaceholder').html('');
    $('#singletab #messageplaceholder').html('');
}

function showMailCompose(){
    parent.location.hash = hash_compose;
    $('#singletab').hide();
    $('#single-compose').show();
    $('#maillist').hide();
    $('#outlist').hide();
    $('#email-page .note-editor input[type=checkbox]').attr('name','note-editable-chkbox');
    $('#email-page textarea.note-codable').attr('required','required');
    $('#email-page textarea.note-codable').attr('data-parsley-required-message','Email cannot be empty');
}

function deleteMail(mailids){

                var block = $(this).parent().parent();

               $.ajax({
               url: CLOUDMLMSOFTWARE.siteUrl+'/user/mail/delete',
               data: {mailids: mailids},
               dataType: 'json',
               async: true,
               type: 'post',
               beforeSend: function() {


                    $(block).block({
                        message: '<i class="icon-spinner2 spinner"></i>',
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.8,
                            cursor: 'wait',
                            'box-shadow': '0 0 0 1px #ddd'
                        },
                        css: {
                            border: 0,
                            padding: 0,
                            backgroundColor: 'none'
                        }
                    });

               },
               success: function(response) {
                     $(block).unblock();


                     new PNotify({
                        text: 'Email Deleted',

                        type: 'success',
                        delay: 1000,
                        animate_speed: 'fast',
                        nonblock: {
                            nonblock: true
                        }
                    });


                    parent.location.hash = hash_inbox;
                    $('#singletab').hide();
                    $('#single-compose').hide();
                    $('#maillist').show();

               },error: function(response){

                new PNotify({
                        text: response.responseJSON.message,
                        type: 'danger',
                        delay: 1000,
                        animate_speed: 'fast',
                        nonblock: {
                            nonblock: true
                        }
                    });


                    $(block).unblock();
               }

           });


}


$(".mailcomposeform").submit(function(e) {
        e.preventDefault();


        var to = $(this).find('input[name=to]').val();
        var subject = $(this).find('input[name=subject]').val();
        var message = $(this).find('.note-editable[contenteditable=true]').html();
        console.log(message);
        var postvalues = {to: to, subject: subject, message: message};


        $('.mailcomposeform').parsley().validate();
            if ($('.mailcomposeform').parsley().isValid()) {

               var block = $(this).parent().parent();

               $.ajax({
               url: CLOUDMLMSOFTWARE.siteUrl+'/user/send',
               data: postvalues,
               dataType: 'json',
               async: true,
               type: 'post',
               beforeSend: function() {


                    $(block).block({
                        message: '<i class="icon-spinner2 spinner"></i>',
                        overlayCSS: {
                            backgroundColor: '#fff',
                            opacity: 0.8,
                            cursor: 'wait',
                            'box-shadow': '0 0 0 1px #ddd'
                        },
                        css: {
                            border: 0,
                            padding: 0,
                            backgroundColor: 'none'
                        }
                    });

               },
               success: function(response) {
                     $(block).unblock();
                     $('.mailcomposeform').find("input[type=text], textarea").val("");

                     new PNotify({
                        text: 'Email Sent',

                        type: 'success',
                        delay: 1000,
                        animate_speed: 'fast',
                        nonblock: {
                            nonblock: true
                        }
                    });


                    parent.location.hash = hash_inbox;
                    $('#singletab').hide();
                    $('#single-compose').hide();
                    $('#maillist').show();

               },error: function(response){

                new PNotify({
                        text: response.responseJSON.message,
                        /*// styling: 'brighttheme',*/
                        /*// icon: 'fa fa-file-image-o',*/
                        type: 'danger',
                        delay: 1000,
                        animate_speed: 'fast',
                        nonblock: {
                            nonblock: true
                        }
                    });


                    $(block).unblock();
               }

           });







            } else {

                console.log('not valid');
            }


    });



if ($('.mailcomposer').length) {
        $('.mailcomposer').summernote({
          callbacks: {
        onKeyup: function(e) {
        $('#email-page textarea.note-codable').text($('#email-page .note-editable').html());
    }
  }
    });
}


if ($('.btn-checkbox-all').length) {
    $(".btn-checkbox-all").click(function () {
        if ($(".btn-checkbox-all input[type=checkbox]").is(':checked')) {
            $(".table-inbox input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
                $(this).attr("checked", true);
                $(this).trigger("change");
                $.uniform.update();
            });
            analyzeCheckBoxes();

        } else {
            $(".table-inbox input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
                $(this).attr("checked", false);
                $.uniform.update();
                $(this).trigger("change");
            });
            analyzeCheckBoxes();
        }
    });




    var data = [];
    $(".table-inbox  input[type='checkbox']").on('change', function(){
        var state = $(this).prop("checked");
        var mailid = $(this).parent().parent().parent().parent().data('mailid');
        var idx = $.inArray(mailid, data);
        if (idx == -1) {
          data.push(mailid);
        } else {
          data.splice(idx, 1);
        }
        analyzeCheckBoxes();
    });

}




function analyzeCheckBoxes(){
     var checkboxs = $(".table-inbox input[type=checkbox]:checked");
     var i =0, box;
     $('.deleteAllCheckedMails').attr('disabled',true);
         while(box = checkboxs[i++]){
         if(!box.checked)continue;
         $('.deleteAllCheckedMails').attr('disabled',false);
         break;
         }
     }


if ($('.deleteAllCheckedMails').length) {
    $('#email-page').on('click', '.deleteAllCheckedMails', function(e) {
        var data =  [];
        email_ids = GetAllCheckedMails();
        if(deleteMail(email_ids)){
            location.reload();
        }else{
            location.reload();
        }
    });
}

if ($('#printThisEmail').length) {
    $('#email-page').on('click', '#printThisEmail', function(e) {
        $('#messageplaceholder').printThis();
    });
}



function GetAllCheckedMails(){

    var data = [];
    $(".table-inbox input[type=checkbox]:checked").each(function(){
        var mailid = $(this).parent().parent().parent().parent().data('mailid');
        data.push(mailid);
    });
    return data;
}





    if ($('.autocompleteusersforemail').length) {

$(function() {

    /*//
    // Typeahead implementation
    //*/

    /*// Matcher*/
    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            /*// an array that will be populated with substring matches*/
            matches = [];

            /*// regex used to determine if a string contains the substring `q`*/
            substrRegex = new RegExp(q, 'i');

            /*// iterate through the pool of strings and for any string that*/
            /*// contains the substring `q`, add it to the `matches` array*/
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {

                    /*// the typeahead jQuery plugin expects suggestions to a*/
                    /*// JavaScript object, refer to typeahead docs for more info*/
                    matches.push({ value: str });
                }
            });
            cb(matches);
        };
    };



    /*Attach typeahead*/

    $('.autocompleteusersforemail').tagsinput('input').typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'to',
            displayKey: 'value',

            source: function(query, syncResults, asyncResults) {
              $.ajax({
                url: "search/autocomplete",
                type: "POST",
                dataType: "json",
                data: { term: query  },
                success: function (data) {
                    asyncResults(data);
                }
              })


              }
        }
    ).bind('typeahead:selected', $.proxy(function (obj, datum) {
        this.tagsinput('add', datum.username);
        this.tagsinput('input').typeahead('val', '');
    }, $('.autocompleteusersforemail')));


});



    }







});
</script>
@stop
