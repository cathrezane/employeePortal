<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workdays extends Model
{
    use HasFactory;

    protected $table = 'workdays_tbl';

    protected $fillable = ['name'];

    // public function shifts()
    // {
    //     return $this->belongsTo(Shift::class, 'days', 'id'); // Specify foreign key relationship
    // }
}
