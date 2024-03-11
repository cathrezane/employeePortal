<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationsManager extends Model
{
    use HasFactory;

    protected $table = 'operationsmanager_tbl';

    protected $fillable = ['name'];
}
