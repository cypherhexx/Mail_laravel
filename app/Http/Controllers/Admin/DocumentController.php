<?php

namespace App\Http\Controllers\Admin;
use App\DocumentUpload;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;
use Response;
use Session;

use Auth;

class DocumentController extends AdminController
{

    public function upload()
    {

        $title     = trans('ticket_config.file_upload');
        $sub_title = "File -upload";
        $base      = "File -upload";
        $method    = "File -upload";

        $uploads = DocumentUpload::paginate(10);

        return view('app.admin.documents.documentsupload', compact('title', 'sub_title', 'base', 'method', 'uploads'));

    }

    public function uploadfile(Request $request)
    {

      $validator = Validator::make($request->all(), [
            'file'   => 'mimes:doc,pdf,docx,ppt,pptx,png,jpeg,jpg',
            'between'=> '0,500000'
        ]);

        if ($validator->fails()) {
            Session::flash('flash_notification', array('level' => 'error', 'message' => trans('ticket_config.uploaded_failed')));
            return Redirect::back();
        }
        else{
      

            if (Input::hasFile('file')) {

            $destinationPath = public_path() . '/assets/uploads';
            $extension       = Input::file('file')->getClientOriginalExtension();
            $fileName        = rand(000011111, 99999999999) . '.' . $extension;
            Input::file('file')->move($destinationPath, $fileName);

            DocumentUpload::create([
                'file_title' => $request->title,
                'name'       => $fileName,
            ]);

            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.uploaded_success')));
            return Redirect::back();
        }

        }


        
        Session::flash('flash_notification', array('level' => 'danger', 'message' => trans('ticket_config.no_file')));
        return Redirect::action('Admin\DocumentController@upload');

    }
    public function deletedocument(Request $request)
    {

        $requestid = $request->requestid;
        $res       = DocumentUpload::where('id', $requestid)->delete();
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.document_details')));
        return Redirect::action('Admin\DocumentController@upload');

    }

    public function updatedocument(Request $request)
    {




        if (Input::hasFile('file')) {
            $requestid = $request->requestid;

            $destinationPath = public_path() . '/assets/uploads';
            $extension       = Input::file('file')->getClientOriginalExtension();
            $fileName        = rand(000011111, 99999999999) . '.' . $extension;


      
      
                $mimetype = File::mimeType($file);
                $filesize = File::size($file);



                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);
                $filename = $this->sanitize($originalNameWithoutExt);
                $allowed_filename = $this->createUniqueFilename( $filename, $extension );
                
                if(substr($file->getMimeType(), 0, 5) == 'image') {
                    
                    $uploadSuccess1 = $this->original( $file, $allowed_filename, $type  );             
                    if( !$uploadSuccess1 ) {
                        return Response::json([
                            'error' => true,
                            'message' => 'Server error while uploading',
                            'code' => 500
                        ], 500);
                    }
                }else{            
                    $uploadSuccess = $this->originalNoImage( $file, $allowed_filename, $type  );
                    if( !$uploadSuccess ) {
                        return Response::json([
                            'error' => true,
                            'message' => 'Server error while uploading',
                            'code' => 500
                        ], 500);
                    }
                }


            Input::file('file')->move($destinationPath, $fileName);

            DocumentUpload::where('id', $requestid)->update(array('file_title' => $request->file_title, 'name' => $fileName));
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.document_updated')));
            return Redirect::action('Admin\DocumentController@upload');
        } else {
            $requestid = $request->requestid;
            DocumentUpload::where('id', $requestid)->update(array('file_title' => $request->file_title));
            Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.document_updated')));
            return Redirect::action('Admin\DocumentController@upload');

        }

    }

    public function getDownload(Request $request)
    {
        $name    = $request->name;
        $file    = public_path() . "/assets/uploads/" . $request->name;
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download($file, $request->name, $headers);
        //dd($name);
    }

     public function document_delete($id)
    {
        
        $name = DocumentUpload::where('id',$id)->value('name');
        $documents=DocumentUpload::where('id',$id)->delete();
        $changedby =Auth::user()->username;
        
        // Activity::add("$changedby deleted  document ","$name was deleted by $changedby ","Documents");
        Session::flash('flash_notification', array('level' => 'success', 'message' => trans('ticket_config.document_deleted_successfully')));
        return redirect()->back();

    }
   

}
