<?php
namespace App\Models\Helpdesk\kb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    protected $table = 'kb_category';
    protected $fillable = ['id', 'slug', 'name', 'description', 'status', 'parent', 'created_at', 'updated_at'];
}
