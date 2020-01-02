<?php
namespace App\Http\Controllers\Admin;
use App\Activity;
use App\Http\Controllers\Admin\AdminController;
use App\User;
use Auth;
use App\ProfileInfo;
class ActivityController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title     = trans('all.activities');
        $sub_title = trans('all.activities');
        //$unread_count  = Mail::unreadMailCount(Auth::id());
        //$unread_mail  = Mail::unreadMail(Auth::id());
        $base   = trans('all.activities');
        $method = trans('all.activities');
        $all_activities = ProfileInfo::select(array('users.id', 'users.name', 'users.username', 'activity_log.description', 'users.email', 'activity_log.created_at','profile_infos.profile'))
            ->join('users', 'users.id', '=', 'profile_infos.user_id')
            // ->join('users', 'users.id', '=', 'profile_infos.user_id')
            ->join('activity_log', 'activity_log.user_id', '=', 'profile_infos.user_id')
            ->where('admin', '<>', 1)           
            ->orderBy('activity_log.created_at', 'DESC')           
            ->paginate(30);
           
        return view('app.admin.activity.index', compact('title', 'sub_title', 'base', 'method', 'all_activities'));
    }

}
