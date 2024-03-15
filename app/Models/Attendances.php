<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    protected $table = 'attendances';

    use HasFactory;

    protected $fillable = [
        'status', 
        'time_logged', 
        'user_id',
        'attendanceStatus'
    ];

    public function schedules()
    {
        return $this->belongsTo(Schedule::class, 'user_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}