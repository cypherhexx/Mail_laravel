@extends('app.admin.layouts.default') {{-- Web site Title --}} @section('title') {{{ $title }}} :: @parent @stop @section('styles') @parent @endsection {{-- Content --}} @section('main')
<style type="text/css">
    
</style>
<div class="panel panel-flat ">
    <div class="panel-heading">
        <h6 class="panel-title">{{trans('tree.sponsor_genealogy')}}<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
      <div id="searchsponsortreeholder" class="row mb-10">
            <div class="col-sm-12">
                <span class="input-group">   
                    <input type="text" class="form-control " id="key-word" name="key-word" placeholder="Search Member">
                    <input type="hidden" id="key_user_hidden" name="key_user_hidden" >
                    <span class="input-group-btn">                    
                        <button class="btn-icon btn btn-info" type="button" id="btn-filter-node"><i class="fa fa-search position-left"></i>{{trans('tree.search')}}  </button>
                    </span>
                <span class="input-group-btn">
                        <button class="btn btn-danger" type="button"  id="btn-cancel"><i class="icon-cross"></i></button>
                    </span>
                </span>
            </div>
        </div>
        <div class="row mb-10">
            <div class="col-lg-12">
                <div id="" class="input-group view-state panel-title">
                    <span class="input-group-addon">
                    <div class="checkbox checkbox-switch">
                  <label>
                      <input id="toggle-images" type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Images" data-off-text="No Images" class="switch-images" >
                  </label>
                 </div>
                  </span>
                <!--     <span class="input-group-addon">
                   <div class="checkbox checkbox-switch">
                  <label>
                      <input id="toggle-grid" type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Grid On" data-off-text="Grid Off" class="switch">                     
                  </label>
                 </div>
                  </span> -->
                    <span class="input-group-addon">

                    <button data-action="reloads" type="button" id="btn-restart-node" class="btn btn-default btn-ladda btn-ladda-spinner" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20"><span class="ladda-label"><i class="icon-spinner4 position-left"></i>{{trans('tree.reset_tree')}}</span></button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="tree-guide-bar col-sm-12">
                <div class="badge  bar bar-active ">{{trans('tree.active')}}</div>
                <div class="badge  bar bar-inactive ">{{trans('tree.inactive')}}</div>
                <div class="badge  bar bar-vacant ">{{trans('tree.vacant')}}</div>
            </div>
        </div>
        <div class="overflow" style="background-image:url('https://office.algolight.net/img/cache/original/genology-bg.jpg'); background-repeat: no-repeat; background-size:cover;">
            <div id="sponsortreediv" class="overflow">
            </div>
            <div class="hidden hide">
                {-- $tree --}
            </div>
        </div>
    </div>
</div>
@endsection