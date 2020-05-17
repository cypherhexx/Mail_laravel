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
use Input;
use DB;
use Response;

use Illuminate\Http\Request;

class GenealogyTreeController extends AdminController
{
    /**
     * Display the page with tree holder.
     *
     * @return Response
     */

    public function index()
    {

        $title     = trans('tree.binary_genealogy');
        $sub_title = trans('tree.your_binary_genealogy');
        $base      = trans('tree.title');
        $method    = trans('tree.binary_genealogy');
        return view('app.admin.tree.index', compact('tree', 'title', 'unread_count', 'unread_mail', 'user', 'sub_title', 'base', 'method'));

    }


    public function getTree(treeRequest $request,$levellimit)
    {

        $user_id = $request->data;    
        //Get level limit from ajax options, if not specified, fall back to 5.    
        $levellimit = isset($request->levellimit) ? $request->levellimit : 5; 
        //If someone alternate levellimit to consume memory, dont allow that, fall back to 10 if its greater than 10.    
        if($levellimit > 10){
            $levellimit = 10;
        }
        if($request->data != 1){
           $user_id =User:: where('username',$request->data)->value('id');
        }
        if($user_id == NULL){
            $user_id = Auth::user()->id;            
        }
        //Added $levellimit to pass level limit to function. default is null, must pass the argument.
        $tree = Tree_Table::getTree(true, $user_id,array(),0,$levellimit);
        return $tree = Tree_Table::generateTree($tree);
    }


    
    /**
     * getChildrenGenealogy
     * @param  [var] $id [id of user]
     * @return [json]     [returns json data with children wrapper]
     */    
    public function getChildrenGenealogyByUserName($username,$levellimit){
        $user_id = User::where('username',$username)->value('id');
        $tree = Tree_Table::getTree(true, $user_id,array(),0,$levellimit);
        return $tree = Tree_Table::generateTree($tree);
    }    

    /**
     * getChildrenGenealogy
     * @param  [var] $id [id of user]
     * @return [json]     [returns json data with children wrapper]
     */    
    public function getChildrenGenealogy($id,$levellimit){
        $user_id = urldecode(Crypt::decrypt($id));  
        if($levellimit > 10){
            $levellimit = 10;
        }
        $tree = Tree_Table::getTree(true, $user_id,array(),0,$levellimit);
        return $tree = Tree_Table::generateTree($tree);
    }
    
    /**
     * getParentGenealogy
     * @param  [var] $id [id of user]
     * @return [json]     [returns json data with children wrapper]
     */    
    public function getParentGenealogy($id,$levellimit){
        $user_id = Crypt::decrypt($id);        
        if (Auth::user()->id != $user_id) {
            $user_id = Tree_Table::getFatherID($user_id);
        }
        $tree = Tree_Table::getTree(true, $user_id,array(),0,$levellimit);
        return $tree = Tree_Table::generateTree($tree);
    }
    

    public static function autocomplete(Request $request)
    {
    
    $term = $request->get('term');
    // dd($term);
    $results = array();
    
    $queries = DB::table('users')
        ->where('username', 'LIKE', '%'.$term.'%')
        ->orWhere('name', 'LIKE', '%'.$term.'%')
        ->orWhere('lastname', 'LIKE', '%'.$term.'%')
        // ->select('id')
        ->take(5)->get();
    
    foreach ($queries as $query)
    {

        $results[] = [ 'id' => $query->id, 'value' => $query->username. ' : '.$query->name.' '.$query->lastname,'user_id' => Crypt::encrypt($query->id),'username' => $query->username ];
    }
    return Response::json($results);

    }




}
