<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurable extends Model
{
    use HasFactory;

    public function solution(){
        return $this->belongsTo(Solution::class);
    }
}
