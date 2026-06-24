<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_tag', 'title', 'content', 'pinned'];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
