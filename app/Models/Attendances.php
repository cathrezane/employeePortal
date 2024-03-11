<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 
        'time_logged', 
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules()
{
    return $this->belongsTo(Schedule::class, 'user_id'); // Adjust foreign key if needed
}
}
