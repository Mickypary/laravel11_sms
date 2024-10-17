<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\User;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = ['pr_id', 'year', 'balance', 'amt_paid'];

    public function pr()
    {
        return $this->belongsTo(PaymentRecord::class, 'pr_id');
    }
}
