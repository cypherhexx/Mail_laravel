<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Response;
use Session;
use App\Note;
use Validator;
use Auth;
use Illuminate\Validation\Rule;

class NotesController extends AdminController
{

    public function index()
    {

        $title     = trans('Notes.notes');
        $sub_title = "Notes";
        $base      = "Notes";
        $method    = "Notes";

        $notes = Note::orderBy('created_at', 'desc')->paginate(12);

        return view('app.admin.notes.index', compact('title', 'sub_title', 'base', 'method', 'notes'));

    }




    public function postNote(Request $request)
    {

        
        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'description'          => 'required',
            'color'          => 'required',
        ]);

        if ($validator->fails()) {

             return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        } else {

            $note = Note::create([
                'user_id'        => Auth::id(),
                'title'          => $request->title,
                'description'    => $request->description,
                'color'          => $request->color
            ]);
            return Response::json([
            'error' => false,
            'code'  => 200,
            'color'  => $note->color,
            'id'  => $note->id,
            'title'  => $note->title,
            'description'  => $note->description,
            'date'  => $note->created_at->diffForHumans()
        ], 200);
        }

    }
    public function removeNote(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'note_id'         => 'required',
            Rule::exists('id')->where(function ($query) {
                $query->where('user_id', Auth::id());
            })
        ]);

         if ($validator->fails()) {

             return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        } else {

            $note_id = $request->note_id;
            $res       = Note::where('id', $note_id)
            ->where('user_id',Auth::id())
            ->delete();


            return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);
        }


        

    }



}
