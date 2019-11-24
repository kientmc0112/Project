<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'user_subject');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'user_course');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'user_task');
    }
}
