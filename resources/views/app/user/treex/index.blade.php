@extends('app.user.layouts.default')

{{-- Web site Title --}}
@section('title') {{{ $title }}} :: @parent @stop

@section('styles') @parent
<link href="/assets/globals/css/tree/style.css" rel="stylesheet" type="text/css">
@stop

{{-- Content --}}
@section('main')



    <!-- <div class="page-header">
        <h3>
            {{$title}}
        </h3>
    </div> -->

            
                
              

<div class="row">

<div>

<div class="col-md-16 col-lg-16">
<div class="panel panel-default panel-block panel-title-block">
</div>







<div class="text-center">
            <div id="treediv">

                {!! $tree !!}

            </div>
        </div>  

</div>
        



                
              </div>
            </div>
         
        
  
@endsection
@section('scripts') @parent


 <script src="/assets/globals/js/tree/jquery-ui.js"></script>
 <script src="/assets/globals/js/tree/jquery.tree.js"></script>



<script>
            $(document).ready(function() {
               initializetree();
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
                App.init();
        </script>
@stop





