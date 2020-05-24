@extends('site') @section('title') {{{
$photo_album->name }}} :: @parent @stop @section('content')
<h3>{{{ $photo_album->name }}}</h3>

<div id="mygallery">
	@foreach($photos as $item) 
	<a
		href="{{{'../public/appfiles/photoalbum/'.$photo_album->folder_id.'/'.$item->filename }}}"
		data-lightbox="roadtrip"> <img alt="{{$item->name}}"
		src="{{{'../public/appfiles/photoalbum/'.$photo_album->folder_id.'/thumbs/'.$item->filename }}}" />
	</a> 
	@endforeach
</div>
@stop @section('scripts')
<script>
        $("#mygallery").justifiedGallery();
    </script>
@stop
