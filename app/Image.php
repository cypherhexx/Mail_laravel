<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Image extends Model
{
	protected $table = 'images';

    public static $rules = [
        'file' => 'required|mimes:png,gif,jpeg,jpg'
    ];
    public static $messages = [
        'file.mimes' => 'Uploaded file is not in allowed format. Only png,gif,jpeg files are allowed',
        'file.required' => 'File is required'
    ];


    public function profile()
    {
        return $this->belongsTo('App\ProfileInfo','user_id', 'author');
    }

}
