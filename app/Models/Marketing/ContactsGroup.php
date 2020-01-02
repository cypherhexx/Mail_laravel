<?php

namespace App\Models\Marketing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactsGroup extends Model
{
    

    use SoftDeletes ;

    protected $table = 'email_marketing_contacts_group';
    protected $fillable = ['name','description'];
}
