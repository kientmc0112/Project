<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'duration',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_subject')->withTimestamps();;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_subject')->withPivot('status', 'process', 'created_at')->withTimestamps();;
    }
}
