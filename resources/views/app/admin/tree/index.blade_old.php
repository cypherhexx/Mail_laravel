
@extends('app.admin.layouts.default')


{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

@section('styles') @parent

<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Cabin:400,700,600"/>
<link href="/assets/globals/css/tree/style.css" rel="stylesheet" type="text/css">

@endsection


{{-- Content --}}
@section('main')
    <div class="panel panel-flat" >
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                
                                
                                
                                
                            </div>
                            <h4 class="panel-title">Binary genealogy</h4>
                        </div>
                        <div class="panel-body">
<div class="overflownopos">
            <div id="treediv">

                {!! $tree !!}

            </div>
        </div>  
        </div>  
        </div>  
@endsection

   		

@section('scripts')
@parent
 <script src="/assets/globals/js/tree/jquery-1.8.1.min.js"></script>
 <script src="/assets/globals/js/tree/jquery-ui.js"></script>
 <script src="/assets/globals/js/tree/jquery.tree.js"></script>


<script>
            $(document).ready(function() {              
               initializetree();
                 App.init();

            });


            function load(user){

            $.ajax({

            url: 'getTree',
                    type: 'post',
                    data: {'data':user, '_token': $('meta[name="csrf-token"]').attr('content')},
                    beforeSend: function(data){
                    $('#treediv').html('<img class="ajax-loader-img" src="http://mes.dev/assets/images/ajax-loader.gif"> ');
                    },
                    success: function(data){
                    $('#treediv').html(data);
                    initializetree();

                    }
                  });
                    }

                function initializetree(){
                    $('.tree').tree_structure({
                    'add_option': false,
                    'edit_option': false,
                    'delete_option': false,
                    'confirm_before_delete': false,
                    'animate_option': [false, 5],
                    'fullwidth_option': false,
                    'align_option': 'center',
                    'draggable_option': false 
                });
                    
                }
        </script>


@endsection
