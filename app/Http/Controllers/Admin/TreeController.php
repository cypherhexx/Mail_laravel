<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\treeRequest;
use App\Mail;
use App\Sponsortree;
use App\Tree_Table;
use App\User;
use Auth;
use Crypt;
use Illuminate\Http\Request;

class TreeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {

        $title     = trans('tree.binary_genealogy');
        $sub_title = trans('tree.your_binary_genealogy');
        $base      = trans('tree.title');
        $method    = trans('tree.binary_genealogy');

        $tree         = Tree_Table::getTree(false, Auth::user()->id);
        $tree         = Tree_Table::generateTree($tree);
        $unread_count = Mail::unreadMailCount(Auth::id());
        $unread_mail  = Mail::unreadMail(Auth::id());
        $users        = User::getUserDetails(Auth::id());
        $user         = $users[0];

        return view('app.admin.tree.index', compact('tree', 'title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }

    public function getTree(treeRequest $request)
    {

        $user_id = $request->data;

        $tree = Tree_Table::getTree(true, $user_id);

        return $tree = Tree_Table::generateTree($tree);
    }


    public function treeUp(treeRequest $request)
    {
        $user_id = $request->data;
        if (Auth::user()->id != $request->data) {
            $user_id = Tree_Table::getFatherID($request->data);
        }

        $tree = Tree_Table::getTree(true, $user_id);

        return $tree = Tree_Table::generateTree($tree);
    }



    /**
     * Sponsor tree
     */

    public function sponsortree()
    {
        $tree = Sponsortree::getTree(true, Auth::user()->id);


        $tree = Sponsortree::generateTree($tree);
        $title     = trans('tree.sponsor_tree');
        $sub_title = trans('tree.your_sponsor_genealogy');

        $method = trans('tree.sponsor_tree');
        $base   = trans('tree.title');

       

        return view('app.admin.tree.sponsortree', compact('tree', 'title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }
    public function postSponsortree(treeRequest $request)
    {

         $user_id = $request->data;        

        if($request->data != 1){
           $user_id =User:: where('username',$request->data)->value('id');
        }
        if($user_id == NULL){
            $user_id = Auth::user()->id;            
        } 

        $tree = Sponsortree::getTree(true, $user_id);

        return $tree = Sponsortree::generateTree($tree);
    }

    public function getsponsortreeurl(treeRequest $request)
    {


        $user_id = $request->data;

        $tree = Sponsortree::getTree(true, $user_id);

        return $tree = Sponsortree::generateTree($tree);
    }

    public function getsponsorchildrenByUserName(treeRequest $request,$username)
    {


        $user_id = User::where('username',$username)->value('id');

        $tree = Sponsortree::getTree(true, $user_id);

        return $tree = Sponsortree::generateTree($tree);
    }

    public function sponsortreeUp($id)
    {


        $user_id = Crypt::decrypt($id);        
        if (Auth::user()->id != $user_id) {
            $user_id = Sponsortree::getSponsorID($user_id);
        }
        $tree = Sponsortree::getTree(true, $user_id);
        return $tree = Sponsortree::generateTree($tree);
       
 
    }

     public function sponsortreeChild($id){
           

          $user_id = urldecode(Crypt::decrypt($id));
        $tree = Sponsortree::getTree(true, $user_id);
        return $tree = Sponsortree::generateTree($tree);
    }

    public function tree()
    {
        $title        = trans('tree.tree_genealogy');
        $root         = Crypt::encrypt('root');
        $sub_title    = trans('tree.your_tree_genealogy');
        $unread_count = Mail::unreadMailCount(Auth::id());
        $unread_mail  = Mail::unreadMail(Auth::id());
        $users        = User::getUserDetails(Auth::id());
        $base         = trans('tree.tree_genealogy');
        $method       = trans('tree.tree_genealogy');
        $user         = $users[0];

        return view('app.admin.tree.tree', compact('title', 'root', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));
    }

    public function treedata(Request $request)
    {

        $decrypted = Crypt::decrypt($request->id);
        // dd($decrypted);
        if ($decrypted == "root") {
            return '[{
                        "id": "' . Crypt::encrypt(Auth::user()->id) . '",
                        "text": "' . Auth::user()->username . '",
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


    /**
     * [getChildrenGenealogy]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */    
    public function getChildrenGenealogy($id){
         return json_encode(Sponsortree::getTreeJson($id));
    }
    


}
