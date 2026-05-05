<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['title', 'description', 'deadline'];

    public function users()
    {
    return $this->belongsToMany(User::class)->withPivot('project_user');
    }

    public function tasks()
    {
    return $this->hasMany(Task::class);
    }

    // Mutator
    public function setTitleAttribute($value)
    {
    $this->attributes['title'] = ucfirst($value);
    }

}
