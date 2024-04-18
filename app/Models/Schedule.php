<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = "schedules";

    protected $fillable = [
        'user_id',
        'shift_id',
        'date',
        // Add other fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Shift model
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    // public function attendances()
    // {
    //     return $this->belongsTo(Attendances::class);
    // }

    // public function diffShift()
    // {
    //     return $this->belongsTo(Shift::class, 'shift_id');
    // }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id'); // Adjust foreign key if needed
    }
}
