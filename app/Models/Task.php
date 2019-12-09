<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'subject_id',
        'name',
        'description',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_task')->withPivot('status', 'created_at', 'updated_at', 'report')->withTimestamps();;
    }
}
