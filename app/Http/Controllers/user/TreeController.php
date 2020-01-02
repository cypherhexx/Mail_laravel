<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Auth;
use Crypt;
use App\Tree_Table;
use App\Mail;
use App\User;
use App\Sponsortree;
use App\Http\Requests;
use App\Http\Requests\user\treeRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\user\UserAdminController;

class TreeController extends UserAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tree=Tree_Table::getTree(true ,Auth::user()->id,array(),0,5);

        $tree=Tree_Table::generateTree($tree);  

        $title =  trans('tree.binary_genealogy');    
        $userss = User::getUserDetails(Auth::id());
        $user = $userss[0];
        $base = trans('tree.base');
        $method = trans('tree.binary_genealogy');
        $sub_title = trans('tree.binary_genealogy');

        return view('app.user.tree.index',compact('tree','title','user','method','base','sub_title'));
    }
     public function indexPost(treeRequest $request,$levellimit)
    {

         $user_id = $request->data;        

        if($request->data = 1){
           $user_id =Auth::user()->id;
        }

        if($request->data != 1){
           $user_id =User:: where('username',$request->data)->value('id');
        }
        if($user_id == NULL){
            $user_id = Auth::user()->id;            
        }
        $tree = Tree_Table::getTree(true, $user_id,array(),0,$levellimit);
        return $tree = Tree_Table::generateTree($tree);


        $user_id=$request->data;
        $tree=Tree_Table::getTree(true ,$user_id,array(),0,5);      
        return $tree=Tree_Table::generateTree($tree);
    }

     public function treeUp(treeRequest $request,$levellimit)
    {
        $user_id = $request->data ;
        if(Auth::user()->id != $request->data)
            $user_id =Tree_Table::getFatherID($request->data);
        $tree=Tree_Table::getTree(true , $user_id,array(),0,$levellimit);
        return $tree=Tree_Table::generateTree($tree);
    } 

     public function sponsortree()
    {
         $tree=Sponsortree::getTree(true ,Auth::user()->id);
       
        $tree=Sponsortree::generateTree($tree);  
        $title =trans('tree.sponsor_tree');    
        $userss = User::getUserDetails(Auth::id());
        $user = $userss[0];
        $base = trans('tree.base');
        $method = trans('tree.sponsor_tree');
        $sub_title = trans('tree.sponsor_tree'); 

        return view('app.user.tree.sponsortree',compact('tree','title','user','base','method','sub_title'));
    }
     public function postSponsortree(treeRequest $request)
    {

        $user_id=($request->data == 1)?Auth::user()->id:0;

        $tree=Sponsortree::getTree(true ,$user_id);        
       
        return $tree=Sponsortree::generateTree($tree);
    }
    public function sponsortreeUp(treeRequest $request,$base64)
    {
          $user_id = Crypt::decrypt($base64) ;
        if(Auth::user()->id != $user_id)
            $user_id =Sponsortree::getSponsorID($user_id);

        
        $tree=Sponsortree::getTree(true , $user_id);
       
        return $tree=Sponsortree::generateTree($tree);
    } 

    public function sponsortreechild(treeRequest $request,$base64)
    {
         $user_id = Crypt::decrypt($base64) ;
        // if(Auth::user()->id != $request->data)
        //     $user_id =Sponsortree::getSponsorID($request->data);

        
        $tree=Sponsortree::getTree(true , $user_id);
       
        return $tree=Sponsortree::generateTree($tree);
    } 

        public function getsponsorchildrenByUserName(treeRequest $request,$username)
    {


        $user_id = User::where('username',$username)->value('id');

        $tree = Sponsortree::getTree(true, $user_id);

        return $tree = Sponsortree::generateTree($tree);
    }



    
    
    public function tree()
    {
        $title =trans('tree.tree_genealogy');
        $sub_title = trans('tree.your_tree_genealogy');
        $root = Crypt::encrypt('root');
        $userss = User::getUserDetails(Auth::id());
        $user = $userss[0];
        $base = trans('tree.tree_genealogy');
        $method = trans('tree.tree_genealogy');
        return view('app.user.tree.tree',compact('title','root','user','base','method','sub_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
     public function treedata(Request $request)
    {        
         $decrypted = Crypt::decrypt($request->id); 
         if($decrypted == "root"){
                 return '[{ 
                        "id": "'.Crypt::encrypt(Auth::user()->id).'", 
                        "text": "'.Auth::user()->username.'", 
                        "children": true, 
                        "type": "root",
                        "file": "treedata",                   
                        "state": {
                            "opened": true
                        }
                    }]';
         }         
       
        return json_encode(Sponsortree::getTreeJson($decrypted));
          
    }
}
