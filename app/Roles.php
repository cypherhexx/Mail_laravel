<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model {
    
    use Notifiable; 
    protected $table = 'roles';
    protected $fillable=["role_name","link","submenu_count","is_root","parent_id","main_role","icon","role_no"];

}