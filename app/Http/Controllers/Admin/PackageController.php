<?php

namespace App\Http\Controllers\Admin;

use App\DirectSposnor;
use App\Http\Controllers\Admin\AdminController;
use App\LeadershipBonus;
use App\MatchingBonus;
use App\Packages;
use App\Settings;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Response;

class PackageController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings  = Packages::all();
        $title     = trans('packages.plan_settings');
        $sub_title = trans('packages.plan_settings');
        $base      = trans('packages.settings');
        $method    = trans('packages.plan_settings');
        $userss    = User::getUserDetails(Auth::id());
        $user      = $userss[0];
        return view('app.admin.packages.index', compact('title', 'settings', 'user', 'sub_title', 'base', 'method'));
    }

    public function update(Request $request)
    {
        $package = Packages::find($request->pk);

        $variable = $request->name;

        $package->$variable = $request->value;

        if ($package->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }

    }

    public function bonus()
    {

        $item      = Settings::find(1);
        $title     = trans('ticket_config.bonus_management');
        $sub_title = trans('packages.bonus_management');
        $base      = trans('packages.settings');
        $method    = trans('packages.bonus_management');
        $userss    = User::getUserDetails(Auth::id());
        $user      = $userss[0];
        $settings  = LeadershipBonus::join('packages', 'packages.id', '=', 'leader_ship.package_id')
            ->select('leader_ship.*', 'packages.package')
            ->get();

        $matching_bonus = MatchingBonus::join('packages', 'packages.id', '=', 'matching_bonus.package_id')->select('matching_bonus.*', 'packages.package')->get();

        return view('app.admin.packages.bonus', compact('title', 'user', 'sub_title', 'base', 'method', 'item', 'settings', 'direct_sponsor', 'matching_bonus'));
    }

    public function updateleadership(Request $request)
    {
        $package = LeadershipBonus::find($request->pk);

        $variable = $request->name;

        $package->$variable = $request->value;

        if ($package->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }

    }

    public function updategroupsales(Request $request)
    {
        $package = MatchingBonus::find($request->pk);

        $variable = $request->name;

        $package->$variable = $request->value;

        if ($package->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }

    }

    public function updatereferbonus(Request $request)
    {
        $package = DirectSposnor::find($request->pk);

        $variable = $request->name;

        $package->$variable = $request->value;

        if ($package->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }

    }

}
