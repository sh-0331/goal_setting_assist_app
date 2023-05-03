<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;
    public function goal() {
        return $this->belongsTo(Goal::class);
    }
    public function measurable() {
        return $this->hasOne(Measurable::class);
    }
}
