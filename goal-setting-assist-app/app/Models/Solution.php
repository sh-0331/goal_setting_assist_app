<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;
    public function goal() {
        return $this->belongsTo(Goal::class, 'goals_id');
    }
    public function measurable() {
        return $this->hasOne(Measurable::class);
    }
    public function milestones() {
        return $this->hasMany(Milestone::class);
    }
}
