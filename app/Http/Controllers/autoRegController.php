<?php

namespace App\Http\Controllers;
use App\User;
use App\Tree_Table;
use App\Sponsortree;
use App\Commission;
use App\Voucher;
use App\PointTable;
use App\Settings;
use App\Ranksetting;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class autoRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$sponsor_id = user::checkUserAvailable($data['sponsor']); // from user table 
        $sponsor_id =1;//rand(2,20);
        $data = array();
        $data['reg_by']="free_join";
        $settings = Settings::getSettings();
        $binary_commission = $settings[0]->point_value;
        $point_value = $settings[0]->point_value;
        $tds =  $settings[0]->tds;
        $service_charge =  $settings[0]->service_charge;
        $amount_payable = $binary_commission - ($tds + $service_charge);
        //print_r($data);die();
        $data['firstname'] = 'Dijil'; 
        $data['lastname'] = 'Palakkal';
        $data['phone'] = 12345678;
        $data['email'] = 'dijilpalakkal';
        $data['username'] = 'user';
        $data['gender'] = 'Male';
        $data['country'] = 1;
        $data['state'] = 'state';
        $data['city'] = 'city';
        $data['password'] = 123456;
        
        for($i = 231; $i <= 270; $i ++){
            if( ($i % 2) ==0 )
                $leg="L";
            else 
                $leg="R";

            $data['leg'] = $leg;
        $userresult=User::create([
            'name' => $data['firstname'],
            'lastname' => $data['lastname'],
            'mobile' => $data['phone'],
            'email' => $data['email'].$i."@".'gmail.com',
            'username' => $data['username'].$i,
            'rank_id' => '1',
            'register_by' => $data['reg_by'],
            'gender' => $data['gender'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'password' => bcrypt($data['password'])
            ]);
        $placement_id = Tree_Table::getPlacementId($sponsor_id,$data['leg']); // from tree table
        $user_id = Tree_Table::vaccantId($placement_id,$data['leg']); // from tree table
        $tree = Tree_Table::find($user_id);
        $tree->user_id = $userresult->id;       
        $tree->sponsor = $sponsor_id;
        $tree->placement_id = $placement_id;
        $tree->leg = $data['leg'];
        $tree->type = 'yes';
        $tree->save(); 
        $sponsortreeid=Sponsortree::where('sponsor',$sponsor_id)->orderBy('id', 'desc')->take(1)->pluck('id');
       
        $sponsortree=Sponsortree::find($sponsortreeid);
        $sponsortree->user_id=$userresult->id;  
        $sponsortree->sponsor=$sponsor_id; 
        $sponsortree->type="yes"; 
        $sponsortree->save();
echo "username: ".$userresult->username;
        $sponsorvaccant = Sponsortree::createVaccant($sponsor_id,$sponsortree->position); // from tree table
        $uservaccant = Sponsortree::createVaccant($userresult->id,0); // from tree table        

        Tree_Table::createVaccant($tree->user_id);
        PointTable::create([
             'user_id' =>$userresult->id,
             'left_carry' =>0,
             'right_carry' =>0,
             'total_left' =>0,
             'total_right' =>0
            ]);
        user::insertToBalance($userresult->id);

        Commission::pointDistribution($userresult->id, $placement_id, $point_value, $tds, $service_charge,$data['leg']);

        Ranksetting::checkRankupdate($userresult->id,$userresult->username,$sponsor_id);
    }
    echo "completed";die();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
