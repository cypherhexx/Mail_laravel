<?php

namespace App\Models\Helpdesk\kb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Define the Model of comment table.
 */
class Comment extends Model
{
    protected $table = 'kb_comment';
    protected $fillable = ['article_id', 'name', 'email', 'website', 'comment', 'status'];
}
