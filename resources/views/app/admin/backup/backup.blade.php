@extends('app.admin.layouts.default')

{{-- Web site Title --}}
@section('title')  @parent
@stop


@section('styles')
@endsection

{{-- Content --}}
@section('main')




   <h3>Administer Database Backups</h3>
    <div class="row">
        <div class="col-xs-12 clearfix">
            <a id="create-new-backup-button" href="{{ url('admin/backup/create') }}" class="btn btn-primary pull-right"
               style="margin-bottom:2em;"><i
                    class="fa fa-plus"></i> Create New Backup
            </a>
        </div>
        <div class="col-xs-12">
            @if (count($backups))

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>File</th>
                        <th>Size</th>
                        <th>Date</th>
                        <th></th>
                    
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($backups as $backup)
                        <tr>
                            <td>{{ $backup['file_name'] }}</td>

                            
                            <td>@php echo App\Http\Controllers\Admin\SettingsController::humanFilesize($backup['file_size']); @endphp</td>

                            <td> 

                                 {{date(" d F, Y, h:ia", $backup['last_modified'])}}
                            </td>
                          
                            <td class="text-right">
                                <a class="btn btn-xs btn-default"
                                   href="{{ url('admin/backup/download/'.$backup['file_name']) }}"><i
                                        class="fa fa-cloud-download"></i></a>
                                <a class="btn btn-xs btn-danger" data-button-type="delete"
                                   href="{{ url('admin/backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                                    </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="well">
                    <h4>There are no backups</h4>
                </div>
            @endif
        </div>
    </div>
  
@stop

{{-- Scripts --}}
@section('scripts')
    @parent
 
    
@stop
