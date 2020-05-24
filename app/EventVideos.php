<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cohensive\Embed\Facades\Embed;


class EventVideos extends Model
{
	use SoftDeletes;
    protected $table = 'event_videos';
      protected $fillable = ['title','type','url'];


	  public static function getVideoHtmlAttribute($video){

        $embed = Embed::make($video)->parseUrl();
        if (!$embed)
            return null;
        $embed->setAttribute(['width' => 400]);
        return $embed->getHtml();
	  }
}
