<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranksetting extends Model
{
    protected $table="rank_setting";

    protected $fillable=['rank_name','top_up','quali_rank_id','quali_rank_count','rank_bonus','direct','sub_direct1','sub_direct2','sub_direct3','sub_direct4','sub_direct5','sub_direct6','sub_junior_direct1','sub_junior_direct2','sub_junior_direct3','sub_junior_direct4','sub_junior_direct5','sub_junior_direct6','gain','tree_level','referral_level'];


    public static function idToRankname($id){
    	return  self::where('id',$id)->value('rank_name');    	

    }
     public static function getUserRank($id){
    	$rank_id=User::where('id',$id)->value('rank_id');
    	return $rank_id;

    } 
    public static function maxRankId(){
    	return  self::max('id'); 

    }
    public static function checkRankupdate($user_id,$current_rank,$level = 1){
    	
    	 if($current_rank == self::maxRankId()){ return true; }


    	
    	$next_rank_details=self::find($current_rank+1);
        $quali_rank_count =0;
    	
        /* Total top up*/
        $total_top_up =PurchaseHistory::where('user_id','=',$user_id)->count();       
    	
        /* direct enrolls rank and count*/
             if($next_rank_details->quali_rank_id AND  $next_rank_details->quali_rank_count){

            $quali_rank_count=Tree_Table::where('sponsor',$user_id)
                                         ->join('users', 'tree_table.user_id', '=', 'users.id')
                                         ->where('users.rank_id','>=',$next_rank_details->quali_rank_id)
                                         ->count();
        }

;
      
        
        /* check for rank upgrade */

        if(($total_top_up >= $next_rank_details->top_up )  && ($quali_rank_count >= $next_rank_details->quali_rank_count)){


      
            $user=User::find($user_id);
            $user->rank_id=$next_rank_details->id;
            $user->save();

            $sponsor = User::find(Tree_Table::where('user_id','=',$user_id)->value('sponsor'));

            if($sponsor->id > 1 && $level == 1)
                return self::checkRankupdate($sponsor->id,$sponsor->rank_id ,2);
        }
        
        
        return true;

    }

    public static function updateUserRank($rank_id,$last_rank,$user_id,$remarks){
       
         return self::insertRankHistory($user_id,$rank_id,$last_rank,$remarks);
    } 
     public static function insertRankHistory($user_id,$rank_id,$last_rank,$remarks){
        // dd("1");

        User::where('id',$user_id)->update(['rank_id' => $rank_id]);
       return Rankhistory::create([
                "user_id"=>$user_id,
                "rank_id"=>$last_rank,
                "rank_updated"=>$rank_id,
                "remarks"=>$remarks,
                    ]);
    }


    public static function getthreeupline($upline_users,$level=1,$uplines){
     if ($level > 5) 
        return $uplines;  
   
     $upline=Sponsortree::where('user_id',$upline_users)->where('type','=','yes')->value('sponsor'); 

      if ($upline > 0)
          $uplines[]=$upline;

     if ($upline == 1) 
       
        return $uplines;  
    
     return SELF::getthreeupline($upline,++$level,$uplines);
   }
}
