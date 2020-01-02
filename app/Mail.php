<?php

namespace App;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mail extends Model
{
	protected $table = 'mail_table';
  protected $fillable = ['from_id','to_id', 'message','message_subject','2005-12-1','2005-12-1'];
	use SoftDeletes;
    protected $dates = ['deleted_at'];
    public static function getAllMail($admin_id){
      $allMessages =  DB::table('mail_table')->whereNull('deleted_at')->whereNotIn('from_id',[$admin_id])->orderBy('created_at', 'desc')->get();
      $message_count = count($allMessages);
      for($i = 0;$i < $message_count; $i++){
      	$allMessages[$i]->from_id = User::userIdToName($allMessages[$i]->from_id);
      	$allMessages[$i]->full_message = substr($allMessages[$i]->message, 0, 30);
      }
      return $allMessages;
    }

     public static function getOutBoxMail($id){
       $allMessages =  Mail::select('profile_infos.image','users.username' ,'mail_table.*')
            ->join('users' ,'users.id','=','mail_table.to_id')
            ->join('profile_infos','profile_infos.user_id','=','mail_table.to_id')
            ->whereNull('mail_table.deleted_at')->where('mail_table.from_id',[$id])->orderBy('mail_table.created_at', 'desc')->simplepaginate(10, ['*'], 'outbox');;
      $message_count = count($allMessages);
      // dd($allMessages);
      for($i = 0;$i < $message_count; $i++){
        $allMessages[$i]->from_id = User::userIdToName($allMessages[$i]->from_id);
        $allMessages[$i]->full_message = substr($allMessages[$i]->message, 0, 30);
        }
      return $allMessages;;
    }
    public static function getMyMail($user_id){
      $messages = Mail::select('profile_infos.profile','users.username','users.email' ,'mail_table.*')
          ->join('users' ,'users.id','=','mail_table.from_id')
          ->join('profile_infos','profile_infos.user_id','=','mail_table.from_id')
          ->whereNull('mail_table.deleted_at')->where('mail_table.to_id',[$user_id])->orderBy('created_at', 'desc')->simplepaginate(10, ['*'], 'inbox');;
      $message_count = count($messages);

      


      for($i = 0;$i < $message_count; $i++){
        $messages[$i]->from_id = User::userIdToName($messages[$i]->from_id);
        $messages[$i]->full_message = substr($messages[$i]->message, 0, 30);
      }
      return $messages;
    }
    public static function perMail(){
        $all_mail_count = Self::completeMail();
        $my_mail = Self::getMyMail(Auth::user()->id);
        $my_mail_count = count($my_mail);
        $per_mail = 0;
        if($all_mail_count>0)
        $per_mail = ($my_mail_count/$all_mail_count)*100;
        return $per_mail;
    }
    public static function completeMail(){
      $allMessages =  DB::table('mail_table')->get();
      
      return count($allMessages);
    }

    public static function unreadMailCount($user_id){
      $unread_messages = DB::table('mail_table')->whereNull('deleted_at')->where('read','no')->where('to_id',[$user_id])->get();
      return count($unread_messages);
    }
    public static function chageMailStatus($mail_id){
       DB::table('mail_table')
            ->where('id', $mail_id)
            ->update(['read' => 'yes']);
    }
    public static function unreadMail($user_id){
      $unread_messages = DB::table('mail_table')->join('users', 'users.id', '=', 'mail_table.from_id')->whereNull('mail_table.deleted_at')->where('mail_table.read','no')->where('mail_table.to_id',[$user_id])->get();
      //DB::table('users')->join('tree_table', 'tree_table.user_id', '=', 'users.id')->where('tree_table.sponsor', '=', Auth::user()->id)->get();
      //print_r($unread_messages);die();

      return $unread_messages;
    }
}
