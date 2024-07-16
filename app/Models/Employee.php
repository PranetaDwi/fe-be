<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'address'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
