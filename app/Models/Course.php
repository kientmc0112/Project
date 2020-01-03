<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'category_id',
        'image',
        'name',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'course_subject')->withTimestamps();
        // ->orderBy('updated_at', 'DESC')
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_course')->withPivot('status', 'user_id', 'process')->withTimestamps();
    }
}
