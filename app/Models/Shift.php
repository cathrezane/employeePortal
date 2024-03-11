<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = "shifts";
    
    protected $casts = [
        'days' => 'json', // Ensure the 'days' attribute is cast to JSON
    ];

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'user_id',
        'workdays_id'
        // Add other fields as needed
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function workday()
    {
        return $this->belongsTo(Workdays::class); // Assuming a "workdays" table
    }

    public function workdays() {
        // Assuming 'days' is the JSON column containing workday IDs
        return $this->hasMany(Workdays::class, 'id')
            ->when($this->days, function ($query) {
                $query->whereIn('id', json_decode($this->days));
            });
    }

}   
