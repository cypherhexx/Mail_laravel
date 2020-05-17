@extends('app.user.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop


@section('styles')
<link href="{{ asset('assets/admin/css/plugins/main.css') }}" rel="stylesheet">
     
@endsection
{{-- Content --}}

@section('main')


<div class="panel panel-success" >
    <div class="panel-heading">
        
        <h4 class="panel-title">{{ trans('mail.your_inbox')}}</h4>
    </div>
    <div class="panel-body">
        @if($limit_mail>0)
        <ul class="messages-list" style="height:600px;overflow:scroll">
            <!--li class="messages-search">
                <form action="#" class="form-inline">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search messages...">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </li-->
            <input type="hidden" name="id" id="msg" value="{!!$all_mail[0]->message!!}">
            <input type="hidden" name="msg_from" id="msg_from" value="{{$all_mail[0]->from_id}}">
            <input type="hidden" name="msg_subject" id="msg_subject" value="{{$all_mail[0]->message_subject}}">
            <input type="hidden" name="msg_id" id="msg_id" value="{{$all_mail[0]->id}}"> 
            <input type="hidden" name="msg_time" id="msg_time" value="{{$all_mail[0]->created_at}}">
            @foreach ($all_mail as $mail)
            <li class="messages-item" name="a" item="msg{{$mail->id}}" id="anch1">
                <a class="a" name="a" id="msg{{$mail->id}}" href="#" value="{{$mail->message_subject}}">
                                        <input type="hidden" name="msg{{$mail->id}}1" id="msg{{$mail->id}}1" value="{{$mail->message}}">
                                            <span title="Mark as starred" class="messages-item-star"><i class="fa fa-star"></i></span>
                                            <img alt="" src="{{asset('public/appfiles/images/profileimages/thumbs/'.$mail->image)}}" class="messages-item-avatar">
                                            <span class="messages-item-from">{{$mail->from_id}}</span>
                                                <input type="hidden" name="msg{{$mail->id}}5" id="msg{{$mail->id}}5" value="{{$mail->created_at}}">
                                                <input type="hidden" name="msg{{$mail->id}}4" id="msg{{$mail->id}}4" value="{{$mail->username}}">
                                                <input type="hidden" name="msg{{$mail->id}}2" id="msg{{$mail->id}}2" value="{{$mail->from_id}}">
                                                <input type="hidden" name="msg{{$mail->id}}3" id="msg{{$mail->id}}3" value="{{$mail->message_subject}}">
                                                <input type="hidden" name="msg{{$mail->id}}6" id="msg{{$mail->id}}6" value="{{$mail->id}}">
                                            <div class="messages-item-time">
                                                <span class="text">{{ Date('h:i A',strtotime($mail->created_at))}}</span>
                                                <div class="messages-item-actions">
                                                    <!--a data-toggle="dropdown" title="Reply" href="#"><i class="fa fa-mail-reply"></i></a-->
                <div class="dropdown">
                    <!--a data-toggle="dropdown" title="Move to folder" href="#"><i class="fa fa-folder-open"></i></a-->
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="#">
                                <i class="fa fa-pencil"></i> {{trans('mail.mark_as_read')}}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-ban"></i> {{trans('mail.spam')}}
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-trash-o"></i> {{trans('mail.delete')}}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown">
                    <!--a data-toggle="dropdown" title="Attach to tag" href="#"><i class="fa fa-tag"></i></a-->
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="#"><i class="tag-icon red"></i>{{ trans('mail.important')}}</a>
                        </li>
                        <li>
                            <a href="#"><i class="tag-icon teal"></i>{{ trans('mail.work')}}</a>
                        </li>
                        <li>
                            <a href="#"><i class="tag-icon green"></i>{{ trans('mail.home')}}</a>
                        </li>
                    </ul>
                </div>
                    </div>
                    </div>
                    <span class="messages-item-subject">{!!$mail->message_subject!!} ...</span>
                    </a>
            </li>
    @endforeach
</ul>
<div class="messages-content">

    <div id="msg_details">
    </div>
    <div id="message">

    </div>
</div>
@else 

{{ trans('mail.no-data')}}  


@endif
</div>
</div>

   




@endsection

{{-- Scripts --}}

@section('scripts')
    @parent

    <script src="{{ asset('assets/globals/plugins/Gritter/js/jquery.gritter.js') }}"></script>
       
    <script type="text/javascript"> 
             App.init(); 
              
              var full_msg;
              var msg_from;
              var subject;
              var msg_id;
              var msg_time;
          $( document ).ready(function() {
             full_msg = $('#msg').val();
             msg_from = $('#msg_from').val();                   
             subject = $('#msg_subject').val();                 
             msg_id = $('#msg_id').val();
             msg_time=$('#msg_time').val(); 
                               
            $('#msg_details').html("@if($limit_mail>0)<div class='message-header'><div class='message-time'>"+msg_time+"</div><div class='message-from'>{{trans('mail.from')}} : "+msg_from+"</div><div class='message-to'>{{trans('mail.to')}}: {{Auth::user()->username}}</div><div class='message-subject'>"+subject+"</div><div class='message-actions'><a title='Move to trash' href='{!! url('user/trash/"+msg_id+"') !!}'><i class='fa fa-trash-o'></i></a><a title='Reply' href='{!! url('user/compose/"+msg_from+"') !!}'><i class='fa fa-reply'></i></a><!--a title='Reply to all' href='#''><i class='fa fa-reply-all'></i></a><a title='Forward' href='#'><i class='fa fa-long-arrow-right'></i></a--></div></div>@endif");
            $('#message').html("<div class='message-content'></div><p> <span style='padding: 0 40px'>&nbsp;</span>"+full_msg+"</p>");

             $(".messages-item").on('click',function(){  
        var id = $(this).attr('item') +"1";
        var id2 = $(this).attr('item') +"2";
        var id3 = $(this).attr('item') +"3";
        var id4=$(this).attr('item') +"4";
        var id5=$(this).attr('item') +"5";
        var id6=$(this).attr('item') +"6";
        full_msg = $("#"+id).val();
        var from = $("#"+id2).val(); 
        var to = $("#"+id4).val();
        var time =$("#"+id5).val();
        var m_id =$("#"+id6).val();
        subject = $("#"+id3).val(); 
        $('#msg_details').html("@if($limit_mail>0)<div class='message-header'><div class='message-time'>"+time+"</div><div class='message-from'>{{trans('mail.from')}} : "+from+"</div><div class='message-to'>{{trans('mail.to')}}:{{Auth::user()->username}}</div><div class='message-subject'>"+subject+"</div><div class='message-actions'><a title='Move to trash' href='{!! url('user/trash/"+m_id+"') !!}'><i class='fa fa-trash-o'></i></a><a title='Reply' href='{!! url('user/compose/"+from+"') !!}'><i class='fa fa-reply'></i></a><!--a title='Reply to all' href='#''><i class='fa fa-reply-all'></i></a><a title='Forward' href='#'><i class='fa fa-long-arrow-right'></i></a--></div></div>@endif");
        
         $('#message').html("<div class='message-content'></div><p> <span style='padding: 0 40px'>&nbsp;</span>"+full_msg+"</p>");
 });
     
    });


 
    </script>
    
@endsection
