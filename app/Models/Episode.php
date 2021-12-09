<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    protected $fillable = ['title', 'description', 'video_url', 'course_id'];

    /**
     * The users that belong the episode
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'completions', 'episode_id', 'user_id');
    }


}
