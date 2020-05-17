<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\ImageRepository;
use Illuminate\Support\Facades\Input;
use File;
use Storage;
use Response;
use App\Image;


class ImageController extends CloudMLMController
{
    protected $file;

    public function __construct(ImageRepository $ImageRepository)
    {

        $this->file = $ImageRepository;
    }



    public function postUpload(Request $request)
    {
        $data = $request->all();

        $response = $this->file->upload($data);
        return $response;

    }

    public function deleteUpload()
    {

        $filename = Input::get('id');

        if(!$filename)
        {
        return Response::json([
            'error' => true,
            'code'  => 404
        ], 200);
        }
        
        $sessionImage = Image::where('original_filename', 'like', $filename)->first();

        $allowed_filename = $sessionImage->filename;

        $delete = Storage::disk('images')->delete($allowed_filename);

        if( !empty($sessionImage))
        {
            $sessionImage->delete();
        }
        
        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);

    }


    public function getFile($file){
        $path = storage_path("files/images") .'\\'. $file;
        if(!File::exists($path)) abort(404);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }



    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }

   public function createUniqueFilename( $filename, $extension )
    {
        $exists =  Storage::disk('images')->exists($filename.'.'.$extension);
        if ( $exists )
        {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken . '.' . $extension;
        }
        return $filename . '.' . $extension;
    }


}
