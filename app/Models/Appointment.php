<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'comment',
        'employee_id',
        'customer_id',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'usertype' === 'Employee');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'usertype' === 'Customer');
    }
}
