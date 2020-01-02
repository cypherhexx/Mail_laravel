@extends('app.admin.layouts.default')
{{-- Web site Title --}}
@section('title') Member profile:: @parent
@stop
{{-- Content --}}
@section('main')
<!-- Notes grid -->
<h6 class="content-group text-semibold">
    Your Notes
    <small class="display-block">
        Notes you've added will be displayed here. you can delete or create new note in this page
    </small>
</h6>
<div class="row mt-30">
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">
                    Create a note
                    <a class="heading-elements-toggle">
                        <i class="icon-more">
                        </i>
                    </a>
                </h6>
                <div class="heading-elements">
                </div>
            </div>
            <div class="panel-body">
                <form action="#" class="notesform" data-parsley-validate="">
                    <div class="form-group">
                        <input class="form-control mb-15" cols="1" id="title" name="title" placeholder="Note title" required="" type="text"/>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control mb-15" cols="1" id="description" name="description" placeholder="Note content" required="" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        
                        <div class="btn-group" id="note-color" data-toggle="buttons">
					    <label class="btn btn-primary btn-xs">
					      <input type="radio" name="color" value="bg-primary" checked> primary </label>
					    <label class="btn btn-success btn-xs">
					      <input type="radio" name="color" value="bg-success">Success</label>
					    <label class="btn btn-info btn-xs">
					      <input type="radio" name="color" value="bg-info">Info</label>
					    <label class="btn btn-warning btn-xs">
					      <input type="radio" name="color" value="bg-warning">Warning</label>
					    <label class="btn btn-danger btn-xs">
					      <input type="radio" name="color" value="bg-danger">Danger</label>
						</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-6 col-sm-6 text-right">
                            <button class="submit-note btn btn-primary btn-labeled btn-labeled-right" type="button">
                                Save Note
                                <b>
                                    <i class="icon-circle-right2">
                                    </i>
                                </b>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row mt-30">

    <div class="col-sm-12">
    <div class="notes">

    	@if (!$notes->isEmpty())
    	

        @foreach($notes->chunk(4) as $notesgroup)
       <div class="row">
            @foreach($notesgroup as $note)
            <div class="each-note col-sm-3">
                <div class="panel {{$note->color}}">
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <i class=" icon-file-text3 no-edge-top mt-5">
                                </i>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading text-semibold">
                                    {{ strlen($note->title) > 15 ? substr($note->title,0,15)."..." : $note->title }} -
                                    <i class="text-xs">
                                        {{$note->created_at->diffForHumans()}}
                                    </i>
                                </h6>
                                {{ strlen($note->description) > 25 ? substr($note->description,0,25)."..." : $note->title }}
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer {{$note->color}} panel-footer-condensed">
                        <div class="heading-elements">
                            <button class="btn  btn-link btn-xs heading-text text-default btn-delete-note" data-id="{{$note->id}}" type="button">
                               
                                <i class="icon-trash text-size-small position-right">
                                </i>
                            </button>

                            <button class="btn  btn-link btn-xs heading-text text-default pull-right" data-target="#view-{{$note->id}}" data-toggle="modal" type="button">
                                View full note
                                <i class="icon-arrow-right14 position-right">
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="view-{{$note->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content {{$note->color}}">
                            <div class="modal-header {{$note->color}}">
                                <button class="close" data-dismiss="modal" type="button">
                                    ×
                                </button>
                                <h6 class="modal-title">
                                    {{$note->created_at->diffForHumans()}}                                   
                                </h6>
                            </div>
                            <div class="modal-body">
                                <h6 class="text-bold">
                                     {{$note->title}}
                                </h6>
                                <p>
                                    {{$note->description}}
                                </p>
                               
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-link" data-dismiss="modal" type="button">
                                    Close
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach

		{{ $notes->links() }}

		@else
		<div class="row">
		<div class="alert alert-info no-border">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
		<span class="text-semibold"></span> You haven't created any notes yet!.
		</div>

		</div>
		
		@endif

       


	
        

    </div>
    </div>
</div>


@endsection

@section('styles')
@parent
<style type="text/css">

</style>
@endsection

@section('scripts')
<script type="text/javascript">
 
</script>
@endsection
