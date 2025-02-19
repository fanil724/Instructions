<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructions extends Model
{
    use HasFactory;
    protected $table = 'instructions';

    protected $fillable = ['title', 'description', 'file', 'is_moderation', 'users_id'];

    public function complaint()
    {
        return $this->hasMany(ComplaintsInstructions::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
