<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentNotification extends Model
{
    protected $table="payment_notification";
    protected $fillable=['subject','mail_content','mail_status'];
}
